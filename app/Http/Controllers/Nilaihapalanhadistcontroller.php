<?php

namespace App\Http\Controllers;

use App\Models\DaftarSantri;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Nilaihapalanhadist;

class Nilaihapalanhadistcontroller extends Controller
{
    public function index()
    {
        $nilaiTerakhir = Nilaihapalanhadist::with('santri')
            ->select('santri_id', 'tanggal_penilaian', 'hadist', 'nilai')
            ->whereIn('id', function ($query) {
                $query->selectRaw('MAX(id)')
                    ->from('nilaihapalanhadists')
                    ->groupBy('santri_id');
            })
            ->orderBy('tanggal_penilaian', 'desc')
            ->get();
        // Urutkan berdasarkan nama santri
        $nilaiTerakhir = $nilaiTerakhir->sortBy(function ($nilai) {
            return $nilai->santri->nama_santri;
        });
        return view('sd.nilaihadist.index', compact('nilaiTerakhir'));
    }

    public function create()
    {
        $daftarSantris = DaftarSantri::all();
        return view('sd.nilaihadist.create', compact('daftarSantris'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'santri_id' => 'required|exists:daftar_santris,id',
            'hadist' => 'required|string',
            'nilai' => 'required|integer|min:1|max:100',
        ]);

        // Tambahkan tanggal penilaian secara terpisah
        $validated['tanggal_penilaian'] = now();

        Nilaihapalanhadist::create($validated);

        return redirect()->route('sd.nilaihadist.index')->with('success', 'Nilai berhasil ditambahkan');
    }

    public function show(DaftarSantri $santri)
    {
        $nilaihadist = Nilaihapalanhadist::where('santri_id', $santri->id)
            ->orderBy('tanggal_penilaian', 'desc')
            ->get();

        $av = $nilaihadist->avg('nilai');

        if ($av >= 90) {
            $keterangan = 'Istimewa';
        } elseif ($av >= 80) {
            $keterangan = 'Baik';
        } elseif ($av >= 70) {
            $keterangan = 'Cukup';
        } else {
            $keterangan = 'Ayo Tingkatkan';
        }
        return view('sd.nilaihadist.show', compact('nilaihadist', 'santri', 'av', 'keterangan'));
    }

    public function edit($id)
    {
        $nilai = Nilaihapalanhadist::findOrFail($id);
        $daftarSantris = DaftarSantri::all();
        return view('sd.nilaihadist.edit', compact('nilai', 'daftarSantris'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'santri_id' => 'required|exists:daftar_santris,id',
            'hadist' => 'required|string',
            'nilai' => 'required|integer|min:1|max:100',
        ]);

        // Tambahkan tanggal penilaian secara terpisah
        $validated['tanggal_penilaian'] = now();

        $nilai = Nilaihapalanhadist::findOrFail($id);
        $nilai->update($validated);

        return redirect()->route('sd.nilaihadist.index')->with('success', 'Nilai berhasil diperbarui');
    }

    public function destroy($id)
    {
        $nilai = Nilaihapalanhadist::findOrFail($id);
        $nilai->delete();

        return redirect()->route('sd.nilaihadist.index')->with('success', 'Nilai berhasil dihapus');
    }
    public function genratePdf($santri_id)
    {
        $santri = DaftarSantri::with(['nilaihapalanhadists' => function ($query) {
            $query->orderBy('tanggal_penilaian', 'desc');
        }])->findOrFail($santri_id);
        $pdf = Pdf::loadView('sd.nilaihadist.generatePDF', compact('santri'));
        return $pdf->download('nilai_hapalan_hadist_', $santri->nama_santri . '.pdf');
    }
    public function reset()
    {
        Nilaihapalanhadist::truncate();
        return redirect()->route('sd.nilaihadist.index')->with('success', 'Semua data infak berhasil direset.');
    }
}
