@extends('layouts.admin')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6">
    <h3 class="text-lg font-semibold text-gray-700 mb-4">Tambah Catatan Keuangan</h3>

    <form action="{{ route('admin.keuangan.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block text-gray-700">Tanggal</label>
            <input type="date" name="tanggal" value="{{ old('tanggal') }}" required
                   class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block text-gray-700">Jumlah (Rp)</label>
            <input type="number" name="jumlah" value="{{ old('jumlah') }}" required
                   class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block text-gray-700">Sumber</label>
            <input type="text" name="sumber" value="{{ old('sumber') }}"
                   class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block text-gray-700">Tujuan</label>
            <input type="text" name="tujuan" value="{{ old('tujuan') }}"
                   class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block text-gray-700">Dana Desa</label>
            <select name="dana_desa_id" class="w-full border rounded px-3 py-2">
                <option value="">-- Pilih Dana Desa --</option>
                @foreach($danas as $dana)
                    <option value="{{ $dana->id }}">{{ $dana->tahun }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-gray-700">Keterangan</label>
            <textarea name="keterangan" rows="3" class="w-full border rounded px-3 py-2">{{ old('keterangan') }}</textarea>
        </div>

        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
            Simpan
        </button>
        <a href="{{ route('admin.keuangan.index') }}" class="ml-2 text-gray-600 hover:underline">Batal</a>
    </form>
</div>
@endsection
