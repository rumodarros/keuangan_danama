<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Danama - Sistem Pencatatan Keuangan Desa')</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800 antialiased">

    <header class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="{{ route('landing') }}" class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-indigo-600 text-white rounded flex items-center justify-center font-bold">D</div>
                    <div class="font-semibold text-lg">Danama</div>
                </a>

                <nav class="flex items-center gap-4">
                    <a href="{{ route('landing') }}" class="hover:text-indigo-600">Beranda</a>
                    <a href="{{ route('about') }}" class="hover:text-indigo-600">Tentang</a>
                    <a href="{{ route('contact') }}" class="hover:text-indigo-600">Kontak</a>
                    @auth
                        @php $role = auth()->user()->role ?? null; @endphp
                        @if($role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="ml-4 px-3 py-2 rounded-md bg-indigo-600 text-white">Dashboard</a>
                        @elseif($role === 'staff')
                            <a href="{{ route('staff.keuangan') }}" class="ml-4 px-3 py-2 rounded-md bg-indigo-600 text-white">Dashboard</a>
                        @else
                            <a href="{{ url('/dashboard') }}" class="ml-4 px-3 py-2 rounded-md bg-indigo-600 text-white">Dashboard</a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="ml-4 px-3 py-2 rounded-md border border-indigo-600 text-indigo-600">Masuk</a>
                    @endauth
                </nav>
            </div>
        </div>
    </header>

    <main class="min-h-[70vh]">
        @yield('content')
    </main>

    <footer class="bg-white border-t mt-12">
        <div class="max-w-7xl mx-auto px-4 py-8 text-sm text-gray-600 flex flex-col sm:flex-row justify-between items-center">
            <div>© {{ date('Y') }} Danama — Sistem Pencatatan Keuangan Desa</div>
            <div class="mt-3 sm:mt-0">
                <a href="{{ route('about') }}" class="hover:text-indigo-600 mr-4">Tentang</a>
                <a href="{{ route('contact') }}" class="hover:text-indigo-600">Kontak</a>
            </div>
        </div>
    </footer>

</body>
</html>
