<!DOCTYPE html>
<html>
<head>
    <title>Nilai Hafalan Surah - {{ $santri->nama }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        .title { font-size: 18px; font-weight: bold; }
        .subtitle { font-size: 14px; }
        .table { width: 100%; border-collapse: collapse; }
        .table th, .table td { border: 1px solid #000; padding: 5px; }
        .table th { background-color: #f2f2f2; text-align: center; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .mt-4 { margin-top: 20px; }
        .signature { margin-top: 50px; }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">LAPORAN NILAI HAFALAN SURAH</div>
        <div class="subtitle">MDAUD</div>
    </div>
    <p>Nama Santri : <strong>{{ $santri->nama_santri }} </strong></p>

    <div class="mt-4">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Surat</th>
                    <th>Ayat</th>
                    <th>Nilai</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($nilaiHafalan as $index => $nilai)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td> {{\Carbon\Carbon::parse($nilai->tanggal_penilaian) ->translatedFormat('d M Y') }}</td>
                    <td>{{ $nilai->surat }}</td>
                    <td>{{ $nilai->ayat }}</td>
                    <td class="text-center">{{ $nilai->nilai }}</td>
                    <td>
                        @if($nilai->nilai >= 80)
                            Sangat Baik
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
    </div>

    <div style="margin-top: 20px;">
      <p><strong>Rata-rata Nilai:</strong> {{ number_format($rataRata, 2) }}</p>
</div>

</body>
</html>