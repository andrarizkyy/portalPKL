@extends('layouts.app')
@section('sidebar') @include('siswa._sidebar') @endsection
@section('page-title', $lowongan->judul)
@section('page-subtitle', $lowongan->dudiProfile->nama_perusahaan)

@section('content')
<div class="max-w-4xl">
    @if($hasApproved)
    <div class="card p-5 mb-6"
        style="background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%); border-color: #86efac;">
        <div class="flex items-center gap-3">
            <svg class="w-6 h-6 text-green-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <div>
                <p class="font-bold text-green-800">Anda sudah diterima di lowongan lain!</p>
                <p class="text-sm text-green-700">Anda tidak dapat melamar lowongan baru karena sudah diterima.</p>
            </div>
        </div>
    </div>
    @endif

    <div class="card p-6 mb-6"
        style="background: linear-gradient(135deg, #eff6ff 0%, #f8fafc 100%); border-color: #bfdbfe;">
        @if($lowongan->gambar)
        <img src="{{ asset('storage/' . $lowongan->gambar) }}" class="w-full h-64 object-cover rounded-xl mb-6" alt="">
        @endif

        <div class="flex flex-wrap gap-2 mb-4">
            <span class="badge bg-indigo-100 text-indigo-800">{{ $lowongan->dudiProfile->industry->nama ?? '' }}</span>
            <span class="badge bg-slate-100 text-slate-600">{{ $lowongan->tanggal_mulai->format('d M Y') }} - {{
                $lowongan->tanggal_selesai->format('d M Y') }}</span>
        </div>

        <div class="prose prose-sm max-w-none text-slate-600 mb-6">
            {!! nl2br(e($lowongan->deskripsi)) !!}
        </div>

        <div class="border-t border-slate-100 pt-6">
            <h3 class="text-lg font-bold text-slate-800 mb-4">Posisi yang Tersedia</h3>
            <div class="space-y-3">
                @foreach($lowongan->posisis as $posisi)
                <div class="flex items-center justify-between p-2 bg-slate-50 rounded-xl border border-slate-100">
                    <div>
                        <p class="font-semibold text-slate-800">{{ $posisi->nama }}</p>
                        <p class="text-sm text-slate-500">Kuota: {{ $posisi->sisaTempat() }}/{{ $posisi->kuota }}
                            tersisa</p>
                    </div>
                    @if(in_array($posisi->id, $appliedPosisiIds))
                    <span class="badge badge-pending">Sudah Dilamar</span>
                    @elseif($hasApproved)
                    <span class="badge bg-green-100 text-green-700">Sudah Diterima di Lowongan Lain</span>
                    @elseif($posisi->sisaTempat() > 0)
                    <a href="{{ route('siswa.lamar', [$lowongan, $posisi]) }}" class="btn-primary text-sm">Lamar</a>
                    @else
                    <span class="badge bg-slate-200 text-slate-500">Kuota Penuh</span>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <a href="{{ route('siswa.lowongan.index') }}" class="btn-outline">Kembali</a>
</div>
@endsection