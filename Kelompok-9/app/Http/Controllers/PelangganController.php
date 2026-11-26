<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PelangganController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->query('q');

        $query = Pelanggan::query();

        if ($request->filled('q')) {
            $query->where(function ($w) use ($q) {
                $w->where('nama', 'like', "%$q%")
                  ->orWhere('no_telepon', 'like', "%$q%");
            });
        }

        $pelanggan = $query->latest()->get();

        $total      = Pelanggan::count();
        $adaCatatan = Pelanggan::whereNotNull('catatan_khusus')
                               ->where('catatan_khusus', '!=', '')
                               ->count();
        $baru       = Pelanggan::where('created_at', '>=', now()->subDays(7))->count();

        return view('pelanggan.index', compact('pelanggan', 'q', 'total', 'adaCatatan', 'baru'));
    }

    public function create()
    {
        return view('pelanggan.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->aturan(), $this->pesan());
        Pelanggan::create($data);

        return redirect()->route('pelanggan.index')
            ->with('success', "Pelanggan {$data['nama']} berhasil ditambahkan.");
    }

    public function edit(Pelanggan $pelanggan)
    {
        return view('pelanggan.edit', compact('pelanggan'));
    }

    public function update(Request $request, Pelanggan $pelanggan)
    {
        $data = $request->validate($this->aturan($pelanggan->id), $this->pesan());
        $pelanggan->update($data);

        return redirect()->route('pelanggan.index')
            ->with('success', "Data pelanggan {$data['nama']} berhasil diperbarui.");
    }

    public function destroy(Pelanggan $pelanggan)
    {
        $nama = $pelanggan->nama;
        $pelanggan->delete();

        return redirect()->route('pelanggan.index')
            ->with('success', "Pelanggan $nama berhasil dihapus.");
    }

    private function aturan(?int $id = null): array
    {
        return [
            'nama'           => ['required', 'string', 'max:255'],
            'alamat'         => ['nullable', 'string'],
            'no_telepon'     => ['required', 'string', 'max:20', Rule::unique('pelanggans', 'no_telepon')->ignore($id)],
            'catatan_khusus' => ['nullable', 'string'],
        ];
    }

    private function pesan(): array
    {
        return [
            'nama.required'       => 'Nama wajib diisi.',
            'no_telepon.required' => 'No. telepon wajib diisi.',
            'no_telepon.unique'   => 'No. telepon sudah terdaftar.',
        ];
    }
}