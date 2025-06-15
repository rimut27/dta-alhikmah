@extends('adminlte::page')

@section('content')
<div class="container">
    <h3>Riwayat Praktek Shalat: {{ $santri->nama_santri }}</h3>
    
    <p><strong>Rata-rata:</strong> {{ number_format($average, 2) }} ({{ $keterangan }})</p>
    <a href="{{ route('tk.praktekshalat.generatePDF', $santri->id) }}" class="btn btn-outline-danger mb-3">Export PDF</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Nilai</th>
                <th>Keterangan</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($praktekshalat as $nilai)
                <tr>
                    <td>{{ $nilai->tanggal_penilaian }}</td>
                    <td>{{ $nilai->nilai }}</td>
                    <td>{{ $nilai->keterangan }}</td>
                    <td>
                        <a href="{{ route('tk.praktekshalat.edit', $nilai->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        <form action="{{ route('tk.praktekshalat.destroy', $nilai->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin hapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
