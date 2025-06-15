<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Laporan Nilai Membaca</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        h2,
        h4 {
            text-align: center;
            margin: 0;
        }

        .info {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
        }

        .footer {
            margin-top: 30px;
            text-align: right;
        }
    </style>
</head>

<body>

    <h2>Laporan Nilai Membaca Santri </h2>
    <div class="info">
        <p><strong>Nama Santri: {{ $santri->nama_santri }}</strong></p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Penilaian</th>
                <th>Surat</th>
                <th>Ayat</th>
                <th>Nilai</th>
            </tr>
        </thead>
        <tbody>
            @foreach($nilaiMembaca as $index => $nilai)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($nilai->tanggal_penilaian)->format('D, d-m-Y') }}</td>
                <td>{{ $nilai->iqra }}</td>
                <td>{{ $nilai->halaman }}</td>
                <td>{{ $nilai->nilai }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="info">
        <p><strong>Rata-rata Nilai:</strong> {{ number_format($average, 2) }}</p>
        <p><strong>Keterangan:</strong> {{ ucfirst($keterangan) }}</p>
    </div>

    <div class="footer">
        <p>Dicetak pada: {{ \Carbon\Carbon::now()->format('d-m-Y') }}</p>
    </div>

</body>

</html>