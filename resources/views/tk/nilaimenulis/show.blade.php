@extends('adminlte::page')

@section('title', 'Detail Nilai Menulis')

@section('content_header')
<h1>Detail Nilai Menulis - {{ $santri->nama_santri }}</h1>
@stop

@section('content')
<div>
    <a href="{{ route('tk.nilaimenulis.create') }}" class="btn btn-primary mb-3">+ Tambah Nilai</a>
    <a href="{{ route('tk.nilaimenulis.generatePDF', $santri->id) }}" class="btn btn-danger mb-3">Download PDF</a>
    <p><strong>Rata-rata Nilai:</strong> {{ number_format($average, 2) }}</p>
    <p><strong>Keterangan:</strong> {{ $keterangan }}</p>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Jilid</th>
            <th>Halaman</th>
            <th>Nilai</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($nilaiMenulis as $nilai)
        <tr>
            <td>{{ \Carbon\Carbon::parse($nilai->tanggal_penilaian)->translatedFormat('D, d M Y')}}</td>
            <td>{{ $nilai->jilid }}</td>
            <td>{{ $nilai->halaman }}</td>
            <td>{{ $nilai->nilai }}</td>
            <td>
                <a href="{{ route('tk.nilaimenulis.edit', $nilai->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('tk.nilaimenulis.destroy', $nilai->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                </form>
        </tr>
        @endforeach
    </tbody>
</table>
<a href="{{ route('tk.nilaimenulis.index') }}" class="btn btn-secondary mt-3">Kembali</a>
@stop