<?php

namespace App\Http\Controllers;

use App\Models\DaftarSantri;
use App\Models\TabunganSantrisd;
use Illuminate\Http\Request;

class TabunganSantriControllersd extends Controller
{
    public function index()
    {
        $tabungan = DaftarSantri::with('tabungan')->orderBy('nama_santri', 'asc')->get();
        return view('sd.tabungan.index', compact('tabungan'));
    }

    public function create()
    {
        $santri = DaftarSantri::orderBy('nama_santri', 'asc')->get();
        return view('sd.tabungan.create', compact('santri'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'santri_id' => 'required|exists:daftar_santris,id',
            'tanggal_transaksi' => 'required|date',
            'jumlah' => 'required|numeric',
            'jenis_transaksi' => 'required|string',
            'keterangan' => 'nullable|string',
        ]);

        $data = $request->all();
        if ($data['jenis_transaksi'] == 'tarik') {
            $data['jumlah'] = -$data['jumlah']; // Negate the amount for withdrawal
        }

        TabunganSantrisd::create($data);

        return redirect()->route('sd.tabungan.index')->with('success', 'Tabungan santri berhasil ditambahkan.');
    }
    public function show($id)
    {
        $santri = DaftarSantri::with('tabungan')->findOrFail($id);
        $tabungan = TabunganSantrisd::with('santri')->where('santri_id', $id)->get();

        return view('sd.tabungan.show', compact('tabungan'));
    }

    public function edit($id)
    {
        $tabungan = TabunganSantrisd::findOrFail($id);
        $santri = DaftarSantri::all();
        return view('sd.tabungan.edit', compact('tabungan', 'santri'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'santri_id' => 'required|exists:daftar_santris,id',
            'tanggal_transaksi' => 'required|date',
            'jumlah' => 'required|numeric',
            'jenis_transaksi' => 'required|string',
            'keterangan' => 'nullable|string',
        ]);

        $tabungan = TabunganSantrisd::findOrFail($id);
        $data = $request->all();
        if ($data['jenis_transaksi'] == 'tarik') {
            $data['jumlah'] = -$data['jumlah']; // Negate the amount for withdrawal
        }

        $tabungan->update($data);

        return redirect()->route('sd.tabungan.index')->with('success', 'Tabungan santri berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $tabungan = TabunganSantrisd::findOrFail($id);
        $tabungan->delete();

        return redirect()->route('sd.tabungan.index')->with('success', 'Tabungan santri berhasil dihapus.');
    }
}
