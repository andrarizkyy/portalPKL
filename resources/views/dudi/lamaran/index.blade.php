@extends('layouts.app')
@section('sidebar') @include('dudi._sidebar') @endsection
@section('page-title', 'Lamaran Masuk')
@section('page-subtitle', 'Tinjau dan kelola semua kandidat yang melamar')

@section('content')
<div class="card overflow-hidden"
    style="background: linear-gradient(135deg, #faf5ff 0%, #f8fafc 100%); border-color: #e9d5ff;">
    @if($lamarans->isEmpty())
    <div style="padding: 64px 16px; text-align: center;">
        <div style="margin-bottom: 16px;"><svg style="width:3rem;height:3rem;color:#94a3b8;margin:0 auto;" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg></div>
        <h3 style="font-size: 1.25rem; font-weight: 700; color: #334155; margin-bottom: 8px;">Belum Ada Lamaran</h3>
        <p style="color: #475569;">Belum ada siswa yang melamar ke lowongan Anda saat ini.</p>
    </div>
    @else
    <div style="padding: 20px 20px 0 20px;">
        @include('components.search-bar', ['target' => 'dudiLamaran', 'placeholder' => 'Cari pelamar, posisi, sekolah, atau status...'])
    </div>
            <thead>
                <tr style="background: linear-gradient(135deg, #f1f5f9, #f8fafc); border-bottom: 1px solid #e2e8f0;">
                    <th
                        style="text-align: left; padding: 12px 20px; font-size: 0.7rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 0.05em;">
                        Pelamar</th>
                    <th
                        style="text-align: left; padding: 12px 20px; font-size: 0.7rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 0.05em;">
                        Posisi</th>
                    <th
                        style="text-align: left; padding: 12px 20px; font-size: 0.7rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 0.05em;">
                        Sekolah / Jurusan</th>
                    <th
                        style="text-align: left; padding: 12px 20px; font-size: 0.7rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 0.05em;">
                        Tanggal</th>
                    <th
                        style="text-align: left; padding: 12px 20px; font-size: 0.7rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 0.05em;">
                        Status</th>
                    <th style="padding: 12px 20px; width: 80px;"></th>
                </tr>
            </thead>
            <tbody id="dudiLamaran">
                @foreach($lamarans as $l)
                <tr class="searchable-item" style="border-bottom: 1px solid #f1f5f9; transition: background 0.15s;"
                    onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                    <td style="padding: 12px 20px;">
                        <div style="display: flex; align-items: center; gap: 10px;">
                            @if($l->user && $l->user->profile_photo)
                            <img src="{{ $l->user->profile_photo }}"
                                style="width: 36px; height: 36px; border-radius: 50%; object-fit: cover; flex-shrink: 0;"
                                alt="">
                            @else
                            <div
                                style="width: 36px; height: 36px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.75rem; font-weight: 700; color: white; flex-shrink: 0; background: linear-gradient(135deg, #6366f1, #8b5cf6);">
                                {{ $l->user ? strtoupper(substr($l->user->name, 0, 1)) : '?' }}
                            </div>
                            @endif
                            <div style="min-width: 0;">
                                <p
                                    style="font-size: 0.875rem; font-weight: 600; color: #1e293b; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                    {{ $l->user->name ?? '-' }}</p>
                                <p
                                    style="font-size: 0.75rem; color: #64748b; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                    {{ $l->user->email ?? '-' }}</p>
                            </div>
                        </div>
                    </td>
                    <td style="padding: 12px 20px;">
                        <span style="font-size: 0.875rem; font-weight: 500; color: #334155;">{{ $l->posisi->nama ?? '-'
                            }}</span>
                    </td>
                    <td style="padding: 12px 20px;">
                        <p style="font-size: 0.875rem; color: #475569; font-weight: 500;">{{ $l->sekolah->nama ?? '-' }}
                        </p>
                        <p style="font-size: 0.75rem; color: #64748b;">{{ $l->jurusan->nama ?? '-' }}</p>
                    </td>
                    <td style="padding: 12px 20px; font-size: 0.875rem; color: #64748b; white-space: nowrap;">{{
                        $l->created_at->format('d M Y') }}</td>
                    <td style="padding: 12px 20px;">
                        @php
                        $statusMap = [
                        'pending' => ['badge-pending', 'Pending'],
                        'approved' => ['badge-approved', 'Diterima'],
                        'rejected' => ['badge-rejected', 'Ditolak'],
                        'cancelled' => ['badge-cancelled', 'Dibatalkan'],
                        ];
                        $s = $statusMap[$l->status] ?? ['badge-cancelled', ucfirst($l->status)];
                        @endphp
                        <span class="badge {{ $s[0] }}">{{ $s[1] }}</span>
                    </td>
                    <td style="padding: 12px 20px; text-align: right;">
                        <a href="{{ route('dudi.lamaran.show', $l) }}" class="btn-outline btn-sm">Detail</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- No results --}}
    <div id="noResults_dudiLamaran" style="display: none; padding: 48px 16px; text-align: center;">
        <svg style="width: 40px; height: 40px; margin: 0 auto 12px; color: #cbd5e1;" fill="none" stroke="currentColor"
            viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
        <p style="color: #64748b; font-weight: 500;">Tidak ada lamaran yang cocok.</p>
    </div>
    @endif
</div>
@endsection

@section('scripts')
<script>
    function searchFilter_dudiLamaran(query) {
        const container = document.getElementById('dudiLamaran');
        if (!container) return;
        const items = container.querySelectorAll('.searchable-item');
        const noResults = document.getElementById('noResults_dudiLamaran');
        const clearBtn = document.getElementById('clearBtn_dudiLamaran');
        const countEl = document.getElementById('searchCount_dudiLamaran');
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
            countEl.textContent = visible + ' dari ' + items.length + ' lamaran ditemukan';
        } else {
            countEl.style.display = 'none';
        }

        noResults.style.display = (q && visible === 0) ? 'block' : 'none';
    }
</script>
@endsection