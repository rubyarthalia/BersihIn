@extends('base.base')

@section('content')
<section class="login-section" style="font-family: 'Montserrat', sans-serif; background-color: #f9fdf8; min-height: 80vh; display: flex; align-items: center; justify-content: center; padding: 20px;">
  <div class="login-container" style="background-color: #ffffff; border-radius: 10px; padding: 40px; width: 100%; max-width: 400px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">

    <h2 style="font-weight: 700; font-size: 28px; margin-bottom: 25px; color: #014A3F; text-align: center;">Masuk</h2>

    @if ($errors->any())
      <div style="color: red; font-size: 14px; margin-bottom: 15px;">
        {{ $errors->first() }}
      </div>
    @endif

    <form action="{{ route('login.auth') }}" method="post" style="margin-bottom: 20px;">
      @csrf
      <div style="margin-bottom: 15px;">
        <input type="text" placeholder="Nomor Telepon / Email" name="username" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 14px;">
      </div>

      <div style="margin-bottom: 20px;">
        <input type="password" placeholder="Password" name="password" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 14px;">
      </div>

      <button type="submit" style="width: 100%; padding: 12px; background-color: #34A853; color: white; border: none; border-radius: 5px; font-size: 16px; font-weight: bold; cursor: pointer;">Berikutnya</button>

      <div style="text-align: left; margin-top: 15px;">
        <a href="{{ route('password_email.show') }}" style="color: #014A3F; text-decoration: underline; font-size: 14px;">Lupa Password?</a>
      </div>
    </form>

    <div style="text-align: center; font-size: 14px; color: #555;">
      <p style="margin: 0;">Belum punya akun? <a href="{{ route('signup.show') }}" style="color: #014A3F; text-decoration: none; font-weight: bold;">Daftar</a></p>
    </div>

  </div>
</section>
@endsection
