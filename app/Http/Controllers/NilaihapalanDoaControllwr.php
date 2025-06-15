<?php

namespace App\Http\Controllers;

use App\Models\DaftarSantri;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\NilaihapalanDoa;

class NilaihapalanDoaControllwr extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil data nilai terakhir setiap santri
        $nilaiTerakhir = NilaihapalanDoa::with('santri')
            ->select('santri_id', 'tanggal_penilaian', 'doa', 'nilai')
            ->whereIn('id', function ($query) {
                $query->selectRaw('MAX(id)')
                    ->from('nilaihapalan_doas')
                    ->groupBy('santri_id');
            })
            ->orderBy('tanggal_penilaian', 'desc')
            ->get();
        // Urutkan berdasarkan nama santri
        $nilaiTerakhir = $nilaiTerakhir->sortBy(function ($nilai) {
            return $nilai->santri->nama_santri;
        });

        return view('sd.nilaidoa.index', compact('nilaiTerakhir'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $santris = DaftarSantri::all();
        return view('sd.nilaidoa.create', compact('santris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'santri_id' => 'required|exists:daftar_santris,id',
            'doa' => 'required|string',
            'nilai' => 'required|integer|min:1|max:100',
        ]);

        // Tambahkan tanggal penilaian secara terpisah
        $validated['tanggal_penilaian'] = now();

        NilaihapalanDoa::create($validated);

        return redirect()->route('sd.nilaidoa.index')->with('success', 'Nilai berhasil ditambahkan');
    }

    /** 
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $nilaiHafalan = NilaihapalanDoa::findOrFail($id);
        $santris = DaftarSantri::all();
        return view('sd.nilaidoa.edit', compact('nilaiHafalan', 'santris'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'santri_id' => 'required|exists:daftar_santris,id',
            'doa' => 'required|string',
            'nilai' => 'required|integer|min:1|max:100',
        ]);

        $nilaiHafalan = NilaihapalanDoa::findOrFail($id);
        $nilaiHafalan->update($validated);

        return redirect()->route('sd.nilaidoa.index')->with('success', 'Nilai berhasil diperbarui');
    }
    /**
     * Display the specified resource.
     */
    public function show(DaftarSantri $santri)
    {
        $nilaidoa = NilaihapalanDoa::where('santri_id', $santri->id)
            ->orderBy('tanggal_penilaian', 'desc')
            ->get();

        $av = $nilaidoa->avg('nilai');

        if ($av >= 90) {
            $keterangan = 'Istimewa';
        } elseif ($av >= 80) {
            $keterangan = 'Baik';
        } elseif ($av >= 70) {
            $keterangan = 'Cukup';
        } else {
            $keterangan = 'Ayo Tingkatkan';
        }

        return view('sd.nilaidoa.show', compact('nilaidoa', 'santri', 'keterangan', 'av'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $nilaiHafalan = NilaihapalanDoa::findOrFail($id);
        $nilaiHafalan->delete();
        return redirect()->route('sd.nilaidoa.index')->with('success', 'Nilai berhasil dihapus');
    }
    /**
     * Generate PDF for the specified santri.
     */
    public function generatePDF($santri_id)
    {
        $santri = DaftarSantri::with(['nilaiHafalanDoas' => function ($query) {
            $query->orderBy('tanggal_penilaian', 'desc');
        }])->findOrFail($santri_id);
        $pdf = Pdf::loadView('sd.nilaidoa.generatePDF', compact('santri'));
        return $pdf->download('nilai_hapalan_doa_', $santri->nama_santri . '.pdf');
    }

    public function reset()
    {
        NilaihapalanDoa::truncate();
        return redirect()->route('sd.nilaidoa.index')->with('success', 'Semua data infak berhasil direset.');
    }
}
