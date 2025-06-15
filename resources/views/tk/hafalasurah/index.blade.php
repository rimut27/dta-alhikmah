@extends('adminlte::page')

@section('title', 'Nilai Hafalan Surat MDAUD')

@section('content')
<div class="container">
    <h2 class="mb-4">Daftar Nilai Hafalan Surah MDAUD</h2>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <a href="{{ route('tk.nilaihafalansurah.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Nilai
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Santri</th>
                            <th>Surat</th>
                            <th>Ayat</th>
                            <th>Nilai</th>
                            <th>Tanggal Penilaian</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($nilaiTerakhir as $index => $nilai)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $nilai->santri->nama_santri }}</td>
                            <td>{{ $nilai->surat }}</td>
                            <td>{{ $nilai->ayat }}</td>
                            <td>
                                {{ $nilai->nilai }}
                            </td>
                            <td> {{\Carbon\Carbon::parse($nilai->tanggal_penilaian) ->translatedFormat('d M Y') }}</td>
                            <td>
                                <a href="{{ route('tk.nilaihafalansurah.show', $nilai->santri_id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye">
                                        Details
                                    </i>
                                </a>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <form action="{{ route('tk.nilaihafalansurah.reset') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus semua data Nilai Hapalan Surah < ?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger mb-4">Reset Semua Data </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection