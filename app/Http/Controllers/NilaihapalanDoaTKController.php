<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\daftarSantriTK;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\NilaihapalanDoaTk;

class NilaihapalanDoaTKController extends Controller
{
    public function index()
    {
        // Ambil data nilai terakhir setiap santri
        $nilaiTerakhir = NilaihapalanDoaTk::with('santri')
            ->select('santri_id', 'tanggal_penilaian', 'doa', 'nilai')
            ->whereIn('id', function ($query) {
                $query->selectRaw('MAX(id)')
                    ->from('nilaihapalan_doa_tks')
                    ->groupBy('santri_id');
            })
            ->orderBy('tanggal_penilaian', 'desc')
            ->get();
        // Urutkan berdasarkan nama santri
        $nilaiTerakhir = $nilaiTerakhir->sortBy(function ($item) {
            return $item->santri->nama_santri ?? '';
        })->values();

        return view('tk.nilaidoa.index', compact('nilaiTerakhir'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $santris = daftarSantriTK::orderBy('nama_santri', 'asc')->get();
        return view('tk.nilaidoa.create', compact('santris'));
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

        NilaihapalanDoaTk::create($validated);

        return redirect()->route('tk.nilaidoa.index')->with('success', 'Nilai berhasil ditambahkan');
    }

    /** 
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $nilaiHafalan = NilaihapalanDoaTk::findOrFail($id);
        $santris = daftarSantriTK::all();
        return view('tk.nilaidoa.edit', compact('nilaiHafalan', 'santris'));
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

        $nilaiHafalan = NilaihapalanDoaTk::findOrFail($id);
        $nilaiHafalan->update($validated);

        return redirect()->route('tk.nilaidoa.index')->with('success', 'Nilai berhasil diperbarui');
    }
    /**
     * Display the specified resource.
     */
    public function show(daftarSantriTK $santri)
    {
        $nilaidoa = NilaihapalanDoaTk::where('santri_id', $santri->id)
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

        return view('tk.nilaidoa.show', compact('nilaidoa', 'santri', 'keterangan', 'av'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $nilaiHafalan = NilaihapalanDoaTk::findOrFail($id);
        $nilaiHafalan->delete();
        return redirect()->route('tk.nilaidoa.index')->with('success', 'Nilai berhasil dihapus');
    }
    /**
     * Generate PDF for the specified santri.
     */
    public function generatePDF($santri_id)
    {
        $santri = daftarSantriTK::findOrFail($santri_id);
        $nilaidoa = NilaihapalanDoaTk::where('santri_id', $santri->id)
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
        $santri->keterangan = $keterangan;
        $santri->average = $av;
        $santri->nilaidoa = $nilaidoa;
        // Generate PDF using the view
        $pdf = Pdf::loadView('tk.nilaidoa.generatePDF', compact('santri', 'nilaidoa', 'keterangan', 'av'));
        return $pdf->download('nilai_hapalan_doa_' . $santri->nama_santri . '.pdf');

    }

    public function reset()
    {
        NilaihapalanDoaTk::truncate();
        return redirect()->route('tk.nilaidoa.index')->with('success', 'Semua data infak berhasil direset.');
    }
}
