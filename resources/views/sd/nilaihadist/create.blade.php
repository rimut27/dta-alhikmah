@extends('adminlte::page')

@section('title', 'Tambah Nilai Hafalan Hadist DTA AL-HIKMAH')

@section('content_header')
<h1>Tambah Nilai Hafalan Hadist DTA AL-HIKMAH</h1>
@stop

@section('content')
<form action="{{ route('sd.nilaihadist.store') }}" method="POST">
    @csrf
    <x-adminlte-select name="santri_id" label="Nama Santri" required>
        @foreach ($daftarSantris as $santri)
        <option value="{{ $santri->id }}">{{ $santri->nama_santri }}</option>
        @endforeach
    </x-adminlte-select>
    <label for="tanggal_penilaian">Tanggal Penilaian</label>
    <input type="text" class="form-control" id="tanggal_penilaian" name="tanggal_penilaian" value="{{ now()->format('d F Y') }}" readonly>
    <small class="text-muted">Tanggal otomatis terisi hari ini</small>
        <x-adminlte-input name="hadist" label="Hadist" placeholder="Masukkan Hadist" required />

    <x-adminlte-input name="nilai" label="Nilai" type="number" min="1" max="100" required />

    <x-adminlte-button class="btn-flat" type="submit" label="Simpan" theme="success" icon="fas fa-save" />
</form>
@stop