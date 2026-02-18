<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Portal PKL') — Portal PKL</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        .glass {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.12);
        }

        .glass-white {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .sidebar-link {
            @apply flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-200;
        }

        .sidebar-link:hover {
            @apply bg-white/10;
        }

        .sidebar-link.active {
            @apply bg-gradient-to-r from-indigo-500/30 to-purple-500/30 text-white shadow-lg shadow-indigo-500/10;
        }

        .btn-primary {
            @apply px-5 py-2.5 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-xl font-semibold text-sm shadow-lg shadow-indigo-500/25 hover:shadow-xl hover:shadow-indigo-500/40 hover:-translate-y-0.5 transition-all duration-200;
        }

        .btn-danger {
            @apply px-5 py-2.5 bg-gradient-to-r from-red-600 to-pink-600 text-white rounded-xl font-semibold text-sm shadow-lg shadow-red-500/25 hover:shadow-xl hover:shadow-red-500/40 hover:-translate-y-0.5 transition-all duration-200;
        }

        .btn-success {
            @apply px-5 py-2.5 bg-gradient-to-r from-emerald-600 to-teal-600 text-white rounded-xl font-semibold text-sm shadow-lg shadow-emerald-500/25 hover:shadow-xl transition-all duration-200;
        }

        .btn-outline {
            @apply px-5 py-2.5 border-2 border-slate-200 text-slate-700 rounded-xl font-semibold text-sm hover:bg-slate-50 transition-all duration-200;
        }

        .card {
            @apply bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden;
        }

        .stat-card {
            @apply bg-white rounded-2xl p-6 border border-slate-100 shadow-sm hover:shadow-md transition-shadow duration-300;
        }

        .input-field {
            @apply w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 outline-none transition-all duration-200;
        }

        .badge {
            @apply inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold;
        }

        .badge-pending {
            @apply bg-amber-100 text-amber-800;
        }

        .badge-verified,
        .badge-approved {
            @apply bg-emerald-100 text-emerald-800;
        }

        .badge-rejected {
            @apply bg-red-100 text-red-800;
        }

        .fade-in {
            animation: fadeIn 0.4s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body class="bg-slate-50 min-h-screen">
    <div class="flex min-h-screen">
        {{-- Sidebar --}}
        <aside
            class="w-64 bg-gradient-to-b from-slate-900 via-slate-800 to-slate-900 text-white flex flex-col fixed h-full z-30">
            <div class="p-6 border-b border-white/10">
                <a href="/" class="flex items-center gap-3">
                    <div
                        class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center font-bold text-lg shadow-lg shadow-indigo-500/30">
                        P</div>
                    <div>
                        <h2
                            class="text-lg font-bold bg-gradient-to-r from-white to-slate-300 bg-clip-text text-transparent">
                            Portal PKL</h2>
                        <p class="text-xs text-slate-400 capitalize">{{ auth()->user()->role ?? '' }}</p>
                    </div>
                </a>
            </div>

            <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
                @yield('sidebar')
            </nav>

            <div class="p-4 border-t border-white/10">
                <div class="flex items-center gap-3 mb-3">
                    @if(auth()->user()->avatar)
                    <img src="{{ auth()->user()->avatar }}" class="w-9 h-9 rounded-full ring-2 ring-indigo-500/30"
                        alt="">
                    @else
                    <div
                        class="w-9 h-9 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-sm font-bold">
                        {{ substr(auth()->user()->name, 0, 1) }}</div>
                    @endif
                    <div class="min-w-0">
                        <p class="text-sm font-semibold truncate">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-slate-400 truncate">{{ auth()->user()->email }}</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button
                        class="w-full sidebar-link text-red-300 hover:bg-red-500/10 hover:text-red-200 justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        {{-- Main Content --}}
        <main class="flex-1 ml-64">
            {{-- Top Bar --}}
            <header class="bg-white/80 backdrop-blur-md border-b border-slate-100 sticky top-0 z-20 px-8 py-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-xl font-bold text-slate-800">@yield('page-title', 'Dashboard')</h1>
                        <p class="text-sm text-slate-500">@yield('page-subtitle', '')</p>
                    </div>
                    @yield('header-actions')
                </div>
            </header>

            {{-- Flash Messages --}}
            <div class="px-8 pt-4">
                @if(session('success'))
                <div
                    class="fade-in bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl px-5 py-3 text-sm font-medium flex items-center gap-2 mb-4">
                    <svg class="w-5 h-5 text-emerald-500 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                    {{ session('success') }}
                </div>
                @endif
                @if($errors->any())
                <div class="fade-in bg-red-50 border border-red-200 text-red-800 rounded-xl px-5 py-3 text-sm mb-4">
                    <ul class="space-y-1">
                        @foreach($errors->all() as $error)
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-red-500 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ $error }}
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>

            {{-- Page Content --}}
            <div class="px-8 py-6 fade-in">
                @yield('content')
            </div>
        </main>
    </div>
    @yield('scripts')
</body>

</html>