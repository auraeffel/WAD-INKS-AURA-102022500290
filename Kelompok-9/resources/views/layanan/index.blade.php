@extends('layouts.app')

@section('title', 'Layanan & Tarif')

@section('content')
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-lg">
                    <i class="fa-solid fa-shirt"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Layanan & Tarif Laundry</h1>
                    <p class="text-xs text-slate-500 mt-0.5">Daftar paket cuci kiloan, satuan, dry clean, dan estimasi waktu pengerjaan</p>
                </div>
            </div>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('layanan.create') }}" 
               class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold shadow-md shadow-indigo-500/20 hover:shadow-lg hover:shadow-indigo-500/30 transition duration-150">
                <i class="fa-solid fa-plus text-xs"></i>
                <span>Tambah Layanan</span>
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
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Total Layanan</p>
                <h3 class="text-2xl font-black text-slate-800 mt-1">{{ $total ?? 0 }}</h3>
                <p class="text-[11px] text-slate-400 mt-0.5">Paket laundry tersedia</p>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-indigo-500 to-blue-500 text-white flex items-center justify-center text-xl shadow-md shadow-indigo-500/20">
                <i class="fa-solid fa-tags"></i>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-xs hover:shadow-md transition duration-200 flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Layanan Aktif</p>
                <h3 class="text-2xl font-black text-emerald-600 mt-1">{{ $aktif ?? 0 }}</h3>
                <p class="text-[11px] text-slate-400 mt-0.5">Dapat dipesan pelanggan</p>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-emerald-500 to-teal-500 text-white flex items-center justify-center text-xl shadow-md shadow-emerald-500/20">
                <i class="fa-solid fa-toggle-on"></i>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-xs hover:shadow-md transition duration-200 flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Tarif Termurah</p>
                <h3 class="text-2xl font-black text-blue-600 mt-1">Rp {{ number_format($termurah ?? 0, 0, ',', '.') }}</h3>
                <p class="text-[11px] text-slate-400 mt-0.5">Mulai dari harga ini</p>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-blue-500 to-cyan-500 text-white flex items-center justify-center text-xl shadow-md shadow-blue-500/20">
                <i class="fa-solid fa-rupiah-sign"></i>
            </div>
        </div>
    </div>

    <!-- Search Bar -->
    <div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-xs mb-6">
        <form action="{{ route('layanan.index') }}" method="GET" class="flex flex-col sm:flex-row items-center gap-3">
            <div class="relative flex-1 w-full">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                    <i class="fa-solid fa-magnifying-glass text-xs"></i>
                </span>
                <input type="text" name="q" value="{{ $q ?? '' }}" 
                       placeholder="Cari nama layanan laundry..."
                       class="w-full pl-9 pr-4 py-2 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition">
            </div>

            <div class="flex items-center gap-2 w-full sm:w-auto">
                <button type="submit" 
                        class="flex-1 sm:flex-initial inline-flex items-center justify-center gap-2 px-4 py-2 rounded-xl bg-slate-800 hover:bg-slate-900 text-white text-sm font-semibold transition">
                    <i class="fa-solid fa-magnifying-glass text-xs"></i>
                    <span>Cari</span>
                </button>
                @if ($q ?? false)
                    <a href="{{ route('layanan.index') }}" 
                       class="inline-flex items-center justify-center px-3.5 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 text-sm font-semibold transition"
                       title="Reset Pencarian">
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
                        <th class="py-3.5 px-4">Nama Layanan</th>
                        <th class="py-3.5 px-4">Tarif</th>
                        <th class="py-3.5 px-4">Estimasi Waktu</th>
                        <th class="py-3.5 px-4">Deskripsi</th>
                        <th class="py-3.5 px-4">Status</th>
                        <th class="py-3.5 px-4 text-center w-28">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse ($layanan ?? [] as $l)
                        <tr class="hover:bg-indigo-50/20 transition duration-150">
                            <td class="py-3.5 px-4 text-center font-bold text-slate-400 text-xs">{{ $loop->iteration }}</td>
                            <td class="py-3.5 px-4 font-semibold text-slate-900">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center text-xs flex-shrink-0">
                                        <i class="fa-solid fa-shirt"></i>
                                    </div>
                                    <span>{{ $l->nama_layanan }}</span>
                                </div>
                            </td>
                            <td class="py-3.5 px-4 font-bold text-slate-800">
                                Rp {{ number_format($l->tarif, 0, ',', '.') }}
                                <span class="text-xs font-normal text-slate-400">/ {{ $l->satuan }}</span>
                            </td>
                            <td class="py-3.5 px-4 text-slate-600 text-xs">
                                <span class="inline-flex items-center gap-1 font-medium bg-slate-100 px-2 py-0.5 rounded-md">
                                    <i class="fa-regular fa-clock text-slate-400 text-[10px]"></i>
                                    {{ $l->estimasi_hari }} hari
                                </span>
                            </td>
                            <td class="py-3.5 px-4 text-slate-500 text-xs max-w-xs truncate" title="{{ $l->deskripsi }}">
                                {{ $l->deskripsi ?: '-' }}
                            </td>
                            <td class="py-3.5 px-4">
                                @if ($l->is_aktif)
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        <span>Aktif</span>
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-500 border border-slate-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                                        <span>Nonaktif</span>
                                    </span>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 text-center">
                                <div class="inline-flex items-center gap-1">
                                    <a href="{{ route('layanan.edit', $l) }}" 
                                       class="p-1.5 text-slate-500 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition"
                                       title="Edit Layanan">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form action="{{ route('layanan.destroy', $l) }}" method="POST" 
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus layanan {{ $l->nama_layanan }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="p-1.5 text-slate-500 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition"
                                                title="Hapus Layanan">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-12 text-center">
                                <div class="w-14 h-14 rounded-2xl bg-slate-100 text-slate-400 flex items-center justify-center mx-auto text-xl mb-3">
                                    <i class="fa-solid fa-box-open"></i>
                                </div>
                                <h4 class="text-sm font-bold text-slate-700">Layanan Tidak Ditemukan</h4>
                                <p class="text-xs text-slate-400 mt-1">
                                    {{ ($q ?? false) ? 'Tidak ada paket layanan yang cocok dengan pencarian Anda.' : 'Belum ada data paket layanan yang didaftarkan.' }}
                                </p>
                                @if (!($q ?? false))
                                    <a href="{{ route('layanan.create') }}" class="inline-flex items-center gap-2 mt-4 px-4 py-2 rounded-xl bg-indigo-600 text-white text-xs font-bold hover:bg-indigo-700 transition">
                                        <i class="fa-solid fa-plus"></i> Tambah Layanan Pertama
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
