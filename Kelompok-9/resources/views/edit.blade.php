<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Pelanggan</title>
</head>
<body>
    <h1>Edit Pelanggan</h1>

    @if ($errors->any())
        <div style="color:red">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('pelanggan.update', $pelanggan) }}">
        @csrf
        @method('PUT')

        <label>Nama</label><br>
        <input type="text" name="nama" value="{{ old('nama', $pelanggan->nama) }}"><br>

        <label>Alamat</label><br>
        <textarea name="alamat">{{ old('alamat', $pelanggan->alamat) }}</textarea><br>

        <label>No. Telepon</label><br>
        <input type="text" name="no_telepon" value="{{ old('no_telepon', $pelanggan->no_telepon) }}"><br>

        <label>Catatan Khusus</label><br>
        <textarea name="catatan_khusus">{{ old('catatan_khusus', $pelanggan->catatan_khusus) }}</textarea><br>

        <button type="submit">Simpan</button>
        <a href="{{ route('pelanggan.index') }}">Batal</a>
    </form>
</body>
</html>