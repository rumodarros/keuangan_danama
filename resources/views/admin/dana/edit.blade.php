{{-- resources/views/admin/dana/edit.blade.php --}}
@extends('layouts.admin')

@section('content')
<div class="max-w-2xl mx-auto bg-white shadow rounded-xl p-6">
    <h2 class="text-lg font-semibold text-gray-700 mb-4">Edit Dana Desa</h2>

    <form method="POST" action="{{ route('admin.dana.update', $dana->id) }}" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-medium text-gray-700">Tahun</label>
            <input type="number" name="tahun" value="{{ old('tahun', $dana->tahun) }}" required
                   class="w-full mt-1 p-2 border rounded-lg focus:ring focus:ring-indigo-200">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Jumlah</label>
            <input type="number" name="jumlah" value="{{ old('jumlah', $dana->jumlah) }}" required
                   class="w-full mt-1 p-2 border rounded-lg focus:ring focus:ring-indigo-200">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Penggunaan</label>
            <textarea name="penggunaan" rows="4"
                      class="w-full mt-1 p-2 border rounded-lg focus:ring focus:ring-indigo-200">{{ old('penggunaan', $dana->penggunaan) }}</textarea>
        </div>

        <div class="flex justify-between items-center">
            <a href="{{ route('admin.dana.index') }}"
               class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm">
                ← Kembali
            </a>
            <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm">
                Update
            </button>
        </div>
    </form>
</div>
@endsection
