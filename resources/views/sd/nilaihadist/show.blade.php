@extends('adminlte::page')

@section('title', 'Detail Nilai Hafalan Hadist DTA AL-HIKMAH')

@section('content_header')
<h1>Detail Nilai Hafalan Hadist - {{ $santri->nama_santri }}</h1>
@stop

@section('content')
<a href="{{ route('sd.nilaihadist.generatePDF', $santri->id) }}" class="btn btn-danger mb-3">Download PDF</a>
<a href="{{ route('sd.nilaihadist.create') }}" class="btn btn-primary mb-3">Tambah Nilai</a>

<table class="table table-bordered table-striped">
    <thead style="background-color:blue; color:white;">
        <tr>
            <th>Tanggal</th>
            <th>Hadist</th>
            <th>Nilai</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($nilaihadist as $item)
        <tr>
            <td>{{ \Carbon\Carbon::parse($item->tanggal_penilaian)->format('d-m-Y') }}</td>
            <td>{{ $item->hadist }}</td>
            <td>{{ $item->nilai }}</td>
            <td>
                <a href="{{ route('sd.nilaihadist.edit', $item->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                <form action="{{ route('sd.nilaihadist.destroy', $item->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</button>
                </form>
        </tr>
        @endforeach
    </tbody>
</table>

<h4>Rata-rata Nilai: {{ number_format($av, 2) }}</h4>
<h5>Keterangan: <span class="badge">
    {{ $keterangan }}
    </span></h5>

@stop