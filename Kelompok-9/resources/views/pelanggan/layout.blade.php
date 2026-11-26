<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Data Pelanggan')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<header class="site-header">
    <div class="header-inner">
        <h1>Data Pelanggan</h1>
        <p>Biodata pelanggan dan catatan penanganan khusus pakaian</p>
    </div>
</header>
<div class="container">
    @yield('content')
</div>
</body>
</html>