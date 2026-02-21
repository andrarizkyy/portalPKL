@extends('layouts.app')
@section('sidebar') @include('admin._sidebar') @endsection
@section('page-title', 'Data Sekolah')
@section('header-actions')
<a href="{{ route('admin.sekolah.create') }}" class="btn-primary">+ Tambah Sekolah</a>
@endsection
@section('content')
<div class="card">
    <table class="w-full">
        <thead>
            <tr class="border-b border-slate-100">
                <th class="text-left px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">#</th>
                <th class="text-left px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Nama</th>
                <th class="text-left px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Alamat
                </th>
                <th class="text-left px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Telepon
                </th>
                <th class="text-left px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Jurusan
                </th>
                <th class="text-right px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($sekolahs as $i => $s)
            <tr class="border-b border-slate-50 hover:bg-slate-50/50 transition-colors">
                <td class="px-6 py-4 text-sm text-slate-500">{{ $i + 1 }}</td>
                <td class="px-6 py-4 text-sm font-semibold text-slate-800">{{ $s->name }}</td>
                <td class="px-6 py-4 text-sm text-slate-500">{{ Str::limit($s->address, 40) }}</td>
                <td class="px-6 py-4 text-sm text-slate-500">{{ $s->phone ?? '-' }}</td>
                <td class="px-6 py-4"><span class="badge bg-indigo-100 text-indigo-800">{{ $s->jurusans_count }}
                        jurusan</span></td>
                <td class="px-6 py-4 text-right space-x-2">
                    <a href="{{ route('admin.sekolah.edit', $s) }}"
                        class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">Edit</a>
                    <form method="POST" action="{{ route('admin.sekolah.destroy', $s) }}" class="inline"
                        onsubmit="return confirm('Hapus sekolah ini?')">
                        @csrf @method('DELETE')
                        <button class="text-red-600 hover:text-red-800 text-sm font-medium">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-12 text-center text-slate-400">Belum ada data sekolah.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection