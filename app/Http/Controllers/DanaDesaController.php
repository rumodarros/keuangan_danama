<?php

namespace App\Http\Controllers;

use App\Models\DanaDesa;
use Illuminate\Http\Request;

class DanaDesaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // admin biasanya, tapi boleh disesuaikan
    }

    public function index()
    {
        $danas = DanaDesa::orderBy('tahun','desc')->paginate(15);
        return view('admin.dana.index', compact('danas'));
    }

    public function create()
    {
        return view('admin.dana.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'tahun' => 'required|digits:4|integer',
            'jumlah' => 'required|numeric',
            'penggunaan' => 'nullable|string',
        ]);

        DanaDesa::create($data);

        return redirect()->route('admin.dana.index')->with('success', 'Dana Desa berhasil dibuat.');
    }

    public function show(DanaDesa $danaDesa)
    {
        return view('admin.dana.show', ['dana' => $danaDesa]);
    }

    public function edit(DanaDesa $danaDesa)
    {
        return view('admin.dana.edit', ['dana' => $danaDesa]);
    }

    public function update(Request $request, DanaDesa $danaDesa)
    {
        $data = $request->validate([
            'tahun' => 'required|digits:4|integer',
            'jumlah' => 'required|numeric',
            'penggunaan' => 'nullable|string',
        ]);

        $danaDesa->update($data);

        return redirect()->route('admin.dana.index')->with('success', 'Dana Desa berhasil diperbarui.');
    }

    public function destroy(DanaDesa $danaDesa)
    {
        $danaDesa->delete();
        return redirect()->route('admin.dana.index')->with('success', 'Dana Desa berhasil dihapus.');
    }
}
