{{-- resources/views/admin/staff/show.blade.php --}}
@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white shadow-xl rounded-2xl overflow-hidden">
        {{-- Header Foto --}}
        <div class="relative">
            <div class="h-32 bg-gradient-to-r from-indigo-600 to-indigo-800"></div>
            <div class="absolute -bottom-16 left-1/2 transform -translate-x-1/2">
                @if($staff->foto)
                    <img src="{{ asset('storage/'.$staff->foto) }}"
                         class="w-32 h-32 rounded-full border-4 border-white shadow-lg object-cover">
                @else
                    <div class="w-32 h-32 rounded-full border-4 border-white shadow-lg bg-gray-200 flex items-center justify-center">
                        <span class="text-gray-500 text-xl">No Foto</span>
                    </div>
                @endif
            </div>
        </div>

        {{-- Info Utama --}}
        <div class="mt-20 text-center px-6">
            <h2 class="text-2xl font-bold text-gray-800">{{ $staff->nama }}</h2>
            <p class="text-gray-500">{{ $staff->jabatan ?? '-' }}</p>
        </div>

        {{-- Detail --}}
        <div class="mt-8 px-6 pb-6">
            <div class="grid md:grid-cols-2 gap-6">
                <div class="bg-gray-50 rounded-xl p-4">
                    <h4 class="text-sm text-gray-500 mb-1">Email</h4>
                    <p class="text-gray-800 font-medium">{{ $staff->user->email }}</p>
                </div>

                <div class="bg-gray-50 rounded-xl p-4">
                    <h4 class="text-sm text-gray-500 mb-1">Jabatan</h4>
                    <p class="text-gray-800 font-medium">{{ $staff->jabatan ?? 'Belum diisi' }}</p>
                </div>
            </div>
        </div>

        {{-- Action --}}
        <div class="px-6 py-4 bg-gray-100 flex justify-between items-center rounded-b-2xl">
            <a href="{{ route('admin.staff.index') }}"
               class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm">
                ← Kembali
            </a>

            <div class="flex space-x-2">
                <a href="{{ route('admin.staff.edit', $staff->id) }}"
                   class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm">
                    Edit
                </a>
                <form action="{{ route('admin.staff.destroy', $staff->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus staff ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
