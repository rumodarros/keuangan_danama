@extends('layouts.public')

@section('title','Tentang Danama')

@section('content')
<section class="py-16">
    <div class="max-w-5xl mx-auto px-4">
        <h1 class="text-3xl font-bold">Tentang Danama</h1>
        <p class="mt-4 text-gray-700">Danama adalah sistem informasi pencatatan keuangan yang dibuat untuk membantu administrasi keuangan desa. Sistem ini mendukung pencatatan dana per tahun, pencatatan transaksi keuangan, serta pengelolaan pengguna (admin & staff).</p>

        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="font-semibold">Visi</h3>
                <p class="mt-2 text-gray-600">Mendorong transparansi dan akuntabilitas keuangan desa melalui pencatatan yang rapi dan mudah diaudit.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="font-semibold">Misi</h3>
                <ul class="mt-2 list-disc list-inside text-gray-600">
                    <li>Menyediakan alat pencatatan yang sederhana dan terstruktur.</li>
                    <li>Mengurangi kesalahan manual dalam pembukuan.</li>
                    <li>Mendukung pembuatan laporan keuangan tahunan.</li>
                </ul>
            </div>
        </div>

        <div class="mt-8">
            <h3 class="font-semibold">Fitur utama</h3>
            <ul class="mt-3 grid grid-cols-1 sm:grid-cols-2 gap-2 text-gray-700">
                <li>• Pencatatan dana desa per tahun</li>
                <li>• Pencatatan transaksi (sumber, tujuan, jumlah, keterangan)</li>
                <li>• Hak akses admin & staff</li>
                <li>• Laporan & eksport (rencana fitur)</li>
            </ul>
        </div>
    </div>
</section>
@endsection
