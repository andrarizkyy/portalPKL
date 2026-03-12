@extends('layouts.app')
@section('page-title', 'Data Siswa Diterima PKL')
@section('page-subtitle', 'Daftar siswa yang telah diterima di tempat PKL')
@section('sidebar') @include('admin._sidebar') @endsection

@section('content')

{{-- Filters --}}
<div class="card" style="padding: 20px; margin-bottom: 20px;">
    <form method="GET" action="{{ route('admin.siswa.index') }}" id="filterForm">
        <div style="display: flex; flex-wrap: wrap; gap: 12px; align-items: flex-end;">

            {{-- Filter Sekolah --}}
            <div style="flex: 1; min-width: 200px;">
                <label
                    style="display: block; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: #475569; margin-bottom: 6px;">
                    <svg style="width:14px;height:14px;display:inline;vertical-align:middle;margin-right:4px"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Sekolah
                </label>
                <select name="sekolah_id" class="input-field" id="sekolahFilter" onchange="onSekolahChange()">
                    <option value="">— Semua Sekolah —</option>
                    @foreach($sekolahs as $s)
                    <option value="{{ $s->id }}" {{ request('sekolah_id')==$s->id ? 'selected' : '' }}>
                        {{ $s->nama }}
                    </option>
                    @endforeach
                </select>
            </div>

            {{-- Filter Jurusan --}}
            <div style="flex: 1; min-width: 200px;">
                <label
                    style="display: block; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: #475569; margin-bottom: 6px;">
                    <svg style="width:14px;height:14px;display:inline;vertical-align:middle;margin-right:4px"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    Jurusan
                </label>
                <select name="jurusan_id" class="input-field" id="jurusanFilter">
                    <option value="">— Semua Jurusan —</option>
                    @foreach($jurusans as $j)
                    <option value="{{ $j->id }}" {{ request('jurusan_id')==$j->id ? 'selected' : '' }}>
                        {{ $j->nama }}
                    </option>
                    @endforeach
                </select>
            </div>

            {{-- Buttons --}}
            <div style="display: flex; gap: 8px;">
                <button type="submit" class="btn-primary btn-sm">
                    <svg style="width:16px;height:16px" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                    </svg>
                    Filter
                </button>
                @if(request('sekolah_id') || request('jurusan_id'))
                <a href="{{ route('admin.siswa.index') }}" class="btn-outline btn-sm">Reset</a>
                @endif
            </div>
        </div>
    </form>
</div>

{{-- Summary Stats --}}
<div
    style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 16px; margin-bottom: 24px;">
    <div class="stat-card" style="text-align: center;">
        <p
            style="font-size: 2rem; font-weight: 800; background: linear-gradient(135deg, #6366f1, #8b5cf6); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
            {{ $siswaDiterima->count() }}</p>
        <p style="font-size: 0.8rem; color: #64748b; font-weight: 600;">Total Siswa Diterima</p>
    </div>
    <div class="stat-card" style="text-align: center;">
        <p
            style="font-size: 2rem; font-weight: 800; background: linear-gradient(135deg, #10b981, #0d9488); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
            {{ $grouped->count() }}</p>
        <p style="font-size: 0.8rem; color: #64748b; font-weight: 600;">Sekolah</p>
    </div>
    <div class="stat-card" style="text-align: center;">
        <p
            style="font-size: 2rem; font-weight: 800; background: linear-gradient(135deg, #f59e0b, #ef4444); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
            {{ $grouped->flatten(1)->count() }}</p>
        <p style="font-size: 0.8rem; color: #64748b; font-weight: 600;">Jurusan</p>
    </div>
</div>

