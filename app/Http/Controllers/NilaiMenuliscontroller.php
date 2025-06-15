<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NilaiMenulis;
use App\Models\DaftarSantriTK;
use Barryvdh\DomPDF\Facade\Pdf;

class NilaiMenuliscontroller extends Controller
{
    public function index()
    {
        $nilaiTerakhir = NilaiMenulis::with('santri')
            ->select('santri_id', 'tanggal_penilaian', 'jilid', 'halaman', 'nilai')
            ->whereIn('id', function ($query) {
                $query->selectRaw('MAX(id)')
                    ->from('nilai_menulis')
                    ->groupBy('santri_id');
            })
            ->get()
            ->sortBy(function ($item) {
                return $item->santri->nama_santri ?? '';
            })
            ->values(); // reset index agar tidak acak

        return view('tk.nilaimenulis.index', compact('nilaiTerakhir'));
    }


    public function create()
    {
        $daftarSantris = DaftarSantriTK::orderBy('nama_santri', 'asc')->get();
        return view('tk.nilaimenulis.create', compact('daftarSantris'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'santri_id' => 'required|exists:daftar_santri_t_k_s,id',
            'jilid' => 'nullable|string',
            'halaman' => 'nullable|string',
            'nilai' => 'required|integer|min:0|max:100',
        ]);

        // Tambahkan tanggal penilaian secara terpisah
        $validated['tanggal_penilaian'] = now();

        NilaiMenulis::create($validated);

        return redirect()->route('tk.nilaimenulis.index')->with('success', 'Nilai berhasil ditambahkan');
    }

    public function show($id)
    {
        $santri = DaftarSantriTK::findOrFail($id);
        $nilaiMenulis = NilaiMenulis::where('santri_id', $santri->id)
            ->orderBy('tanggal_penilaian', 'desc')
            ->get();

        $average = $nilaiMenulis->avg('nilai');

        if ($average >= 90) {
            $keterangan = 'luar biasa';
        } elseif ($average >= 80) {
            $keterangan = 'Baik';
        } elseif ($average >= 70) {
            $keterangan = 'Cukup';
        } else {
            $keterangan = 'Perlu Perbaikan';
        }

        return view('tk.nilaimenulis.show', compact('santri', 'nilaiMenulis', 'average', 'keterangan'));
    }

    public function edit($id)
    {
        $nilaiMenulis = NilaiMenulis::findOrFail($id);
        $daftarSantris = DaftarSantriTK::orderBy('nama_santri', 'asc')->get();
        return view('tk.nilaimenulis.edit', compact('nilaiMenulis', 'daftarSantris'));
    }

    public function update(Request $request, $id)
    {
        $nilaiMenulis = NilaiMenulis::findOrFail($id);

        $validated = $request->validate([
            'santri_id' => 'required|exists:daftar_santri_t_k_s,id',
            'jilid' => 'nullable|string',
            'halaman' => 'nullable|string',
            'nilai' => 'required|integer|min:0|max:100',
        ]);

        $nilaiMenulis->update($validated);

        return redirect()->route('tk.nilaimenulis.index')->with('success', 'Nilai berhasil diperbarui');
    }
    
    public function reset()
    {
        NilaiMenulis::truncate();
        return redirect()->route('tk.nilaimenulis.index')->with('success', 'Semua data infak berhasil direset.');
    }
    public function destroy($id)
    {
        $nilaiMenulis = NilaiMenulis::findOrFail($id);
        $nilaiMenulis->delete();

        return redirect()->route('tk.nilaimenulis.index')->with('success', 'Nilai berhasil dihapus');
    }

    public function exportPdf()
    {
        $nilaiTerakhir = NilaiMenulis::with('santri')
            ->select('santri_id', 'tanggal_penilaian', 'jilid', 'halaman', 'nilai')
            ->whereIn('id', function ($query) {
                $query->selectRaw('MAX(id)')
                    ->from('nilai_menulis')
                    ->groupBy('santri_id');
            })
            ->orderBy('tanggal_penilaian', 'desc')
            ->get();
        $pdf = Pdf::loadView('tk.nilaimenulis.pdf', compact('nilaiTerakhir'));
        return $pdf->download('laporan_nilai_menulis.pdf');
    }
    public function generatePDF($santri_id)
    {
        $santri = DaftarSantriTK::with(['nilaiMenulis' => function ($query) {
            $query->orderBy('tanggal_penilaian', 'desc');
        }])->findOrFail($santri_id);
        $pdf = Pdf::loadView('tk.nilaimenulis.generatePDF', compact('santri'));
        return $pdf->download('nilai_menulis_' . $santri->nama_santri . '.pdf');
    }
}
