@extends('layouts.app')
@section('sidebar') @include('dudi._sidebar') @endsection

@section('page-title', 'Lamaran Masuk')
@section('page-subtitle', 'Tinjau dan kelola semua kandidat yang melamar')


@section('content')

<div class="card overflow-hidden"
style="background: linear-gradient(135deg,#faf5ff 0%,#f8fafc 100%); border-color:#e9d5ff;">

@if($lamarans->isEmpty())

<div style="padding:64px 16px;text-align:center;">
    <h3 style="font-size:1.25rem;font-weight:700;color:#334155;margin-bottom:8px;">
        Belum Ada Lamaran
    </h3>
    <p style="color:#475569;">
        Belum ada siswa yang melamar ke lowongan Anda saat ini.
    </p>
</div>

@else

<div class="px-3 sm:px-6 pt-5">
    <div class="overflow-x-auto">
    <table id="dudiLamaran" class="table table-striped table-hover nowrap">
    <thead class="table-light">
        <tr>
            <th class="text-start fw-bold text-uppercase small">Pelamar</th>
            <th class="text-start fw-bold text-uppercase small">Posisi</th>
            <th class="text-start fw-bold text-uppercase small">Sekolah / Jurusan</th>
            <th class="text-start fw-bold text-uppercase small">Tanggal</th>
            <th class="text-start fw-bold text-uppercase small">Status</th>
            <th class="text-end" style="width: 80px;"></th>
        </tr>
    </thead>

<tbody>
        @foreach($lamarans as $l)
        <tr class="searchable-item">
            <td class="py-3 px-4">
                <div class="d-flex align-items-center gap-3">
                    @if($l->user && $l->user->profile_photo)
                    <img src="{{ $l->user->profile_photo }}" class="rounded-circle" style="width: 36px; height: 36px; object-fit: cover;" alt="Foto Profil">
                    @else
                    <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold text-white" style="width: 36px; height: 36px; background: linear-gradient(135deg, #6366f1, #8b5cf6); font-size: 0.75rem;">
                        {{ $l->user ? strtoupper(substr($l->user->name, 0, 1)) : '?' }}
                    </div>
                    @endif
                    <div class="flex-grow-1 min-w-0">
                        <p class="mb-0 fw-semibold text-truncate">{{ $l->user->name ?? '-' }}</p>
                        <p class="mb-0 text-muted small text-truncate">{{ $l->user->email ?? '-' }}</p>
                    </div>
                </div>
            </td>


<td class="py-3 px-4 fw-medium">{{ $l->posisi->nama ?? '-' }}</td>
            <td class="py-3 px-4">
                <p class="mb-0 fw-medium">{{ $l->sekolah->nama ?? '-' }}</p>
                <p class="mb-0 text-muted small">{{ $l->jurusan->nama ?? '-' }}</p>
            </td>
            <td class="py-3 px-4 text-muted">{{ $l->created_at->format('d M Y') }}</td>
            <td class="py-3 px-4">
                @php
                $statusMap = [
                    'pending' => ['bg-warning', 'Pending'],
                    'approved' => ['bg-success', 'Diterima'],
                    'rejected' => ['bg-danger', 'Ditolak'],
                    'cancelled' => ['bg-secondary', 'Dibatalkan'],
                ];
                $s = $statusMap[$l->status] ?? ['bg-secondary', ucfirst($l->status)];
                @endphp
                <span class="badge {{ $s[0] }}">{{ $s[1] }}</span>
            </td>
            <td class="py-3 px-4 text-end">
                <a href="{{ route('dudi.lamaran.show', $l) }}" class="btn btn-outline-primary btn-sm">Detail</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


</div>
</div>          


<div id="noResults_dudiLamaran"
style="display:none;padding:48px 16px;text-align:center;">

<p style="color:#64748b;font-weight:500;">
Tidak ada lamaran yang cocok.
</p>

</div>

@endif

</div>

@endsection



@section('scripts')
<script>

function searchFilter_dudiLamaran(query){

const container=document.getElementById('dudiLamaran');
if(!container) return;

const rows=container.querySelectorAll('.searchable-item');

const noResults=document.getElementById('noResults_dudiLamaran');
const clearBtn=document.getElementById('clearBtn_dudiLamaran');
const countEl=document.getElementById('searchCount_dudiLamaran');

const q=query.toLowerCase().trim();

let visible=0;

clearBtn.style.display=q?'block':'none';

rows.forEach(row=>{

const nama=row.querySelector('.nama-pelamar')?.textContent.toLowerCase() || '';
const posisi=row.querySelector('.posisi-nama')?.textContent.toLowerCase() || '';
const sekolah=row.querySelector('.sekolah-nama')?.textContent.toLowerCase() || '';
const jurusan=row.querySelector('.jurusan-nama')?.textContent.toLowerCase() || '';
const status=row.querySelector('.status-lamaran')?.textContent.toLowerCase() || '';

const text=nama+' '+posisi+' '+sekolah+' '+jurusan+' '+status;

const match=!q || text.includes(q);

row.style.display=match?'':'none';

if(match) visible++;

});

if(q){
countEl.style.display='block';
countEl.textContent=visible+' dari '+rows.length+' lamaran ditemukan';
}else{
countEl.style.display='none';
}

noResults.style.display=(q && visible===0)?'block':'none';

}

</script>
@endsection