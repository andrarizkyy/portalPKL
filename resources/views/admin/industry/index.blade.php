@extends('layouts.app')
@section('sidebar') @include('admin._sidebar') @endsection
@section('page-title', 'Data Industry')
@section('header-actions')
<a href="{{ route('admin.industry.create') }}" class="btn-primary">+ Tambah Industry</a>
@endsection
@section('content')
<div class="card" style="background: linear-gradient(135deg, #faf5ff 0%, #f8fafc 100%); border-color: #e9d5ff;">
    <table class="w-full">
        <thead>
            <tr class="border-b border-slate-100">
                <th class="text-left px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">#</th>
                <th class="text-left px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Nama
                    Industry</th>
                <th class="text-right px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($industries as $i => $ind)
            <tr class="border-b border-slate-50 hover:bg-slate-50/50 transition-colors">
                <td class="px-6 py-4 text-sm text-slate-500">{{ $i + 1 }}</td>
                <td class="px-6 py-4 text-sm font-semibold text-slate-800">{{ $ind->nama }}</td>
                <td class="px-6 py-4 text-right space-x-2">
                    <a href="{{ route('admin.industry.edit', $ind) }}"
                        class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">Edit</a>
                    <form method="POST" action="{{ route('admin.industry.destroy', $ind) }}" class="inline"
                        onsubmit="return confirm('Hapus?')">
                        @csrf @method('DELETE')
                        <button class="text-red-600 hover:text-red-800 text-sm font-medium">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="px-6 py-12 text-center text-slate-600">Belum ada data industry.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection