{{-- resources/views/auth/login.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Keuangan Desa</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-md bg-white/90 backdrop-blur-xl shadow-2xl rounded-3xl p-10 relative overflow-hidden">
        <div class="absolute -top-10 -right-10 w-40 h-40 bg-indigo-400 rounded-full blur-3xl opacity-30"></div>
        <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-pink-400 rounded-full blur-3xl opacity-30"></div>

        <h1 class="text-3xl font-extrabold text-center text-gray-900 mb-8">Selamat Datang</h1>

        @if(session('status'))
            <div class="mb-4 p-3 rounded-lg bg-green-100 text-green-700 text-sm text-center">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            {{-- Email Address --}}
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                       class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 transition-all duration-200 shadow-sm">
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            {{-- Password --}}
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input id="password" type="password" name="password" required
                       class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 transition-all duration-200 shadow-sm">
                @error('password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            {{-- Remember Me and Forgot Password --}}
            <div class="flex items-center justify-between text-sm">
                <label class="flex items-center">
                    <input id="remember_me" type="checkbox" name="remember" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    <span class="ml-2 text-gray-600">Ingat saya</span>
                </label>
                <a href="{{ route('password.request') }}" class="text-indigo-600 hover:text-indigo-700 font-medium">Lupa password?</a>
            </div>

            {{-- Submit --}}
            <div>
                <button type="submit" class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold py-3 px-4 rounded-xl shadow-lg transition-all duration-200">
                    Masuk
                </button>
            </div>
        </form>
    </div>

</body>
</html>
