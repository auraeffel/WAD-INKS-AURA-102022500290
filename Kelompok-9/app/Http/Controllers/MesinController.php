<?php

namespace App\Http\Controllers;

use App\Models\Mesin;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MesinController extends Controller
{
    public function index(Request $request)
    {
        $q      = $request->query('q');
        $status = $request->query('status');

        try {
            $mesin = Mesin::when($q, fn ($query) =>
                    $query->where('nama_mesin', 'like', "%{$q}%"))
                ->when($status, fn ($query) =>
                    $query->where('status', $status))
                ->latest()
                ->get();

            $total      = Mesin::count();
            $tersedia   = Mesin::where('status', 'tersedia')->count();
            $bermasalah = Mesin::whereIn('status', ['perawatan', 'rusak'])->count();
        } catch (\Throwable $e) {
            $mesin      = collect();
            $total      = 0;
            $tersedia   = 0;
            $bermasalah = 0;
            session()->flash('error', 'Tabel mesin belum tersedia di database. Jalankan: php artisan migrate');
        }

        return view('mesin.index', compact('mesin', 'q', 'status', 'total', 'tersedia', 'bermasalah'));
    }

    public function create()
    {
        return view('mesin.create');
    }

    public function store(Request $request)
    {
        Mesin::create($this->validated($request));

        return redirect()->route('mesin.index')
            ->with('success', 'Mesin/peralatan berhasil ditambahkan.');
    }

    public function edit(Mesin $mesin)
    {
        return view('mesin.edit', compact('mesin'));
    }

    public function update(Request $request, Mesin $mesin)
    {
        $mesin->update($this->validated($request));

        return redirect()->route('mesin.index')
            ->with('success', 'Mesin/peralatan berhasil diperbarui.');
    }

    public function destroy(Mesin $mesin)
    {
        $mesin->delete();

        return redirect()->route('mesin.index')
            ->with('success', 'Mesin/peralatan berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'nama_mesin'         => 'required|string|max:100',
            'jenis'              => ['required', Rule::in(array_keys(Mesin::JENIS))],
            'kapasitas_kg'       => 'nullable|integer|min:0|max:1000',
            'status'             => ['required', Rule::in(array_keys(Mesin::STATUS))],
            'perawatan_terakhir' => 'nullable|date',
            'catatan'            => 'nullable|string|max:500',
        ]);
    }
}
