<?php

namespace App\Http\Controllers;

use App\Models\daftarSantriTK as Santri;
use Illuminate\Http\Request;

class daftarSantritkController extends Controller
{
    public function index()
    {
        $santris = Santri::orderBy('nama_santri', 'asc')->paginate(10);
        return view('tk.daftar.index', compact('santris'));
    }

    public function create()
    {
        return view('tk.daftar.create');
    }

    public function store(Request $request)
    {

        Santri::create($request->all());

        return redirect()->route('tk.daftar.index')
            ->with('success', 'Data santri berhasil ditambahkan');
    }

    public function show(Santri $santri)
    {
        return view('tk.daftar.show', compact('santri'));
    }

    public function edit(Santri $santri)
    {
        return view('tk.daftar.edit', compact('santri'));
    }

    public function update(Request $request, Santri $santri)
    {
        $request->validate([
            'nama_santri' => 'required',
            'jk' => 'required',
            'tanggal_lahir' => 'required|date',
            'nama_ayah' => 'required',
            'nama_ibu' => 'required',
            'nama_sekolah' => 'required',
            'alamat' => 'required',
        ]);

        $santri->update($request->all());

        return redirect()->route('tk.daftar.index')
            ->with('success', 'Data santri berhasil diupdate');
    }

    public function destroy(Santri $santri)
    {
        $santri->delete();

        return redirect()->route('tk.daftar.index')
            ->with('success', 'Data santri berhasil dihapus');
    }
}
