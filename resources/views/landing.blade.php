<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal PKL — Temukan Pengalaman Magang Terbaik</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css'])
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        .hero-gradient {
            background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 40%, #312e81 70%, #4338ca 100%);
        }

        .float {
            animation: float 6s ease-in-out infinite;
        }

        .float-delay {
            animation: float 6s ease-in-out 2s infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-20px);
            }
        }
    </style>
</head>

<body class="bg-slate-50">
    {{-- Navbar --}}
    <nav class="fixed top-0 w-full z-50 bg-white/80 backdrop-blur-md border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <a href="/" class="flex items-center gap-3">
                <div
                    class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center font-bold text-white shadow-lg shadow-indigo-500/30">
                    P</div>
                <span
                    class="text-xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">Portal
                    PKL</span>
            </a>
            <a href="{{ route('login') }}"
                class="px-6 py-2.5 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-xl font-semibold text-sm shadow-lg shadow-indigo-500/25 hover:shadow-xl hover:-translate-y-0.5 transition-all duration-200">
                Masuk
            </a>
        </div>
    </nav>

    {{-- Hero --}}
    <section class="hero-gradient min-h-screen flex items-center relative overflow-hidden">
        <div class="absolute inset-0">
            <div class="absolute top-20 left-20 w-72 h-72 bg-indigo-500/20 rounded-full blur-3xl float"></div>
            <div class="absolute bottom-20 right-20 w-96 h-96 bg-purple-500/15 rounded-full blur-3xl float-delay"></div>
            <div
                class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-indigo-400/10 rounded-full blur-3xl">
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-6 pt-24 pb-16 relative z-10">
            <div class="max-w-3xl">
                <div
                    class="inline-flex items-center gap-2 px-4 py-2 bg-white/10 border border-white/20 rounded-full text-sm text-indigo-200 mb-8 backdrop-blur-sm">
                    <span class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse"></span>
                    Platform PKL Terpercaya
                </div>

                <h1 class="text-5xl md:text-7xl font-black text-white mb-6 leading-tight">
                    Temukan<br>
                    <span
                        class="bg-gradient-to-r from-indigo-400 via-purple-400 to-pink-400 bg-clip-text text-transparent">Pengalaman
                        Magang</span><br>
                    Terbaik
                </h1>

                <p class="text-lg text-slate-300 mb-10 max-w-xl leading-relaxed">
                    Hubungkan siswa dengan perusahaan untuk program Praktik Kerja Lapangan. Proses yang mudah,
                    terstruktur, dan transparan.
                </p>

                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('login') }}"
                        class="px-8 py-4 bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-2xl font-bold text-base shadow-2xl shadow-indigo-500/30 hover:shadow-indigo-500/50 hover:-translate-y-1 transition-all duration-300">
                        Mulai Sekarang →
                    </a>
                    <a href="#fitur"
                        class="px-8 py-4 bg-white/10 text-white border border-white/20 rounded-2xl font-bold text-base backdrop-blur-sm hover:bg-white/20 transition-all duration-300">
                        Pelajari Lebih Lanjut
                    </a>
                </div>

                <div class="mt-16 flex gap-12">
                    <div>
                        <p class="text-3xl font-bold text-white">3</p>
                        <p class="text-sm text-slate-400">Role Pengguna</p>
                    </div>
                    <div>
                        <p class="text-3xl font-bold text-white">100%</p>
                        <p class="text-sm text-slate-400">Gratis</p>
                    </div>
                    <div>
                        <p class="text-3xl font-bold text-white">∞</p>
                        <p class="text-sm text-slate-400">Lowongan</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Features --}}
    <section id="fitur" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <p class="text-sm font-semibold text-indigo-600 uppercase tracking-wider mb-3">Fitur</p>
                <h2 class="text-4xl font-bold text-slate-800">Semua yang Anda Butuhkan</h2>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div
                    class="group p-8 rounded-3xl border border-slate-100 hover:border-indigo-100 hover:shadow-xl hover:shadow-indigo-500/5 hover:-translate-y-1 transition-all duration-300">
                    <div
                        class="w-14 h-14 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-2xl flex items-center justify-center mb-6 shadow-lg shadow-blue-500/20 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 mb-3">Untuk Siswa</h3>
                    <p class="text-slate-500 leading-relaxed">Cari dan lamar posisi PKL dengan mudah. Upload CV,
                        portfolio, dan sertifikat Anda.</p>
                </div>

                <div
                    class="group p-8 rounded-3xl border border-slate-100 hover:border-purple-100 hover:shadow-xl hover:shadow-purple-500/5 hover:-translate-y-1 transition-all duration-300">
                    <div
                        class="w-14 h-14 bg-gradient-to-br from-purple-500 to-pink-500 rounded-2xl flex items-center justify-center mb-6 shadow-lg shadow-purple-500/20 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 mb-3">Untuk DUDI</h3>
                    <p class="text-slate-500 leading-relaxed">Buat lowongan PKL, kelola posisi, dan pilih kandidat
                        terbaik untuk perusahaan Anda.</p>
                </div>

                <div
                    class="group p-8 rounded-3xl border border-slate-100 hover:border-emerald-100 hover:shadow-xl hover:shadow-emerald-500/5 hover:-translate-y-1 transition-all duration-300">
                    <div
                        class="w-14 h-14 bg-gradient-to-br from-emerald-500 to-teal-500 rounded-2xl flex items-center justify-center mb-6 shadow-lg shadow-emerald-500/20 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 mb-3">Admin Verified</h3>
                    <p class="text-slate-500 leading-relaxed">Semua perusahaan diverifikasi oleh admin untuk memastikan
                        keamanan dan kualitas.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- How It Works --}}
    <section class="py-24 bg-slate-50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <p class="text-sm font-semibold text-indigo-600 uppercase tracking-wider mb-3">Cara Kerja</p>
                <h2 class="text-4xl font-bold text-slate-800">Proses yang Mudah</h2>
            </div>

            <div class="grid md:grid-cols-4 gap-6">
                @foreach([
                ['1', 'Daftar', 'Login dengan akun Google Anda', 'from-indigo-500 to-blue-500'],
                ['2', 'Lengkapi Profil', 'Isi data diri atau data perusahaan', 'from-purple-500 to-pink-500'],
                ['3', 'Jelajahi', 'Cari lowongan atau buat lowongan baru', 'from-amber-500 to-orange-500'],
                ['4', 'Selesai', 'Lamar atau terima kandidat terbaik', 'from-emerald-500 to-teal-500'],
                ] as $step)
                <div class="text-center">
                    <div
                        class="w-12 h-12 bg-gradient-to-br {{ $step[3] }} rounded-2xl flex items-center justify-center mx-auto mb-4 text-white font-bold text-lg shadow-lg">
                        {{ $step[0] }}</div>
                    <h3 class="text-lg font-bold text-slate-800 mb-2">{{ $step[1] }}</h3>
                    <p class="text-sm text-slate-500">{{ $step[2] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="bg-slate-900 text-slate-400 py-12">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <div class="flex items-center justify-center gap-3 mb-4">
                <div
                    class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center font-bold text-white text-sm">
                    P</div>
                <span class="text-lg font-bold text-white">Portal PKL</span>
            </div>
            <p class="text-sm">&copy; {{ date('Y') }} Portal PKL. Platform untuk menghubungkan siswa dengan dunia
                industri.</p>
        </div>
    </footer>
</body>

</html>