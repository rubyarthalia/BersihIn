@extends('base.base')

@section('content')

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

<div class="container mt-5 mb-5" style="font-family: 'Montserrat', sans-serif;">
    <div class="row">
         <!-- Sidebar -->
        <div class="col-12 col-md-4 col-lg-3 mb-4">
    <div id="sidebar" class="p-3" style="position: sticky; overflow-y: auto; background-color: #f5f5f5; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); padding: 20px;">
     <h5 style="color: #014A3F; margin-bottom: 20px;"><strong>Sherin</strong></h5>
                <hr style="margin: 0 0 16px 0;">

                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center" style="cursor: pointer;" onclick="toggleSection('profil')">
                        <strong style="color: #014A3F;">Profil Saya</strong>
                    </div>
                    <ul id="profilSection" class="list-unstyled mt-3 mb-0">
                        <li class="mb-3">
                            <img src="{{ asset('Images/iconuser.png') }}" alt="Biodata Diri" style="width: 24px; height: 24px; margin-right: 5px;">
                            <a href="{{ route('biodata.show') }}" style="color: #014A3F; text-decoration: none;">Biodata Diri</a>
                        </li>
                        <li class="mb-3">
                            <img src="{{ asset('Images/address.png') }}" alt="Daftar Alamat" style="width: 24px; height: 24px; margin-right: 5px;">
                            <a href="{{ route('alamat.show') }}" style="color: #014A3F; text-decoration: none;">Daftar Alamat</a>
                        </li>
                    </ul>
                </div>

                <hr class="mb-3">

                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center" style="cursor: pointer;">
                        <strong style="color: #014A3F;">Aktivitas Saya</strong>
                    </div>
                   <ul id="aktivitasSection" class="list-unstyled mt-3 mb-0">
                        <li class="mb-3">
                            <img src="{{ asset('Images/profileheart.png') }}" alt="Wishlist" style="width: 24px; height: 24px; margin-right: 5px;">
                            <a href="{{ route('wishlist.show') }}" style="color: #014A3F; text-decoration: none;">Wishlist</a>
                        </li>
                        <li class="mb-3">
                            <img src="{{ asset('Images/transaksi.png') }}" alt="Transaksi" style="width: 24px; height: 24px; margin-right: 5px;">
                            <a href="{{ route('transaksi.show') }}" style="color: #014A3F; text-decoration: none;">Transaksi</a>
                        </li>
                        <li class="mb-3">
                            <img src="{{ asset('Images/ulasan.png') }}" alt="Ulasan" style="width: 24px; height: 24px; margin-right: 5px;">
                            <a href="{{ route('ulasan.show') }}" style="color: #014A3F; text-decoration: none;">Ulasan</a>
                        </li>
                    </ul>
                </div>

                <hr class="mb-3">

                <div class="d-flex align-items-center gap-2 mt-4">
                    <img src="{{ asset('Images/logout.png') }}" style="width: 18px;">
                    <a href="#" onclick="confirmLogout(event)" style="color: #dc3545; text-decoration: none;">Log Out</a>
                </div>
            </div>
        </div>

        <!-- Konten Wishlist -->
        <div class="col-12 col-md-8 col-lg-9">
            <div class="bg-white p-4 rounded shadow-sm" style="min-height: 400px;">
                <div class="d-flex align-items-center mb-3">
                    <img src="{{ asset('Images/profileheart.png') }}" style="width: 32px; margin-right: 10px;">
                    <h4 class="text-success mb-0">Wishlist</h4>
                </div>
                <hr>

                <div class="row row-cols-1 row-cols-md-4 g-4 justify-content-center">
                <!-- Item 1 -->
                <div class="col d-flex justify-content-center">
                    <div class="card h-100 border-success" style="width: 14rem;">
                        <img src="{{ asset('Images/laundry-1.png') }}" class="card-img-top" alt="Setrika Pakaian">
                        <div class="card-body d-flex flex-column">
                            <h6 class="card-title mb-1" style="color: #014A3F;"><strong>Setrika Pakaian</strong></h6>
                            <p class="text-muted mb-0" style="color: #014A3F;">Rp50.000/Jam</p>
                            <div class="mt-auto text-end pt-2">
                                <img src="{{ asset('Images/fullheart.png') }}" alt="Wishlist" style="width: 24px;">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Item 2 -->
                <div class="col d-flex justify-content-center">
                    <div class="card h-100 border-success" style="width: 14rem;">
                        <img src="{{ asset('Images/cleaning-10.png') }}" class="card-img-top" alt="Pencucian Bantal dan Guling">
                        <div class="card-body d-flex flex-column">
                            <h6 class="card-title mb-1" style="color: #014A3F;"><strong>Pencucian Bantal dan Guling</strong></h6>
                            <p class="text-muted mb-0" style="color: #014A3F;">Rp40.000/Pasang</p>
                            <div class="mt-auto text-end pt-2">
                                <img src="{{ asset('Images/fullheart.png') }}" alt="Wishlist" style="width: 24px;">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Item 3 -->
                <div class="col d-flex justify-content-center">
                    <div class="card h-100 border-success" style="width: 14rem;">
                        <img src="{{ asset('Images/cleaning-6.png') }}" class="card-img-top" alt="Pembersihan Kolam Renang">
                        <div class="card-body d-flex flex-column">
                            <h6 class="card-title mb-1" style="color: #014A3F;"><strong>Pembersihan Kolam Renang</strong></h6>
                            <p class="text-muted mb-0" style="color: #014A3F;">Rp20.000/Meter persegi</p>
                            <div class="mt-auto text-end pt-2">
                                <img src="{{ asset('Images/fullheart.png') }}" alt="Wishlist" style="width: 24px;">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Item 4 -->
                <div class="col d-flex justify-content-center">
                    <div class="card h-100 border-success" style="width: 14rem;">
                        <img src="{{ asset('Images/maintenance-1.png') }}" class="card-img-top" alt="Cuci AC">
                        <div class="card-body d-flex flex-column">
                            <h6 class="card-title mb-1" style="color: #014A3F;"><strong>Cuci AC</strong></h6>
                            <p class="text-muted mb-0" style="color: #014A3F;">Rp75.000/Unit</p>
                            <div class="mt-auto text-end pt-2">
                                <img src="{{ asset('Images/fullheart.png') }}" alt="Wishlist" style="width: 24px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            </div>
        </div>
    </div>
</div>

<script>
function confirmLogout(event) {
    event.preventDefault();
    if (confirm('Apakah Anda yakin ingin keluar?')) {
        document.getElementById('logout-form').submit();
    }
}
</script>

@endsection
