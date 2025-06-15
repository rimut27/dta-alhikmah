<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\AbsensiTK;
use App\Models\DaftarSantriTK;

class AbsensiTKcontroller extends Controller
{
    public function index()
    {
        $absensis = AbsensiTK::with('santri')->get();
        $santris = DaftarSantriTK::orderBy('nama_santri', 'asc')->get();
        $report = AbsensiTK::selectRaw('santri_id, COUNT(*) as total, 
            SUM(status = "hadir") as hadir, 
            SUM(status = "sakit") as sakit, 
            SUM(status = "izin") as izin, 
            SUM(status = "alfa") as alfa')
            ->groupBy('santri_id')
            ->with('santri')
            ->orderByRaw('(SELECT nama_santri FROM daftar_santri_t_k_s WHERE daftar_santri_t_k_s.id = absensi_t_k_s.santri_id) ASC')
            ->get();

        return view('tk.absensi.index', compact('absensis', 'santris', 'report'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'status' => 'required|array',
            'status.*' => 'required|in:hadir,sakit,izin,alfa',
        ]);

        // Loop melalui array status
        foreach ($request->status as $santriId => $status) {
            // Cek apakah absensi sudah ada untuk santri dan tanggal hari ini
            if (AbsensiTK::where('santri_id', $santriId)->whereDate('tanggal', now()->toDateString())->exists()) {
                return redirect()->back()->with('error', "Absensi untuk santri  {$santriId} pada tanggal hari ini sudah tercatat.");
            }

            // Simpan data absensi
            AbsensiTK::create([
                'santri_id' => $santriId,
                'tanggal' => now(),
                'status' => $status,
            ]);
        }

        return redirect()->route('tk.absensis.index')->with('success', 'Absensi berhasil dicatat');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $absensi = AbsensiTK::findOrFail($id);
        $request->validate([
            'status' => 'required|in:hadir,sakit,izin,alfa',
        ]);
        $absensi->update([
            'tanggal' => now(),
            'status' => $request->status,
        ]);

        return redirect()->route('tk.absensis.index')->with('success', 'Absensi berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function repport()
    {
        $report = AbsensiTK::selectRaw('absensi_t_k_s.santri_id, 
            COUNT(*) as total, 
            SUM(status = "hadir") as hadir,
            SUM(status = "sakit") as sakit, 
            SUM(status = "izin") as izin, 
            SUM(status = "alfa") as alfa')
            ->groupBy('santri_id')
            ->with('santri')
            ->orderByRaw('(SELECT nama FROM santris WHERE santris.id = absensi_t_k_s.santri_id) ASC')
            ->get();
        $pdf = Pdf::loadView('tk.absensi.report', compact('report'));
        return $pdf->stream('laporan_absensi.pdf');
    }

    public function export()
    {
        $report = AbsensiTK::selectRaw('absensi_t_k_s.santri_id, 
            COUNT(*) as total, 
            SUM(status = "hadir") as hadir,
            SUM(status = "sakit") as sakit, 
            SUM(status = "izin") as izin, 
            SUM(status = "alfa") as alfa')
            ->groupBy('santri_id')
            ->with('santri')
            ->join('daftar_santri_t_k_s', 'daftar_santri_t_k_s.id', '=', 'absensi_t_k_s.santri_id')
            ->orderBy('daftar_santri_t_k_s.nama_santri', 'asc')
            ->get();

        $totals = [
            'hadir' => $report->sum('hadir'),
            'sakit' => $report->sum('sakit'),
            'izin'  => $report->sum('izin'),
            'alfa'  => $report->sum('alfa'),
        ];

        $pdf = Pdf::loadView('tk.absensi.export', compact('report', 'totals'));
        return $pdf->download('laporan_absensi.pdf');
    }

    public function exportPerSantri($santri_id)
    {
        $report = AbsensiTK::where('santri_id', $santri_id)
            ->selectRaw('COUNT(*) as total, 
                SUM(status = "hadir") as hadir,
                SUM(status = "sakit") as sakit, 
                SUM(status = "izin") as izin, 
                SUM(status = "alfa") as alfa')
            ->first();

        $santri = DaftarSantriTK::findOrFail($santri_id);

        $pdf = Pdf::loadView('tk.absensi.export-per-santri', compact('report', 'santri'));
        return $pdf->download("laporan_absensi_{$santri->nama_santri}.pdf");
    }

    public function reset()
    {
        AbsensiTK::truncate();
        return redirect()->route('tk.absensis.index')->with('success', 'Data absensi berhasil direset');
    }
}
