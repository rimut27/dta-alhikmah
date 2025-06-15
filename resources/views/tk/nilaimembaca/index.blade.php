@extends('adminlte::page')

@section('title', 'Daftar Nilai Membaca')

@section('content_header')
<h1>Daftar Nilai Membaca Santri MDAUD</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <a href="{{ route('tk.nilaimembaca.create') }}" class="btn btn-primary">Tambah Nilai</a>
    </div>
    <div class="card-body">
        <table id="nilaiTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Santri</th>
                    <th>Tanggal Penilaian</th>
                    <th>Iqra</th>
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
                    <td>{{ $nilai->iqra }}</td>
                    <td>{{ $nilai->halaman }}</td>
                    <td>{{ $nilai->nilai }}</td>
                    <td>
                        <a href="{{ route('tk.nilaimembaca.show', $nilai->santri_id) }}" class="btn btn-info btn-sm">Detail</a>
                        <a href="{{ route('tk.nilaimembaca.exportPerSantri', $nilai->santri_id) }}" class="btn btn-secondary btn-sm">Export PDF</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <form action="{{ route('tk.nilaimembaca.reset') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus semua data Nilai membaca?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger mb-4 mt-3">Reset Semua Data Nilai Membaca </button>
        </form>
    </div>
</div>
@stop

@section('js')
<script>
    $(document).ready(function() {
        $('#nilaiTable').DataTable();
    });
</script>
@stop