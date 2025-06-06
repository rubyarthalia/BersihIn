
@if (Request::is('login') ||
        Request::is('resetpasswordemail') ||
        Request::is('resetpassword') ||
        Request::is('signup') ||
        Request::is('logout'))
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-3 fixed-top">
        <div class="container d-flex justify-content-center">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="{{ asset('Images/LogoBersihIn.png') }}" alt="Logo BersihIn" class="logo">
            </a>
        </div>
    </nav>
@else
    @if (Auth::guard('customer')->check())
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-3 fixed-top"
            style="font-family: 'Montserrat', sans-serif;">
            <div class="container">
                <a class="navbar-brand" href="{{ route('landing.show') }}">
                    <img src="{{ asset('Images/LogoBersihIn.png') }}" alt="Logo BersihIn" class="logo"
                        style="height: 40px;">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                    aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation"
                    style="border: none; box-shadow: none; color: #014A3F;">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center">
                        <li class="nav-item">
                            <a class="nav-link mx-lg-3" href="{{ route('landing.show') }}"
                                style="color:#014A3F; font-weight: 700; font-size: clamp(16px, 2vw, 20px);">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-lg-3" href="{{ route('aboutus.show') }}"
                                style="color:#014A3F; font-weight: 700; font-size: clamp(16px, 2vw, 20px);">Tentang
                                Kami</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link mx-lg-3 dropdown-toggle" href="#" id="servicesDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false"
                                style="color:#014A3F; font-weight: 700; font-size: clamp(16px, 2vw, 20px);">
                                Layanan
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="servicesDropdown">
                                <li><a class="dropdown-item"
                                        href="{{ route('layanan_customer.show', ['kategori' => 'cleaning', 'category_id' => 'C01']) }}">Cleaning</a>
                                </li>
                                <li><a class="dropdown-item"
                                        href="{{ route('layanan_customer.show', ['kategori' => 'disinfection', 'category_id' => 'C04']) }}">Disinfection</a>
                                </li>
                                <li><a class="dropdown-item"
                                        href="{{ route('layanan_customer.show', ['kategori' => 'laundry', 'category_id' => 'C02']) }}">Laundry</a>
                                </li>
                                <li><a class="dropdown-item"
                                        href="{{ route('layanan_customer.show', ['kategori' => 'maintenance', 'category_id' => 'C03']) }}">Maintenance</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item d-flex align-items-center mt-2 mt-lg-0">
                            <a href="{{ route('cart.show') }}" class="mx-lg-3 text-decoration-none position-relative">
                                <span class="d-none d-lg-inline">
                                    <i class="fa-solid fa-cart-shopping"
                                        style="color: #014A3F; font-size: clamp(18px, 2vw, 20px); transition: all 0.3s;"></i>
                                </span>
                                <span class="d-lg-none fw-bold"
                                    style="color: #014A3F; font-size: clamp(16px, 2vw, 20px); transition: all 0.3s;">
                                    Keranjang
                                </span>
                            </a>
                        </li>
                        <li class="nav-item d-none d-lg-flex align-items-center">
                            <div style="height: 24px; width: 1px; background-color: #A0BC94;"></div>
                        </li>
                        <li class="nav-item mt-2 mt-lg-0">
                            <a class="nav-link mx-lg-3" href="{{ route('biodata.show') }}"
                                style="color:#014A3F; font-weight: 700; font-size: clamp(16px, 2vw, 20px);">
                                {{ Auth::guard('customer')->user()->nama ?? 'Profil' }}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    @elseif (Auth::guard('admin')->check())
        @include('include.header_admin')
    @else
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-3 fixed-top"
            style="font-family: 'Montserrat', sans-serif;">
            <div class="container">
                <a class="navbar-brand" href="{{ route('landing.show') }}">
                    <img src="{{ asset('Images/LogoBersihIn.png') }}" alt="Logo BersihIn" class="logo"
                        style="height: 40px;">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                    aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation"
                    style="border: none; box-shadow: none; color: #014A3F;">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center">
                        <li class="nav-item">
                            <a class="nav-link mx-lg-3 my-2 my-lg-0" href="{{ route('landing.show') }}"
                                style="color:#014A3F; font-weight: 700; font-size: clamp(16px, 2vw, 20px);">Beranda</a>
                        </li>
                        <li class="nav-item"> {{-- Corrected: Added nav-item class --}}
                            <a class="nav-link mx-lg-3 my-2 my-lg-0" href="{{ route('aboutus.show') }}"
                                style="color:#014A3F; font-weight: 700; font-size: clamp(16px, 2vw, 20px);">Tentang
                                Kami</a>
                        </li>
                        <li class="nav-item dropdown my-2 my-lg-0">
                            <a class="nav-link mx-lg-3 dropdown-toggle" href="#" id="servicesDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false"
                                style="color:#014A3F; font-weight: 700; font-size: clamp(16px, 2vw, 20px);">
                                Layanan
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="servicesDropdown">
                                <li><a class="dropdown-item"
                                        href="{{ route('layanan_customer.show', ['kategori' => 'cleaning', 'category_id' => 'C01']) }}">Cleaning</a>
                                </li>
                                <li><a class="dropdown-item"
                                        href="{{ route('layanan_customer.show', ['kategori' => 'disinfection', 'category_id' => 'C04']) }}">Disinfection</a>
                                </li>
                                <li><a class="dropdown-item"
                                        href="{{ route('layanan_customer.show', ['kategori' => 'laundry', 'category_id' => 'C02']) }}">Laundry</a>
                                </li>
                                <li><a class="dropdown-item"
                                        href="{{ route('layanan_customer.show', ['kategori' => 'maintenance', 'category_id' => 'C03']) }}">Maintenance</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item d-flex align-items-center my-2 my-lg-0">
                            <a href="{{ route('login.show') }}" class="mx-lg-3 text-decoration-none">
                                <span class="d-none d-lg-inline">
                                    <i class="fa-solid fa-cart-shopping"
                                        style="color: #014A3F; font-size: clamp(18px, 2vw, 20px);"></i>
                                </span>
                                <span class="d-lg-none fw-bold"
                                    style="color: #014A3F; font-size: clamp(18px, 2vw, 20px);">
                                    Keranjang
                                </span>
                            </a>
                        </li>
                        <li class="nav-item d-none d-lg-flex align-items-center">
                            <div style="height: 24px; width: 1px; background-color: #A0BC94;"></div>
                        </li>
                        <li class="nav-item my-2 my-lg-0">
                            <a href="{{ route('login.show') }}"
                                class="mx-lg-2 d-inline-block text-decoration-none py-2 px-3"
                                style="background-color: white; color: #014A3F; border:1px solid #A0BC94; border-radius: 5px; font-weight: bold; font-size: clamp(14px, 2vw, 18px);">
                                Masuk
                            </a>
                        </li>
                        <li class="nav-item my-2 my-lg-0">
                            <a href="{{ route('signup.show') }}"
                                class="mx-lg-2 d-inline-block text-decoration-none py-2 px-3"
                                style="background-color: #E0EAB8; color: #014A3F; border:1px solid #2E8656; border-radius: 5px; font-weight: bold; font-size: clamp(14px, 2vw, 18px);">
                                Daftar
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    @endif
@endif
