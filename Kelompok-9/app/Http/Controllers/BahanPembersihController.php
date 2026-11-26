<?php

namespace App\Http\Controllers;

use App\Models\BahanPembersih;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BahanPembersihController extends Controller
{
    public function index(Request $request)
    {
        $q     = $request->query('q');
        $jenis = $request->query('jenis');

        try {
            $bahan = BahanPembersih::when($q, fn ($query) =>
                    $query->where('nama_bahan', 'like', "%{$q}%"))
                ->when($jenis, fn ($query) =>
                    $query->where('jenis', $jenis))
                ->latest()
                ->get();

            $total   = BahanPembersih::count();
            $menipis = BahanPembersih::whereColumn('stok', '<=', 'stok_minimum')->count();
            $habis   = BahanPembersih::where('stok', '<=', 0)->count();
        } catch (\Throwable $e) {
            $bahan   = collect();
            $total   = 0;
            $menipis = 0;
            $habis   = 0;
            session()->flash('error', 'Tabel bahan pembersih belum tersedia di database. Jalankan: php artisan migrate');
        }

        return view('bahan-pembersih.index', compact('bahan', 'q', 'jenis', 'total', 'menipis', 'habis'));
    }

    public function create()
    {
        return view('bahan-pembersih.create');
    }

    public function store(Request $request)
    {
        BahanPembersih::create($this->validated($request));

        return redirect()->route('bahan-pembersih.index')
            ->with('success', 'Bahan pembersih berhasil ditambahkan.');
    }

    public function edit(BahanPembersih $bahanPembersih)
    {
        return view('bahan-pembersih.edit', ['bahan' => $bahanPembersih]);
    }

    public function update(Request $request, BahanPembersih $bahanPembersih)
    {
        $bahanPembersih->update($this->validated($request));

        return redirect()->route('bahan-pembersih.index')
            ->with('success', 'Bahan pembersih berhasil diperbarui.');
    }

    public function destroy(BahanPembersih $bahanPembersih)
    {
        $bahanPembersih->delete();

        return redirect()->route('bahan-pembersih.index')
            ->with('success', 'Bahan pembersih berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'nama_bahan'   => 'required|string|max:100',
            'jenis'        => ['required', Rule::in(array_keys(BahanPembersih::JENIS))],
            'stok'         => 'required|numeric|min:0',
            'satuan'       => ['required', Rule::in(array_keys(BahanPembersih::SATUAN))],
            'stok_minimum' => 'required|numeric|min:0',
            'harga_satuan' => 'required|integer|min:0',
            'catatan'      => 'nullable|string|max:500',
        ]);
    }
}
