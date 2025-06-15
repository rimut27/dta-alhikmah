@extends('adminlte::page')
@section('title', 'Detail Nilai Hafalan Doa SD - ' . $santri->nama_santri)

@section('content')
<div class="container">
    <h2>Detail Nilai Hafalan Doa - {{ $santri->nama_santri }}</h2>

    <a href="{{ route('sd.nilaidoa.create') }}" class="btn btn-primary btn-sm m-3">
        <i class="fas fa-plus"></i> Tambah Nilai
    </a>
    <table class="table table-bordered table-hover">
        <thead style="background-color:blue; color:white;">
            <tr>
                <th>Tanggal Penilaian</th>
                <th>Doa</th>
                <th>Nilai</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($nilaidoa as $nilai)
            <tr>
                <td>{{ \Carbon\Carbon::parse($nilai->tanggal_penilaian)->translatedFormat('d M Y')}}</td>
                <td>{{ $nilai->doa }}</td>
                <td>{{ $nilai->nilai }}</td>
                <td>
                    <a href="{{ route('sd.nilaidoa.edit', $nilai->id) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('sd.nilaidoa.destroy', $nilai->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
            </tr>
            @endforeach
        </tbody>
    </table>
    <h5>Rata-rata Nilai: {{ number_format($av, 2) }}</h5>
    <h5>Keterangan: <span class="badge">
            {{ $keterangan }}
        </span></h5>

    <a href="{{ route('sd.nilaidoa.index') }}" class="btn btn-primary">Kembali</a>
    <a href="{{ route('sd.nilaidoa.generatePDF', $santri->id) }}" class="btn btn-success">Unduh PDF</a>
</div>
@endsection