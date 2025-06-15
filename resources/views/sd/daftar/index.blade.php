@extends('adminlte::page')

@section('title', 'Daftar Santri')

@section('content_header')
<h1>Daftar Santri DTA AL-HIKMAH </h1>
@stop

@section('content')
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<a href="{{ route('sd.daftar.create') }}" class="btn btn-primary mb-3">Tambah Santri</a>
<table class="table table-bordered">
    <thead class="bg-info text-white">
        <tr>
            <th>Nama Santri</th>
            <th>Jenis Kelamin</th>
            <th>Tanggal lahir</th>
            <th>Nama Ayah</th>
            <th>Nama Ibu</th>
            <th>Nama Sekolah</th>
            <th>Kelas</th>
            <th>Alamat</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($santris as $santri)
        <tr>
            <td>{{ $santri->nama_santri }}</td>
            <td>{{ $santri->jk }}</td>
            <td>{{ \Carbon\Carbon::parse($santri->tanggal_lahir)->translatedFormat('d F Y') }}</td>
            <td>{{ $santri->nama_ayah }}</td>
            <td>{{ $santri->nama_ibu }}</td>
            <td>{{ $santri->nama_sekolah }}</td>
            <td>{{ $santri->kelas }}</td>
            <td>{{ $santri->alamat }}</td>
            <td>
                <a href="{{ route('sd.daftar.edit', $santri->id) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('sd.daftar.destroy', $santri->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
    console.log('Hi!');
</script>
@stop