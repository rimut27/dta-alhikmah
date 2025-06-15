<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Detail Nilai Menulis</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; font-size: 12px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: center; }
    </style>
</head>
<body>
    <h3>Nama Santri: {{ $santri->nama_santri }}</h3>
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Jilid</th>
                <th>Halaman</th>
                <th>Nilai</th>
            </tr>
        </thead>
        <tbody>
            @foreach($santri->nilaiMenulis as $nilai)
                <tr>
                    <td>{{ $nilai->tanggal_penilaian->format('d-m-Y') }}</td>
                    <td>{{ $nilai->jilid }}</td>
                    <td>{{ $nilai->halaman }}</td>
                    <td>{{ $nilai->nilai }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>