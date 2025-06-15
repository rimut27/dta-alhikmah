<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DaftarSantri;
use App\Models\Nilaihafalansurahsd;
use Barryvdh\DomPDF\Facade\Pdf;

class Nilaihafalansurahsdcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Di method index(), perbaiki subquery
        $nilaiTerakhir = Nilaihafalansurahsd::with('santri')
            ->select('santri_id', 'tanggal_penilaian', 'surat', 'ayat', 'nilai')
            ->whereIn('id', function ($query) {
                $query->selectRaw('MAX(id)')
                    ->from('nilaihafalansurahsds') // Pastikan nama tabel disini benar
                    ->groupBy('santri_id');
            })
            ->orderBy('tanggal_penilaian', 'desc')
            ->get();
        // Urutkan berdasarkan nama santri
        $nilaiTerakhir = $nilaiTerakhir->sortBy(function ($item) {
            return $item->santri->nama_santrii;
        });

        return view('sd.hafalasurah.index', compact('nilaiTerakhir'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $santris = DaftarSantri::all();
        return view('sd.hafalasurah.create', compact('santris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'santri_id' => 'required|exists:daftar_santris,id',
            'surat' => 'required|string',
            'ayat' => 'required|string',
            'nilai' => 'required|integer|min:1|max:100',
        ]);

        // Tambahkan tanggal penilaian secara terpisah
        $validated['tanggal_penilaian'] = now();

        Nilaihafalansurahsd::create($validated);

        return redirect()->route('sd.nilaihafalansurah.index')->with('success', 'Nilai berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($santri_id)
    {
        $santri = DaftarSantri::findOrFail($santri_id);
        $nilaiHafalan = Nilaihafalansurahsd::where('santri_id', $santri_id)
            ->orderBy('tanggal_penilaian', 'desc')
            ->get();

        // Hitung rata-rata nilai
        $rataRataNilai = $nilaiHafalan->avg('nilai');


        if ($rataRataNilai >= 90) {
            $keterangan = 'Istimewa';
        } elseif ($rataRataNilai >= 80) {
            $keterangan = 'Baik';
        } elseif ($rataRataNilai >= 70) {
            $keterangan = 'Cukup';
        } else {
            $keterangan = 'Ayo Tingkatkan';
        }

        return view('sd.hafalasurah.show', compact('santri', 'nilaiHafalan', 'rataRataNilai', 'keterangan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($santri_id)
    {
        $santri = DaftarSantri::findOrFail($santri_id);
        $nilaiHafalan = Nilaihafalansurahsd::where('santri_id', $santri_id)
            ->orderBy('tanggal_penilaian', 'desc')
            ->first();

        return view('sd.hafalasurah.edit', compact('santri', 'nilaiHafalan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $santri_id)
    {
        $validated = $request->validate([
            'santri_id' => 'required|exists:daftar_santris,id',
            'surat' => 'required|string',
            'ayat' => 'required|string',
            'nilai' => 'required|integer|min:1|max:100',
        ]);

        // Tambahkan tanggal penilaian secara terpisah
        $validated['tanggal_penilaian'] = now();

        $nilaiHafalan = Nilaihafalansurahsd::findOrFail($santri_id);
        $nilaiHafalan->update($validated);

        return redirect()->route('sd.nilaihafalansurah.index')->with('success', 'Nilai berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $nilaiHafalan = Nilaihafalansurahsd::findOrFail($id);
        $nilaiHafalan->delete();

        return redirect()->route('sd.nilaihafalansurah.show')->with('success', 'Nilai berhasil dihapus');
    }

    public function exportPdf($santri_id)
    {
        $santri = DaftarSantri::findOrFail($santri_id);
        $nilaiHafalan = Nilaihafalansurahsd::where('santri_id', $santri_id)
            ->orderBy('tanggal_penilaian', 'desc')
            ->get();
        // Format dates in Indonesian
        foreach ($santri->nilaiAlquransds as $nilai) {
            $nilai->tanggal_formatted = \Carbon\Carbon::parse($nilai->tanggal_penilaian)
                ->locale('id')
                ->isoFormat('dddd, D MMMM YYYY');
        }
        // Hitung rata-rata nilai
        $totalNilai = $nilaiHafalan->sum('nilai');
        $jumlahPenilaian = $nilaiHafalan->count();
        $rataRata = $jumlahPenilaian > 0 ? $totalNilai / $jumlahPenilaian : 0;


        $pdf = PDF::loadView('sd.hafalansurnah.export_pdf', compact('santri', 'rataRata', 'nilaiHafalan'));
        return $pdf->download('Nilai_Hafalan_ surat' . $santri->nama_santrii . '.pdf');
    }
    public function reset()
    {
        Nilaihafalansurahsd::truncate();
        return redirect()->route('sd.nilaihafalansurah.index')->with('success', 'Nilai berhasil dihapus');
    }
}