{{-- Search Bar --}}
@include('components.search-bar', ['target' => 'groupedContent', 'placeholder' => 'Cari siswa, sekolah, jurusan, atau
 perusahaan...'])

{{-- Grouped Content --}}
<div id="groupedContent">
    @forelse($grouped as $sekolahNama => $jurusanGroups)
    <div class="card searchable-item" style="margin-bottom: 20px; overflow: hidden;">

        {{-- Sekolah Header --}}
        <div
            style="padding: 16px 20px; background: linear-gradient(135deg, #0f172a, #1e1b4b); display: flex; align-items: center; justify-content: between; gap: 12px;">
            <div style="display: flex; align-items: center; gap: 10px; flex: 1;">
                <div
                    style="width: 36px; height: 36px; border-radius: 10px; background: linear-gradient(135deg, #6366f1, #8b5cf6); display: flex; align-items: center; justify-content: center;">
                    <svg style="width:18px;height:18px;color:#fff" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                </div>
                <div>
                    <h3 style="color: #fff; font-weight: 700; font-size: 1rem;">{{ $sekolahNama }}</h3>
                    <p style="color: rgba(255,255,255,0.4); font-size: 0.75rem;">{{ $jurusanGroups->flatten()->count()
                        }} siswa diterima</p>
                </div>
            </div>
        </div>

        @foreach($jurusanGroups as $jurusanNama => $students)
        {{-- Jurusan Subheader --}}
        <div
            style="padding: 10px 20px; background: linear-gradient(135deg, #eff6ff, #f0fdf4); border-bottom: 1px solid #e8ecf4; display: flex; align-items: center; gap: 8px;">
            <svg style="width:14px;height:14px;color:#6366f1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
            </svg>
            <span style="font-weight: 700; font-size: 0.85rem; color: #334155;">{{ $jurusanNama }}</span>
            <span class="badge badge-active" style="font-size: 0.7rem;">{{ $students->count() }} siswa</span>
        </div>

        {{-- Students Table --}}
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr class="table-header">
                    <th style="text-align: left;">Siswa</th>
                    <th style="text-align: left;">Perusahaan</th>
                    <th style="text-align: left;">Posisi</th>
                    <th style="text-align: left;">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $p)
                <tr class="table-row">
                    <td>
                        <div style="display: flex; align-items: center; gap: 10px;">
                            @if($p->user->avatar)
                            <img src="{{ $p->user->avatar }}" class="w-8 h-8 rounded-full" alt="">
                            @else
                            <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold text-white"
                                style="background: linear-gradient(135deg, #6366f1, #8b5cf6);">
                                {{ strtoupper(substr($p->user->name, 0, 1)) }}
                            </div>
                            @endif
                            <div>
                                <p style="font-weight: 600; color: #1e293b;">{{ $p->user->name }}</p>
                                <p style="font-size: 0.75rem; color: #94a3b8;">{{ $p->user->email }}</p>
                            </div>
                        </div>
                    </td>
                    <td>{{ $p->posisi->lowongan->dudiProfile->nama_perusahaan ?? '-' }}</td>
                    <td><span class="badge badge-approved">{{ $p->posisi->nama ?? '-' }}</span></td>
                    <td style="font-size: 0.8rem; color: #94a3b8;">{{ $p->created_at->format('d M Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endforeach
    </div>
    @empty
    <div class="card" style="padding: 60px 20px; text-align: center;">
        <svg style="width:48px;height:48px;color:#cbd5e1;margin:0 auto 12px" fill="none" stroke="currentColor"
            viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
        </svg>
        <p style="color: #64748b; font-weight: 600;">Belum ada siswa yang diterima PKL.</p>
        @if(request('sekolah_id') || request('jurusan_id'))
        <p style="color: #94a3b8; font-size: 0.85rem; margin-top: 4px;">Coba ubah filter atau <a
                href="{{ route('admin.siswa.index') }}" style="color: #6366f1; font-weight: 600;">reset filter</a>.</p>
        @endif
    </div>
    @endforelse
</div>

{{-- No search results --}}
<div id="noResults_groupedContent" class="card p-12 text-center" style="display: none;">
    <svg class="w-10 h-10 mx-auto mb-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
    </svg>
    <p class="text-slate-500 font-medium">Tidak ada siswa yang cocok.</p>
</div>

@endsection

@section('scripts')
<script>
    function onSekolahChange() {
        const sekolahId = document.getElementById('sekolahFilter').value;
        // Reset jurusan filter
        document.getElementById('jurusanFilter').innerHTML = '<option value="">— Semua Jurusan —</option>';

        if (sekolahId) {
            // Fetch jurusan for this sekolah
            fetch('/api/jurusan/' + sekolahId)
                .then(r => r.json())
                .then(data => {
                    const select = document.getElementById('jurusanFilter');
                    data.forEach(j => {
                        const opt = document.createElement('option');
                        opt.value = j.id;
                        opt.textContent = j.nama;
                        select.appendChild(opt);
                    });
                });
        }
    }

    // Search filter for grouped content
    function searchFilter_groupedContent(query) {
        const container = document.getElementById('groupedContent');
        const items = container.querySelectorAll('.searchable-item');
        const noResults = document.getElementById('noResults_groupedContent');
        const clearBtn = document.getElementById('clearBtn_groupedContent');
        const countEl = document.getElementById('searchCount_groupedContent');
        const q = query.toLowerCase().trim();
        let visible = 0;

        if (clearBtn) clearBtn.style.display = q ? 'block' : 'none';

        items.forEach(item => {
            const text = item.textContent.toLowerCase();
            const match = !q || text.includes(q);
            item.style.display = match ? '' : 'none';
            if (match) visible++;
        });

        if (countEl) {
            if (q) {
                countEl.style.display = 'block';
                countEl.textContent = visible + ' dari ' + items.length + ' kelompok ditemukan';
            } else {
                countEl.style.display = 'none';
            }
        }

        if (noResults) {
            noResults.style.display = (q && visible === 0) ? 'block' : 'none';
        }
    }
</script>
@endsection