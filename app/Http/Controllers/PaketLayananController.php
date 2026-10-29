<?php

namespace App\Http\Controllers;

use App\Models\PaketLayanan;
use Illuminate\Http\Request;

class PaketLayananController extends Controller
{
    public function index()
    {
        $pakets = PaketLayanan::latest()->get();
        return view('paket.index', compact('pakets'));
    }

    public function create()
    {
        return view('paket.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_paket' => 'required',
            'jenis' => 'required',
            'harga' => 'required|numeric',
            'estimasi_jam' => 'required|numeric',
        ]);

        PaketLayanan::create($request->all());
        return redirect()->route('paket.index')->with('success', 'Paket berhasil ditambahkan');
    }

    public function edit($id)
    {
        $paket = PaketLayanan::findOrFail($id);
        return view('paket.edit', compact('paket'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_paket' => 'required',
            'jenis' => 'required',
            'harga' => 'required|numeric',
            'estimasi_jam' => 'required|numeric',
        ]);

        $paket = PaketLayanan::findOrFail($id);
        $paket->update($request->all());
        return redirect()->route('paket.index')->with('success', 'Paket berhasil diperbarui');
    }

    public function destroy($id)
    {
        $paket = PaketLayanan::findOrFail($id);
        $paket->delete();
        return redirect()->route('paket.index')->with('success', 'Paket berhasil dihapus');
    }
}