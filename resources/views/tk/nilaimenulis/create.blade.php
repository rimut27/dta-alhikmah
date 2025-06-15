@extends('adminlte::page')

@section('title', 'Tambah Nilai Menulis')

@section('content_header')
<h1>Tambah Nilai Menulis</h1>
@stop

@section('content')
<form action="{{ isset($nilaiMenulis) ? route('tk.nilaimenulis.update', $nilaiMenulis->id) : route('tk.nilaimenulis.store') }}" method="POST">
    @csrf
    @if(isset($nilaiMenulis)) @method('PUT') @endif

    <div class="form-group">
        <label for="santri_id">Santri</label>
        <select name="santri_id" class="form-control" required>
            <option value="">Pilih Santri</option>
            @foreach($daftarSantris as $santri)
            <option value="{{ $santri->id }}" {{ isset($nilaiMenulis) && $nilaiMenulis->santri_id == $santri->id ? 'selected' : '' }}>
                {{ $santri->nama_santri }}
            </option>
            @endforeach
        </select>
    </div>

    <label>Tanggal</label>
    <input type="text" class="form-control" value="{{ now()->format('d F Y') }}" readonly>
    <small class="text-muted">Tanggal otomatis terisi hari ini</small>

    <div class="form-group">
        <label>Jilid</label>
        <input type="text" name="jilid" class="form-control" value="{{ $nilaiMenulis->jilid ?? old('jilid') }}">
    </div>

    <div class="form-group">
        <label>Halaman</label>
        <input type="text" name="halaman" class="form-control" value="{{ $nilaiMenulis->halaman ?? old('halaman') }}">
    </div>

    <div class="form-group">
        <label>Nilai</label>
        <input type="number" name="nilai" class="form-control" min="0" max="100" value="{{ $nilaiMenulis->nilai ?? old('nilai') }}" required>
    </div>

    <button class="btn btn-success">Simpan</button>
</form>
@stop