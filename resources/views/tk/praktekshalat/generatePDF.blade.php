<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>PDF Praktek Shalat</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #333; padding: 8px; text-align: center; }
    </style>
</head>
<body>
    <h2>Nilai Praktek Shalat - {{ $santri->nama_santri }}</h2>
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Nilai</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($santri->praktekShalat as $nilai)
                <tr>
                    <td>{{ $nilai->tanggal_penilaian }}</td>
                    <td>{{ $nilai->nilai }}</td>
                    <td>{{ $nilai->keterangan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>