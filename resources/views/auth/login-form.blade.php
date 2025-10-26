<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Admin Kebencanaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #0d6efd, #198754);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
        }
        .login-card {
            max-width: 420px;
            width: 100%;
            border-radius: 15px;
            box-shadow: 0 6px 25px rgba(0,0,0,0.25);
            overflow: hidden;
            background: #fff;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .login-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0,0,0,0.3);
        }
        .login-header {
            background: #0d6efd;
            color: #fff;
            text-align: center;
            padding: 25px;
        }
        .login-header i {
            font-size: 2.8rem;
            margin-bottom: 10px;
            color: #fff;
        }
        .btn-primary {
            background-color: #0d6efd;
            border: none;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #198754;
            transform: scale(1.03);
        }
        .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(25, 135, 84, 0.25);
            border-color: #198754;
        }
    </style>
</head>
<body>

<div class="card login-card">
    <div class="login-header">
        <i class="fas fa-shield-alt"></i>
        <h4 class="fw-bold mb-1">Admin Kebencanaan</h4>
        <p class="mb-0 text-light">Silakan login untuk melanjutkan</p>
    </div>
    <div class="card-body p-4">

        <!-- Pesan error -->
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/auth/login" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label"><i class="fas fa-user me-1"></i> Username</label>
                <input type="text" name="username" value="{{ old('username') }}" class="form-control" placeholder="Masukkan username" required>
            </div>
            <div class="mb-3">
                <label class="form-label"><i class="fas fa-lock me-1"></i> Password</label>
                <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">
                <i class="fas fa-sign-in-alt me-1"></i> Login
            </button>
        </form>
    </div>
</div>

</body>
</html>
