<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InfakHariansd;
use App\Models\daftarSantri;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;


class InfakHariansdController extends Controller
{
    public function index()
    {
        $infak = InfakHariansd::select('infak_hariansds.santri_id', DB::raw('SUM(jumlah) as total_infak'))
            ->join('daftar_santris', 'infak_hariansds.santri_id', '=', 'daftar_santris.id')
            ->groupBy('infak_hariansds.santri_id', 'daftar_santris.nama_santri')
            ->orderBy('daftar_santris.nama_santri', 'asc')
            ->with('santri')
            ->get();

        $totalKeseluruhan = $infak->sum('total_infak');

        return view('sd.infak.index', compact('infak', 'totalKeseluruhan'));
    }

    public function create()
    {
        $santri = daftarSantri::orderby('nama_santri', 'asc')->get();
        return view('sd.infak.create', compact('santri'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jumlah' => 'required|array', // pastikan ada array jumlah
            'jumlah.*' => 'nullable|numeric|min:0', // validasi setiap item (boleh kosong/null atau angka >= 0)
        ]);

        $tanggal = now()->toDateString();
        $jumlah = $request->input('jumlah'); // array: [santri_id => jumlah, ...]

        foreach ($jumlah as $santri_id => $nilai_infak) {
            if (!is_null($nilai_infak) && $nilai_infak > 0) {
                // Simpan hanya jika ada nilai > 0
                InfakHariansd::create([
                    'santri_id' => $santri_id,
                    'tanggal' => $tanggal,
                    'jumlah' => $nilai_infak,
                ]);
            }
        }

        return redirect()->route('sd.infak.index')->with('success', 'Data infak berhasil ditambahkan.');
    }

    public function edit(InfakHariansd $infakHariansd)
    {
        $santri = daftarSantri::all();
        return view('sd.infak.edit', compact('infakHariansd', 'santri'));
    }

    public function update(Request $request, InfakHariansd $infakHariansd)
    {
        $request->validate([
            'santri_id' => 'required|exists:daftar_santris,id',
            'jumlah' => 'required|numeric|min:0',
        ]);

        $infakHariansd->update($request->all());

        return redirect()->route('sd.infak.index')->with('success', 'Data infak berhasil diperbarui.');
    }

    public function destroy(InfakHariansd $infakHariansd)
    {
        $infakHariansd->delete();
        return redirect()->route('sd.infak.index')->with('success', 'Data infak berhasil dihapus.');
    }

    public function show($santri_id)
    {
        // Ambil data santri
        $santri = daftarSantri::findOrFail($santri_id);

        // Ambil semua transaksi infak berdasarkan santri_id
        $infak = InfakHariansd::where('santri_id', $santri_id)->get();

        return view('sd.infak.show', compact('santri', 'infak'));
    }
  
    public function exportPerSantri($santri_id)
    {
        $santri = daftarSantri::findOrFail($santri_id);
        $infak = InfakHariansd::where('santri_id', $santri_id)
            ->orderBy('tanggal', 'desc')
            ->get();

        $totalInfak = $infak->sum('jumlah');
        $tanggal = now()->format('d-m-Y');

        $pdf = Pdf::loadView('sd.infak.export-per-santri', compact('santri', 'infak', 'totalInfak', 'tanggal'));
        return $pdf->download("laporan-infak-{$santri->nama_santri}-{$tanggal}.pdf");
    }

    public function reset()
    {
        InfakHariansd::truncate();
        return redirect()->route('sd.infak.index')->with('success', 'Semua data infak berhasil direset.');
    }
}
