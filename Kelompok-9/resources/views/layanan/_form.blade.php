@csrf

<div class="space-y-5">
    <div>
        <label for="nama_layanan" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
            Nama Layanan Laundry <span class="text-rose-500">*</span>
        </label>
        <input type="text" id="nama_layanan" name="nama_layanan"
               value="{{ old('nama_layanan', $layanan->nama_layanan ?? '') }}" required
               placeholder="Contoh: Cuci Komplit Reguler (Cuci + Kering + Setrika)"
               class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition">
        @error('nama_layanan') <p class="text-rose-600 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
            <label for="tarif" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                Tarif Harga (Rp) <span class="text-rose-500">*</span>
            </label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-xs font-bold text-slate-400">Rp</span>
                <input type="number" id="tarif" name="tarif" min="0" required
                       value="{{ old('tarif', $layanan->tarif ?? '') }}"
                       placeholder="Contoh: 7000"
                       class="w-full pl-10 pr-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition">
            </div>
            @error('tarif') <p class="text-rose-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="satuan" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                Satuan Tarif <span class="text-rose-500">*</span>
            </label>
            <select id="satuan" name="satuan" required
                    class="w-full px-3 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition">
                @foreach (['kg' => 'Per Kilogram (kg)', 'pcs' => 'Per Potong (pcs)', 'm2' => 'Per Meter Persegi (m²)'] as $val => $label)
                    <option value="{{ $val }}" {{ old('satuan', $layanan->satuan ?? 'kg') === $val ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
            @error('satuan') <p class="text-rose-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
    </div>

    <div>
        <label for="estimasi_hari" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
            Estimasi Selesai (Hari) <span class="text-rose-500">*</span>
        </label>
        <input type="number" id="estimasi_hari" name="estimasi_hari" min="0" max="30" required
               value="{{ old('estimasi_hari', $layanan->estimasi_hari ?? 2) }}"
               placeholder="Contoh: 2"
               class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition">
        @error('estimasi_hari') <p class="text-rose-600 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="deskripsi" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
            Deskripsi Layanan
        </label>
        <textarea id="deskripsi" name="deskripsi" rows="3"
                  placeholder="Detail pengerjaan paket laundry, fasilitas pewangi premium, dll..."
                  class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition">{{ old('deskripsi', $layanan->deskripsi ?? '') }}</textarea>
        @error('deskripsi') <p class="text-rose-600 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200">
        <label class="flex items-center gap-3 cursor-pointer">
            <input type="checkbox" name="is_aktif" value="1"
                   {{ old('is_aktif', $layanan->is_aktif ?? true) ? 'checked' : '' }}
                   class="w-4 h-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
            <div>
                <span class="text-sm font-bold text-slate-800">Layanan Aktif</span>
                <p class="text-xs text-slate-500">Jika dicentang, pelanggan dapat memesan layanan ini.</p>
            </div>
        </label>
    </div>
</div>

<div class="flex items-center justify-end gap-3 mt-8 pt-5 border-t border-slate-100">
    <a href="{{ route('layanan.index') }}" 
       class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-50 text-sm font-semibold transition">
        Batal
    </a>
    <button type="submit" 
            class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold shadow-md shadow-indigo-500/20 hover:shadow-lg hover:shadow-indigo-500/30 transition">
        <i class="fa-solid fa-floppy-disk text-xs"></i>
        <span>Simpan Data Layanan</span>
    </button>
</div>
