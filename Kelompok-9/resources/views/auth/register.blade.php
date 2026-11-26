@extends('layouts.guest')

@section('title', 'Daftar')

@section('content')
    <h2 class="text-lg font-semibold mb-4 text-gray-800">Buat akun baru</h2>

    <form action="{{ route('register') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label for="name" class="block text-sm font-medium mb-1 text-gray-700">Nama Lengkap</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" autofocus required
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('name')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-medium mb-1 text-gray-700">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('email')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-medium mb-1 text-gray-700">Password (min. 8 karakter)</label>
            <input type="password" id="password" name="password" required
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('password')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium mb-1 text-gray-700">Ulangi Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white rounded py-2 font-medium hover:bg-blue-700 transition">
            Daftar
        </button>
    </form>

    <p class="text-sm text-center mt-4 text-gray-600">
        Sudah punya akun?
        <a href="{{ route('login') }}" class="text-blue-600 font-medium underline hover:text-blue-700">Login</a>
    </p>
@endsection
