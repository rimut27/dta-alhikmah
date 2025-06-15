<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Nilai Hafalan Hadist - {{ $santri->nama_santri }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: center; }
        h2, p { text-align: center; }
    </style>
</head>
<body>
    <h2>Laporan Nilai Hafalan Hadist</h2>
    <p>Nama Santri: <strong>{{ $santri->nama_santri }}</strong></p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Penilaian</th>
                <th>Nilai</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($santri->nilaihapalanhadists as $index => $nilai)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $nilai->tanggal_penilaian }}</td>
                    <td>{{ $nilai->nilai }}</td>
                    <td>{{ $nilai->keterangan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
