<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar</title>
    <link rel="stylesheet" href="{{ asset('css/styling.css') }}">
</head>
<body>
    <div class="form-card">
        <h2 class="form-title">Daftar Akun Baru</h2>

        @if ($errors->any())
            <div class="alert-error">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('register.proses') }}" method="POST">
            @csrf

            <label>Nama Lengkap:</label>
            <input type="text" name="name" value="{{ old('name') }}" required autofocus>

            <label>Email:</label>
            <input type="email" name="email" value="{{ old('email') }}" required>

            <label>Kata Sandi (minimal 8 karakter):</label>
            <input type="password" name="password" required>

            <label>Ulangi Kata Sandi:</label>
            <input type="password" name="password_confirmation" required>

            <div class="form-button">
                <button type="submit">Daftar</button>
            </div>
        </form>

        <p style="text-align:center">Sudah punya akun? <a href="{{ route('login') }}">Masuk</a></p>
    </div>
</body>
</html>