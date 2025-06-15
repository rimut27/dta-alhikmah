@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Nilai Doa Santri DTA</h1>
@stop

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <a href="{{ route('sd.nilaidoa.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Tambah Nilai
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped" >
        <thead style="background-color:blue; color:white;">
                    <tr>
                        <th>Nama Santri</th>
                        <th>Doa</th>
                        <th>Nilai</th>
                        <th>Tanggal Penilaian</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($nilaiTerakhir as $index => $nilai)
                    <tr>
                        <td>{{ $nilai->santri->nama_santri }}</td>
                        <td>{{ $nilai->doa }}</td>
                        <td>
                            {{ $nilai->nilai }}
                        </td>
                        <td>{{ \Carbon\Carbon::parse($nilai->tanggal_penilaian)->translatedFormat('d M Y')}}</td>
                        <td>
                            <a href="{{ route('sd.nilaidoa.show', $nilai->santri_id) }}" class="btn btn-info btn-sm">
                                <i class="fas fa-eye"></i>
                            </a>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <form action="{{ route('sd.nilaidoa.reset') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus semua data Nilai Doa?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger mb-4">Reset Semua Data Nilai Doa</button>
            </form>
        </div>
    </div>
</div>

@endsection