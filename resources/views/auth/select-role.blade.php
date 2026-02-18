<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Role — Portal PKL</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css'])
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body
    class="min-h-screen bg-gradient-to-br from-slate-900 via-indigo-950 to-purple-950 flex items-center justify-center p-4">
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-indigo-500/20 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-1/3 right-1/3 w-96 h-96 bg-purple-500/20 rounded-full blur-3xl animate-pulse"
            style="animation-delay:1s"></div>
    </div>

    <div class="relative w-full max-w-lg">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-white mb-2">Selamat Datang! 👋</h1>
            <p class="text-slate-400">Halo <strong class="text-white">{{ session('google_user.name') }}</strong>, pilih
                role Anda untuk melanjutkan.</p>
        </div>

        <div class="grid grid-cols-2 gap-4">
            {{-- Siswa --}}
            <form method="POST" action="{{ route('select.role') }}">
                @csrf
                <input type="hidden" name="role" value="siswa">
                <button type="submit"
                    class="w-full group bg-white/10 backdrop-blur-xl border border-white/20 rounded-3xl p-8 text-center hover:bg-white/20 hover:border-indigo-500/50 hover:-translate-y-1 hover:shadow-2xl hover:shadow-indigo-500/10 transition-all duration-300">
                    <div
                        class="w-16 h-16 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-xl group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Siswa</h3>
                    <p class="text-sm text-slate-400">Cari dan lamar posisi PKL yang tersedia</p>
                </button>
            </form>

            {{-- DUDI --}}
            <form method="POST" action="{{ route('select.role') }}">
                @csrf
                <input type="hidden" name="role" value="dudi">
                <button type="submit"
                    class="w-full group bg-white/10 backdrop-blur-xl border border-white/20 rounded-3xl p-8 text-center hover:bg-white/20 hover:border-purple-500/50 hover:-translate-y-1 hover:shadow-2xl hover:shadow-purple-500/10 transition-all duration-300">
                    <div
                        class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-500 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-xl group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">DUDI</h3>
                    <p class="text-sm text-slate-400">Buka lowongan PKL untuk siswa</p>
                </button>
            </form>
        </div>
    </div>
</body>

</html>