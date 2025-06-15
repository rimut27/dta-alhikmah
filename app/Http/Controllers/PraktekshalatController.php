<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Praktekshalat;
use App\Models\DaftarSantriTK;
use Barryvdh\DomPDF\Facade\Pdf;

class PraktekshalatController extends Controller
{
    public function index()
    {
        $nilaiTerakhir = Praktekshalat::with('santri')
            ->select('santri_id', 'tanggal_penilaian', 'nilai', 'keterangan')
            ->whereIn('id', function ($query) {
                $query->selectRaw('MAX(id)')
                    ->from('praktekshalats')
                    ->groupBy('santri_id');
            })
            ->get()
            ->sortBy(function ($item) {
                return $item->santri->nama_santri ?? '';
            })
            ->values();

        return view('tk.praktekshalat.index', ['praktekshalats' => $nilaiTerakhir]);
    }

    public function show($id)
    {
        $santri = DaftarSantriTK::findOrFail($id);
        $praktekshalat = Praktekshalat::where('santri_id', $santri->id)
            ->orderBy('tanggal_penilaian', 'desc')
            ->get();

        $average = $praktekshalat->avg('nilai');

        if ($average >= 90) {
            $keterangan = 'luar biasa';
        } elseif ($average >= 80) {
            $keterangan = 'Baik';
        } elseif ($average >= 70) {
            $keterangan = 'Cukup';
        } else {
            $keterangan = 'Perlu Perbaikan';
        }

        return view('tk.praktekshalat.show', compact('santri', 'praktekshalat', 'average', 'keterangan'));
    }

    public function create()
    {
        $santris = DaftarSantriTK::orderBy('nama_santri', 'asc')->get();
        return view('tk.praktekshalat.create', compact('santris'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'santri_id' => 'required|exists:daftar_santri_t_k_s,id',
            'nilai' => 'required|integer|min:0|max:100',
            'keterangan' => 'nullable|string|max:255',
        ]);

        // Tambahkan tanggal penilaian secara terpisah
        $validated['tanggal_penilaian'] = now();
        Praktekshalat::create($validated);
        return redirect()->route('tk.praktekshalat.index')->with('success', 'Data praktek shalat berhasil ditambahkan.');
    }

    public function edit(Praktekshalat $praktekshalat)
    {
        $santris = DaftarSantriTK::all();
        return view('tk.praktekshalat.edit', compact('praktekshalat', 'santris'));
    }
    public function update(Request $request, Praktekshalat $praktekshalat)
    {
        $request->validate([
            'santri_id' => 'required|exists:daftar_santri_t_k_s,id',
            'tanggal_penilaian' => 'required|date',
            'nilai' => 'required|integer|min:0|max:100',
            'keterangan' => 'nullable|string|max:255',
        ]);

        $praktekshalat->update($request->all());
        return redirect()->route('tk.praktekshalat.index')->with('success', 'Data praktek shalat berhasil diperbarui.');
    }

    public function destroy(Praktekshalat $praktekshalat)
    {
        $praktekshalat->delete();
        return redirect()->route('tk.praktekshalat.index')->with('success', 'Data praktek shalat berhasil dihapus.');
    }

    public function pdfpersantri($santri_id)
    {
        $santri = DaftarSantriTK::with(['praktekShalat' => function ($query) {
            $query->orderBy('tanggal_penilaian', 'desc');
        }])->findOrFail($santri_id);


        $pdf = Pdf::loadView('tk.praktekshalat.generatePDF', compact('santri'));
        return $pdf->download('nilai praktek sholat' . $santri->nama_santri . '.pdf');
    }

    public function reset()
    {
        Praktekshalat::truncate();
        return redirect()->route('tk.praktekshalat.index')->with('success', 'Semua data praktek shalat berhasil direset.');
    }
}
