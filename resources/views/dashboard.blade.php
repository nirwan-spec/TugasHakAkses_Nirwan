<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/styling.css') }}">
</head>
<body>

    <div class="userbar">
        <span>{{ auth()->user()->name }} <span class="badge-role">{{ auth()->user()->role }}</span></span>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Keluar</button>
        </form>
    </div>

    <div class="page-header">
        <p class="breadcrumb">Dashboard</p>
        <h1>Selamat datang, {{ auth()->user()->name }}</h1>
        <p>Anda masuk sebagai <strong>{{ auth()->user()->role }}</strong>.</p>
    </div>

    <br>

    @can('viewAny', \App\Models\Pelanggan::class)
        <div class="summary">
            <div class="summary-card">
                <p>Modul</p>
                <h2><a href="{{ route('pelanggan.index') }}">Pelanggan & Member</a></h2>
            </div>
        </div>
    @else
        <div class="alert-success">
            Akun Anda terdaftar sebagai member. Modul pengelolaan pelanggan hanya tersedia untuk admin dan staff.
        </div>
    @endcan

</body>
</html>