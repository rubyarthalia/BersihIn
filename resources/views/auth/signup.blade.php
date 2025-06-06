@extends('base.base')

@section('content')
<section class="login-section" style="font-family: 'Montserrat', sans-serif; background-color: #f9fdf8; min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 20px;">  
    <div class="login-container" style=" background-color: #ffffff; border-radius: 10px; padding: 40px; width: 100%; max-width: 400px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
    
    <h2 style="font-weight: 700; font-size: 28px; margin-bottom: 25px; color: #014A3F; text-align: center;">Daftar Sekarang</h2>
    
    <form action="{{ route('signup.auth') }}" method="post" style="margin-bottom: 20px;">
        @csrf
        
        {{-- NAMA --}}
        <div style="margin-bottom: 15px;">
            <input type="text" placeholder="Nama" name="nama" value="{{ old('nama') }}" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 14px;">
            {{-- This block will show the error for the 'nama' field --}}
            @error('nama')
                <div style="color: red; font-size: 12px; margin-top: 5px;">{{ $message }}</div>
            @enderror
        </div>
        
        {{-- EMAIL --}}
        <div style="margin-bottom: 15px;">
            <input type="email" placeholder="Email" name="email" value="{{ old('email') }}" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 14px;">
            {{-- This block will show the error for the 'email' field --}}
            @error('email')
                <div style="color: red; font-size: 12px; margin-top: 5px;">{{ $message }}</div>
            @enderror
        </div>

        {{-- NOMOR TELEPON --}}
        <div style="margin-bottom: 15px;">
            <input type="text" placeholder="Nomor Telpon" name="notelpon" value="{{ old('notelpon') }}" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 14px;">
            {{-- This block will show the error for the 'notelpon' field --}}
            @error('notelpon')
                <div style="color: red; font-size: 12px; margin-top: 5px;">{{ $message }}</div>
            @enderror
        </div>
        
        {{-- PASSWORD --}}
        <div style="margin-bottom: 20px;">
            <input type="password" placeholder="Password" name="password" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 14px;">
            <p style="font-size: 10px "class="m-2"> Min. 8 Karakter</p>
            {{-- This block will show the error for the 'password' field --}}
            @error('password')
                <div style="color: red; font-size: 12px; margin-top: 5px;">{{ $message }}</div>
            @enderror
        </div>

        {{-- KONFIRMASI PASSWORD --}}
        <div style="margin-bottom: 20px;">
            <input type="password" placeholder="Konfirmasi Password" name="password_confirmation" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 14px;">
        </div>
      
      <button type="submit" style="width: 100%; padding: 12px; background-color: #34A853; color: white; border: none; border-radius: 5px; font-size: 16px; font-weight: bold; cursor: pointer;">Berikutnya</button>
    </form>

    <div style="text-align: center; font-size: 14px; color: #555;">
      <p style="margin: 0;">Punya akun? <a href="{{ route('login.show') }}" style="color: #014A3F; text-decoration: none; font-weight: bold;">Masuk</a></p>
    </div>
    
  </div>
</section>
@endsection