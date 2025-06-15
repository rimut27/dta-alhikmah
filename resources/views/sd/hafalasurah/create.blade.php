@extends('adminlte::page')

@section('title', 'Nilai Hafalan Surat DTA')

@section('content')
<div class="container">
    <h2 class="mb-4">Tambah Nilai Hafalan SuraH DTA</h2>

    <div class="card shadow">

        <div class="card-body">
            <form action="{{ route('sd.nilaihafalansurah.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <div class="input-group">
                        <select class="form-select select2 p-2" id="santri_id" name="santri_id" required style="width: 100%;">
                            <option value="" disabled selected>-- Cari Santri --</option>
                            @foreach($santris as $santri)
                            <option value="{{ $santri->id }}" @if(old('santri_id')==$santri->id) selected @endif>
                                {{ $santri->nama_santri }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <small class="text-muted">Ketikan nama santri untuk mencari</small>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tanggal Penilaian</label>
                    <input type="text" class="form-control" value="{{ now()->format('d F Y') }}" readonly>
                    <small class="text-muted">Tanggal otomatis terisi hari ini</small>
                </div>
                <div class="mb-3">
                    <div class="form-group">
                        <label for="surat">Surat</label>
                        <input type="text" class="form-control" id="surat" name="surat" required>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-group">
                        <label for="ayat">Ayat</label>
                        <input type="text" class="form-control" id="ayat" name="ayat" required>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-group">
                        <label for="nilai">Nilai (1-100)</label>
                        <input type="number" class="form-control" id="nilai" name="nilai" min="1" max="100" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('sd.nilaihafalansurah.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection