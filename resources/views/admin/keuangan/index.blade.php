@extends('layouts.admin')

@section('content')
<div class="bg-white shadow-lg rounded-lg p-6">
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-xl font-semibold text-gray-700">Daftar Catatan Keuangan</h3>
        <a href="{{ route('admin.keuangan.create') }}"
           class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
            + Tambah Catatan
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full border-collapse border border-gray-300 rounded-lg">
            <thead>
                <tr class="bg-gray-100 text-gray-700 text-sm">
                    <th class="border border-gray-300 px-4 py-2">Tanggal</th>
                    <th class="border border-gray-300 px-4 py-2">Jumlah</th>
                    <th class="border border-gray-300 px-4 py-2">Sumber</th>
                    <th class="border border-gray-300 px-4 py-2">Tujuan</th>
                    <th class="border border-gray-300 px-4 py-2">Dana Desa</th>
                    <th class="border border-gray-300 px-4 py-2">User</th>
                    <th class="border border-gray-300 px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($keuangans as $item)
                <tr class="text-sm text-gray-600 hover:bg-gray-50">
                    <td class="border px-4 py-2">{{ $item->tanggal }}</td>
                    <td class="border px-4 py-2">Rp {{ number_format($item->jumlah,0,',','.') }}</td>
                    <td class="border px-4 py-2">{{ $item->sumber ?? '-' }}</td>
                    <td class="border px-4 py-2">{{ $item->tujuan ?? '-' }}</td>
                    <td class="border px-4 py-2">{{ $item->danaDesa->tahun ?? '-' }}</td>
                    <td class="border px-4 py-2">{{ $item->user->name }}</td>
                    <td class="border px-4 py-2 flex gap-2">
                        <a href="{{ route('admin.keuangan.show',$item) }}"
                           class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded">Detail</a>
                        <a href="{{ route('admin.keuangan.edit',$item) }}"
                           class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">Edit</a>
                        <form action="{{ route('admin.keuangan.destroy',$item) }}" method="POST" onsubmit="return confirm('Hapus catatan ini?')">
                            @csrf @method('DELETE')
                            <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-4 text-gray-500">Belum ada catatan keuangan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $keuangans->links() }}
    </div>
</div>
@endsection
