<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NilaiMembaca;
use App\Models\DaftarSantriTK;
use Barryvdh\DomPDF\Facade\Pdf;

class NilaiMembacaControoller extends Controller
{
    public function index()
    {
        $nilaiTerakhir = NilaiMembaca::with('santri')
            ->select('santri_id', 'tanggal_penilaian',  'iqra', 'halaman', 'nilai')
            ->whereIn('id', function ($query) {
                $query->selectRaw('MAX(id)')
                    ->from('nilai_membacas')
                    ->groupBy('santri_id');
            })
            ->orderBy('tanggal_penilaian', 'desc')
            ->get();

        // Urutkan berdasarkan nama santri
        $nilaiTerakhir = $nilaiTerakhir->sortBy(function ($nilai) {
            return $nilai->santri->nama_santri;
        });

        return view('tk.nilaimembaca.index', compact('nilaiTerakhir'));
    }
    public function create()
    {
        $daftarSantris = DaftarSantriTK::orderBy('nama_santri', 'asc')->get();
        return view('tk.nilaimembaca.create', compact('daftarSantris'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'santri_id' => 'required|exists:daftar_santri_t_k_s,id',
            'iqra' => 'required|string',
            'halaman' => 'required|integer|min:1|max:1000',
            'nilai' => 'required|integer|min:0|max:100',
        ]);

        // Tambahkan tanggal penilaian secara terpisah
        $validated['tanggal_penilaian'] = now();

        NilaiMembaca::create($validated);

        return redirect()->route('tk.nilaimembaca.index')->with('success', 'Nilai berhasil ditambahkan');
    }
    public function show($id)
    {
        $santri = DaftarSantriTK::findOrFail($id);
        $nilaiMembaca = NilaiMembaca::where('santri_id', $santri->id)
            ->orderBy('tanggal_penilaian', 'desc')
            ->get();

        $average = $nilaiMembaca->avg('nilai');

        if ($average >= 90) {
            $keterangan = 'luar biasa';
        } elseif ($average >= 80) {
            $keterangan = 'Baik';
        } elseif ($average >= 70) {
            $keterangan = 'Cukup';
        } else {
            $keterangan = 'Kurang';
        }

        return view('tk.nilaimembaca.show', compact('santri', 'nilaiMembaca', 'average', 'keterangan'));
    }
    public function edit($id)
    {
        $nilaiMembaca = NilaiMembaca::findOrFail($id);
        $daftarSantris = DaftarSantriTK::all();
        return view('tk.nilaimembaca.edit', compact('nilaiMembaca', 'daftarSantris'));
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'santri_id' => 'required|exists:daftar_santri_t_k_s,id',
            'iqra' => 'required|string',
            'halaman' => 'required|integer|min:1|max:1000',
            'nilai' => 'required|integer|min:0|max:100',
        ]);

        // Tambahkan tanggal penilaian secara terpisah
        $validated['tanggal_penilaian'] = now();

        $nilaiMembaca = NilaiMembaca::findOrFail($id);
        $nilaiMembaca->update($validated);

        return redirect()->route('tk.nilaimembaca.index')->with('success', 'Nilai berhasil diperbarui');
    }
    public function destroy($id)
    {
        $nilaiMembaca = NilaiMembaca::findOrFail($id);
        $nilaiMembaca->delete();

        return redirect()->route('tk.nilaimembaca.index')->with('success', 'Nilai berhasil dihapus');
    }
    public function reset()
    {
        NilaiMembaca::truncate();
        return redirect()->route('tk.nilaimembaca.index')->with('success', 'Semua data infak berhasil direset.');
    }

    public function exportPdf($id)
    {
        $santri = DaftarSantriTK::findOrFail($id);
        $nilaiMembaca = NilaiMembaca::where('santri_id', $santri->id)
            ->orderBy('tanggal_penilaian', 'desc')
            ->get();

        $average = $nilaiMembaca->avg('nilai');

        if ($average >= 90) {
            $keterangan = 'luar biasa';
        } elseif ($average >= 80) {
            $keterangan = 'Baik';
        } elseif ($average >= 70) {
            $keterangan = 'Cukup';
        } else {
            $keterangan = 'Kurang';
        }
        $pdf = Pdf::loadView('tk.nilaimembaca.pdf', compact('santri', 'nilaiMembaca', 'average', 'keterangan'));
        return $pdf->download("laporan-nilai-membaca-{$santri->nama_santri}.pdf");
    }
}
