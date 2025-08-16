@extends('layouts.public')

@section('title','Kontak — Danama')

@section('content')
<section class="py-16">
    <div class="max-w-3xl mx-auto px-4">
        <h1 class="text-2xl font-bold">Kontak Kami</h1>
        <p class="mt-2 text-gray-600">Kalau ada pertanyaan atau butuh bantuan instalasi, kirim pesan ke kami lewat email atau gunakan tombol di bawah.</p>

        <div class="mt-6 bg-white p-6 rounded-lg shadow">
            <h3 class="font-semibold">Email</h3>
            <p class="mt-2 text-gray-700">admin@desa.test</p>

            <div class="mt-4 flex flex-col sm:flex-row gap-3">
                <a href="mailto:admin@desa.test?subject=Pertanyaan%20Danama" class="px-4 py-2 rounded-md bg-indigo-600 text-white inline-block">Kirim Email</a>
                <a href="{{ route('landing') }}" class="px-4 py-2 rounded-md border border-indigo-600 inline-block">Kembali ke Beranda</a>
            </div>
        </div>
    </div>
</section>
@endsection
