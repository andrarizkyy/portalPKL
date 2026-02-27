@extends('layouts.app')
@section('sidebar') @include('admin._sidebar') @endsection
@section('page-title', 'Tambah Jurusan')
@section('content')
<div class="card max-w-2xl"
    style="background: linear-gradient(135deg, #eff6ff 0%, #f8fafc 100%); border-color: #bfdbfe;">
    <form method="POST" action="{{ route('admin.jurusan.store') }}" class="p-6 space-y-5">
        @csrf
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Sekolah *</label>
            <select name="sekolah_id" class="input-field" required>
                <option value="">-- Pilih Sekolah --</option>
                @foreach($sekolahs as $s)
                <option value="{{ $s->id }}" {{ old('sekolah_id')==$s->id ? 'selected' : '' }}>{{ $s->nama }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Jurusan *</label>
            <p class="text-xs text-slate-500 mb-3">Anda bisa menambahkan beberapa jurusan sekaligus.</p>
            <div id="jurusan-inputs" class="space-y-2">
                <div class="flex items-center gap-2">
                    <input type="text" name="nama[]" value="{{ old('nama.0') }}" class="input-field flex-1"
                        placeholder="Contoh: Teknik Komputer & Jaringan" required>
                </div>
            </div>
            <button type="button" onclick="addJurusanInput()"
                class="mt-3 inline-flex items-center gap-1.5 text-sm font-semibold text-indigo-600 hover:text-indigo-800 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Tambah Jurusan Lagi
            </button>
        </div>

        <div class="flex gap-3 pt-2">
            <button type="submit" class="btn-primary">Simpan Semua</button>
            <a href="{{ route('admin.jurusan.index') }}" class="btn-outline">Batal</a>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    let jurusanCount = 1;
    function addJurusanInput() {
        jurusanCount++;
        const container = document.getElementById('jurusan-inputs');
        const div = document.createElement('div');
        div.className = 'flex items-center gap-2';
        div.innerHTML = `
            <input type="text" name="nama[]" class="input-field flex-1" placeholder="Nama jurusan ke-${jurusanCount}" required>
            <button type="button" onclick="this.parentElement.remove()" class="p-2 text-red-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        `;
        container.appendChild(div);
    }
</script>
@endsection