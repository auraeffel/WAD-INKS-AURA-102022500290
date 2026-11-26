@extends('layouts.app')

@section('title', 'Bahan Pembersih')

@section('content')
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-lg">
                    <i class="fa-solid fa-flask"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Bahan Pembersih</h1>
                    <p class="text-xs text-slate-500 mt-0.5">Pantau persediaan stok deterjen, pelembut, pewangi, dan pemutih pakaian</p>
                </div>
            </div>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('bahan-pembersih.create') }}" 
               class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold shadow-md shadow-indigo-500/20 hover:shadow-lg hover:shadow-indigo-500/30 transition duration-150">
                <i class="fa-solid fa-plus text-xs"></i>
                <span>Tambah Bahan</span>
            </a>
        </div>
    </div>

    <!-- Alert Notifications -->
    @if (session('success'))
        <div class="mb-6 p-4 rounded-2xl bg-emerald-50 border border-emerald-100 text-emerald-800 flex items-center gap-3 shadow-xs">
            <div class="w-8 h-8 rounded-xl bg-emerald-500 text-white flex items-center justify-center flex-shrink-0 text-sm">
                <i class="fa-solid fa-check"></i>
            </div>
            <div class="text-sm font-medium">{{ session('success') }}</div>
        </div>
    @endif

    @if (session('error'))
        <div class="mb-6 p-4 rounded-2xl bg-rose-50 border border-rose-100 text-rose-800 flex items-center gap-3 shadow-xs">
            <div class="w-8 h-8 rounded-xl bg-rose-500 text-white flex items-center justify-center flex-shrink-0 text-sm">
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>
            <div class="text-sm font-medium">{{ session('error') }}</div>
        </div>
    @endif

    <!-- Stat Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-8">
        <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-xs hover:shadow-md transition duration-200 flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Total Bahan</p>
                <h3 class="text-2xl font-black text-slate-800 mt-1">{{ $total ?? 0 }}</h3>
                <p class="text-[11px] text-slate-400 mt-0.5">Item pembersih terdata</p>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-indigo-500 to-blue-500 text-white flex items-center justify-center text-xl shadow-md shadow-indigo-500/20">
                <i class="fa-solid fa-bottle-droplet"></i>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-xs hover:shadow-md transition duration-200 flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Stok Menipis</p>
                <h3 class="text-2xl font-black text-amber-600 mt-1">{{ $menipis ?? 0 }}</h3>
                <p class="text-[11px] text-slate-400 mt-0.5">Perlu segera restock</p>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-amber-500 to-yellow-500 text-white flex items-center justify-center text-xl shadow-md shadow-amber-500/20">
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-xs hover:shadow-md transition duration-200 flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Stok Habis</p>
                <h3 class="text-2xl font-black text-rose-600 mt-1">{{ $habis ?? 0 }}</h3>
                <p class="text-[11px] text-slate-400 mt-0.5">Persediaan kosong</p>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-rose-500 to-red-500 text-white flex items-center justify-center text-xl shadow-md shadow-rose-500/20">
                <i class="fa-solid fa-circle-xmark"></i>
            </div>
        </div>
    </div>

    <!-- Search & Filter Bar -->
    <div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-xs mb-6">
        <form action="{{ route('bahan-pembersih.index') }}" method="GET" class="flex flex-col sm:flex-row items-center gap-3">
            <div class="relative flex-1 w-full">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                    <i class="fa-solid fa-magnifying-glass text-xs"></i>
                </span>
                <input type="text" name="q" value="{{ $q ?? '' }}" 
                       placeholder="Cari nama bahan pembersih..."
                       class="w-full pl-9 pr-4 py-2 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition">
            </div>

            <div class="w-full sm:w-56">
                <select name="jenis" 
                        class="w-full px-3 py-2 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition">
                    <option value="">Semua Jenis</option>
                    @if (class_exists(\App\Models\BahanPembersih::class))
                        @foreach (\App\Models\BahanPembersih::JENIS as $val => $label)
                            <option value="{{ $val }}" {{ ($jenis ?? '') === $val ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    @else
                        <option value="deterjen">Deterjen</option>
                        <option value="pelembut">Pelembut</option>
                        <option value="pewangi">Pewangi</option>
                        <option value="pemutih">Pemutih</option>
                        <option value="lainnya">Lainnya</option>
                    @endif
                </select>
            </div>

            <div class="flex items-center gap-2 w-full sm:w-auto">
                <button type="submit" 
                        class="flex-1 sm:flex-initial inline-flex items-center justify-center gap-2 px-4 py-2 rounded-xl bg-slate-800 hover:bg-slate-900 text-white text-sm font-semibold transition">
                    <i class="fa-solid fa-filter text-xs"></i>
                    <span>Filter</span>
                </button>
                @if (($q ?? false) || ($jenis ?? false))
                    <a href="{{ route('bahan-pembersih.index') }}" 
                       class="inline-flex items-center justify-center px-3.5 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 text-sm font-semibold transition"
                       title="Reset Filter">
                        <i class="fa-solid fa-rotate-left"></i>
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Data Table Card -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/80 border-b border-slate-200/80 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                        <th class="py-3.5 px-4 w-12 text-center">#</th>
                        <th class="py-3.5 px-4">Nama Bahan</th>
                        <th class="py-3.5 px-4">Jenis</th>
                        <th class="py-3.5 px-4">Sisa Stok</th>
                        <th class="py-3.5 px-4">Stok Minimum</th>
                        <th class="py-3.5 px-4">Harga Satuan</th>
                        <th class="py-3.5 px-4">Status</th>
                        <th class="py-3.5 px-4">Catatan</th>
                        <th class="py-3.5 px-4 text-center w-28">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse ($bahan ?? [] as $b)
                        <tr class="hover:bg-indigo-50/20 transition duration-150">
                            <td class="py-3.5 px-4 text-center font-bold text-slate-400 text-xs">{{ $loop->iteration }}</td>
                            <td class="py-3.5 px-4 font-semibold text-slate-900">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center text-xs flex-shrink-0">
                                        <i class="fa-solid fa-flask"></i>
                                    </div>
                                    <span>{{ $b->nama_bahan }}</span>
                                </div>
                            </td>
                            <td class="py-3.5 px-4 text-slate-600">
                                {{ class_exists(\App\Models\BahanPembersih::class) ? (\App\Models\BahanPembersih::JENIS[$b->jenis] ?? $b->jenis) : $b->jenis }}
                            </td>
                            <td class="py-3.5 px-4 font-bold text-slate-800">
                                {{ (float) $b->stok }} <span class="text-xs font-normal text-slate-400">{{ $b->satuan }}</span>
                            </td>
                            <td class="py-3.5 px-4 text-slate-500 text-xs font-medium">
                                {{ (float) $b->stok_minimum }} {{ $b->satuan }}
                            </td>
                            <td class="py-3.5 px-4 text-slate-700 font-semibold text-xs">
                                Rp {{ number_format($b->harga_satuan, 0, ',', '.') }}
                            </td>
                            <td class="py-3.5 px-4">
                                @if ($b->stok <= 0)
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-rose-50 text-rose-700 border border-rose-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                        <span>Habis</span>
                                    </span>
                                @elseif ($b->is_menipis)
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                        <span>Menipis</span>
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        <span>Aman</span>
                                    </span>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 text-slate-500 text-xs max-w-xs truncate" title="{{ $b->catatan }}">
                                {{ $b->catatan ?: '-' }}
                            </td>
                            <td class="py-3.5 px-4 text-center">
                                <div class="inline-flex items-center gap-1">
                                    <a href="{{ route('bahan-pembersih.edit', $b) }}" 
                                       class="p-1.5 text-slate-500 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition"
                                       title="Edit Bahan">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form action="{{ route('bahan-pembersih.destroy', $b) }}" method="POST" 
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus bahan {{ $b->nama_bahan }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="p-1.5 text-slate-500 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition"
                                                title="Hapus Bahan">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="py-12 text-center">
                                <div class="w-14 h-14 rounded-2xl bg-slate-100 text-slate-400 flex items-center justify-center mx-auto text-xl mb-3">
                                    <i class="fa-solid fa-flask-vial"></i>
                                </div>
                                <h4 class="text-sm font-bold text-slate-700">Bahan Pembersih Tidak Ditemukan</h4>
                                <p class="text-xs text-slate-400 mt-1">
                                    {{ (($q ?? false) || ($jenis ?? false)) ? 'Tidak ada bahan yang cocok dengan kriteria filter.' : 'Belum ada data bahan pembersih yang terdaftar.' }}
                                </p>
                                @if (!(($q ?? false) || ($jenis ?? false)))
                                    <a href="{{ route('bahan-pembersih.create') }}" class="inline-flex items-center gap-2 mt-4 px-4 py-2 rounded-xl bg-indigo-600 text-white text-xs font-bold hover:bg-indigo-700 transition">
                                        <i class="fa-solid fa-plus"></i> Tambah Bahan Pertama
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
