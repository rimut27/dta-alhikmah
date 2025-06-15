@extends('adminlte::page')

@section('title', 'Absensi Santri SD')

@section('content')
<div class="container">
    <h2>Absensi DTA AL-HIKMAH</h2>
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    <form action="{{ route('sd.absensis.store') }}" method="POST">
        @csrf
        <table class="table">
            <thead>
                <tr>
                    <th>Santri</th>
                    <th>Kehadiran</th>
                </tr>
            </thead>
            <tbody>
                @foreach($santris as $santri)
                <tr>
                    <td>{{ $santri->nama_santri }}</td>
                    <td>
                        <label class="mr-3">
                            <input type="radio" name="status[{{ $santri->id }}]" value="hadir" required>
                            Hadir
                        </label>
                        <label class="mr-3">
                            <input type="radio" name="status[{{ $santri->id }}]" value="sakit" required>
                            Sakit
                        </label>
                        <label class="mr-3">
                            <input type="radio" name="status[{{ $santri->id }}]" value="izin" required>
                            Izin
                        </label>
                        <label>
                            <input type="radio" name="status[{{ $santri->id }}]" value="alfa" required>
                            Alfa
                        </label>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <!-- Edit form -->
    <h2 class="mt-5">Attendance Report</h2>
    <a href="{{ route('sd.absensis.export') }}" class="btn btn-success mb-3" target="_blank">Export PDF</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Hadir</th>
                <th>Sakit</th>
                <th>Izin</th>
                <th>Alfa</th>
                <th>export</th>
            </tr>
        </thead>
        <tbody>
            @foreach($report as $record)
            <tr>
                <td>{{ $record->santri->nama_santri }}</td>
                <td>{{ $record->hadir }}</td>
                <td>{{ $record->sakit }}</td>
                <td>{{ $record->izin }}</td>
                <td>{{ $record->alfa }}</td>
                <td>
                    <a href="{{ route('sd.absensis.exportPerSantri', $record->santri_id) }}"
                        class="btn btn-sm btn-danger" target="_blank">export</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <form action="{{ route('sd.absensis.reset') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus semua data Absens?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger mb-4">Reset Semua Data Absen </button>
    </form>
</div>
@endsection