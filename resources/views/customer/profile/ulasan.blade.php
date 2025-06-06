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
                    <h5 class="mb-0" style="color: #014A3F;"><strong>Ulasan</strong></h5>
                    <select class="form-select w-auto" id="filterSelect" onchange="filterUlasan()" style="border-color: #014A3F; color: #014A3F;">
                        <option value="semua">Semua</option>
                        <option value="sudah">Sudah Diulas</option>
                        <option value="belum">Belum Diulas</option>
                    </select>
                </div>

                <!-- Sudah Diulas -->
                <div id="sudahDiulas" class="d-flex flex-column gap-3 mb-4">
                    <div class="card border-success">
                        <div class="card-body">
                            <h6 class="card-title" style="color: #014A3F;"><strong>Setrika Pakaian</strong></h6>
                            <div class="d-flex align-items-center mb-2" style="font-size: 14px;">
                                <span style="color: #ffc107;">★★★★★</span>
                                <span class="ms-2 text-muted" style="font-size: 13px;">(5.0)</span>
                            </div>
                            <p class="card-text text-muted" style="font-size: 14px;">
                                Sangat puas dengan pelayanannya! Pekerja datang tepat waktu dan hasilnya sangat rapi.
                            </p>
                            <p class="text-muted mb-2" style="font-size: 13px;">Transaksi: 10 Mei 2025</p>
                        </div>
                    </div>
                </div>

                <!-- Belum Diulas -->
                <div id="belumDiulas" class="d-flex flex-column gap-3" style="display: none;">
                    <div class="card border-secondary">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-0" style="color: #014A3F;"><strong>Cuci Sofa</strong></h6>
                                <p class="text-muted mb-2" style="font-size: 13px;">Transaksi: 12 Mei 2025</p>
                                <p class="mb-0 text-muted" style="font-size: 14px;">Belum ada ulasan</p>
                            </div>
                            <a href="#" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#ulasanModal">Tulis Ulasan</a>
                        </div>
                    </div>
                    <div class="card border-secondary">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-0" style="color: #014A3F;"><strong>Pembersihan Karpet</strong></h6>
                                <p class="text-muted mb-2" style="font-size: 13px;">Transaksi: 13 Mei 2025</p>
                                <p class="mb-0 text-muted" style="font-size: 14px;">Belum ada ulasan</p>
                            </div>
                            <a href="#" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#ulasanModal">Tulis Ulasan</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Ulasan -->
<div class="modal fade" id="ulasanModal" tabindex="-1" aria-labelledby="ulasanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-3 border-0">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title mx-auto" id="ulasanModalLabel" style="color: #014A3F;"><strong>Ulasan</strong></h5>
                <button type="button" class="btn-close position-absolute end-0 me-3" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-0">
                <div class="d-flex align-items-center mb-3">
                    <img src="{{ asset('Images/cleaning-2.png') }}" alt="Cuci Sofa" class="rounded me-3" width="60" height="60">
                    <div>
                        <h6 class="mb-1" style="color: #014A3F;"><strong>Cuci Sofa</strong></h6>
                        <p class="mb-0 text-muted" style="font-size: 14px;">2 Unit</p>
                    </div>
                </div>

                <div class="mb-3 text-center fs-4 text-warning" id="bintangContainer">
                    @for ($i = 1; $i <= 5; $i++)
                        <i class="bi bi-star" data-rating="{{ $i }}" style="cursor: pointer;"></i>
                    @endfor
                </div>

                <div class="mb-3">
                    <textarea class="form-control" id="ulasanTeks" rows="3" placeholder="Apa hal yang ingin Anda ceritakan?"></textarea>
                </div>

                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="anonimCheck">
                    <label class="form-check-label" for="anonimCheck">
                        Anonim
                    </label>
                </div>

                <div class="d-grid">
                    <button type="button" class="btn text-white" style="background-color: #006838;" onclick="submitUlasan()">Simpan</button>
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

function filterUlasan() {
    const filter = document.getElementById('filterSelect').value;
    const sudahDiulas = document.getElementById('sudahDiulas');
    const belumDiulas = document.getElementById('belumDiulas');

    if (filter === 'semua') {
        sudahDiulas.style.display = 'flex';
        belumDiulas.style.display = 'flex';
    } else if (filter === 'sudah') {
        sudahDiulas.style.display = 'flex';
        belumDiulas.style.display = 'none';
    } else if (filter === 'belum') {
        sudahDiulas.style.display = 'none';
        belumDiulas.style.display = 'flex';
    }
}

// Rating stars functionality
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

function submitUlasan() {
    const rating = document.querySelectorAll('#bintangContainer .bi-star-fill').length;
    const reviewText = document.getElementById('ulasanTeks').value;
    const isAnonymous = document.getElementById('anonimCheck').checked;

    if (rating === 0) {
        alert('Harap berikan rating!');
        return;
    }

    console.log({
        rating,
        reviewText,
        isAnonymous
    });

    const modal = bootstrap.Modal.getInstance(document.getElementById('ulasanModal'));
    modal.hide();

    alert('Ulasan berhasil dikirim!');
}
</script>
@endsection
