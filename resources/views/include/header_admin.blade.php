<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      margin: 0;
      background-color: #f9fdf8;
      padding-top: 80px;
    }
  </style>
</head>
<body>
  @if (Request::is('login_admin') || Request::is('resetpasswordemail_admin') || Request::is('resetpassword_admin'))
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-3 fixed-top">
      <div class="container d-flex justify-content-center">
        <a class="navbar-brand d-flex align-items-center" href="#">
          <img src="{{ asset('Images/LogoBersihIn.png')}}" alt="Logo BersihIn" class="logo">
        </a>
      </div>
    </nav>
  @else
    {{-- Header untuk admin --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-3 fixed-top" style="font-family: 'Montserrat', sans-serif;">
      <div class="container">
        <a class="navbar-brand" href="#">
          <img src="{{ asset('Images/LogoBersihIn.png')}}" alt="Logo BersihIn" class="logo" style="height: 40px;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation"
                style="border: none; box-shadow: none; color: #014A3F;">
          <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center">
            <li class="nav-item my-2 my-lg-0">
              <a class="nav-link mx-lg-3" href="{{ route('landing_admin.show') }}"
                 style="color:#014A3F; font-weight: 700; font-size: clamp(16px, 2vw, 20px);">
                Beranda
              </a>
            </li>
            <li class="nav-item dropdown my-2 my-lg-0">
              <a class="nav-link mx-lg-3 dropdown-toggle" href="#" id="servicesDropdown"
                 role="button" data-bs-toggle="dropdown" aria-expanded="false"
                 style="color:#014A3F; font-weight: 700; font-size: clamp(16px, 2vw, 20px);">
                Layanan
              </a>
              <ul class="dropdown-menu" aria-labelledby="servicesDropdown">
                <li><a class="dropdown-item" href="{{ route('layanan_admin.show', ['kategori' => 'cleaning', 'category_id' => 'C01']) }}">Cleaning</a></li>
                <li><a class="dropdown-item" href="{{ route('layanan_admin.show', ['kategori' => 'disinfection', 'category_id' => 'C04']) }}">Disinfection</a></li>
                <li><a class="dropdown-item" href="{{ route('layanan_admin.show', ['kategori' => 'laundry', 'category_id' => 'C02']) }}">Laundry</a></li>
                <li><a class="dropdown-item" href="{{ route('layanan_admin.show', ['kategori' => 'maintenance', 'category_id' => 'C03']) }}">Maintenance</a></li>
              </ul>
            </li>
            <li class="nav-item d-none d-lg-flex align-items-center my-2 my-lg-0">
              <div style="height: 24px; width: 1px; background-color: #A0BC94;"></div>
            </li>

            <li class="nav-item dropdown my-2 my-lg-0">
              <a class="nav-link mx-lg-3 dropdown-toggle" href="#" id="userDropdown"
                role="button" data-bs-toggle="dropdown" aria-expanded="false"
                style="color:#014A3F; font-weight: 700; font-size: clamp(16px, 2vw, 20px);">
                 {{ Auth::guard('admin')->user()->nama }}
              </a>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                <li>
                  <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item" style="color:#014A3F; background: none; border: none; width: 100%; text-align: left;">
                      Logout
                    </button>
                  </form>
                </li>
              </ul>
            </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  @endif
</body>
</html>
