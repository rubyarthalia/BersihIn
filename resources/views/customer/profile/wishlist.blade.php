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
                    <div class="d-flex justify-content-between align-items-center" style="cursor: pointer;">
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
                    @forelse ($wishlist as $item)
                    <div class="col d-flex justify-content-center">
                        <div class="card h-100 border-success" style="width: 14rem;">
                            <img src="{{ asset('Images/' . $item->service->gambar . '.png') }}" class="card-img-top" alt="{{ $item->service->nama }}">
                            <div class="card-body d-flex flex-column">
                                <h6 class="card-title mb-1" style="color: #014A3F;"><strong>{{ $item->service->nama }}</strong></h6>
                                <p class="text-muted mb-0" style="color: #014A3F;">
                                    Rp{{ number_format($item->service->harga, 0, ',', '.') }} / {{ $item->service->satuan }}
                                </p>
                                <div class="mt-auto text-end pt-2">
                                    <i 
                                        class="fa-heart fa-solid" 
                                        style="cursor: pointer; font-size: 20px; color: #40744E;"
                                        data-service-id="{{ $item->service->id }}"
                                    ></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center text-muted">Belum ada item di wishlist.</div>
                    @endforelse
                </div>
                <nav aria-label="Transaction pagination" class="d-flex justify-content-center mt-4">
                    {{ $wishlist->links() }}
                </nav>
                <style>
                .pagination .page-link {
                    color: #40744E;
                    border: 1px solid #40744E;
                }

                .pagination .page-item.active .page-link {
                    background-color: #40744E;
                    border-color: #40744E;
                    color: white;
                }

                .pagination .page-link:hover {
                    background-color: #40744E;
                    color: white;
                    border-color: #40744E;
                }
            </style>
            </div>
        </div>
    </div>
</div>

@php
    use Illuminate\Support\Facades\Auth;
    $loggedIn = Auth::guard('customer')->check();
@endphp

<script>
function confirmLogout(event) {
    event.preventDefault();
    if (confirm('Apakah Anda yakin ingin keluar?')) {
        document.getElementById('logout-form').submit();
    }
}

const loggedIn = @json($loggedIn);

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.fa-heart').forEach(icon => {
        icon.addEventListener('click', function () {
            if (!loggedIn) {
                alert('Anda harus login terlebih dahulu untuk menggunakan fitur wishlist.');
                return;
            }

            const serviceId = this.getAttribute('data-service-id');
            const token = '{{ csrf_token() }}';
            const iconEl = this;

            fetch('{{ route("wishlist.toggle") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ service_id: serviceId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    iconEl.classList.toggle('fa-solid', data.liked);
                    iconEl.classList.toggle('fa-regular', !data.liked);

                    if (!data.liked) {
                        const card = iconEl.closest('.col');
                        if (card) {
                            card.remove();
                        }
                    }
                } else {
                    alert(data.message || 'Terjadi kesalahan.');
                }
            })
            .catch(() => {
                alert('Gagal menghubungi server.');
            });
        });
    });
});
</script>

@endsection
