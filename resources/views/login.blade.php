<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login - Apotek App</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .login-container {
      min-height: 100vh;
    }
    .login-card {
      border-radius: 1rem;
      overflow: hidden;
    }
    .login-image {
      background-color: #f0f4f8;
    }
    .login-image img {
      max-height: 320px;
    }
  </style>
</head>
<body>
  <div class="container login-container d-flex align-items-center justify-content-center">
    <div class="row w-100 justify-content-center">
      <div class="col-lg-10">
        <div class="row shadow bg-white login-card">

          <!-- Gambar -->
          <div class="col-md-6 d-none d-md-flex align-items-center justify-content-center login-image">
            <img src="{{ asset('assets/vita_care.png') }}" alt="Logo" class="img-fluid p-4">
          </div>

          <!-- Form -->
          <div class="col-md-6 p-5">
            <div class="text-center mb-4">
              <h3 class="fw-bold mb-1">Welcome Back</h3>
              <p class="text-muted">Login untuk melanjutkan</p>
            </div>

            <form action="{{ route('login.auth') }}" method="POST">
              @csrf

              @if (Session::get('failed'))
                <div class="alert alert-danger">{{ Session::get('failed') }}</div>
              @endif
              @if (Session::get('logout'))
                <div class="alert alert-success">{{ Session::get('logout') }}</div>
              @endif
              @if (Session::get('canAccess'))
                <div class="alert alert-warning">{{ Session::get('canAccess') }}</div>
              @endif

              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Masukkan email" required>
                @error('email')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>

              <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password" required>
                @error('password')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>

              <div class="d-grid">
                <button type="submit" class="btn btn-primary">Login</button>
              </div>
            </form>
          </div>

        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
