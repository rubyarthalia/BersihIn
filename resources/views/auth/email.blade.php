@extends('base.base')

@section('content')
<section class="login-section" style="font-family: 'Montserrat', sans-serif; background-color: #f9fdf8; min-height: 80vh; display: flex; align-items: center; justify-content: center; padding: 20px;">  
    <div class="login-container" style="background-color: #ffffff; border-radius: 10px; padding: 40px; width: 100%; max-width: 400px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
    
        <h2 style="font-weight: 700; font-size: 28px; margin-bottom: 25px; color: #014A3F; text-align: center;">Reset Password</h2>
        
        <form action="{{ route('password_email.auth') }}" method="post" style="margin-bottom: 20px;">
            @csrf
            <div style="margin-bottom: 15px;">
                <input type="text" placeholder="Nomor Telepon / Email" name="username" value="{{ old('username') }}" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 14px;">
                
                @if ($errors->has('username'))
                    <div style="color: red; font-size: 13px; margin-top: 5px;">
                        {{ $errors->first('username') }}
                    </div>
                @endif
            </div>


            <button type="submit" style="width: 100%; padding: 12px; background-color: #34A853; color: white; border: none; border-radius: 5px; font-size: 16px; font-weight: bold; cursor: pointer;">Berikutnya</button>
        </form>

        <a href="{{ route('login.show') }}" style="display: inline-block; width: 100%; padding: 12px; background-color: #34A853; color: white; border: 1px solid #34A853; border-radius: 5px; font-size: 16px; font-weight: bold; text-align: center; text-decoration: none; cursor: pointer;">Kembali</a>
    </div>
</section>
@endsection