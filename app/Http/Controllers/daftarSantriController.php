<?php

namespace App\Http\Controllers;

use App\Models\daftarSantri;
use Illuminate\Http\Request;

class daftarSantriController extends Controller
{
    public function index()
    {
       $santris = DaftarSantri::orderBy('nama_santri', 'asc')->get(); 
        return view('sd.daftar.index', compact('santris'));
    }

    public function create()
    {
        return view('sd.daftar.create');
    }

    public function store(Request $request)
    {
        $santri = daftarSantri::create($request->all());
        return redirect()->route('sd.daftar.index')->with('success', 'Santri berhasil ditambahkan!');
    }
    public function edit(daftarSantri $santri)
    {
        return view('sd.daftar.edit', compact('santri'));
    }

    public function update(Request $request, daftarSantri $santri)
    {
        $santri->update($request->all());
        return redirect()->route('sd.daftar.index')->with('success', 'Santri berhasil diperbarui!');
    }
    public function destroy(daftarSantri $santri)
    {
        $santri->delete();
        return redirect()->route('sd.daftar.index')->with('success', 'Santri berhasil dihapus!');
    }
}
