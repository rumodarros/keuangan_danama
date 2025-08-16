{{-- resources/views/layouts/staff.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard Staff' }}</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans">

    <div class="flex min-h-screen">
        {{-- Sidebar --}}
        <aside class="w-64 bg-gradient-to-b from-emerald-600 to-emerald-800 text-white shadow-lg">
            <div class="px-6 py-4 text-center border-b border-emerald-500">
                <h1 class="text-xl font-bold">Staff Desa</h1>
            </div>
            <nav class="mt-6">
                <ul>
                    <li>
                        <a href="{{ route('staff.keuangan.index') }}"
                           class="block px-6 py-3 hover:bg-emerald-700 {{ request()->routeIs('staff.keuangan.*') ? 'bg-emerald-700' : '' }}">
                            Catatan Keuangan
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('staff.keuangan.create') }}"
                           class="block px-6 py-3 hover:bg-emerald-700 {{ request()->routeIs('staff.keuangan.create') ? 'bg-emerald-700' : '' }}">
                            Tambah Keuangan
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        {{-- Main Content --}}
        <main class="flex-1">
            {{-- Navbar --}}
            <header class="bg-white shadow flex items-center justify-between px-6 py-4">
                <h2 class="text-lg font-semibold text-gray-700">{{ $title ?? 'Dashboard' }}</h2>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-600">{{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-sm">
                            Logout
                        </button>
                    </form>
                </div>
            </header>

            {{-- Page Content --}}
            <div class="p-6">
                @if(session('success'))
                    <div class="mb-4 p-4 rounded-lg bg-green-100 text-green-800">
                        {{ session('success') }}
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>
@stack('scripts')
</body>
</html>
