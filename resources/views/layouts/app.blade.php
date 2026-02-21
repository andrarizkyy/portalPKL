<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Portal PKL') — Portal PKL</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* ── Sidebar ── */
        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            border-radius: 12px;
            font-size: 0.875rem;
            font-weight: 500;
            color: rgba(255, 255, 255, 0.6);
            transition: all 0.2s ease;
        }

        .sidebar-link:hover {
            background: rgba(255, 255, 255, 0.08);
            color: #fff;
        }

        .sidebar-link.active {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.3), rgba(168, 85, 247, 0.2));
            color: #fff;
            box-shadow: 0 0 0 1px rgba(99, 102, 241, 0.3) inset;
        }

        .sidebar-link svg {
            flex-shrink: 0;
        }

        /* ── Buttons ── */
        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 10px 20px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: #fff;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.875rem;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.35);
            transition: all 0.2s ease;
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 25px rgba(99, 102, 241, 0.45);
        }

        .btn-danger {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 10px 20px;
            background: linear-gradient(135deg, #ef4444, #ec4899);
            color: #fff;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.875rem;
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
            transition: all 0.2s ease;
        }

        .btn-danger:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 25px rgba(239, 68, 68, 0.4);
        }

        .btn-success {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 10px 20px;
            background: linear-gradient(135deg, #10b981, #0d9488);
            color: #fff;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.875rem;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
            transition: all 0.2s ease;
        }

        .btn-success:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.4);
        }

        .btn-outline {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 10px 20px;
            background: #fff;
            border: 1.5px solid #e2e8f0;
            color: #475569;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.875rem;
            transition: all 0.2s ease;
        }

        .btn-outline:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
        }

        .btn-sm {
            padding: 7px 14px !important;
            font-size: 0.8rem !important;
        }

        /* ── Cards ── */
        .card {
            background: #fff;
            border-radius: 18px;
            border: 1px solid #f1f5f9;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04), 0 4px 12px rgba(0, 0, 0, 0.03);
        }

        .stat-card {
            background: #fff;
            border-radius: 18px;
            padding: 24px;
            border: 1px solid #f1f5f9;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04), 0 4px 12px rgba(0, 0, 0, 0.03);
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        }

        /* ── Form ── */
        .input-field {
            width: 100%;
            padding: 10px 14px;
            background: #f8fafc;
            border: 1.5px solid #e2e8f0;
            border-radius: 12px;
            font-size: 0.875rem;
            color: #1e293b;
            transition: all 0.2s ease;
            outline: none;
        }

        .input-field:focus {
            background: #fff;
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.12);
        }

        /* ── Badges ── */
        .badge {
            display: inline-flex;
            align-items: center;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .badge-pending {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-approved,
        .badge-verified {
            background: #d1fae5;
            color: #065f46;
        }

        .badge-rejected {
            background: #fee2e2;
            color: #991b1b;
        }

        .badge-cancelled {
            background: #f1f5f9;
            color: #475569;
        }

        .badge-active {
            background: #dbeafe;
            color: #1e40af;
        }

        /* ── Table ── */
        .table-header {
            background: #f8fafc;
        }

        .table-header th {
            padding: 12px 16px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #94a3b8;
        }

        .table-row td {
            padding: 14px 16px;
            font-size: 0.875rem;
            color: #475569;
            border-top: 1px solid #f1f5f9;
        }

        .table-row:hover td {
            background: #fafbfc;
        }

        /* ── Animations ── */
        .fade-in {
            animation: fadeIn 0.35s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(6px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .slide-in {
            animation: slideIn 0.4s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-8px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* ── Sidebar scrollbar ── */
        nav::-webkit-scrollbar {
            width: 4px;
        }

        nav::-webkit-scrollbar-track {
            background: transparent;
        }

        nav::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 4px;
        }

        /* ── Section labels ── */
        .nav-section {
            font-size: 0.65rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: rgba(255, 255, 255, 0.25);
            padding: 14px 14px 4px;
        }
    </style>
</head>

<body class="bg-slate-50 min-h-screen">
    <div class="flex min-h-screen">
        {{-- Sidebar --}}
        <aside class="w-64 fixed h-full z-30 flex flex-col"
            style="background: linear-gradient(180deg, #0f172a 0%, #1a1040 50%, #0f172a 100%);">

            {{-- Logo --}}
            <div class="px-5 py-5 border-b border-white/[0.06]">
                <a href="/" class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl flex items-center justify-center font-black text-white text-base shadow-lg"
                        style="background: linear-gradient(135deg, #6366f1, #8b5cf6);">P</div>
                    <div>
                        <p class="text-white font-bold text-base leading-none">Portal PKL</p>
                        <p class="text-[11px] mt-0.5 capitalize" style="color: rgba(255,255,255,0.35);">{{
                            auth()->user()->role ?? '' }}</p>
                    </div>
                </a>
            </div>

            {{-- Nav --}}
            <nav class="flex-1 px-3 py-4 space-y-0.5 overflow-y-auto">
                @yield('sidebar')
            </nav>

            {{-- User profile --}}
            <div class="px-4 py-4 border-t border-white/[0.06]">
                <div class="flex items-center gap-3 mb-3 px-2">
                    @if(auth()->user()->profile_photo)
                    <img src="{{ auth()->user()->profile_photo }}"
                        class="w-8 h-8 rounded-full ring-2 ring-indigo-500/40" alt="">
                    @else
                    <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold text-white shrink-0"
                        style="background: linear-gradient(135deg, #6366f1, #8b5cf6);">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    @endif
                    <div class="min-w-0">
                        <p class="text-sm font-semibold text-white truncate">{{ auth()->user()->name }}</p>
                        <p class="text-[11px] truncate" style="color: rgba(255,255,255,0.35);">{{ auth()->user()->email
                            }}</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="sidebar-link w-full justify-center text-red-400 hover:text-red-300"
                        style="background: rgba(239,68,68,0.06);">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Keluar
                    </button>
                </form>
            </div>
        </aside>

        {{-- Main --}}
        <main class="flex-1 ml-64 min-h-screen flex flex-col">
            {{-- Topbar --}}
            <header class="sticky top-0 z-20 px-8 py-4 flex items-center justify-between"
                style="background: rgba(248,250,252,0.85); backdrop-filter: blur(12px); border-bottom: 1px solid #f1f5f9;">
                <div>
                    <h1 class="text-lg font-bold text-slate-800 leading-none">@yield('page-title', 'Dashboard')</h1>
                    @hasSection('page-subtitle')
                    <p class="text-sm text-slate-400 mt-0.5">@yield('page-subtitle')</p>
                    @endif
                </div>
                <div class="flex items-center gap-3">
                    @yield('header-actions')
                </div>
            </header>

            {{-- Alerts --}}
            <div class="px-8 pt-5">
                @if(session('success'))
                <div class="fade-in flex items-center gap-3 px-4 py-3.5 rounded-2xl mb-4 text-sm font-medium"
                    style="background: #ecfdf5; border: 1px solid #a7f3d0; color: #065f46;">
                    <svg class="w-5 h-5 shrink-0" style="color: #059669;" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                    {{ session('success') }}
                </div>
                @endif
                @if($errors->any())
                <div class="fade-in px-4 py-3.5 rounded-2xl mb-4 text-sm"
                    style="background: #fff1f2; border: 1px solid #fecdd3; color: #991b1b;">
                    <ul class="space-y-1">
                        @foreach($errors->all() as $error)
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 shrink-0 text-red-400" fill="currentColor" viewBox="0 0 20 20">
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

            {{-- Content --}}
            <div class="px-8 pb-8 pt-4 fade-in flex-1">
                @yield('content')
            </div>
        </main>
    </div>
    @yield('scripts')
</body>

</html>