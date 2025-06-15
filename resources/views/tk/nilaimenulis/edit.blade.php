@extends('adminlte::page')

@section('title', 'Edit Nilai Menulis')

@section('content_header')
<h1>Edit Nilai Menulis</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('tk.nilaimenulis.update', $nilaiMenulis->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="santri_id">Santri</label>
                <select name="santri_id" class="form-control" required>
                    <option value="">Pilih Santri</option>
                    @foreach($daftarSantris as $santri)
                    <option value="{{ $santri->id }}" {{ $nilaiMenulis->santri_id == $santri->id ? 'selected' : '' }}>
                        {{ $santri->nama_santri }}
                    </option>
                    @endforeach
                </select>
            </div>
            <label>Tanggal</label>
            <input type="text" class="form-control" value="{{ now()->format('d F Y') }}" readonly>
            <small class="text-muted">Tanggal otomatis terisi hari ini</small>
            <div class="form-group">
                <label for="jilid">Jilid</label>
                <input type="text" name="jilid" class="form-control" value="{{ old('jilid', $nilaiMenulis->jilid) }}">
            </div>

            <div class="form-group">
                <label for="halaman">Halaman</label>
                <input type="text" name="halaman" class="form-control" value="{{ old('halaman', $nilaiMenulis->halaman) }}">
            </div>

            <div class="form-group">
                <label for="nilai">Nilai</label>
                <input type="number" name="nilai" class="form-control" value="{{ old('nilai', $nilaiMenulis->nilai) }}" min="0" max="100" required>
            </div>

            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
            <a href="{{ route('tk.nilaimenulis.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@stop