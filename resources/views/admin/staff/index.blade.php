@extends('layouts.admin')

@section('title', 'Manajemen Staff')

@section('content')
<div class="bg-white shadow-md rounded-xl overflow-hidden">
    <div class="flex justify-between items-center px-6 py-4 border-b border-gray-200">
        <h1 class="text-xl font-semibold text-gray-700">Daftar Staff</h1>
        <a href="{{ route('admin.staff.create') }}"
           class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition">
            + Tambah Staff
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left border-collapse">
            <thead class="bg-gray-50 text-gray-600 uppercase text-xs font-semibold">
                <tr>
                    <th class="px-6 py-3">Foto</th>
                    <th class="px-6 py-3">Nama</th>
                    <th class="px-6 py-3">Email</th>
                    <th class="px-6 py-3">Jabatan</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($staffs as $staff)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">
                        @if($staff->foto)
                            <img src="{{ asset('storage/'.$staff->foto) }}"
                                 class="w-12 h-12 rounded-full object-cover shadow">
                        @else
                            <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center text-gray-500">
                                <span class="text-xs">N/A</span>
                            </div>
                        @endif
                    </td>
                    <td class="px-6 py-4 font-medium text-gray-800">{{ $staff->nama }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $staff->user->email }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $staff->jabatan ?? '-' }}</td>
                    <td class="px-6 py-4 text-center space-x-2">
                        <a href="{{ route('admin.staff.show',$staff->id) }}"
                           class="text-indigo-600 hover:text-indigo-800 font-medium">Detail</a>
                        <a href="{{ route('admin.staff.edit',$staff->id) }}"
                           class="text-yellow-600 hover:text-yellow-700 font-medium">Edit</a>
                        <form action="{{ route('admin.staff.destroy',$staff->id) }}"
                              method="POST" class="inline-block"
                              onsubmit="return confirm('Yakin ingin hapus staff ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-700 font-medium">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                        Belum ada data staff.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="px-6 py-4 border-t border-gray-200">
        {{ $staffs->links() }}
    </div>
</div>
@endsection
