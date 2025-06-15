<!DOCTYPE html>
<html>

<head>
    <title>Nilai Hapalan Doa - {{ $santri->nama }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .title {
            font-size: 18px;
            font-weight: bold;
        }

        .subtitle {
            font-size: 14px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            border: 1px solid #000;
            padding: 5px;
        }

        .table th {
            background-color: #f2f2f2;
            text-align: center;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .mt-4 {
            margin-top: 20px;
        }

        .signature {
            margin-top: 50px;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="title">LAPORAN NILAI HAPALAN DOA</div>
    </div>

    <div class="student-info">
        <h4><strong>{{ $santri->nama_santri }} </strong> </h4>
    </div>

    <div class="mt-4">
        <table class="table">
            <thead style="background-color:blue; color:white;">
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Doa</th>
                    <th>Nilai</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($santri->nilaiHafalanDoas as $index => $nilai)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($nilai->tanggal_penilaian)->translatedFormat('d M Y')}}</td>

                    <td>{{ $nilai->doa }}</td>
                    <td class="text-center">{{ $nilai->nilai }}</td>
                    <td>
                        @if($nilai->nilai >= 80)
                        Sangat Baik
                        @elseif($nilai->nilai >= 60)
                        Cukup
                        @else
                        Kurang
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>