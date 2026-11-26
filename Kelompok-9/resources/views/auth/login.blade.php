@extends('layouts.guest')

@section('title', 'Login')

@section('content')
    <h2 class="text-lg font-semibold mb-4 text-gray-800">Masuk ke akun</h2>

    <form action="{{ route('login') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label for="email" class="block text-sm font-medium mb-1 text-gray-700">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" autofocus required
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('email')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-medium mb-1 text-gray-700">Password</label>
            <input type="password" id="password" name="password" required
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('password')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <label class="flex items-center gap-2 text-sm text-gray-600">
            <input type="checkbox" name="remember" value="1"> Ingat saya
        </label>

        <button type="submit" class="w-full bg-blue-600 text-white rounded py-2 font-medium hover:bg-blue-700 transition">
            Login
        </button>
    </form>

    <p class="text-sm text-center mt-4 text-gray-600">
        Belum punya akun?
        <a href="{{ route('register') }}" class="text-blue-600 font-medium underline hover:text-blue-700">Daftar di sini</a>
    </p>
@endsection
