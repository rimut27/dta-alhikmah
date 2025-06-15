<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DaftarSantriTK;
use App\Models\TabunganTK;

class TabunganTKcontroller extends Controller
{
    // Tambahkan metode untuk mengelola tabungan TK
    public function index()
    {
        $daftartabungan = DaftarSantriTK::with('tabungan')->orderby('nama_santri', 'asc')->get();
        return view('tk.tabungan.index', compact('daftartabungan'));
    }

    public function create()
    {
        $santri = DaftarSantriTK::orderBy('nama_santri', 'asc')->get();
        return view('tk.tabungan.create', compact('santri'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'santri_id' => 'required|exists:daftar_santri_t_k_s,id',
            'tanggal_transaksi' => 'required|date',
            'jumlah' => 'required|numeric',
            'jenis_transaksi' => 'required|string',
            'keterangan' => 'nullable|string',
        ]);

        $data = $request->all();
        if ($data['jenis_transaksi'] == 'tarik') {
            $data['jumlah'] = -$data['jumlah']; // Negate the amount for withdrawal
        }

        TabunganTK::create($data);

        return redirect()->route('tk.tabungan.index')->with('success', 'Tabungan santri berhasil ditambahkan.');
    }

    public function show($id)
    {
        $santri = DaftarSantriTK::with('tabungan')->findOrFail($id);
        $tabungan = TabunganTK::with('santri')->where('santri_id', $id)->get();

        return view('tk.tabungan.show', compact('santri','tabungan'));
    }
    public function edit($id)
    {
        $tabungan = TabunganTK::findOrFail($id);
        $santri = DaftarSantriTK::all();
        return view('tk.tabungan.edit', compact('tabungan', 'santri'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'santri_id' => 'required|exists:daftar_santri_t_k_s,id',
            'tanggal_transaksi' => 'required|date',
            'jumlah' => 'required|numeric',
            'jenis_transaksi' => 'required|string',
            'keterangan' => 'nullable|string',
        ]);

        $tabungan = TabunganTK::findOrFail($id);
        $data = $request->all();
        if ($data['jenis_transaksi'] == 'tarik') {
            $data['jumlah'] = -$data['jumlah']; // Negate the amount for withdrawal
        }

        $tabungan->update($data);

        return redirect()->route('tk.tabungan.index')->with('success', 'Tabungan santri berhasil diperbarui.');
    }
    public function destroy($id)
    {
        $tabungan = TabunganTK::findOrFail($id);
        $tabungan->delete();

        return redirect()->route('tk.tabungan.index')->with('success', 'Tabungan santri berhasil dihapus.');
    }
}
