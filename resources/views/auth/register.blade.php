<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar — Portal PKL</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="min-h-screen bg-gradient-to-br from-slate-900 via-indigo-950 to-purple-950 flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <div
                class="w-14 h-14 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-xl shadow-indigo-500/30">
                <span class="text-white font-bold text-xl">P</span>
            </div>
            <h1 class="text-2xl font-bold text-white">Daftar Akun Baru</h1>
            <p class="text-slate-400 text-sm mt-1">Buat akun untuk mulai menggunakan Portal PKL</p>
        </div>

        <div class="bg-white/10 backdrop-blur-xl rounded-2xl border border-white/10 p-8">
            @if($errors->any())
            <div class="bg-red-500/20 border border-red-500/30 text-red-200 px-4 py-3 rounded-xl text-sm mb-6">
                @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
                @endforeach
            </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-slate-300 mb-1.5">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                        class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                        placeholder="Masukkan nama lengkap" required>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-300 mb-1.5">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                        class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                        placeholder="contoh@email.com" required>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-300 mb-1.5">Daftar Sebagai</label>
                    <div class="grid grid-cols-2 gap-3">
                        <label
                            class="flex items-center gap-3 p-3 bg-white/5 border border-white/10 rounded-xl cursor-pointer hover:bg-white/10 transition-colors has-[:checked]:bg-indigo-500/20 has-[:checked]:border-indigo-500/50">
                            <input type="radio" name="role" value="siswa" {{ old('role', 'siswa' )==='siswa' ? 'checked'
                                : '' }} class="w-4 h-4 text-indigo-600">
                            <div>
                                <p class="text-sm font-semibold text-white">🎓 Siswa</p>
                                <p class="text-xs text-slate-400">Cari magang</p>
                            </div>
                        </label>
                        <label
                            class="flex items-center gap-3 p-3 bg-white/5 border border-white/10 rounded-xl cursor-pointer hover:bg-white/10 transition-colors has-[:checked]:bg-purple-500/20 has-[:checked]:border-purple-500/50">
                            <input type="radio" name="role" value="dudi" {{ old('role')==='dudi' ? 'checked' : '' }}
                                class="w-4 h-4 text-purple-600">
                            <div>
                                <p class="text-sm font-semibold text-white">🏢 DUDI</p>
                                <p class="text-xs text-slate-400">Buka lowongan</p>
                            </div>
                        </label>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-300 mb-1.5">Password</label>
                    <input type="password" name="password"
                        class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                        placeholder="Minimal 6 karakter" required>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-300 mb-1.5">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation"
                        class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                        placeholder="Ulangi password" required>
                </div>

                <button type="submit"
                    class="w-full py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-xl hover:from-indigo-500 hover:to-purple-500 transition-all shadow-lg shadow-indigo-500/30">
                    Daftar Sekarang
                </button>
            </form>

            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-white/10"></div>
                </div>
                <div class="relative flex justify-center text-sm"><span
                        class="px-4 bg-transparent text-slate-400">atau</span></div>
            </div>

            <a href="{{ route('google.login') }}"
                class="w-full flex items-center justify-center gap-3 py-3 bg-white rounded-xl text-gray-700 font-semibold hover:bg-gray-100 transition-colors">
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

            <p class="text-center text-sm text-slate-400 mt-6">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-indigo-400 hover:text-indigo-300 font-semibold">Masuk</a>
            </p>
        </div>
    </div>
</body>

</html>