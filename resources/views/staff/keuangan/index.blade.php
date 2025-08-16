@extends('layouts.staff')

@section('content')
    <div class="bg-white shadow rounded-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-xl font-bold text-gray-700">Catatan Keuangan Saya</h1>
            <a href="{{ route('staff.keuangan.create') }}"
               class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg">
                + Tambah Catatan
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full border border-gray-200 rounded-lg overflow-hidden">
                <thead class="bg-indigo-600 text-white">
                    <tr>
                        <th class="px-4 py-3 text-left">Tanggal</th>
                        <th class="px-4 py-3 text-left">Jumlah</th>
                        <th class="px-4 py-3 text-left">Sumber</th>
                        <th class="px-4 py-3 text-left">Tujuan</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($keuangans as $keuangan)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2">{{ \Carbon\Carbon::parse($keuangan->tanggal)->format('d/m/Y') }}</td>
                            <td class="px-4 py-2">Rp {{ number_format($keuangan->jumlah,0,',','.') }}</td>
                            <td class="px-4 py-2">{{ $keuangan->sumber ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $keuangan->tujuan ?? '-' }}</td>
                            <td class="px-4 py-2 text-center">
                                <a href="{{ route('staff.keuangan.show', $keuangan) }}"
                                   class="text-blue-600 hover:underline">Lihat</a>
                                <a href="{{ route('staff.keuangan.edit', $keuangan) }}"
                                   class="text-yellow-600 hover:underline ml-3">Edit</a>
                                <form action="{{ route('staff.keuangan.destroy', $keuangan) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button onclick="return confirm('Yakin hapus catatan ini?')"
                                            class="text-red-600 hover:underline ml-3">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-4 text-center text-gray-500">Belum ada catatan keuangan.</td>
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
