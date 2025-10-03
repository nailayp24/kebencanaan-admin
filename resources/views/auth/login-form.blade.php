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
        }
        .login-card {
            max-width: 420px;
            width: 100%;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.2);
        }
        .login-header {
            background: #0d6efd;
            color: #fff;
            border-radius: 15px 15px 0 0;
            text-align: center;
            padding: 20px;
        }
        .login-header i {
            font-size: 2.5rem;
        }
    </style>
</head>
<body>

<div class="card login-card">
    <div class="login-header">
        <i class="fas fa-shield-alt mb-2"></i>
        <h4 class="mb-0">Admin Kebencanaan</h4>
        <p class="mb-0">Silakan login untuk melanjutkan</p>
    </div>
    <div class="card-body">

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
                <input type="text" name="username" value="{{ old('username') }}" class="form-control" placeholder="Masukkan username">
            </div>
            <div class="mb-3">
                <label class="form-label"><i class="fas fa-lock me-1"></i> Password</label>
                <input type="password" name="password" class="form-control" placeholder="Masukkan password">
            </div>
            <button class="btn btn-primary w-100"><i class="fas fa-sign-in-alt me-1"></i> Login</button>
        </form>
    </div>
</div>

</body>
</html>
