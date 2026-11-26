@extends('layouts.app')

@section('title', 'Ubah Pelanggan')

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="mb-6 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <a href="{{ route('pelanggan.index') }}" 
                   class="w-9 h-9 rounded-xl bg-white border border-slate-200 text-slate-600 flex items-center justify-center hover:bg-slate-50 transition"
                   title="Kembali ke Daftar Pelanggan">
                    <i class="fa-solid fa-arrow-left text-xs"></i>
                </a>
                <div>
                    <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Edit Data Pelanggan</h1>
                    <p class="text-xs text-slate-500 mt-0.5">Perbarui kontak atau catatan khusus penanganan pakaian</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm p-6 sm:p-8">
            <form action="{{ route('pelanggan.update', $pelanggan) }}" method="POST">
                @method('PUT')
                @include('pelanggan._form')
            </form>
        </div>
    </div>
@endsection
