@csrf

<div class="space-y-5">
    <div>
        <label for="nama_bahan" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
            Nama Bahan Pembersih <span class="text-rose-500">*</span>
        </label>
        <input type="text" id="nama_bahan" name="nama_bahan"
               value="{{ old('nama_bahan', $bahan->nama_bahan ?? '') }}" required
               placeholder="Contoh: Deterjen Cair Ultra Soft 20L"
               class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition">
        @error('nama_bahan') <p class="text-rose-600 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
            <label for="jenis" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                Kategori Bahan <span class="text-rose-500">*</span>
            </label>
            <select id="jenis" name="jenis" required
                    class="w-full px-3 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition">
                @if (class_exists(\App\Models\BahanPembersih::class))
                    @foreach (\App\Models\BahanPembersih::JENIS as $val => $label)
                        <option value="{{ $val }}" {{ old('jenis', $bahan->jenis ?? 'deterjen') === $val ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                @else
                    <option value="deterjen">Deterjen</option>
                    <option value="pelembut">Pelembut</option>
                    <option value="pewangi">Pewangi</option>
                    <option value="pemutih">Pemutih</option>
                    <option value="lainnya">Lainnya</option>
                @endif
            </select>
            @error('jenis') <p class="text-rose-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="satuan" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                Satuan Ukuran <span class="text-rose-500">*</span>
            </label>
            <select id="satuan" name="satuan" required
                    class="w-full px-3 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition">
                @if (class_exists(\App\Models\BahanPembersih::class))
                    @foreach (\App\Models\BahanPembersih::SATUAN as $val => $label)
                        <option value="{{ $val }}" {{ old('satuan', $bahan->satuan ?? 'liter') === $val ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                @else
                    <option value="liter">Liter</option>
                    <option value="kg">Kg</option>
                    <option value="pcs">Pcs</option>
                    <option value="botol">Botol</option>
                @endif
            </select>
            @error('satuan') <p class="text-rose-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
            <label for="stok" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                Jumlah Stok Saat Ini <span class="text-rose-500">*</span>
            </label>
            <input type="number" step="0.01" min="0" id="stok" name="stok" required
                   value="{{ old('stok', isset($bahan) ? (float) $bahan->stok : 0) }}"
                   class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition">
            @error('stok') <p class="text-rose-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="stok_minimum" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                Batas Stok Minimum <span class="text-rose-500">*</span>
            </label>
            <input type="number" step="0.01" min="0" id="stok_minimum" name="stok_minimum" required
                   value="{{ old('stok_minimum', isset($bahan) ? (float) $bahan->stok_minimum : 0) }}"
                   class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition">
            @error('stok_minimum') <p class="text-rose-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
    </div>

    <div>
        <label for="harga_satuan" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
            Harga Satuan Beli (Rp) <span class="text-rose-500">*</span>
        </label>
        <div class="relative">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-xs font-bold text-slate-400">Rp</span>
            <input type="number" min="0" id="harga_satuan" name="harga_satuan" required
                   value="{{ old('harga_satuan', $bahan->harga_satuan ?? 0) }}"
                   placeholder="Contoh: 45000"
                   class="w-full pl-10 pr-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition">
        </div>
        @error('harga_satuan') <p class="text-rose-600 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="catatan" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
            Catatan Tambahan
        </label>
        <textarea id="catatan" name="catatan" rows="3"
                  placeholder="Informasi supplier, rekomendasi takaran cuci, tanggal kedaluwarsa..."
                  class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition">{{ old('catatan', $bahan->catatan ?? '') }}</textarea>
        @error('catatan') <p class="text-rose-600 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
</div>

<div class="flex items-center justify-end gap-3 mt-8 pt-5 border-t border-slate-100">
    <a href="{{ route('bahan-pembersih.index') }}" 
       class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-50 text-sm font-semibold transition">
        Batal
    </a>
    <button type="submit" 
            class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold shadow-md shadow-indigo-500/20 hover:shadow-lg hover:shadow-indigo-500/30 transition">
        <i class="fa-solid fa-floppy-disk text-xs"></i>
        <span>Simpan Bahan Pembersih</span>
    </button>
</div>
