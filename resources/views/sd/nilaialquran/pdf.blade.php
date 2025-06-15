<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Laporan Nilai Al-Quran - {{ $santri->nama }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h2 { margin-bottom: 5px; }
        .header p { margin-top: 0; }
        .table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .table th, .table td { border: 1px solid #000; padding: 8px; }
        .table th { background-color: #f2f2f2; text-align: center; }
        .text-center { text-align: center; }
        .footer { margin-top: 30px; text-align: right; }
    </style>
</head>
<body>
    <div class="header">
        <h2>LAPORAN NILAI Tilawah</h2>
        <p>DTA AL-HIKMAH</p>
    </div>

    <div>

    <p>Nama Santri : <strong>{{ $santri->nama_santri }} </strong></p>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Surat</th>
                <th>Halaman</th>
                <th>Nilai</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($santri->nilaiAlquransds as $key => $nilai)
            <tr>
                <td class="text-center">{{ $key+1 }}</td>
                <td>{{ $nilai->tanggal_formatted }}</td>
                <td>{{ $nilai->surat }}</td>
                <td>{{ $nilai->halaman }}</td>
                <td class="text-center">{{ $nilai->nilai }}</td>
                <td>
                    @if($nilai->nilai >= 80)
                        Sangat Baik
                    @elseif($nilai->nilai >= 70)
                        Baik
                    @elseif($nilai->nilai >= 60)
                        Cukup
                    @else
                        Perlu Bimbingan
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-top: 20px;">
        <p><strong>Rata-rata Nilai:</strong> {{ $rata_rata }}</p>
        <p><strong>Total Penilaian:</strong> {{ count($santri->nilaiAlquransds) }}</p>
    </div>

    <div class="footer">
        <p>Dicetak pada: {{ $tanggal_laporan }}</p>
    </div>
</body>
</html>