<?php

namespace App\Http\Controllers;

use App\Models\DanaDesa;
use App\Models\Keuangan;
use Illuminate\Http\Request;

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

        Keuangan::create($data);

        // NOTE: tidak otomatis mengubah dana_desa.jumlah karena tidak ada field tipe.
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

        $keuangan->update($data);

        return redirect()->route(auth()->user()->role === 'admin' ? 'admin.keuangan.index' : 'staff.keuangan.index')
                         ->with('success', 'Catatan keuangan berhasil diperbarui.');
    }

    public function destroy(Keuangan $keuangan)
    {
        $this->authorizeView($keuangan);
        $keuangan->delete();
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
