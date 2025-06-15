<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Nilai Hafalan Doa</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .info {
            margin-top: 10px;
        }
    </style>
</head>

<body>

    <div class="header">
        <h2>Laporan Nilai Hafalan Doa</h2>
    </div>

    <div class="info">
        <p><strong>Nama Santri: {{ $santri->nama_santri }}</strong></p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Penilaian</th>
                <th>Doa</th>
                <th>Nilai</th>
            </tr>
        </thead>
        <tbody>
            @foreach($nilaidoa as $index => $nilai)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($nilai->tanggal_penilaian)->format('d-m-Y') }}</td>
                <td>{{ $nilai->doa }}</td>
                <td>{{ $nilai->nilai }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

        <h5>Rata-rata Nilai: {{ number_format($av, 2) }}</h5>
        <h5>Keterangan: <span class="badge">
                {{ $keterangan }}
            </span></h5>

</body>

</html>