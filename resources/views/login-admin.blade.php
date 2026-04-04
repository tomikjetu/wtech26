<!DOCTYPE html>
<html lang="sk">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Mini Login - trickohouse</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Irish+Grover&family=Nunito:wght@400;600;700;900&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/admin-header.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/login-small.css') }}" />
</head>
<body class="mini-login-page">
  @include('include.admin-header')
<main class="mini-login-wrap" aria-labelledby="mini-login-title">
    <section class="mini-login-card">
      <h1 id="mini-login-title" class="mini-login-title">Prihlasenie</h1>
      <form class="mini-login-form" method="POST" action="{{ route('admin.login') }}">
    @csrf

    <label class="mini-login-label" for="mini-username">Email</label>
    <input id="mini-username" name="email" type="email" class="mini-login-input" placeholder="admin@trickohouse.sk" value="{{ old('email') }}" required />

    <label class="mini-login-label" for="mini-password">Heslo</label>
    <input id="mini-password" name="password" type="password" class="mini-login-input" placeholder="••••••" required />

    @error('email')
        <div class="login-error">{{ $message }}</div>
    @enderror

    <button type="submit" class="mini-login-btn">Prihlásenie</button>

</form>
    </section>
  </main>

  <footer class="admin-header-footer">
    <div class="container admin-header-footer__inner">
      <p class="admin-header-footer__copy">Admin Panel WTECH 2026</p>
    </div>
  </footer>
</body>
</html>

