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

<div style="padding:20px 20px 0 20px;">
@include('components.search-bar', [
'target'=>'dudiLamaran',
'placeholder'=>'Cari nama pelamar, posisi, sekolah...'
])
</div>

<div style="overflow-x:auto;padding:0 20px 20px 20px;">

<table style="width:100%;border-collapse:collapse;min-width:850px;">

<thead>
<tr style="background:linear-gradient(135deg,#f1f5f9,#f8fafc);
border-bottom:1px solid #e2e8f0;">

<th style="text-align:left;padding:12px 20px;">Pelamar</th>
<th style="text-align:left;padding:12px 20px;">Posisi</th>
<th style="text-align:left;padding:12px 20px;">Sekolah / Jurusan</th>
<th style="text-align:left;padding:12px 20px;">Tanggal</th>
<th style="text-align:left;padding:12px 20px;">Status</th>
<th style="padding:12px 20px;width:90px;"></th>

</tr>
</thead>

<tbody id="dudiLamaran">

@foreach($lamarans as $l)

<tr class="searchable-item"
style="border-bottom:1px solid #f1f5f9;transition:background .15s;"
onmouseover="this.style.background='#f8fafc'"
onmouseout="this.style.background='transparent'">

<td style="padding:12px 20px;">
<div style="display:flex;align-items:center;gap:10px;">

@if($l->user && $l->user->profile_photo)

<img src="{{ $l->user->profile_photo }}"
style="width:36px;height:36px;border-radius:50%;object-fit:cover;">

@else

<div style="width:36px;height:36px;border-radius:50%;
display:flex;align-items:center;justify-content:center;
font-size:0.75rem;font-weight:700;color:white;
background:linear-gradient(135deg,#6366f1,#8b5cf6);">

{{ $l->user ? strtoupper(substr($l->user->name,0,1)) : '?' }}

</div>

@endif

<div class="nama-pelamar">
<p style="font-weight:600;color:#1e293b;">
{{ $l->user->name ?? '-' }}
</p>

<p style="font-size:0.75rem;color:#64748b;">
{{ $l->user->email ?? '-' }}
</p>
</div>

</div>
</td>


<td style="padding:12px 20px;">
<span class="posisi-nama"
style="font-weight:500;color:#334155;">
{{ $l->posisi->nama ?? '-' }}
</span>
</td>


<td style="padding:12px 20px;">
<p class="sekolah-nama" style="font-weight:500;color:#475569;">
{{ $l->sekolah->nama ?? '-' }}
</p>

<p class="jurusan-nama" style="font-size:0.75rem;color:#64748b;">
{{ $l->jurusan->nama ?? '-' }}
</p>
</td>


<td style="padding:12px 20px;color:#64748b;">
{{ $l->created_at->format('d M Y') }}
</td>


<td style="padding:12px 20px;">
<span class="status-lamaran badge badge-{{ $l->status }}">
{{ ucfirst($l->status) }}
</span>
</td>


<td style="padding:12px 20px;text-align:right;">
<a href="{{ route('dudi.lamaran.show',$l) }}"
class="btn-outline btn-sm">
Detail
</a>
</td>

</tr>

@endforeach

</tbody>
</table>

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