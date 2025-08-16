<?php

namespace App\Http\Controllers;

use App\Models\DanaDesa;
use App\Models\Keuangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KeuanganController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // index: admin lihat semua, staff lihat miliknya
    public function index(Request $request)
    {
        $user = $request->user();

        if ($user->role === 'admin') {
            $keuangans = Keuangan::with(['user','danaDesa'])->orderBy('tanggal','desc')->paginate(15);
        } else {
            $keuangans = Keuangan::with('danaDesa')->where('user_id', $user->id)->orderBy('tanggal','desc')->paginate(15);
        }

        return view($user->role === 'admin' ? 'admin.keuangan.index' : 'staff.keuangan.index', compact('keuangans'));
    }

    public function create(Request $request)
    {
        $user = $request->user();
        $danas = DanaDesa::orderBy('tahun','desc')->get();
        return view($user->role === 'admin' ? 'admin.keuangan.create' : 'staff.keuangan.create', compact('danas'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'jumlah' => 'required|numeric',
            'tanggal' => 'required|date',
            'sumber' => 'nullable|string|max:255',
            'tujuan' => 'nullable|string|max:255',
            'total' => 'nullable|numeric',
            'keterangan' => 'nullable|string',
            'dana_desa_id' => 'nullable|exists:dana_desa,id',
        ]);

        $data['user_id'] = $request->user()->id;

        // jika ada dana_desa_id, cek saldo dan kurangi dana secara aman
        if (!empty($data['dana_desa_id'])) {
            DB::beginTransaction();
            try {
                $dana = DanaDesa::where('id', $data['dana_desa_id'])->lockForUpdate()->first();
                if (!$dana) {
                    DB::rollBack();
                    return back()->withInput()->withErrors(['dana_desa_id' => 'Dana desa tidak ditemukan.']);
                }

                if ($dana->jumlah < $data['jumlah']) {
                    DB::rollBack();
                    return back()->withInput()->withErrors(['jumlah' => 'Jumlah melebihi saldo dana desa yang tersedia.']);
                }

                Keuangan::create($data);

                $dana->jumlah = $dana->jumlah - $data['jumlah'];
                $dana->save();

                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                throw $e;
            }
        } else {
            // tanpa dana, hanya simpan catatan
            Keuangan::create($data);
        }

        return redirect()->route($request->user()->role === 'admin' ? 'admin.keuangan.index' : 'staff.keuangan.index')
                         ->with('success', 'Catatan keuangan berhasil disimpan.');
    }

    public function show(Keuangan $keuangan)
    {
        $this->authorizeView($keuangan);
        return view($keuangan->user->role === 'admin' ? 'admin.keuangan.show' : 'staff.keuangan.show', compact('keuangan'));
    }

    public function edit(Keuangan $keuangan)
    {
        $this->authorizeView($keuangan);
        $danas = DanaDesa::orderBy('tahun','desc')->get();
        $view = auth()->user()->role === 'admin' ? 'admin.keuangan.edit' : 'staff.keuangan.edit';
        return view($view, compact('keuangan','danas'));
    }

    public function update(Request $request, Keuangan $keuangan)
    {
        $this->authorizeView($keuangan);

        $data = $request->validate([
            'jumlah' => 'required|numeric',
            'tanggal' => 'required|date',
            'sumber' => 'nullable|string|max:255',
            'tujuan' => 'nullable|string|max:255',
            'total' => 'nullable|numeric',
            'keterangan' => 'nullable|string',
            'dana_desa_id' => 'nullable|exists:dana_desa,id',
        ]);

        // atur perubahan pada dana jika ada perubahan jumlah atau dana_desa_id
        $oldJumlah = $keuangan->jumlah;
        $oldDanaId = $keuangan->dana_desa_id;
        $newJumlah = $data['jumlah'];
        $newDanaId = $data['dana_desa_id'] ?? null;

        DB::beginTransaction();
        try {
            if ($oldDanaId && $oldDanaId == $newDanaId) {
                // sama dana, cukup sesuaikan selisih
                $dana = DanaDesa::where('id', $oldDanaId)->lockForUpdate()->first();
                if (!$dana) {
                    DB::rollBack();
                    return back()->withInput()->withErrors(['dana_desa_id' => 'Dana desa lama tidak ditemukan.']);
                }
                $availableAfterRestore = $dana->jumlah + $oldJumlah; // jika kita kembalikan dulu
                if ($availableAfterRestore < $newJumlah) {
                    DB::rollBack();
                    return back()->withInput()->withErrors(['jumlah' => 'Jumlah melebihi saldo dana desa yang tersedia setelah perubahan.']);
                }
                $dana->jumlah = $availableAfterRestore - $newJumlah;
                $dana->save();
            } else {
                // jika berbeda, kembalikan ke dana lama dulu
                if ($oldDanaId) {
                    $oldDana = DanaDesa::where('id', $oldDanaId)->lockForUpdate()->first();
                    if (!$oldDana) {
                        DB::rollBack();
                        return back()->withInput()->withErrors(['dana_desa_id' => 'Dana desa lama tidak ditemukan.']);
                    }
                    $oldDana->jumlah = $oldDana->jumlah + $oldJumlah;
                    $oldDana->save();
                }

                // lalu tarik dari dana baru jika ada
                if ($newDanaId) {
                    $newDana = DanaDesa::where('id', $newDanaId)->lockForUpdate()->first();
                    if (!$newDana) {
                        DB::rollBack();
                        return back()->withInput()->withErrors(['dana_desa_id' => 'Dana desa baru tidak ditemukan.']);
                    }
                    if ($newDana->jumlah < $newJumlah) {
                        DB::rollBack();
                        return back()->withInput()->withErrors(['jumlah' => 'Jumlah melebihi saldo dana desa yang tersedia.']);
                    }
                    $newDana->jumlah = $newDana->jumlah - $newJumlah;
                    $newDana->save();
                }
            }

            $keuangan->update($data);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        return redirect()->route(auth()->user()->role === 'admin' ? 'admin.keuangan.index' : 'staff.keuangan.index')
                         ->with('success', 'Catatan keuangan berhasil diperbarui.');
    }

    public function destroy(Keuangan $keuangan)
    {
        $this->authorizeView($keuangan);

        // kembalikan dana jika catatan terkait dana desa
        if ($keuangan->dana_desa_id) {
            DB::beginTransaction();
            try {
                $dana = DanaDesa::where('id', $keuangan->dana_desa_id)->lockForUpdate()->first();
                if ($dana) {
                    $dana->jumlah = $dana->jumlah + $keuangan->jumlah;
                    $dana->save();
                }
                $keuangan->delete();
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                throw $e;
            }
        } else {
            $keuangan->delete();
        }

        return back()->with('success', 'Catatan keuangan berhasil dihapus.');
    }

    protected function authorizeView(Keuangan $keuangan)
    {
        $user = auth()->user();
        if ($user->role === 'admin') return true;
        if ($keuangan->user_id === $user->id) return true;
        abort(403);
    }
}
