<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Masuk') - Sistem Operasional Laundry</title>
    
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-gradient-to-br from-indigo-50 via-slate-50 to-blue-50 min-h-screen flex items-center justify-center p-4 selection:bg-indigo-500 selection:text-white">
    <div class="w-full max-w-md">
        <div class="text-center mb-6">
            <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-gradient-to-tr from-indigo-600 to-blue-500 text-white shadow-xl shadow-indigo-500/25 mb-3 text-2xl">
                <i class="fa-solid fa-soap"></i>
            </div>
            <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Laundry<span class="text-indigo-600">Hub</span></h1>
            <p class="text-xs text-slate-500 mt-1 font-medium">Sistem Manajemen Operasional Laundry &bull; Kelompok 9</p>
        </div>
        <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/70 border border-slate-100 p-8">
            @yield('content')
        </div>
        <div class="text-center text-xs text-slate-400 mt-6">
            &copy; {{ date('Y') }} LaundryHub Management System
        </div>
    </div>
</body>
</html>
