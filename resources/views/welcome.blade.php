@extends('layouts.public')

@section('title','Danama — Pencatatan Keuangan Desa')

@section('content')
<section class="bg-gradient-to-br from-indigo-600 via-indigo-500 to-indigo-400 text-white py-20">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h1 class="text-4xl sm:text-5xl font-extrabold">Selamat datang di <span class="underline decoration-white/40">Danama</span></h1>
        <p class="mt-4 text-lg max-w-2xl mx-auto">Sistem informasi pencatatan keuangan desa yang sederhana, aman, dan mudah digunakan oleh admin dan staff desa. Pantau dana, catat transaksi, dan buat laporan dengan rapi.</p>

        <div class="mt-8 flex justify-center gap-4">
            <a href="{{ route('about') }}" class="px-6 py-3 bg-white text-indigo-600 rounded-md font-semibold shadow">Pelajari lebih lanjut</a>
            <a href="{{ route('contact') }}" class="px-6 py-3 border border-white rounded-md text-white">Hubungi Kami</a>
        </div>
    </div>
</section>

<section class="py-12">
    <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="font-semibold text-lg">Kelola Dana</h3>
            <p class="mt-2 text-sm text-gray-600">Catat dan monitor anggaran per tahun serta penggunaan dana desa dengan mudah.</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="font-semibold text-lg">Pencatatan Keuangan</h3>
            <p class="mt-2 text-sm text-gray-600">Input transaksi masuk/keluar, sumber & tujuan, serta keterangan secara terstruktur.</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="font-semibold text-lg">Hak Akses</h3>
            <p class="mt-2 text-sm text-gray-600">Role admin dan staff untuk memudahkan pembagian tugas dan keamanan data.</p>
        </div>
    </div>
</section>

<section class="py-12 bg-gray-50">
    <div class="max-w-5xl mx-auto px-4 text-center">
        <h2 class="text-2xl font-semibold">Kenapa pilih Danama?</h2>
        <p class="mt-2 text-gray-600">Dirancang khusus untuk kebutuhan pencatatan keuangan desa — ringan, mudah dipakai, dan fokus pada auditabilitas.</p>
    </div>
</section>
@endsection
