{{-- ulasan --}}
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
     <h5 style="color: #014A3F; margin-bottom: 20px;"><strong>{{ Auth::guard('customer')->user()->nama ?? 'Customer' }}</strong></h5>
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

        <!-- Konten Daftar Ulasan -->
        <div class="col-12 col-md-8 col-lg-9">
            <div class="bg-white p-4 rounded shadow-sm" style="min-height: 400px;">
                <div class="d-flex align-items-center mb-3">
                    <img src="{{ asset('Images/ulasan.png') }}" style="width: 32px; margin-right: 10px;">
                    <h4 class="text-success mb-0">Ulasan</h4>
                </div>
                <hr>

                <!-- Filter -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="mb-0" style="color: #014A3F; margin-left:15px;"><strong>Ulasan</strong></h5>
                    <select class="form-select w-auto" id="filterSelect" onchange="filterUlasan()" style="border-color: #014A3F; color: #014A3F; margin-right:15px">
                        <option value="semua">Semua</option>
                        <option value="sudah">Sudah Diulas</option>
                        <option value="belum">Belum Diulas</option>
                    </select>
                </div>
                
                @foreach ($orders as $order)
                    @if ($order->ulasan)
                        <div class="card border-success" style="margin:15px;">
                            <div class="card-body">
                                <h6 class="card-title" style="color: #014A3F;"><strong>Order: {{ $order->id }}</strong></h6>
                                <div class="d-flex align-items-center mb-2" style="font-size: 14px;">
                                    <span style="color: #ffc107;">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $order->ulasan->nilai)
                                                ★
                                            @else
                                                ☆
                                            @endif
                                        @endfor
                                    </span>
                                    <span class="ms-2 text-muted" style="font-size: 13px;">({{ number_format($order->ulasan->nilai, 1) }})</span>
                                </div>
                                <p class="card-text text-muted" style="font-size: 14px;">
                                    {{ $order->ulasan->komen }}
                                </p>
                                <p class="text-muted mb-2" style="font-size: 13px;">
                                    Transaksi: {{ \Carbon\Carbon::parse($order->tanggal_jadwal)->format('d M Y • H:i') }} WIB
                                </p>
                            </div>
                        </div>
                    @else
                        <div class="card border-success" style="margin:15px;">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-0" style="color: #014A3F;"><strong>Order: {{ $order->id }}</strong></h6>
                                    <p class="text-muted mb-2" style="font-size: 13px;">
                                        Transaksi: {{ \Carbon\Carbon::parse($order->tanggal_jadwal)->format('d M Y • H:i') }} WIB
                                    </p>
                                    <p class="mb-0 text-muted" style="font-size: 14px;">Belum ada ulasan</p>
                                </div>
                                <a href="#" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#ulasanModal" data-order-id="{{ $order->id }}" >Tulis Ulasan</a>
                            </div>
                        </div>
                    @endif
                @endforeach

            </div>
        </div>
    </div>
</div>
<nav aria-label="Transaction pagination" class="d-flex justify-content-center mt-4">
                    {{ $orders->links() }}
                </nav>
                <style>
                .pagination .page-link { color: #40744E; border: 1px solid #40744E; }
                .pagination .page-item.active .page-link { background-color: #40744E; border-color: #40744E; color: white; }
                .pagination .page-link:hover { background-color: #40744E; color: white; border-color: #40744E; }
                </style>

<!-- Modal Ulasan -->
<div class="modal fade" id="ulasanModal" tabindex="-1" aria-labelledby="ulasanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content rounded-3 border-0 ">
            <div class="modal-header border-0 pb-0">
                <h2 class="modal-title " id="ulasanModalLabel" style="color: #014A3F;"><strong>Ulasan</strong></h2>
                <button type="button" class="btn-close position-absolute end-0 me-3" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="mb-3 text-center fs-4 text-warning" id="bintangContainer">
                @for ($i = 1; $i <= 5; $i++)
                    <i class="bi bi-star" data-rating="{{ $i }}" style="cursor: pointer;"></i>
                @endfor
            </div>

            <div class="mb-3" style="margin-left:10px; margin-right:10px;">
                <textarea class="form-control" id="ulasanTeks" rows="3" placeholder="Apa hal yang ingin Anda ceritakan?"></textarea>
            </div>

            <div class="d-grid" style="margin-left:10px; margin-right:10px; margin-bottom:20px;">
                <button type="button" class="btn text-white" id="submitUlasanBtn" style="background-color: #006838;">Simpan</button>
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

var ulasanModal = document.getElementById('ulasanModal');
ulasanModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget;
    var orderId = button.getAttribute('data-order-id');

    document.getElementById('submitUlasanBtn').setAttribute('data-order-id', orderId);

    resetUlasanModal();
});

function resetUlasanModal() {
    const stars = document.querySelectorAll('#bintangContainer i');
    stars.forEach(star => {
        star.classList.remove('bi-star-fill');
        star.classList.add('bi-star');
    });
    document.getElementById('ulasanTeks').value = '';
}

function submitUlasan() {
    const rating = document.querySelectorAll('#bintangContainer .bi-star-fill').length;
    const reviewText = document.getElementById('ulasanTeks').value.trim();
    const orderId = document.getElementById('submitUlasanBtn').getAttribute('data-order-id');

    if (rating === 0) {
        alert('Harap berikan rating!');
        return;
    }

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch('/ulasan/add', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({
            order_id: orderId,
            nilai: rating,
            komen: reviewText
        })
    })
    .then(async response => {
        const data = await response.json();
        if (!response.ok) {
            alert('Gagal mengirim ulasan: ' + (data.message || 'Terjadi kesalahan'));
            throw new Error(data.message || 'Error response');
        }
        return data;
    })
    .then(data => {
        alert('Ulasan berhasil dikirim!');
        var modalInstance = bootstrap.Modal.getInstance(ulasanModal);
        modalInstance.hide();
        location.reload(); 
    })
    .catch(error => {
        console.error('Fetch error:', error);
    });
}

document.querySelectorAll('#bintangContainer i').forEach(star => {
    star.addEventListener('click', function() {
        const rating = this.getAttribute('data-rating');
        const stars = document.querySelectorAll('#bintangContainer i');

        stars.forEach((s, index) => {
            if (index < rating) {
                s.classList.remove('bi-star');
                s.classList.add('bi-star-fill');
            } else {
                s.classList.remove('bi-star-fill');
                s.classList.add('bi-star');
            }
        });
    });
});

document.getElementById('submitUlasanBtn').addEventListener('click', submitUlasan);
</script>

@endsection
