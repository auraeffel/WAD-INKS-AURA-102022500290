@php
    $menu = [
        ['label' => 'Data Pelanggan',    'route' => 'pelanggan.index',       'match' => 'pelanggan.*',       'icon' => 'fa-users'],
        ['label' => 'Mesin & Peralatan', 'route' => 'mesin.index',           'match' => 'mesin.*',           'icon' => 'fa-gears'],
        ['label' => 'Layanan Laundry',   'route' => 'layanan.index',         'match' => 'layanan.*',         'icon' => 'fa-shirt'],
        ['label' => 'Bahan Pembersih',   'route' => 'bahan-pembersih.index', 'match' => 'bahan-pembersih.*', 'icon' => 'fa-flask'],
    ];
@endphp

<header class="sticky top-0 z-40 bg-white/90 backdrop-blur-md border-b border-slate-200/80 shadow-xs">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <!-- Brand Logo -->
            <a href="/" class="flex items-center gap-3 group">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-indigo-600 to-blue-500 text-white flex items-center justify-center shadow-md shadow-indigo-500/20 group-hover:scale-105 transition duration-200">
                    <i class="fa-solid fa-soap text-lg"></i>
                </div>
                <div>
                    <span class="font-extrabold text-lg tracking-tight text-slate-900 group-hover:text-indigo-600 transition">Laundry<span class="text-indigo-600">Hub</span></span>
                    <span class="hidden sm:block text-[10px] font-semibold text-slate-400 uppercase tracking-wider -mt-1">Kelompok 9</span>
                </div>
            </a>

            <!-- Navigation Links -->
            <nav class="hidden md:flex items-center gap-1">
                @foreach ($menu as $m)
                    @php $active = request()->routeIs($m['match']); @endphp
                    <a href="{{ route($m['route']) }}"
                       class="flex items-center gap-2 px-3.5 py-2 rounded-xl text-sm font-semibold transition duration-150 {{ $active ? 'bg-indigo-50 text-indigo-600 shadow-xs' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100/70' }}">
                        <i class="fa-solid {{ $m['icon'] }} text-xs {{ $active ? 'text-indigo-600' : 'text-slate-400' }}"></i>
                        <span>{{ $m['label'] }}</span>
                    </a>
                @endforeach
            </nav>

            <!-- User Auth Profile -->
            <div class="flex items-center gap-3">
                @auth
                    <div class="flex items-center gap-2 pl-3 border-l border-slate-200">
                        <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-indigo-500 to-purple-500 text-white flex items-center justify-center font-bold text-sm shadow-xs">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <div class="hidden lg:block text-left">
                            <div class="text-xs font-bold text-slate-800 leading-tight">{{ auth()->user()->name }}</div>
                            <div class="text-[10px] text-slate-400">Petugas</div>
                        </div>
                        <form action="{{ route('logout') }}" method="POST" class="ml-2 inline">
                            @csrf
                            <button type="submit" 
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold text-red-600 hover:text-red-700 hover:bg-red-50 border border-transparent hover:border-red-100 transition duration-150"
                                    title="Keluar dari akun">
                                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                <span class="hidden sm:inline">Logout</span>
                            </button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="px-4 py-2 rounded-xl text-sm font-semibold text-slate-700 hover:text-slate-900 hover:bg-slate-100 transition">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="px-4 py-2 rounded-xl text-sm font-semibold bg-indigo-600 text-white hover:bg-indigo-700 shadow-sm shadow-indigo-500/20 transition">
                        Daftar
                    </a>
                @endauth
            </div>
        </div>

        <!-- Mobile Nav Sub-bar -->
        <div class="md:hidden flex items-center justify-between gap-1 py-2 border-t border-slate-100 overflow-x-auto text-xs">
            @foreach ($menu as $m)
                @php $active = request()->routeIs($m['match']); @endphp
                <a href="{{ route($m['route']) }}"
                   class="whitespace-nowrap flex items-center gap-1.5 px-2.5 py-1.5 rounded-lg font-medium {{ $active ? 'bg-indigo-50 text-indigo-600' : 'text-slate-600' }}">
                    <i class="fa-solid {{ $m['icon'] }} text-[11px]"></i>
                    <span>{{ $m['label'] }}</span>
                </a>
            @endforeach
        </div>
    </div>
</header>
