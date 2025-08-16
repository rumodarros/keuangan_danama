@extends('layouts.admin')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6">
    <h3 class="text-xl font-semibold text-gray-700 mb-4">Detail Catatan Keuangan</h3>

    <div class="grid grid-cols-2 gap-4 text-gray-700">
        <p><strong>Tanggal:</strong> {{ $keuangan->tanggal }}</p>
        <p><strong>Jumlah:</strong> Rp {{ number_format($keuangan->jumlah,0,',','.') }}</p>
        <p><strong>Sumber:</strong> {{ $keuangan->sumber ?? '-' }}</p>
        <p><strong>Tujuan:</strong> {{ $keuangan->tujuan ?? '-' }}</p>
        <p><strong>Dana Desa:</strong> {{ $keuangan->danaDesa->tahun ?? '-' }}</p>
        <p><strong>User:</strong> {{ $keuangan->user->name }}</p>
        <p class="col-span-2"><strong>Keterangan:</strong> {{ $keuangan->keterangan ?? '-' }}</p>
    </div>

    <div class="mt-6 flex gap-2">
        <a href="{{ route('admin.keuangan.edit',$keuangan) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">Edit</a>
        <form action="{{ route('admin.keuangan.destroy',$keuangan) }}" method="POST" onsubmit="return confirm('Hapus catatan ini?')">
            @csrf @method('DELETE')
            <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">Hapus</button>
        </form>
        <a href="{{ route('admin.keuangan.index') }}" class="ml-2 text-gray-600 hover:underline">Kembali</a>
    </div>
</div>
@endsection
