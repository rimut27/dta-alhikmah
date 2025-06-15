@extends('adminlte::page')

@section('title', 'Nilai Hadist Hafalan DTA AL-HIKMAH')

@section('content_header')
<h1>Data Nilai Hafalan Hadist DTA AL-HIKMAH</h1>
@stop

@section('content')
@if (session('success'))
<x-adminlte-alert theme="success" title="Berhasil">
    {{ session('success') }}
</x-adminlte-alert>
@endif

<a href="{{ route('sd.nilaihadist.create') }}" class="btn btn-primary mb-3">Tambah Nilai</a>

<table class="table table-bordered table-striped">
    <thead style="background-color:blue; color:white;">
        <tr>
            <th>Nama Santri</th>
            <th>Hadist</th>
            <th>Nilai</th>
            <th>Tanggal Penilaian</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($nilaiTerakhir as $nilai)
        <tr>
            <td>{{ $nilai->santri->nama_santri }}</td>
            <td>{{ $nilai->hadist }}</td>
            <td>{{ $nilai->nilai }}</td>
            <td>{{ \Carbon\Carbon::parse($nilai->tanggal_penilaian)->format('d-m-Y') }}</td>
            <td>
                <a href="{{ route('sd.nilaihadist.show', $nilai->santri_id) }}" class="btn btn-info btn-sm">
                    <i class="fas fa-eye"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<form action="{{ route('sd.nilaihadist.reset') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus semua data Nilai Hadist?');">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger mb-4">Reset Semua Data Nilai Hadist</button>
    @stop