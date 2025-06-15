@extends('adminlte::page')

@section('title', 'Nilai Menulis')

@section('content_header')
<h1>Nilai Menulis MDAUD</h1>
@stop

@section('content')
<a href="{{ route('tk.nilaimenulis.create') }}" class="btn btn-primary mb-3">+ Tambah Nilai</a>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Nama Santri</th>
            <th>Tanggal</th>
            <th>Jilid</th>
            <th>Halaman</th>
            <th>Nilai</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($nilaiTerakhir as $nilai)
        <tr>
            <td>{{ $nilai->santri->nama_santri }}</td>
            <td>{{ \Carbon\Carbon::parse($nilai->tanggal_penilaian)->translatedFormat('D, d M Y')}}</td>
            <td>{{ $nilai->jilid }}</td>
            <td>{{ $nilai->halaman }}</td>
            <td>{{ $nilai->nilai }}</td>
            <td>
                <a href="{{ route('tk.nilaimenulis.show', $nilai->santri_id) }}" class="btn btn-info btn-sm">Lihat</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<form action="{{ route('tk.nilaimenulis.reset') }}" method="post" onsubmit="return confirm('Yakin ingin reset semua data?')">
    @csrf
    <button type="submit" class="btn btn-danger mb-3 mt-3">Reset Data</button>
</form>
@stop