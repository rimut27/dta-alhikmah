<!DOCTYPE html>
<html>

<head>
    <title>Laporan Absensi MDAUD</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            font-family: sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;

        }
    </style>
</head>

<body>
    <table class="table">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Santri</th>
                    <th>Total Absensi</th>
                    <th>Hadir</th>
                    <th>Sakit</th>
                    <th>Izin</th>
                    <th>Alfa</th>
                </tr>
            </thead>
            <tbody>
                @foreach($report as $record)
                <tr>
                    <td>{{ $record->santri->nama_santri }}</td>
                    <td>{{ $record->total }}</td>
                    <td>{{ $record->hadir }}</td>
                    <td>{{ $record->sakit }}</td>
                    <td>{{ $record->izin }}</td>
                    <td>{{ $record->alfa }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Total Semua Murid -->
        <h3>Total Semua Murid</h3>
        <p>Total Hadir: {{ $totals['hadir'] }}</p>
        <p>Total Sakit: {{ $totals['sakit'] }}</p>
        <p>Total Izin: {{ $totals['izin'] }}</p>
        <p>Total Alfa: {{ $totals['alfa'] }}</p>

</body>

</html>