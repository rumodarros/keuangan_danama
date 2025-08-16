{{-- resources/views/admin/dana/index.blade.php --}}
@extends('layouts.admin')

@section('content')
<div class="bg-white shadow rounded-xl overflow-hidden">
    <div class="flex justify-between items-center px-6 py-4 border-b">
        <h2 class="text-lg font-semibold text-gray-700">Data Dana Desa</h2>
        <a href="{{ route('admin.dana.create') }}"
           class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm">
            + Tambah Dana
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full border-collapse">
            <thead class="bg-gray-100 text-gray-700 text-sm">
                <tr>
                    <th class="px-6 py-3 text-left">Tahun</th>
                    <th class="px-6 py-3 text-left">Jumlah</th>
                    <th class="px-6 py-3 text-left">Penggunaan</th>
                    <th class="px-6 py-3 text-center w-48">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y text-sm">
                @forelse($danas as $dana)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-3 font-medium">{{ $dana->tahun }}</td>
                        <td class="px-6 py-3">Rp {{ number_format($dana->jumlah,0,',','.') }}</td>
                        <td class="px-6 py-3">{{ Str::limit($dana->penggunaan, 50) }}</td>
                        <td class="px-6 py-3 text-center">
                            <a href="{{ route('admin.dana.show', $dana->id) }}"
                               class="text-blue-600 hover:underline">Lihat</a> |
                            <a href="{{ route('admin.dana.edit', $dana->id) }}"
                               class="text-indigo-600 hover:underline">Edit</a> |
                            <form action="{{ route('admin.dana.destroy', $dana->id) }}" method="POST" class="inline"
                                  onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                            Belum ada data Dana Desa.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="px-6 py-4 border-t">
        {{ $danas->links() }}
    </div>
</div>
@endsection
