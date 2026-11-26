<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->query('q');

        try {
            $layanan = Layanan::when($q, fn ($query) =>
                    $query->where('nama_layanan', 'like', "%{$q}%"))
                ->latest()
                ->get();

            $total    = Layanan::count();
            $aktif    = Layanan::where('is_aktif', true)->count();
            $termurah = Layanan::min('tarif') ?? 0;
        } catch (\Throwable $e) {
            $layanan  = collect();
            $total    = 0;
            $aktif    = 0;
            $termurah = 0;
            session()->flash('error', 'Tabel layanan belum tersedia di database. Jalankan: php artisan migrate');
        }

        return view('layanan.index', compact('layanan', 'q', 'total', 'aktif', 'termurah'));
    }

    public function create()
    {
        return view('layanan.create');
    }

    public function store(Request $request)
    {
        Layanan::create($this->validated($request));

        return redirect()->route('layanan.index')
            ->with('success', 'Layanan berhasil ditambahkan.');
    }

    public function edit(Layanan $layanan)
    {
        return view('layanan.edit', compact('layanan'));
    }

    public function update(Request $request, Layanan $layanan)
    {
        $layanan->update($this->validated($request));

        return redirect()->route('layanan.index')
            ->with('success', 'Layanan berhasil diperbarui.');
    }

    public function destroy(Layanan $layanan)
    {
        $layanan->delete();

        return redirect()->route('layanan.index')
            ->with('success', 'Layanan berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'nama_layanan'  => 'required|string|max:100',
            'tarif'         => 'required|integer|min:0',
            'satuan'        => 'required|in:kg,pcs,m2',
            'estimasi_hari' => 'required|integer|min:0|max:30',
            'deskripsi'     => 'nullable|string|max:500',
        ]);

        $data['is_aktif'] = $request->boolean('is_aktif');

        return $data;
    }
}
