<?php

namespace App\Http\Controllers;

use App\Models\DaftarSantri;
use App\Models\NilaiAlquransd;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class NilaiAlquransdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil data nilai terakhir setiap santri
        $nilaiTerakhir = NilaiAlquransd::with('santri')
            ->select('santri_id', 'tanggal_penilaian', 'surat', 'halaman', 'nilai')
            ->whereIn('id', function ($query) {
                $query->selectRaw('MAX(id)')
                    ->from('nilai_alquransds')
                    ->groupBy('santri_id');
            })
            ->orderBy('tanggal_penilaian', 'desc')
            ->get();
        // Urutkan berdasarkan nama santri
        $nilaiTerakhir = $nilaiTerakhir->sortBy(function ($nilai) {
            return $nilai->santri->nama_santri;
        });
        // Kembalikan view dengan data nilai terakhir

        return view('sd.nilaialquran.index', compact('nilaiTerakhir'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $santris = DaftarSantri::all();
        return view('sd.nilaialquran.create', compact('santris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'santri_id' => 'required|exists:daftar_santris,id',
            'surat' => 'required|string',
            'halaman' => 'required|string',
            'nilai' => 'required|integer|min:1|max:100',
        ]);

        // Tambahkan tanggal penilaian secara terpisah
        $validated['tanggal_penilaian'] = now();

        NilaiAlquransd::create($validated);

        return redirect()->route('sd.nilaialquran.index')->with('success', 'Nilai berhasil ditambahkan');
    }
    /**
     * Display the specified resource.
     */

    public function show($santri_id)
    {
        $santri = DaftarSantri::with(['nilaiAlquransds' => function ($query) {
            $query->orderBy('tanggal_penilaian', 'desc');
        }])->findOrFail($santri_id);
        $rataRataNilai = $santri->nilaiAlquransds->avg('nilai');


        if ($rataRataNilai >= 90) {
            $keterangan = 'Istimewa';
        } elseif ($rataRataNilai >= 80) {
            $keterangan = 'Baik';
        } elseif ($rataRataNilai >= 70) {
            $keterangan = 'Cukup';
        } else {
            $keterangan = 'Ayo Tingkatkan';
        }

        return view('sd.nilaialquran.show', compact('santri', 'rataRataNilai', 'keterangan'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NilaiAlquransd $NilaiAlquransd)
    {
        $santris = DaftarSantri::all();
        return view('sd.nilaialquran.edit', compact('NilaiAlquransd', 'santris'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, NilaiAlquransd $nilaiAlquransd)
    {
        $validated = $request->validate([
            'santri_id' => 'required|exists:daftar_santris,id',
            'surat' => 'required|string',
            'halaman' => 'required|string',
            'nilai' => 'required|integer|min:1|max:100',
            'tanggal_penilaian' => 'required|date', // Tambahkan validasi tanggal
        ]);

        // Format tanggal ke database (Y-m-d)
        $validated['tanggal_penilaian'] = \Carbon\Carbon::parse($validated['tanggal_penilaian'])->format('dddd, DD MMMM YYYY');

        $nilaiAlquransd->update($validated);

        return redirect()->route('sd.nilaialquran.show', $nilaiAlquransd->santri_id)
            ->with('success', 'Nilai berhasil diperbarui');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NilaiAlquransd $NilaiAlquransd)
    {
        $NilaiAlquransd->delete();
        return redirect()->back()->with('success', 'Nilai berhasil dihapus');
    }

    /**
     * Export PDF for a specific santri's Al-Quran scores
     */
    public function exportPdf($santri_id)
    {
        $santri = DaftarSantri::with(['nilaiAlquransds' => function ($query) {
            $query->orderBy('tanggal_penilaian', 'desc');
        }])->findOrFail($santri_id);

        // Format dates in Indonesian
        foreach ($santri->nilaiAlquransds as $nilai) {
            $nilai->tanggal_formatted = \Carbon\Carbon::parse($nilai->tanggal_penilaian)
                ->locale('id')
                ->isoFormat('dddd, D MMMM YYYY');
        }

        $data = [
            'santri' => $santri,
            'tanggal_laporan' => now()->locale('id')->isoFormat('dddd, D MMMM YYYY'),
            'rata_rata' => number_format($santri->nilaiAlquransds->avg('nilai'), 2),
        ];

        $pdf = Pdf::loadView('sd.nilaialquran.pdf', $data);
        return $pdf->download('nilai-alquran-' . $santri->nama_santri . '.pdf');
    }
    public function reset()
    {
        NilaiAlquransd::truncate();
        return redirect()->route('sd.nilaialquran.index')->with('success', 'Semua data infak berhasil direset.');
    }
}
