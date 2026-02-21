@extends('layouts.app')
@section('sidebar') @include('siswa._sidebar') @endsection
@section('page-title', 'Profil Siswa')
@section('page-subtitle', $profile ? 'Edit profil Anda' : 'Lengkapi profil untuk mulai melamar PKL')

@section('content')
<div class="card max-w-2xl">
    <form method="POST" action="{{ route('siswa.profil.update') }}" class="p-6 space-y-5">
        @csrf
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Sekolah *</label>
            <select name="sekolah_id" id="sekolah_id" class="input-field" required>
                <option value="">-- Pilih Sekolah --</option>
                @foreach($sekolahs as $s)
                <option value="{{ $s->id }}" {{ old('sekolah_id', $profile?->sekolah_id) == $s->id ? 'selected' : ''
                    }}>{{ $s->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Jurusan *</label>
            <select name="jurusan_id" id="jurusan_id" class="input-field" required>
                <option value="">-- Pilih Jurusan --</option>
                @foreach($jurusans as $j)
                <option value="{{ $j->id }}" {{ old('jurusan_id', $profile?->jurusan_id) == $j->id ? 'selected' : ''
                    }}>{{ $j->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">NIS *</label>
            <input type="text" name="nis" value="{{ old('nis', $profile?->nis) }}" class="input-field" required>
        </div>
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">No. Telepon *</label>
            <input type="text" name="phone" value="{{ old('phone', $profile?->phone) }}" class="input-field" required>
        </div>
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Jenis Kelamin *</label>
            <select name="gender" class="input-field" required>
                <option value="">-- Pilih --</option>
                <option value="male" {{ old('gender', $profile?->gender) === 'male' ? 'selected' : '' }}>Laki-laki
                </option>
                <option value="female" {{ old('gender', $profile?->gender) === 'female' ? 'selected' : '' }}>Perempuan
                </option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Alamat *</label>
            <textarea name="address" rows="3" class="input-field"
                required>{{ old('address', $profile?->address) }}</textarea>
        </div>
        <button type="submit" class="btn-primary">Simpan Profil</button>
    </form>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('sekolah_id').addEventListener('change', function () {
        const jurusanSelect = document.getElementById('jurusan_id');
        jurusanSelect.innerHTML = '<option value="">Memuat...</option>';
        if (!this.value) { jurusanSelect.innerHTML = '<option value="">-- Pilih Jurusan --</option>'; return; }
        fetch('/api/jurusan/' + this.value)
            .then(r => r.json())
            .then(data => {
                jurusanSelect.innerHTML = '<option value="">-- Pilih Jurusan --</option>';
                data.forEach(j => {
                    jurusanSelect.innerHTML += `<option value="${j.id}">${j.name}</option>`;
                });
            });
    });
</script>
@endsection