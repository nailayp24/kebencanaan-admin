<!DOCTYPE html>
<html>
<head>
    <title>Login Berhasil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-success text-white text-center d-flex flex-column justify-content-center" style="height:100vh">

    <div class="container">
        <h1>🎉 Login Berhasil!</h1>
        <p>Selamat datang, <strong>{{ $username }}</strong></p>

        <div class="mt-4">
            <!-- Tombol ke Dashboard -->
            <a href="/kebencanaan" class="btn btn-light btn-lg me-2">Masuk ke Dashboard</a>
            <!-- Tombol kembali ke login -->
            <a href="/auth" class="btn btn-outline-light btn-lg">🔑 Login Lagi</a>
        </div>
    </div>

</body>
</html>
