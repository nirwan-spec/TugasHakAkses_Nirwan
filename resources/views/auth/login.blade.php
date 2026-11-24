<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/styling.css') }}">
</head>
<body>
    <div class="form-card">
        <h2 class="form-title">Masuk ke Sistem Venue</h2>

        @if ($errors->any())
            <div class="alert-error">{{ $errors->first() }}</div>
        @endif

        <form action="{{ route('login.proses') }}" method="POST">
            @csrf

            <label>Email:</label>
            <input type="email" name="email" value="{{ old('email') }}" required autofocus>

            <label>Kata Sandi:</label>
            <input type="password" name="password" required>

            <div class="form-button">
                <button type="submit">Masuk</button>
            </div>
        </form>

        <p style="text-align:center">Belum punya akun? <a href="{{ route('register') }}">Daftar</a></p>
    </div>
</body>
</html>