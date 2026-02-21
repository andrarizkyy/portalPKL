@extends('layouts.app')
@section('sidebar') @include('admin._sidebar') @endsection
@section('page-title', 'Data Jurusan')
@section('header-actions')
<a href="{{ route('admin.jurusan.create') }}" class="btn-primary">+ Tambah Jurusan</a>
@endsection
@section('content')
<div class="card">
    <table class="w-full">
        <thead>
            <tr class="border-b border-slate-100">
                <th class="text-left px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">#</th>
                <th class="text-left px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Nama
                    Jurusan</th>
                <th class="text-left px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Sekolah
                </th>
                <th class="text-right px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($jurusans as $i => $j)
            <tr class="border-b border-slate-50 hover:bg-slate-50/50 transition-colors">
                <td class="px-6 py-4 text-sm text-slate-500">{{ $i + 1 }}</td>
                <td class="px-6 py-4 text-sm font-semibold text-slate-800">{{ $j->name }}</td>
                <td class="px-6 py-4 text-sm text-slate-500">{{ $j->sekolah->name }}</td>
                <td class="px-6 py-4 text-right space-x-2">
                    <a href="{{ route('admin.jurusan.edit', $j) }}"
                        class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">Edit</a>
                    <form method="POST" action="{{ route('admin.jurusan.destroy', $j) }}" class="inline"
                        onsubmit="return confirm('Hapus?')">
                        @csrf @method('DELETE')
                        <button class="text-red-600 hover:text-red-800 text-sm font-medium">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="px-6 py-12 text-center text-slate-400">Belum ada data jurusan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection