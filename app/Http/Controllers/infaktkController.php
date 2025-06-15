<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\infaktk;
use App\Models\daftarSantriTK;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class infaktkController extends Controller
{
    public function index()
    {
        $infak = infaktk::select('infaktks.santri_id', DB::raw('SUM(jumlah) as total_infak'))
            ->join('daftar_santri_t_k_s', 'infaktks.santri_id', '=', 'daftar_santri_t_k_s.id')
            ->groupBy('infaktks.santri_id', 'daftar_santri_t_k_s.nama_santri')
            ->orderBy('daftar_santri_t_k_s.nama_santri', 'asc')
            ->with('santri')
            ->get();

        $totalKeseluruhan = $infak->sum('total_infak');

        return view('tk.infak.index', compact('infak', 'totalKeseluruhan'));
    }

    public function create()
    {
        $santri = daftarSantriTK::orderby('nama_santri', 'asc')->get();
        return view('tk.infak.create', compact('santri'));
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
                infaktk::create([
                    'santri_id' => $santri_id,
                    'tanggal' => $tanggal,
                    'jumlah' => $nilai_infak,
                ]);
            }
        }

        return redirect()->route('tk.infak.index')->with('success', 'Data infak berhasil ditambahkan.');
    }

    public function edit(infaktk $infaktk)
    {
        $santri = daftarSantriTK::all();
        return view('tk.infak.edit', compact('infaktk', 'santri'));
    }

    public function update(Request $request, infaktk $infaktk)
    {
        $request->validate([
            'santri_id' => 'required|exists:daftar_santri_t_k_s,id',
            'jumlah' => 'required|numeric|min:0',
        ]);

        $infaktk->update($request->all());

        return redirect()->route('stk.infak.index')->with('success', 'Data infak berhasil diperbarui.');
    }

    public function destroy(infaktk $infaktk)
    {
        $infaktk->delete();
        return redirect()->route('tk.infak.index')->with('success', 'Data infak berhasil dihapus.');
    }

    public function show($santri_id)
    {
        // Ambil data santri
        $santri = daftarSantriTK::findOrFail($santri_id);

        // Ambil semua transaksi infak berdasarkan santri_id
        $infak = infaktk::where('santri_id', $santri_id)->get();

        return view('tk.infak.show', compact('santri', 'infak'));
    }
    public function exportPerSantri($santri_id)
    {
        $santri = daftarSantriTK::findOrFail($santri_id);
        $infak = infaktk::where('santri_id', $santri_id)
            ->orderBy('tanggal', 'desc')
            ->get();

        $totalInfak = $infak->sum('jumlah');
        $tanggal = now()->format('d-m-Y');

        $pdf = Pdf::loadView('tk.infak.export-per-santri', compact('santri', 'infak', 'totalInfak', 'tanggal'));
        return $pdf->download("laporan-infak-{$santri->nama_santri}-{$tanggal}.pdf");
    }

    public function hapus()
    {
        // Hapus semua data infak
        infaktk::truncate();
        return redirect()->route('tk.infak.index')->with('success', 'Semua data infak berhasil direset.');
    }
}
