<!DOCTYPE html>
<html>
<head>
    <title>Laporan Absensi {{ $santri->nama_santri }}</title>
    <style>
        body { font-family: sans-serif; }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
        }
    </style>
</head>

<body>
    <h2>Laporan Absensi Santri MDAUD</h2>
    <p><strong>Nama:</strong> {{ $santri->nama_santri }}</p>
    
    <table>
        <thead>
            <tr>
                <th>Total Absensi</th>
                <th>Hadir</th>
                <th>Sakit</th>
                <th>Izin</th>
                <th>Alfa</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $report->total }}</td>
                <td>{{ $report->hadir }}</td>
                <td>{{ $report->sakit }}</td>
                <td>{{ $report->izin }}</td>
                <td>{{ $report->alfa }}</td>
            </tr>
        </tbody>
    </table>

@endsection