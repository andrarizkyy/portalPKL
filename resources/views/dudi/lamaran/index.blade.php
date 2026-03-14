@extends('layouts.app')
@section('sidebar') @include('dudi._sidebar') @endsection

@section('page-title', 'Lamaran Masuk')
@section('page-subtitle', 'Tinjau dan kelola semua kandidat yang melamar')

@section('content')
{{-- DataTables CSS --}}
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.dataTables.min.css">

<style>
    /* ── DataTables Custom Theme ── */
    #myTable_wrapper {
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    /* Search & length controls */
    .dt-search input {
        padding: 8px 14px !important;
        background: #f8fafc !important;
        border: 1.5px solid #e2e8f0 !important;
        border-radius: 10px !important;
        font-size: 0.85rem !important;
        color: #1e293b !important;
        outline: none !important;
        transition: all 0.2s ease !important;
    }

    .dt-search input:focus {
        background: #fff !important;
        border-color: #6366f1 !important;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.12) !important;
    }

    .dt-search label {
        font-size: 0.85rem !important;
        color: #64748b !important;
        font-weight: 500 !important;
    }

    .dt-length select {
        padding: 6px 28px 6px 12px !important;
        background: #f8fafc !important;
        border: 1.5px solid #e2e8f0 !important;
        border-radius: 10px !important;
        font-size: 0.85rem !important;
        color: #1e293b !important;
        outline: none !important;
        cursor: pointer !important;
    }

    .dt-length label {
        font-size: 0.85rem !important;
        color: #64748b !important;
        font-weight: 500 !important;
    }

    /* Table styling */
    table.dataTable {
        border-collapse: collapse !important;
        width: 100% !important;
    }

    table.dataTable thead th {
        background: linear-gradient(135deg, #f1f5f9, #f8fafc) !important;
        border-bottom: 1px solid #e2e8f0 !important;
        text-align: left !important;
        padding: 12px 20px !important;
        font-size: 0.7rem !important;
        font-weight: 700 !important;
        color: #475569 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.05em !important;
    }

    table.dataTable tbody td {
        padding: 12px 20px !important;
        border-bottom: 1px solid #f1f5f9 !important;
        vertical-align: middle !important;
    }

    table.dataTable tbody tr:hover {
        background: #f8fafc !important;
    }

    /* Pagination */
    .dt-paging-button {
        padding: 6px 12px !important;
        margin: 0 2px !important;
        border-radius: 8px !important;
        font-size: 0.8rem !important;
        font-weight: 600 !important;
        color: #475569 !important;
        border: 1px solid #e2e8f0 !important;
        background: #fff !important;
        cursor: pointer !important;
        transition: all 0.2s ease !important;
    }

    .dt-paging-button:hover {
        background: #f1f5f9 !important;
        border-color: #cbd5e1 !important;
    }

    .dt-paging-button.current {
        background: linear-gradient(135deg, #6366f1, #8b5cf6) !important;
        color: #fff !important;
        border-color: transparent !important;
        box-shadow: 0 2px 8px rgba(99, 102, 241, 0.3) !important;
    }

    .dt-paging-button.disabled {
        opacity: 0.4 !important;
        cursor: not-allowed !important;
    }

    /* Info text */
    .dt-info {
        font-size: 0.8rem !important;
        color: #64748b !important;
        font-weight: 500 !important;
        padding-top: 12px !important;
    }

    /* Top & bottom controls layout */
    .dt-layout-row {
        padding: 12px 20px !important;
    }

    /* Empty state */
    .dataTables_empty {
        text-align: center !important;
        padding: 48px 16px !important;
        color: #64748b !important;
        font-weight: 500 !important;
    }

    /* Responsive child rows */
    table.dataTable.dtr-inline.collapsed>tbody>tr>td.dtr-control::before,
    table.dataTable.dtr-inline.collapsed>tbody>tr>th.dtr-control::before {
        background: linear-gradient(135deg, #6366f1, #8b5cf6) !important;
        border: none !important;
        box-shadow: 0 2px 6px rgba(99, 102, 241, 0.3) !important;
    }

    table.dataTable>tbody>tr.child ul.dtr-details {
        width: 100% !important;
    }

    table.dataTable>tbody>tr.child ul.dtr-details>li {
        border-bottom: 1px solid #f1f5f9 !important;
        padding: 8px 0 !important;
    }

    /* Pelamar cell */
    .pelamar-cell {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .pelamar-avatar {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        object-fit: cover;
        flex-shrink: 0;
    }

    .pelamar-avatar-placeholder {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.75rem;
        font-weight: 700;
        color: white;
        flex-shrink: 0;
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
    }

    .pelamar-name {
        font-size: 0.875rem;
        font-weight: 600;
        color: #1e293b;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .pelamar-email {
        font-size: 0.75rem;
        color: #64748b;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .sekolah-jurusan small {
        display: block;
        font-size: 0.75rem;
        color: #64748b;
    }
</style>

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
    <div style="overflow-x: auto; padding: 10px 0;">
        <table id="myTable" class="display nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>Pelamar</th>
                    <th>Posisi</th>
                    <th>Sekolah / Jurusan</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($lamarans as $l)
                <tr>
                    <td data-order="{{ $l->user->name ?? '-' }}">
                        <div class="pelamar-cell">
                            @if($l->user && $l->user->profile_photo)
                            <img src="{{ $l->user->profile_photo }}" class="pelamar-avatar" alt="">
                            @else
                            <div class="pelamar-avatar-placeholder">
                                {{ $l->user ? strtoupper(substr($l->user->name, 0, 1)) : '?' }}
                            </div>
                            @endif
                            <div style="min-width: 0;">
                                <p class="pelamar-name">{{ $l->user->name ?? '-' }}</p>
                                <p class="pelamar-email">{{ $l->user->email ?? '-' }}</p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span style="font-size: 0.875rem; font-weight: 500; color: #334155;">{{ $l->posisi->nama ?? '-'
                            }}</span>
                    </td>
                    <td>
                        <div class="sekolah-jurusan">
                            <span style="font-size: 0.875rem; color: #475569; font-weight: 500;">{{ $l->sekolah->nama ??
                                '-' }}</span>
                            <small>{{ $l->jurusan->nama ?? '-' }}</small>
                        </div>
                    </td>
                    <td data-order="{{ $l->created_at->format('Y-m-d') }}"
                        style="font-size: 0.875rem; color: #64748b; white-space: nowrap;">
                        {{ $l->created_at->format('d M Y') }}
                    </td>
                    <td>
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
                    <td>
                        <a href="{{ route('dudi.lamaran.show', $l) }}" class="btn-outline btn-sm">Detail →</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>

@endsection



@section('scripts')
{{-- jQuery & DataTables JS --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.min.js"></script>
<script>
    $(document).ready(function () {
        let table = new DataTable('#myTable', {
            responsive: true,
            pageLength: 10,
            lengthMenu: [5, 10, 25, 50],
            order: [[3, 'desc']], // urutkan berdasarkan tanggal terbaru
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data",
                info: "Menampilkan _START_ - _END_ dari _TOTAL_ lamaran",
                infoEmpty: "Tidak ada data",
                infoFiltered: "(disaring dari _MAX_ total lamaran)",
                zeroRecords: "Tidak ada lamaran yang cocok",
                paginate: {
                    first: "«",
                    last: "»",
                    next: "›",
                    previous: "‹"
                }
            },
            columnDefs: [
                { orderable: false, targets: [5] } // kolom Aksi tidak bisa di-sort
            ]
        });
    });
</script>
@endsection