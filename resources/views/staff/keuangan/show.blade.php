@extends('layouts.staff')

@section('content')
    <div class="bg-white shadow rounded-lg p-6 max-w-3xl mx-auto">
        <h1 class="text-xl font-bold text-gray-700 mb-4">Detail Catatan Keuangan</h1>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <p class="font-semibold">Tanggal</p>
                <p>{{ \Carbon\Carbon::parse($keuangan->tanggal)->format('d M Y') }}</p>
            </div>
            <div>
                <p class="font-semibold">Jumlah</p>
                <p>Rp {{ number_format($keuangan->jumlah,0,',','.') }}</p>
            </div>
            <div>
                <p class="font-semibold">Sumber</p>
                <p>{{ $keuangan->sumber ?? '-' }}</p>
            </div>
            <div>
                <p class="font-semibold">Tujuan</p>
                <p>{{ $keuangan->tujuan ?? '-' }}</p>
            </div>
            <div class="col-span-2">
                <p class="font-semibold">Keterangan</p>
                <p>{{ $keuangan->keterangan ?? '-' }}</p>
            </div>
            <div class="col-span-2">
                <p class="font-semibold">Dana Desa</p>
                <p>{{ $keuangan->danaDesa ? $keuangan->danaDesa->tahun.' - Rp '.number_format($keuangan->danaDesa->jumlah,0,',','.') : '-' }}</p>
            </div>
        </div>

        <div class="mt-6 flex justify-end space-x-3">
            <a href="{{ route('staff.keuangan.index') }}" class="px-4 py-2 bg-gray-200 rounded-lg">Kembali</a>
            <a href="{{ route('staff.keuangan.edit', $keuangan) }}" class="px-4 py-2 bg-yellow-500 text-white rounded-lg">Edit</a>
        </div>
    </div>
@endsection
