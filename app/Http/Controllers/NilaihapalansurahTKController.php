<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NilaihapalansurahTK;
use App\Models\daftarSantriTK;
use Barryvdh\DomPDF\Facade\Pdf;

class NilaihapalansurahTKController extends Controller
{
    public function index()
    {
        // Di method index(), perbaiki subquery
        $nilaiTerakhir = NilaihapalansurahTK::with('santri')
            ->select('santri_id', 'tanggal_penilaian', 'surat', 'ayat', 'nilai')
            ->whereIn('id', function ($query) {
                $query->selectRaw('MAX(id)')
                    ->from('nilaihapalansurah_t_k_s') // Pastikan nama tabel disini benar
                    ->groupBy('santri_id');
            })
            ->get();
        // Urutkan berdasarkan nama santri
        $nilaiTerakhir = $nilaiTerakhir->sortBy(function ($item) {
            return $item->santri->nama_santrii;
        });

        return view('tk.hafalasurah.index', compact('nilaiTerakhir'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $santris = daftarSantriTK::orderBy('nama_santri', 'asc')->get();
        return view('tk.hafalasurah.create', compact('santris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'santri_id' => 'required|exists:daftar_santri_t_k_s,id',
            'surat' => 'required|string',
            'ayat' => 'required|string',
            'nilai' => 'required|integer|min:1|max:100',
        ]);

        // Tambahkan tanggal penilaian secara terpisah
        $validated['tanggal_penilaian'] = now();

        NilaihapalansurahTK::create($validated);

        return redirect()->route('tk.nilaihafalansurah.index')->with('success', 'Nilai berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($santri_id)
    {
        $santri = daftarSantriTK::findOrFail($santri_id);
        $nilaiHafalan = NilaihapalansurahTK::where('santri_id', $santri_id)
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

        return view('tk.hafalasurah.show', compact('santri', 'nilaiHafalan', 'rataRataNilai', 'keterangan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $nilaiHafalan = NilaihapalansurahTK::findOrFail($id);
        $santri = daftarSantriTK::findOrFail($nilaiHafalan->santri_id);

        return view('tk.hafalasurah.edit', compact('santri', 'nilaiHafalan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'santri_id' => 'required|exists:daftar_santri_t_k_s,id',
            'surat' => 'required|string',
            'ayat' => 'required|string',
            'nilai' => 'required|integer|min:1|max:100',
        ]);

        $validated['tanggal_penilaian'] = now();

        $nilaiHafalan = NilaihapalansurahTK::findOrFail($id); // <-- pakai ID penilaian
        $nilaiHafalan->update($validated);

        return redirect()->route('tk.nilaihafalansurah.index')->with('success', 'Nilai berhasil diperbarui');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $nilaiHafalan = NilaihapalansurahTK::findOrFail($id);
        $nilaiHafalan->delete();

        return redirect()->route('tk.nilaihafalansurah.show')->with('success', 'Nilai berhasil dihapus');
    }

    public function exportPdf($santri_id)
    {
        $santri = NilaihapalansurahTK::findOrFail($santri_id);
        $nilaiHafalan = NilaihapalansurahTK::where('santri_id', $santri_id)
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


        $pdf = PDF::loadView('tk.hafalansurnah.export_pdf', compact('santri', 'rataRata', 'nilaiHafalan'));
        return $pdf->download('Nilai_Hafalan_ surat' . $santri->nama_santrii . '.pdf');
    }
    public function reset()
    {
        NilaihapalansurahTK::truncate();
        return redirect()->route('tk.nilaihafalansurah.index')->with('success', 'Nilai berhasil dihapus');
    }
}
