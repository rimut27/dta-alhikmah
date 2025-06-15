<!DOCTYPE html>
<html>
<head>
    <title>Laporan Infak Per Santri</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .header { margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="header">
        <h2 class="text-center">Laporan Infak Santri</h2>
        <h3 class="text-center">{{ $santri->nama_santri }}</h3>
        <p class="text-center">Per Tanggal: {{ $tanggal }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th class="text-right">Jumlah Infak</th>
            </tr>
        </thead>
        <tbody>
            @foreach($infak as $key => $item)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ date('d-m-Y', strtotime($item->tanggal)) }}</td>
                <td class="text-right">Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="2">Total Infak</th>
                <th class="text-right">Rp {{ number_format($totalInfak, 0, ',', '.') }}</th>
            </tr>
        </tfoot>
    </table>
</body>
</html>