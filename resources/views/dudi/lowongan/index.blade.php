@extends('layouts.app')
@section('sidebar') @include('dudi._sidebar') @endsection
@section('page-title', 'Lowongan Saya')
@section('page-subtitle', 'Kelola semua posisi magang yang Anda buka')

@section('header-actions')
@if($profile && $profile->status === 'verified')
<a href="{{ route('dudi.lowongan.create') }}" class="btn-primary">
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
    </svg>
    Buat Lowongan
</a>
@endif
@endsection

@section('content')
@if(!$profile || $profile->status !== 'verified')
<div class="card p-8 text-center"
    style="background: linear-gradient(135deg, #fffbeb 0%, #fef9ee 100%); border-color: #fde68a;">
    <div class="text-5xl mb-4"><svg style="width:2.5rem;height:2.5rem;color:#94a3b8" fill="none" stroke="currentColor"
            viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
        </svg></div>
    <h3 class="font-bold text-slate-700 text-lg mb-2">Akun Belum Terverifikasi</h3>
    <p class="text-slate-500 text-sm">Perusahaan Anda harus diverifikasi oleh admin sebelum bisa membuat lowongan.</p>
</div>
@elseif($lowongans->isEmpty())
<div class="card p-16 text-center"
    style="background: linear-gradient(135deg, #eef2ff 0%, #f8fafc 100%); border-color: #c7d2fe;">
    <div class="text-6xl mb-4"><svg style="width:3rem;height:3rem;color:#94a3b8" fill="none" stroke="currentColor"
            viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
        </svg></div>
    <h3 class="text-xl font-bold text-slate-700 mb-2">Belum Ada Lowongan</h3>
    <p class="text-slate-600 mb-6">Mulai buat lowongan PKL pertama Anda dan temukan kandidat terbaik.</p>
    <a href="{{ route('dudi.lowongan.create') }}" class="btn-primary">+ Buat Lowongan Pertama</a>
</div>
@else

<div class="card overflow-hidden"
    style="background: linear-gradient(135deg, #eef2ff 0%, #f8fafc 100%); border-color: #c7d2fe;">
    <div style="padding: 20px 20px 0 20px;">
        @include('components.search-bar', ['target' => 'dudiLowongan', 'placeholder' => 'Cari lowongan, posisi...'])
    </div>

    <div style="overflow-x: auto; padding: 0 20px 20px 20px;">
        <table id="tableLowongan" style="width: 100%; border-collapse: collapse; min-width: 800px;">
            <thead>
                <tr style="background: linear-gradient(135deg, #f1f5f9, #f8fafc); border-bottom: 1px solid #e2e8f0;">
                    <th style="text-align: left; padding: 12px 20px;">Lowongan</th>
                    <th style="text-align: left; padding: 12px 20px;">Tanggal</th>
                    <th style="text-align: left; padding: 12px 20px;">Posisi</th>
                    <th style="padding: 12px 20px; width: 150px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($lowongans as $l)
                <tr style="border-bottom: 1px solid #f1f5f9; transition: background 0.15s;"
                    onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                    <td style="padding: 12px 20px;">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl flex items-center justify-center text-white shrink-0"
                                style="background: linear-gradient(135deg, #6366f1, #8b5cf6);">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-bold text-slate-800">{{ $l->judul }}</p>
                                @if($l->is_published)
                                <span class="badge badge-approved" style="font-size: 0.65rem;">● Dipublikasikan</span>
                                @else
                                <span class="badge badge-cancelled" style="font-size: 0.65rem;">○ Draft</span>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td style="padding: 12px 20px;">
                        <span class="text-sm text-slate-600">
                            {{ $l->tanggal_mulai->format('d M Y') }} - {{ $l->tanggal_selesai->format('d M Y') }}
                        </span>
                    </td>
                    <td style="padding: 12px 20px;">
                        <div class="flex flex-wrap gap-1">
                            @foreach($l->posisis as $p)
                            <span class="text-xs px-2 py-0.5 rounded-md font-medium"
                                style="background: rgba(99,102,241,0.08); color: #6366f1;">
                                {{ $p->nama }} ({{ $p->kuota }})
                            </span>
                            @endforeach
                        </div>
                    </td>
                    <td style="padding: 12px 20px;">
                        <div class="flex items-center gap-2">
                            <a href="{{ route('dudi.lowongan.show', $l) }}" class="btn-outline btn-sm" title="Detail">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </a>
                            <a href="{{ route('dudi.lowongan.edit', $l) }}" class="btn-outline btn-sm" title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </a>
                            <form method="POST" action="{{ route('dudi.lowongan.destroy', $l) }}"
                                onsubmit="return confirm('Yakin hapus lowongan ini?')">
                                @csrf @method('DELETE')
                                <button class="btn-danger btn-sm" title="Hapus">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif
@endsection

@section('scripts')
<script>
    function searchFilter_dudiLowongan(query) {
        const container = document.getElementById('dudiLowongan');
        const items = container.querySelectorAll('.searchable-item');
        const noResults = document.getElementById('noResults_dudiLowongan');
        const clearBtn = document.getElementById('clearBtn_dudiLowongan');
        const countEl = document.getElementById('searchCount_dudiLowongan');
        const q = query.toLowerCase().trim();
        let visible = 0;

        clearBtn.style.display = q ? 'block' : 'none';

        items.forEach(item => {
            const text = item.textContent.toLowerCase();
            const match = !q || text.includes(q);
            item.style.display = match ? '' : 'none';
            if (match) visible++;
        });

        if (q) {
            countEl.style.display = 'block';
            countEl.textContent = visible + ' dari ' + items.length + ' lowongan ditemukan';
        } else {
            countEl.style.display = 'none';
        }

        noResults.style.display = (q && visible === 0) ? 'block' : 'none';
    }
</script>
@endsection