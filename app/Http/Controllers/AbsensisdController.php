<?php

namespace App\Http\Controllers;

use App\Models\AbsensiSd;
use App\Models\DaftarSantri;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class AbsensiSdController extends Controller
{
    public function index()
    {
        $absensis = AbsensiSd::with('santri')->get();
        $santris = DaftarSantri::orderBy('nama_santri', 'asc')->get()->map(function ($santri) {
            $santri->nama_santri = ucwords(strtolower($santri->nama_santri));
            return $santri;
        });
        $report = AbsensiSd::selectRaw('santri_id, COUNT(*) as total, SUM(status = "hadir") as hadir,
            SUM(status = "sakit") as sakit, SUM(status = "izin") as izin, SUM(status = "alfa") as alfa')
            ->groupBy('santri_id')
            ->with('santri')
            ->get();
        return view('sd.absensi.index', compact('absensis', 'santris', 'report'));
    }

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
            if (AbsensiSd::where('santri_id', $santriId)->whereDate('tanggal', now()->toDateString())->exists()) {
                return redirect()->back()->with('error', "Attendance for student ID {$santriId} on today's date has already been recorded.");
            }

            // Simpan data absensi
            AbsensiSd::create([
                'santri_id' => $santriId,
                'tanggal' => now(),
                'status' => $status,
            ]);
        }

        return redirect()->route('sd.absensis.index')->with('success', 'Attendance recorded successfully');
    }

    public function update(Request $request, $id)
    {
        $absensi = AbsensiSd::findOrFail($id);
        $request->validate([
            'status' => 'required|in:hadir,sakit,izin,alfa',
        ]);
        $absensi->update([
            'tanggal' => now(),
            'status' => $request->status,
        ]);

        return redirect()->route('sd.absensis.index')->with('success', 'Attendance updated successfully');
    }

    public function report()
    {
        $report = AbsensiSd::selectRaw('absensi_sd.santri_id, 
        COUNT(*) as total, 
        SUM(status = "hadir") as hadir,
        SUM(status = "sakit") as sakit, 
        SUM(status = "izin") as izin, 
        SUM(status = "alfa") as alfa,
        daftar_santri.nama_santri')
            ->join('daftar_santri', 'absensi_sd.santri_id', '=', 'daftar_santri.id')
            ->whereDate('tanggal', now()->toDateString())
            ->groupBy('absensi_sd.santri_id', 'daftar_santri.nama_santri')
            ->orderBy('daftar_santri.nama_santri', 'asc') // Urutkan berdasarkan nama santri A-Z
            ->get();

        return view('sd.absensi.report', compact('report'));
    }

    public function export()
    {
        $report = AbsensiSd::with(['santri' => function ($query) {
            $query->select('id', 'nama_santri');  // Ambil hanya kolom yang diperlukan
        }])
            ->selectRaw('
            santri_id, 
            SUM(CASE WHEN status = "hadir" THEN 1 ELSE 0 END) as hadir, 
            SUM(CASE WHEN status = "sakit" THEN 1 ELSE 0 END) as sakit, 
            SUM(CASE WHEN status = "izin" THEN 1 ELSE 0 END) as izin, 
            SUM(CASE WHEN status = "alfa" THEN 1 ELSE 0 END) as alfa')
            ->groupBy('santri_id')
            ->get();
        $totals = [
            'hadir' => $report->sum('hadir'),
            'sakit' => $report->sum('sakit'),
            'izin'  => $report->sum('izin'),
            'alfa'  => $report->sum('alfa'),
        ];

        // Generate PDF dengan data laporan dan total
        $pdf = Pdf::loadView('sd.absensi.report-pdf', compact('report', 'totals'));

        return $pdf->download('laporan absensi_' . now()->timestamp . '.pdf');
    }
    public function exportPerSantri($santri_id)
    {
        $santri = DaftarSantri::findOrFail($santri_id);

        $absensis = AbsensiSd::where('santri_id', $santri_id)
            ->orderBy('tanggal', 'desc')
            ->get();

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('sd.absensi.per-santri-pdf', compact('santri', 'absensis'));

        return $pdf->download("absensi_{$santri->nama_santri}.pdf");
    }

    public function reset()
    {
        AbsensiSd::truncate();
        return redirect()->route('sd.absensis.index')->with('success', 'Semua data Absen berhasil direset.');
    }
}
