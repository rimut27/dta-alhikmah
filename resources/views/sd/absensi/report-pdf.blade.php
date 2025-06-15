<!DOCTYPE html>
<html>

<head>
    <title>Laporan Absensi DTA AL-HIKMAH</title>
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
        <thead>
            <tr>
                <th>Nama Santri</th>
                <th>Total Hadir</th>
                <th>Total Sakit</th>
                <th>Total Izin</th>
                <th>Total Alfa</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($report as $item)
            <tr>
                <td>{{ $item->santri->nama_santri ?? 'N/A' }}</td>
                <td>{{ $item->hadir }}</td>
                <td>{{ $item->sakit }}</td>
                <td>{{ $item->izin }}</td>
                <td>{{ $item->alfa }}</td>
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