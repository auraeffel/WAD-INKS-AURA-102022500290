@extends('layouts.app')

@section('title', 'Data Pelanggan')

@section('content')
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-lg">
                    <i class="fa-solid fa-users"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Data Pelanggan</h1>
                    <p class="text-xs text-slate-500 mt-0.5">Kelola biodata pelanggan, kontak telepon, dan catatan penanganan khusus pakaian</p>
                </div>
            </div>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('pelanggan.create') }}" 
               class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold shadow-md shadow-indigo-500/20 hover:shadow-lg hover:shadow-indigo-500/30 transition duration-150">
                <i class="fa-solid fa-user-plus text-xs"></i>
                <span>Tambah Pelanggan</span>
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

    <!-- Stat Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-8">
        <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-xs hover:shadow-md transition duration-200 flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Total Pelanggan</p>
                <h3 class="text-2xl font-black text-slate-800 mt-1">{{ $total ?? 0 }}</h3>
                <p class="text-[11px] text-slate-400 mt-0.5">Pelanggan terdaftar</p>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-indigo-500 to-blue-500 text-white flex items-center justify-center text-xl shadow-md shadow-indigo-500/20">
                <i class="fa-solid fa-address-book"></i>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-xs hover:shadow-md transition duration-200 flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Catatan Khusus</p>
                <h3 class="text-2xl font-black text-indigo-600 mt-1">{{ $adaCatatan ?? 0 }}</h3>
                <p class="text-[11px] text-slate-400 mt-0.5">Perlu perhatian cucian</p>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-purple-500 to-indigo-500 text-white flex items-center justify-center text-xl shadow-md shadow-purple-500/20">
                <i class="fa-solid fa-clipboard-list"></i>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-xs hover:shadow-md transition duration-200 flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Pelanggan Baru</p>
                <h3 class="text-2xl font-black text-emerald-600 mt-1">{{ $baru ?? 0 }}</h3>
                <p class="text-[11px] text-slate-400 mt-0.5">Dalam 7 hari terakhir</p>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-emerald-500 to-teal-500 text-white flex items-center justify-center text-xl shadow-md shadow-emerald-500/20">
                <i class="fa-solid fa-user-check"></i>
            </div>
        </div>
    </div>

    <!-- Search Bar -->
    <div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-xs mb-6">
        <form action="{{ route('pelanggan.index') }}" method="GET" class="flex flex-col sm:flex-row items-center gap-3">
            <div class="relative flex-1 w-full">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                    <i class="fa-solid fa-magnifying-glass text-xs"></i>
                </span>
                <input type="text" name="q" value="{{ $q ?? '' }}" 
                       placeholder="Cari nama atau nomor telepon pelanggan..."
                       class="w-full pl-9 pr-4 py-2 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition">
            </div>

            <div class="flex items-center gap-2 w-full sm:w-auto">
                <button type="submit" 
                        class="flex-1 sm:flex-initial inline-flex items-center justify-center gap-2 px-4 py-2 rounded-xl bg-slate-800 hover:bg-slate-900 text-white text-sm font-semibold transition">
                    <i class="fa-solid fa-magnifying-glass text-xs"></i>
                    <span>Cari</span>
                </button>
                @if ($q ?? false)
                    <a href="{{ route('pelanggan.index') }}" 
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
                        <th class="py-3.5 px-4">Nama Pelanggan</th>
                        <th class="py-3.5 px-4">No. Telepon</th>
                        <th class="py-3.5 px-4">Alamat</th>
                        <th class="py-3.5 px-4">Catatan Khusus</th>
                        <th class="py-3.5 px-4 text-center w-28">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse ($pelanggan ?? [] as $p)
                        <tr class="hover:bg-indigo-50/20 transition duration-150">
                            <td class="py-3.5 px-4 text-center font-bold text-slate-400 text-xs">{{ $loop->iteration }}</td>
                            <td class="py-3.5 px-4 font-semibold text-slate-900">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-indigo-500 to-blue-500 text-white flex items-center justify-center text-xs font-bold flex-shrink-0">
                                        {{ strtoupper(substr($p->nama, 0, 1)) }}
                                    </div>
                                    <span>{{ $p->nama }}</span>
                                </div>
                            </td>
                            <td class="py-3.5 px-4 text-slate-700">
                                <span class="inline-flex items-center gap-1.5 font-mono text-xs text-slate-600 bg-slate-100 px-2.5 py-1 rounded-lg">
                                    <i class="fa-solid fa-phone text-[10px] text-slate-400"></i>
                                    {{ $p->no_telepon }}
                                </span>
                            </td>
                            <td class="py-3.5 px-4 text-slate-600 text-xs max-w-xs truncate" title="{{ $p->alamat }}">
                                {{ $p->alamat ?: '-' }}
                            </td>
                            <td class="py-3.5 px-4">
                                @if ($p->catatan_khusus)
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-amber-50 text-amber-700 border border-amber-200">
                                        <i class="fa-solid fa-note-sticky text-[10px]"></i>
                                        <span>{{ Str::limit($p->catatan_khusus, 30) }}</span>
                                    </span>
                                @else
                                    <span class="text-xs text-slate-400">-</span>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 text-center">
                                <div class="inline-flex items-center gap-1">
                                    <a href="{{ route('pelanggan.edit', $p) }}" 
                                       class="p-1.5 text-slate-500 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition"
                                       title="Edit Pelanggan">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form action="{{ route('pelanggan.destroy', $p) }}" method="POST" 
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus pelanggan {{ $p->nama }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="p-1.5 text-slate-500 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition"
                                                title="Hapus Pelanggan">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center">
                                <div class="w-14 h-14 rounded-2xl bg-slate-100 text-slate-400 flex items-center justify-center mx-auto text-xl mb-3">
                                    <i class="fa-solid fa-users-slash"></i>
                                </div>
                                <h4 class="text-sm font-bold text-slate-700">Pelanggan Tidak Ditemukan</h4>
                                <p class="text-xs text-slate-400 mt-1">
                                    {{ ($q ?? false) ? 'Tidak ada pelanggan yang cocok dengan pencarian Anda.' : 'Belum ada data pelanggan yang terdaftar.' }}
                                </p>
                                @if (!($q ?? false))
                                    <a href="{{ route('pelanggan.create') }}" class="inline-flex items-center gap-2 mt-4 px-4 py-2 rounded-xl bg-indigo-600 text-white text-xs font-bold hover:bg-indigo-700 transition">
                                        <i class="fa-solid fa-plus"></i> Tambah Pelanggan Pertama
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
