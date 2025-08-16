@extends('layouts.staff')

@section('content')
    <div class="bg-white shadow rounded-lg p-6 max-w-2xl mx-auto">
        <h1 class="text-xl font-bold text-gray-700 mb-4">Tambah Catatan Keuangan</h1>

        <form action="{{ route('staff.keuangan.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium">Tanggal</label>
                <input type="date" name="tanggal" class="w-full border rounded-lg p-2"
                       value="{{ old('tanggal') }}" required>
            </div>

            <div>
                <label class="block text-sm font-medium">Jumlah (Rp)</label>
                <input type="number" name="jumlah" class="w-full border rounded-lg p-2"
                       value="{{ old('jumlah') }}" required>
            </div>

            <div>
                <label class="block text-sm font-medium">Sumber</label>
                <input type="text" name="sumber" class="w-full border rounded-lg p-2"
                       value="{{ old('sumber') }}">
            </div>

            <div>
                <label class="block text-sm font-medium">Tujuan</label>
                <input type="text" name="tujuan" class="w-full border rounded-lg p-2"
                       value="{{ old('tujuan') }}">
            </div>

            <div>
                <label class="block text-sm font-medium">Keterangan</label>
                <textarea name="keterangan" class="w-full border rounded-lg p-2">{{ old('keterangan') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium">Dana Desa (opsional)</label>
                <select name="dana_desa_id" class="w-full border rounded-lg p-2">
                    <option value="">- Pilih Dana Desa -</option>
                    @foreach($danas as $dana)
                        <option value="{{ $dana->id }}">{{ $dana->tahun }} - Rp {{ number_format($dana->jumlah,0,',','.') }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('staff.keuangan.index') }}" class="px-4 py-2 bg-gray-200 rounded-lg">Batal</a>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg">Simpan</button>
            </div>
        </form>
    </div>
@endsection
