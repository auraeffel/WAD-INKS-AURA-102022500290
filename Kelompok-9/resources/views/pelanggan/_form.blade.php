@csrf

<div class="space-y-5">
    <div>
        <label for="nama" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
            Nama Lengkap Pelanggan <span class="text-rose-500">*</span>
        </label>
        <div class="relative">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                <i class="fa-regular fa-user text-xs"></i>
            </span>
            <input type="text" id="nama" name="nama" 
                   value="{{ old('nama', $pelanggan->nama ?? '') }}" required
                   placeholder="Contoh: Budi Santoso"
                   class="w-full pl-9 pr-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition">
        </div>
        @error('nama') <p class="text-rose-600 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="no_telepon" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
            Nomor Telepon / WhatsApp <span class="text-rose-500">*</span>
        </label>
        <div class="relative">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                <i class="fa-solid fa-phone text-xs"></i>
            </span>
            <input type="text" id="no_telepon" name="no_telepon" 
                   value="{{ old('no_telepon', $pelanggan->no_telepon ?? '') }}" required
                   placeholder="Contoh: 08123456789"
                   class="w-full pl-9 pr-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition">
        </div>
        @error('no_telepon') <p class="text-rose-600 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="alamat" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
            Alamat Domisili
        </label>
        <textarea id="alamat" name="alamat" rows="3"
                  placeholder="Nama jalan, nomor rumah, RT/RW, kelurahan..."
                  class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition">{{ old('alamat', $pelanggan->alamat ?? '') }}</textarea>
        @error('alamat') <p class="text-rose-600 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="catatan_khusus" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
            Catatan Khusus Pakaian
        </label>
        <textarea id="catatan_khusus" name="catatan_khusus" rows="3"
                  placeholder="Contoh: Jangan disetrika terlalu panas, pisahkan pakaian putih, alergi pewangi tertentu..."
                  class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition">{{ old('catatan_khusus', $pelanggan->catatan_khusus ?? '') }}</textarea>
        @error('catatan_khusus') <p class="text-rose-600 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
</div>

<div class="flex items-center justify-end gap-3 mt-8 pt-5 border-t border-slate-100">
    <a href="{{ route('pelanggan.index') }}" 
       class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-50 text-sm font-semibold transition">
        Batal
    </a>
    <button type="submit" 
            class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold shadow-md shadow-indigo-500/20 hover:shadow-lg hover:shadow-indigo-500/30 transition">
        <i class="fa-solid fa-floppy-disk text-xs"></i>
        <span>Simpan Data Pelanggan</span>
    </button>
</div>
