<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal PKL — Temukan Pengalaman Magang Terbaik</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <style>
        * {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .hero-bg {
            background: linear-gradient(140deg, #0a0628 0%, #130d3d 30%, #1e0a4a 60%, #150b35 100%);
        }

        .glow-indigo {
            box-shadow: 0 0 80px rgba(99, 102, 241, 0.4);
        }

        .glow-purple {
            box-shadow: 0 0 80px rgba(139, 92, 246, 0.3);
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0)
            }

            50% {
                transform: translateY(-18px)
            }
        }

        @keyframes pulse-glow {

            0%,
            100% {
                opacity: 0.5
            }

            50% {
                opacity: 1
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px)
            }

            to {
                opacity: 1;
                transform: translateY(0)
            }
        }

        @keyframes spin-slow {
            from {
                transform: rotate(0deg)
            }

            to {
                transform: rotate(360deg)
            }
        }

        .float {
            animation: float 7s ease-in-out infinite;
        }

        .float-delay {
            animation: float 7s ease-in-out 2.5s infinite;
        }

        .slide-up {
            animation: slideUp 0.8s ease-out forwards;
            opacity: 0;
        }

        .slide-up-1 {
            animation-delay: 0.1s;
        }

        .slide-up-2 {
            animation-delay: 0.25s;
        }

        .slide-up-3 {
            animation-delay: 0.4s;
        }

        .slide-up-4 {
            animation-delay: 0.55s;
        }

        .spin-slow {
            animation: spin-slow 20s linear infinite;
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.12);
        }

        .gradient-text {
            background: linear-gradient(135deg, #a78bfa, #8b5cf6, #6366f1, #60a5fa);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>

<body class="bg-slate-50 overflow-x-hidden">

    {{-- Navbar --}}
    <nav class="fixed top-0 w-full z-50"
        style="background: rgba(10,6,40,0.8); backdrop-filter: blur(20px); border-bottom: 1px solid rgba(255,255,255,0.06);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-3 sm:py-4 flex items-center justify-between">

            <!-- LOGO -->
            <a href="/" class="flex items-center gap-2 group">
                <div class="w-10 h-10 rounded-xl overflow-hidden shadow-lg
                    bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center">
                    <img src="/coba4.png" alt="logo"
                        class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                </div>
                <span class="text-white font-bold text-sm sm:text-lg tracking-wide">
                    Portal <span class="gradient-text">PKL</span>
                </span>
            </a>

            <div class="flex items-center gap-2 sm:gap-3">
                <a href="{{ route('login') }}"
                    class="text-xs sm:text-sm font-medium text-slate-300 hover:text-white px-3 py-1.5 sm:px-4 sm:py-2">
                    Masuk
                </a>
                <a href="{{ route('register') }}"
                    class="text-xs sm:text-sm font-semibold text-white px-3 py-1.5 sm:px-5 sm:py-2.5 rounded-xl"
                    style="background: linear-gradient(135deg, #6366f1, #8b5cf6); box-shadow: 0 4px 15px rgba(99,102,241,0.4);">
                    Daftar
                </a>
            </div>

        </div>
    </nav>

    {{-- Hero --}}
    <section class="hero-bg min-h-screen flex items-center relative overflow-hidden px-4 sm:px-6">

<<<<<<< HEAD
        <!-- Background decorations -->
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute top-20 left-4 sm:left-16 w-40 sm:w-80 h-40 sm:h-80 rounded-full float"
                style="background: radial-gradient(circle, rgba(99,102,241,0.2) 0%, transparent 70%); filter: blur(40px);">
=======
        <div class="absolute bottom-20 right-4 sm:right-16 w-52 sm:w-96 h-52 sm:h-96 rounded-full float-delay"
            style="background: radial-gradient(circle, rgba(139,92,246,0.18) 0%, transparent 70%); filter: blur(50px);">
        </div>

        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[300px] sm:w-[700px] h-[300px] sm:h-[700px] rounded-full"
            style="background: radial-gradient(circle, rgba(99,102,241,0.07) 0%, transparent 65%); filter: blur(30px);">
        </div>
    </div>

    <div class="max-w-7xl mx-auto pt-24 sm:pt-28 pb-16 sm:pb-20 relative z-10 w-full">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">

            <!-- LEFT -->
            <div class="text-center lg:text-left">

                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full mb-6 text-xs sm:text-sm font-semibold"
                    style="background: rgba(99,102,241,0.15); border: 1px solid rgba(99,102,241,0.3); color: #a5b4fc;">
                    <span class="w-2 h-2 rounded-full animate-pulse bg-emerald-400"></span>
                    Portal PKL SMK
                </div>

                <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black text-white leading-tight mb-6">
                    Tingkatkan
                    <span class="gradient-text">Kompetensi</span><br>
                    <span class="text-slate-200">Siap Hadapi Tantangan</span>
                </h1>

                <p class="text-sm sm:text-lg text-slate-400 mb-8 max-w-lg mx-auto lg:mx-0">
                    Hubungkan siswa berbakat dengan perusahaan terbaik. Proses lamaran PKL yang mudah, cepat, dan terstruktur dalam satu platform.
                </p>

                <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 mb-12 justify-center lg:justify-start">
                    <a href="{{ route('register') }}"
                        class="px-6 sm:px-8 py-3 sm:py-4 rounded-2xl font-bold text-white text-sm sm:text-base transition hover:-translate-y-1"
                        style="background: linear-gradient(135deg,#6366f1,#8b5cf6); box-shadow:0 8px 30px rgba(99,102,241,.45);">
                        Mulai Gratis →
                    </a>

                    <a href="#fitur"
                        class="px-6 sm:px-8 py-3 sm:py-4 rounded-2xl font-bold text-white text-sm sm:text-base transition hover:bg-white/10"
                        style="background: rgba(255,255,255,.07); border:1px solid rgba(255,255,255,.12);">
                        Pelajari Fitur
                    </a>
                </div>

                <!-- Stats -->
                <div class="flex justify-center lg:justify-start gap-6 sm:gap-10">
                    <div>
                        <p class="text-2xl sm:text-3xl font-black text-white">500+</p>
                        <p class="text-[10px] sm:text-xs text-slate-500">Lowongan PKL</p>
                    </div>
                    <div class="w-px h-8 sm:h-10 bg-white/10"></div>
                    <div>
                        <p class="text-2xl sm:text-3xl font-black text-white">100%</p>
                        <p class="text-[10px] sm:text-xs text-slate-500">Gratis Selamanya</p>
                    </div>
                    <div class="w-px h-8 sm:h-10 bg-white/10"></div>
                    <div>
                        <p class="text-2xl sm:text-3xl font-black text-white">3x</p>
                        <p class="text-[10px] sm:text-xs text-slate-500">Lebih Cepat</p>
                    </div>
                </div>
>>>>>>> 38ab5d6 (admin)
            </div>

            <div class="absolute bottom-20 right-4 sm:right-16 w-52 sm:w-96 h-52 sm:h-96 rounded-full float-delay"
                style="background: radial-gradient(circle, rgba(139,92,246,0.18) 0%, transparent 70%); filter: blur(50px);">
            </div>

            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[300px] sm:w-[700px] h-[300px] sm:h-[700px] rounded-full"
                style="background: radial-gradient(circle, rgba(99,102,241,0.07) 0%, transparent 65%); filter: blur(30px);">
            </div>
        </div>

        <div class="max-w-7xl mx-auto pt-24 sm:pt-28 pb-16 sm:pb-20 relative z-10 w-full">
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">

                <!-- LEFT -->
                <div class="text-center lg:text-left">

                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full mb-6 text-xs sm:text-sm font-semibold"
                        style="background: rgba(99,102,241,0.15); border: 1px solid rgba(99,102,241,0.3); color: #a5b4fc;">
                        <span class="w-2 h-2 rounded-full animate-pulse bg-emerald-400"></span>
                        Platform PKL Terpercaya
                    </div>

                    <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black text-white leading-tight mb-6">
                        Tingkatkan
                        <span class="gradient-text">Kompetensi</span><br>
                        <span class="text-slate-200">Siap Hadapi Tantangan</span>
                    </h1>

                    <p class="text-sm sm:text-lg text-slate-400 mb-8 max-w-lg mx-auto lg:mx-0">
                        Hubungkan siswa berbakat dengan perusahaan terbaik. Proses lamaran PKL yang mudah, cepat, dan
                        terstruktur dalam satu platform.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 mb-12 justify-center lg:justify-start">
                        <a href="{{ route('register') }}"
                            class="px-6 sm:px-8 py-3 sm:py-4 rounded-2xl font-bold text-white text-sm sm:text-base transition hover:-translate-y-1"
                            style="background: linear-gradient(135deg,#6366f1,#8b5cf6); box-shadow:0 8px 30px rgba(99,102,241,.45);">
                            Mulai Gratis →
                        </a>

                        <a href="#fitur"
                            class="px-6 sm:px-8 py-3 sm:py-4 rounded-2xl font-bold text-white text-sm sm:text-base transition hover:bg-white/10"
                            style="background: rgba(255,255,255,.07); border:1px solid rgba(255,255,255,.12);">
                            Pelajari Fitur
                        </a>
                    </div>

                    <!-- Stats -->
                    <div class="flex justify-center lg:justify-start gap-6 sm:gap-10">
                        <div>
                            <p class="text-2xl sm:text-3xl font-black text-white">500+</p>
                            <p class="text-[10px] sm:text-xs text-slate-500">Lowongan PKL</p>
                        </div>
                        <div class="w-px h-8 sm:h-10 bg-white/10"></div>
                        <div>
                            <p class="text-2xl sm:text-3xl font-black text-white">100%</p>
                            <p class="text-[10px] sm:text-xs text-slate-500">Gratis Selamanya</p>
                        </div>
                        <div class="w-px h-8 sm:h-10 bg-white/10"></div>
                        <div>
                            <p class="text-2xl sm:text-3xl font-black text-white">3x</p>
                            <p class="text-[10px] sm:text-xs text-slate-500">Lebih Cepat</p>
                        </div>
                    </div>
                </div>

                {{-- Floating UI Card --}}
                <div class="hidden lg:flex justify-center relative">
                    <div class="relative">
                        {{-- Main card --}}
                        <div class="rounded-3xl p-6 w-80 float"
                            style="background: rgba(255,255,255,0.05); backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.1);">
                            <div class="flex items-center gap-3 mb-5">
                                <div class="w-10 h-10 rounded-xl flex items-center justify-center text-white font-bold"
                                    style="background: linear-gradient(135deg, #6366f1, #8b5cf6);">
                                    {{ $dudi ? strtoupper(substr($dudi->nama_perusahaan, 0, 2)) : 'PT' }}
                                </div>
                                <div>
                                    <p class="text-white font-semibold text-sm">{{ $dudi->nama_perusahaan ?? 'Perusahaan
                                        Mitra' }}</p>
                                    <p class="text-slate-400 text-xs">{{ $dudi->alamat ?? 'Kota, Indonesia' }}</p>
                                </div>
                                <span class="ml-auto text-xs px-2 py-1 rounded-full font-semibold"
                                    style="background: rgba(52,211,153,0.15); color: #34d399;">Open</span>
                            </div>
                            <p class="text-white font-bold text-lg mb-1">Magang PKL</p>
                            <p class="text-slate-400 text-sm mb-4">{{ $dudi->industry->nama ?? 'Industri' }} · On Site
                            </p>
                            <a href="{{ route('perusahaan.index') }}">
                                <button class="w-full py-2.5 rounded-xl text-white font-semibold text-sm"
                                    style="background: linear-gradient(135deg, #6366f1, #8b5cf6);">Lihat
                                    Perusahaan</button>
                            </a>
                        </div>
                        {{-- Floating notification --}}
                        <div class="absolute -top-4 -right-4 rounded-2xl px-4 py-3 float-delay shadow-2xl"
                            style="background: rgba(255,255,255,0.08); backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.12);">
                            <div class="flex items-center gap-2">
                                <span class="text-lg"><svg style="width:1.125rem;height:1.125rem;color:#10b981"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg></span>
                                <div>
                                    <p class="text-white text-xs font-semibold">Perusahaan Baru</p>
                                    <p class="text-slate-400 text-[10px]">Baru saja mendaftar</p>
                                </div>
                            </div>
                        </div>
                        {{-- Floating badge --}}
                        <div class="absolute -bottom-4 -left-4 rounded-2xl px-4 py-3 float shadow-2xl"
                            style="background: rgba(255,255,255,0.08); backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.12); animation-delay: 1s;">
                            <div class="flex items-center gap-2">
                                <div class="w-7 h-7 rounded-full flex items-center justify-center text-xs font-bold text-white"
                                    style="background: linear-gradient(135deg, #10b981, #0d9488);">
                                    <svg style="width:0.875rem;height:0.875rem" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-white text-xs font-semibold">Mitra PKL</p>
                                    <p class="text-slate-400 text-[10px]">Terpercaya & Terverifikasi</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Features --}}
    <section id="fitur" class="py-28 bg-slate-50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-20">
                <span class="text-sm font-bold text-indigo-400 uppercase tracking-widest">Fitur Unggulan</span>
                <h2 class="text-4xl font-black text-slate-800 mt-3 mb-4">Platform Lengkap untuk PKL</h2>
                <p class="text-slate-500 max-w-xl mx-auto">Semua yang Anda butuhkan untuk proses PKL yang sukses, dari
                    pencarian hingga penerimaan.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                @foreach([
                ['<svg
                    style="width:3rem;height:3rem; background: center; background-size: contain; background-repeat: no-repeat;"
                    fill="none" stroke="#6f44d4" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                </svg>', 'Siswa', 'Temukan lowongan PKL yang sesuai bidang studi, lamar dengan mudah, dan pantau
                status lamaran secara real-time.', 'from-blue-500 to-cyan-500', 'blue'],
                ['<svg
                    style="width:3rem;height:3rem; background: center; background-size: contain; background-repeat: no-repeat;"
                    fill="none" stroke="#6f44d4" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>', 'DUDI', 'Buat lowongan, kelola posisi, dan pilih kandidat terbaik dari database siswa
                yang
                terverifikasi.', 'from-purple-500 to-pink-500', 'purple'],
                ['<svg
                    style="width:3rem;height:3rem; background: center; background-size: contain; background-repeat: no-repeat;"
                    fill="none" stroke="#6f44d4" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>', 'Admin Verified', 'Setiap perusahaan melewati proses verifikasi ketat oleh admin untuk keamanan
                dan kualitas terjamin.', 'from-emerald-500 to-teal-500', 'emerald'],
                ] as $f)
                <div class="card-hover group rounded-3xl p-8 border border-slate-100">
                    <div
                        class="w-16 h-16 rounded-2xl flex items-center justify-center text-3xl mb-6 shadow-lg bg-gradient-to-br {{ $f[3] }} group-hover:scale-110 transition-transform duration-300">
                        {!! $f[0] !!}
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 mb-3">{{ $f[1] }}</h3>
                    <p class="text-slate-500 leading-relaxed">{{ $f[2] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- How it works --}}
    <section class="py-28" style="background: linear-gradient(135deg, #0f172a, #1e1b4b);">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-20">
                <span class="text-sm font-bold text-indigo-400 uppercase tracking-widest">Cara Kerja</span>
                <h2 class="text-4xl font-black text-white mt-3 mb-4">4 Langkah Mudah</h2>
                <p class="text-slate-400 max-w-xl mx-auto">Mulai perjalanan PKL Anda hanya dalam beberapa menit.</p>
            </div>

            <div class="grid md:grid-cols-4 gap-6">
                @foreach([
                ['01', 'Daftar Akun', 'Daftar akun menggunakan akun Google.',
                'from-indigo-500 to-blue-600'],
                ['02', 'Lengkapi Profil', 'Isi data diri lengkap agar DUDI lebih mudah mengenali Anda.',
                'from-purple-500 to-indigo-600'],
                ['03', 'Cari Lowongan', 'Cari tempat PKL yang sesuai minat dan jurusanmu.', 'from-pink-500
                to-purple-600'],
                ['04', 'Mulai PKL', 'Kirim lamaran, tunggu kabar baik, dan mulai pengalaman barumu.',
                'from-emerald-500 to-teal-600'],
                ] as $i => $step)
                <div class="relative text-center group">
                    @if($i < 3) <div class="hidden md:block absolute top-8 left-[60%] w-[80%] h-px opacity-20"
                        style="background: linear-gradient(90deg, #6366f1, transparent);">
                </div>
                @endif
                <div
                    class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-5 text-white font-black text-xl shadow-2xl bg-gradient-to-br {{ $step[3] }} group-hover:scale-110 transition-transform duration-300">
                    {{ $step[0] }}
                </div>
                <h3 class="text-lg font-bold text-white mb-2">{{ $step[1] }}</h3>
                <p class="text-sm text-slate-400 leading-relaxed">{{ $step[2] }}</p>
            </div>
            @endforeach
        </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="py-24 bg-white">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <div class="rounded-3xl p-12 relative overflow-hidden"
                style="background: linear-gradient(135deg, #6366f1, #8b5cf6, #a855f7);">
                <div class="absolute inset-0 opacity-10"
                    style="background-image: radial-gradient(circle at 50% 50%, white 1px, transparent 1px); background-size: 30px 30px;">
                </div>
                <div class="relative z-10">
                    <h2 class="text-4xl font-black text-white mb-4">Siap Memulai?</h2>
                    <p class="text-indigo-100 text-lg mb-8 max-w-md mx-auto">Bergabung dengan ribuan siswa dan
                        perusahaan yang sudah menggunakan Portal PKL.</p>
                    <div class="flex flex-wrap justify-center gap-4">
                        <a href="{{ route('register') }}"
                            class="px-8 py-4 bg-white rounded-2xl font-bold text-indigo-600 hover:bg-indigo-50 transition-colors shadow-xl">
                            Daftar Sekarang — Gratis!
                        </a>
                        <a href="{{ route('login') }}"
                            class="px-8 py-4 rounded-2xl font-bold text-white transition-all hover:bg-white/10"
                            style="background: rgba(255,255,255,0.15); border: 1px solid rgba(255,255,255,0.25);">
                            Sudah punya akun? Masuk
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="py-10 bg-slate-900">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <div
                    class="w-9 h-9 rounded-lg overflow-hidden bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center">
                    <img src="/coba4.png" alt="Portal PKL" class="w-full h-full object-cover">
                </div>
                <span class="text-white font-bold text-lg">Portal <span class="gradient-text">PKL</span></span>
            </div>
            <p class="text-sm text-slate-500">© {{ date('Y') }} Portal PKL. Platform menghubungkan siswa dengan dunia
                industri.</p>
        </div>
    </footer>

</body>

</html>