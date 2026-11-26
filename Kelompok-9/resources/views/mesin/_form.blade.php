@csrf

<div class="space-y-5">
    <div>
        <label for="nama_mesin" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
            Nama Mesin / Peralatan <span class="text-rose-500">*</span>
        </label>
        <input type="text" id="nama_mesin" name="nama_mesin"
               value="{{ old('nama_mesin', $mesin->nama_mesin ?? '') }}" required
               placeholder="Contoh: Mesin Cuci LG Front Load 15kg"
               class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition">
        @error('nama_mesin') <p class="text-rose-600 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
            <label for="jenis" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                Jenis Peralatan <span class="text-rose-500">*</span>
            </label>
            <select id="jenis" name="jenis" required
                    class="w-full px-3 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition">
                @if (class_exists(\App\Models\Mesin::class))
                    @foreach (\App\Models\Mesin::JENIS as $val => $label)
                        <option value="{{ $val }}" {{ old('jenis', $mesin->jenis ?? 'mesin_cuci') === $val ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                @else
                    <option value="mesin_cuci">Mesin Cuci</option>
                    <option value="pengering">Pengering</option>
                    <option value="setrika">Setrika</option>
                    <option value="lainnya">Peralatan Lain</option>
                @endif
            </select>
            @error('jenis') <p class="text-rose-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="kapasitas_kg" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                Kapasitas (Kg)
            </label>
            <input type="number" id="kapasitas_kg" name="kapasitas_kg" min="0" max="1000"
                   value="{{ old('kapasitas_kg', $mesin->kapasitas_kg ?? '') }}"
                   placeholder="Contoh: 15"
                   class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition">
            @error('kapasitas_kg') <p class="text-rose-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
            <label for="status" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                Status Operasional <span class="text-rose-500">*</span>
            </label>
            <select id="status" name="status" required
                    class="w-full px-3 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition">
                @if (class_exists(\App\Models\Mesin::class))
                    @foreach (\App\Models\Mesin::STATUS as $val => $label)
                        <option value="{{ $val }}" {{ old('status', $mesin->status ?? 'tersedia') === $val ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                @else
                    <option value="tersedia">Tersedia</option>
                    <option value="digunakan">Sedang Digunakan</option>
                    <option value="perawatan">Perawatan</option>
                    <option value="rusak">Rusak</option>
                @endif
            </select>
            @error('status') <p class="text-rose-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="perawatan_terakhir" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                Tanggal Perawatan Terakhir
            </label>
            <input type="date" id="perawatan_terakhir" name="perawatan_terakhir"
                   value="{{ old('perawatan_terakhir', isset($mesin) && $mesin->perawatan_terakhir ? \Carbon\Carbon::parse($mesin->perawatan_terakhir)->format('Y-m-d') : '') }}"
                   class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition">
            @error('perawatan_terakhir') <p class="text-rose-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
    </div>

    <div>
        <label for="catatan" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
            Catatan Tambahan
        </label>
        <textarea id="catatan" name="catatan" rows="3"
                  placeholder="Kondisi filter, jadwal ganti sabuk, atau info servis lainnya..."
                  class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition">{{ old('catatan', $mesin->catatan ?? '') }}</textarea>
        @error('catatan') <p class="text-rose-600 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
</div>

<div class="flex items-center justify-end gap-3 mt-8 pt-5 border-t border-slate-100">
    <a href="{{ route('mesin.index') }}" 
       class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-50 text-sm font-semibold transition">
        Batal
    </a>
    <button type="submit" 
            class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold shadow-md shadow-indigo-500/20 hover:shadow-lg hover:shadow-indigo-500/30 transition">
        <i class="fa-solid fa-floppy-disk text-xs"></i>
        <span>Simpan Data Mesin</span>
    </button>
</div>
