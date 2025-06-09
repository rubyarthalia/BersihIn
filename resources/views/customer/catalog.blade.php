@php
  $logged_in = session('logged_in', false);
@endphp
@extends('base.base')

@section('content')
<section class="login-section" style="font-family: 'Montserrat', sans-serif; background-color: #f9fdf8; min-height: 50vh; display: flex; flex-direction: column; align-items: center; justify-content: center;">  

    <section 
        style="background-image: url('{{ asset('Images/' . $category->gambar . '.png') }}'); 
               min-height: 50vh; 
               min-width: 100%; 
               margin: 0; 
               background-size: cover; 
               background-position: center;
               display: flex; 
               align-items: center; 
               justify-content: center">
        <div class="container py-5 text-center">
            <h1 class="display-4 fw-bold" style="color:#E0EAB8;">{{ strtoupper($category->nama) }}</h1>
            <p class="fs-5 mt-4 mx-auto text-white" style="max-width: 700px;">{{ $category->deskripsi }}</p>
        </div>
    </section>

    <div class="container mx-5 my-5">
        <div class="row justify-content-center gy-4">
            @foreach($services as $service)
            <div class="col-lg-3 col-md-6 ms-0" style="max-width: 290px; min-width: 290px; ">
                <div class="card mx-auto" style="border:1px solid #2E8656; height: 350px;">
                    <div style="
                        background-image: url('{{ asset('Images/' . $service->gambar . '.png') }}');
                        background-size: cover;
                        background-position: center;
                        height: 200px;
                        position: relative;">
                        <a href="{{ route('produk_detail.show', ['id' => $service->id]) }}" class="btn open-modal-btn" 
                        style="position: absolute; bottom: 10px; left: 10px; background-color: #40744E; color: white; border-radius: 5px; font-size: 14px; font-weight: bold;">
                            Detail
                        </a>
                    </div>
                    <div class="card-body pb-3">
                        <h5 class="mb-1" style="font-size: 16px; font-weight: bold; color:#014A3F;">{{ $service->nama }}</h5>
                        <p class="text-dark mb-3" style="font-size: 14px;">Rp{{ number_format($service->harga, 0, ',', '.') }}/{{ $service->satuan }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <i class="fa-solid fa-cart-shopping open-modal-btn"
                               data-mode="cart"
                               data-id="{{ $service->id }}"
                               data-nama="{{ $service->nama }}"
                               data-harga="{{ $service->harga }}"
                               data-satuan="{{ $service->satuan }}"
                               data-gambar="{{ $service->gambar }}"
                               data-bs-toggle="modal"
                               data-bs-target="#orderModal"
                               style="cursor: pointer; font-size: 20px; color: #014A3F;"></i>
                            <button class="btn py-2 px-4 open-modal-btn"
                                data-mode="order"
                                data-id="{{ $service->id }}"
                                data-nama="{{ $service->nama }}"
                                data-harga="{{ $service->harga }}"
                                data-satuan="{{ $service->satuan }}"
                                data-gambar="{{ $service->gambar }}"
                                data-bs-toggle="modal"
                                data-bs-target="#orderModal"
                                style="background-color: #40744E; color: white; border-radius: 5px; font-size: 14px; font-weight: bold;">
                                Pesan Sekarang
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <nav aria-label="Transaction pagination" class="d-flex justify-content-center mt-4">
                    {{ $services->links() }}
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

    <!-- Modal -->
    <div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-center w-100" id="orderModalLabel" style="font-weight: bold;">Detail Pesanan</h1>
                    <button type="button" class="btn-close position-absolute end-0 me-3" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="section-tanggal-jam">
                        <p class="fw-bold">Tanggal</p>
                        <div class="d-flex flex-wrap gap-2 mb-3" id="tanggalOptions"></div>

                        <p class="fw-bold">Jam</p>
                        <div class="d-flex flex-wrap gap-2 mb-3" id="jamOptions"></div>
                    </div>

                    <p class="fw-bold">Jumlah</p>
                    <div id="quantity-container" class="d-flex align-items-center border rounded" style="width: fit-content;">
                        <button onclick="decreaseQty()" style="width: 40px; height: 40px; border: none; background: white; font-size: 20px; color: #014A3F;">−</button>
                        <input id="qty-input" type="text" value="1" class="form-control text-center" style="width: 50px; border: none;">
                        <button onclick="increaseQty()" style="width: 40px; height: 40px; border: none; background: white; font-size: 20px; color: #014A3F;">+</button>
                    </div>
                </div>
                <div class="modal-footer">
                    @auth('customer')
                        <button id="modalActionBtn" class="btn btn-success w-100">Pesan Sekarang</button>
                    @else
                        <button class="btn btn-secondary w-100" disabled>Login terlebih dahulu</button>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <script>
    let modalMode = 'order';
    let selectedService = {};

    document.querySelectorAll('.open-modal-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            selectedService = {
                id: btn.dataset.id,
                nama: btn.dataset.nama,
                harga: btn.dataset.harga,
                satuan: btn.dataset.satuan,
                gambar: btn.dataset.gambar
            };
            modalMode = btn.dataset.mode;
            document.getElementById('modalActionBtn').textContent = modalMode === 'cart' ? 'Tambah ke Keranjang' : 'Pesan Sekarang';

            const sectionTanggalJam = document.getElementById('section-tanggal-jam');
            if (modalMode === 'cart') {
                sectionTanggalJam.style.display = 'none';
            } else {
                sectionTanggalJam.style.display = 'block';
            }
        });
    });


    document.getElementById('modalActionBtn')?.addEventListener('click', () => {
        const tanggal = document.querySelector('input[name="tanggalradio"]:checked')?.nextElementSibling?.textContent || '';
        const jam = document.querySelector('input[name="jamradio"]:checked')?.nextElementSibling?.textContent || '';
        const qty = document.getElementById('qty-input').value;

        const url = new URL("{{ route('order.show') }}");
        Object.entries(selectedService).forEach(([key, val]) => url.searchParams.append(key, val));
        url.searchParams.append("tanggal", tanggal);
        url.searchParams.append("jam", jam);
        url.searchParams.append("qty", qty);

        if (modalMode === 'cart') {
            fetch("{{ route('cart.add') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    service_id: selectedService.id,
                    jumlah: qty
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    alert(data.success);
                } else {
                    alert(data.error || "Gagal menambahkan ke keranjang.");
                }
            });
        } else {
            window.location.href = url.toString();
        }
    });

    const tanggalContainer = document.getElementById('tanggalOptions');
    const hariList = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
    const today = new Date();
    for (let i = 1; i <= 7; i++) {
        const date = new Date(today);
        date.setDate(today.getDate() + i);
        const label = `${hariList[date.getDay()]}, ${date.getDate()} ${date.toLocaleString('default', { month: 'long' })}`;
        const id = `btnradio${i}`;
        tanggalContainer.innerHTML += `<input type="radio" class="btn-check" name="tanggalradio" id="${id}" autocomplete="off" ${i === 1 ? 'checked' : ''}>
            <label class="btn radio-btn-custom" for="${id}">${label}</label>`;
    }

    const jamContainer = document.getElementById('jamOptions');
    for (let j = 9; j <= 19; j++) {
        const label = `${j.toString().padStart(2, '0')}.00`;
        const id = `jamradio${j}`;
        jamContainer.innerHTML += `<input type="radio" class="btn-check" name="jamradio" id="${id}" autocomplete="off" ${j === 9 ? 'checked' : ''}>
            <label class="btn radio-btn-custom" for="${id}">${label}</label>`;
    }

    function increaseQty() {
        const input = document.getElementById('qty-input');
        const val = parseInt(input.value) || 1;
        input.value = val + 1;
    }
    function decreaseQty() {
        const input = document.getElementById('qty-input');
        const val = parseInt(input.value) || 1;
        if (val > 1) input.value = val - 1;
    }
    </script>

    <style>
    .radio-btn-custom {
        min-width: 120px;
        text-align: center;
        font-size: 15px;
        border-radius: 5px;
        font-family: 'Hind', sans-serif;
        color: #014A3F;
        background-color: white;
        border: 1px solid #014A3F;
        transition: all 0.2s ease;
    }
    .btn-check:checked + .radio-btn-custom {
        background-color: #014A3F !important;
        color: white !important;
        border: 1px solid #014A3F;
    }
    </style>

</section>
@endsection
