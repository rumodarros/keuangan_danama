{{-- resources/views/admin/dana/show.blade.php --}}
@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto bg-white shadow-xl rounded-2xl overflow-hidden">
    <div class="bg-gradient-to-r from-indigo-600 to-indigo-800 px-6 py-4 text-white">
        <h2 class="text-xl font-bold">Detail Dana Desa {{ $dana->tahun }}</h2>
    </div>

    <div class="p-6 space-y-4">
        <div>
            <h4 class="text-sm text-gray-500">Tahun</h4>
            <p class="text-lg font-semibold text-gray-800">{{ $dana->tahun }}</p>
        </div>

        <div>
            <h4 class="text-sm text-gray-500">Jumlah</h4>
            <p class="text-lg font-semibold text-green-700">Rp {{ number_format($dana->jumlah,0,',','.') }}</p>
        </div>

        <div>
            <h4 class="text-sm text-gray-500">Penggunaan</h4>
            <p class="text-gray-800">{{ $dana->penggunaan ?? '-' }}</p>
        </div>
    </div>

    <div class="px-6 py-4 bg-gray-100 flex justify-between items-center">
        <a href="{{ route('admin.dana.index') }}"
           class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm">
            ← Kembali
        </a>
        <div class="flex space-x-2">
            <a href="{{ route('admin.dana.edit', $dana->id) }}"
               class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm">
                Edit
            </a>
            <form action="{{ route('admin.dana.destroy', $dana->id) }}" method="POST"
                  onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm">
                    Hapus
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
