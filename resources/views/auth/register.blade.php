<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar — Portal PKL</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background: linear-gradient(140deg, #0a0628 0%, #130d3d 40%, #1e0a4a 75%, #0f0a25 100%);
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        {{-- Logo --}}
        <div class="text-center mb-8">
            <a href="/" class="inline-flex items-center gap-3">
                <div class="w-11 h-11 rounded-xl flex items-center justify-center font-black text-white text-lg shadow-lg"
                    style="background: linear-gradient(135deg, #6366f1, #8b5cf6);">P</div>
                <span class="text-2xl font-bold text-white">Portal PKL</span>
            </a>
            <p class="text-slate-300 mt-2 text-sm">Buat akun baru</p>
        </div>

        {{-- Card --}}
        <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-8">
            @if($errors->any())
            <div class="mb-5 px-4 py-3 rounded-2xl text-sm text-red-700 bg-red-50 border border-red-100">
                @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
                @endforeach
            </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-slate-800 text-sm outline-none focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 transition-all placeholder:text-slate-400"
                        placeholder="Nama lengkap Anda" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-slate-800 text-sm outline-none focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 transition-all placeholder:text-slate-400"
                        placeholder="email@contoh.com" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Daftar sebagai</label>
                    <div class="grid grid-cols-2 gap-3">
                        <label class="relative cursor-pointer">
                            <input type="radio" name="role" value="siswa" {{ old('role', 'siswa' )==='siswa' ? 'checked'
                                : '' }} class="peer sr-only">
                            <div
                                class="flex items-center justify-center gap-2 py-3 rounded-xl border-2 border-slate-200 text-sm font-semibold text-slate-500 peer-checked:border-blue-500 peer-checked:bg-blue-50 peer-checked:text-blue-700 transition-all">
                                📚 Siswa
                            </div>
                        </label>
                        <label class="relative cursor-pointer">
                            <input type="radio" name="role" value="dudi" {{ old('role')==='dudi' ? 'checked' : '' }}
                                class="peer sr-only">
                            <div
                                class="flex items-center justify-center gap-2 py-3 rounded-xl border-2 border-slate-200 text-sm font-semibold text-slate-500 peer-checked:border-purple-500 peer-checked:bg-purple-50 peer-checked:text-purple-700 transition-all">
                                🏢 DUDI
                            </div>
                        </label>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Password</label>
                    <input type="password" name="password"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-slate-800 text-sm outline-none focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 transition-all placeholder:text-slate-400"
                        placeholder="Min. 6 karakter" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-slate-800 text-sm outline-none focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 transition-all placeholder:text-slate-400"
                        placeholder="Ulangi password" required>
                </div>

                <button type="submit"
                    class="w-full py-3 rounded-xl font-bold text-white text-sm transition-all hover:opacity-90 hover:-translate-y-0.5 shadow-md"
                    style="background: linear-gradient(135deg, #6366f1, #8b5cf6);">
                    Daftar
                </button>
            </form>

            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-slate-100"></div>
                </div>
                <div class="relative flex justify-center text-xs text-slate-400"><span class="px-3 bg-white">atau</span>
                </div>
            </div>

            {{-- Google Register --}}
            <a href="{{ route('google.login') }}"
                class="w-full flex items-center justify-center gap-3 py-3 rounded-xl border-2 border-slate-100 font-semibold text-slate-600 text-sm hover:bg-slate-50 hover:border-slate-200 transition-all">
                <svg class="w-5 h-5" viewBox="0 0 24 24">
                    <path fill="#4285F4"
                        d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.06 5.06 0 01-2.2 3.32v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.1z" />
                    <path fill="#34A853"
                        d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" />
                    <path fill="#FBBC05"
                        d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" />
                    <path fill="#EA4335"
                        d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" />
                </svg>
                Daftar dengan Google
            </a>

            <p class="text-center mt-6 text-sm text-slate-500">
                Sudah punya akun? <a href="{{ route('login') }}"
                    class="font-semibold text-indigo-600 hover:text-indigo-700">Masuk</a>
            </p>
        </div>

        <p class="text-center mt-5">
            <a href="/" class="text-xs text-slate-400 hover:text-slate-500">← Kembali ke Beranda</a>
        </p>
    </div>
</body>

</html>