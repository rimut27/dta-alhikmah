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
    <h2>Laporan Absensi Santri DTA AL-HIKMAH</h2>
    <p><strong>Nama:</strong> {{ $santri->nama_santri }}</p>
    
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($absensis as $i => $absen)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($absen->tanggal)->format('d-m-Y') }}</td>
                <td>{{ ucfirst($absen->status) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
