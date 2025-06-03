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
                            <i class="fa-solid fa-cart-shopping open-modal-btn" data-action="cart" data-bs-toggle="modal" data-bs-target="#staticBackdrop" 
                               style="cursor: pointer; font-size: 20px; color: #014A3F;"></i>
                            <button class="btn py-2 px-4 open-modal-btn" data-action="order" data-bs-toggle="modal" data-bs-target="#staticBackdrop" 
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

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-center w-100" id="staticBackdropLabel" style="font-weight: bold;">Detail Pesanan</h1>
                    <button type="button" class="btn-close position-absolute end-0 me-3" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p style="font-size: 15px; font-family: 'Hind', sans-serif; font-weight: bold;">Tanggal</p>
                    <div class="d-flex flex-wrap gap-2 mb-3" id="tanggalOptions"></div>

                    <p style="font-size: 15px; font-family: 'Hind', sans-serif; font-weight: bold;">Jam</p>
                    <div class="d-flex flex-wrap gap-2 mb-3" id="jamOptions"></div>

                    <p style="font-size: 15px; font-family: 'Hind', sans-serif; font-weight: bold;">Jumlah</p>
                    <div id="quantity-container" style="margin-top: 12px; display: flex; align-items: center; border: 1px solid #ddd; border-radius: 4px; overflow: hidden; width: fit-content;">
                        <button onclick="decreaseQty()" id="btn-minus" style="width: 40px; height: 40px; border: none; background: white; font-size: 20px; font-weight: bold; color: #014A3F; cursor: pointer;">−</button>
                        <input id="qty-input" type="text" value="1" style="color: #014A3F; width: 50px; height: 40px; text-align: center; font-weight: bold; border: none; outline: none; font-size: 16px;" inputmode="numeric" pattern="[0-9]*">
                        <button onclick="increaseQty()" id="btn-plus" style="width: 40px; height: 40px; border: none; background: white; font-size: 20px; font-weight: bold; color: #014A3F; cursor: pointer;">+</button>
                    </div>
                </div>

               <div class="modal-footer">
                    @if ($logged_in)
                    <button id="simpanBtn" type="button" class="btn" style="font-family: 'Hind', sans-serif; color: white; background-color: #014A3F; width: 100%; border: 1px solid #014A3F;">
                        Simpan
                    </button>
                    @else
                    <button id="simpanBtn" type="button" class="btn" disabled
                        style="font-family: 'Hind', sans-serif; color: white; background-color: grey; width: 100%; border: 1px solid #014A3F;"
                        title="Anda harus login terlebih dahulu untuk menyimpan pesanan.">
                        Anda harus login terlebih dahulu untuk menyimpan pesanan
                    </button>
                    @endauth
                </div>

            </div>
        </div>
    </div>

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

    <script>
    let actionType = '';

    document.querySelectorAll('.open-modal-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            actionType = btn.getAttribute('data-action');
        });
    });

    const tanggalContainer = document.getElementById('tanggalOptions');
    const hariList = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
    const today = new Date();
    for (let i = 1; i <= 7; i++) {
        const date = new Date(today);
        date.setDate(today.getDate() + i);
        const dayName = hariList[date.getDay()];
        const label = `${dayName}, ${date.getDate()} ${date.toLocaleString('default', { month: 'long' })}`;
        const radioId = `btnradio${i}`;
        const checked = i === 1 ? 'checked' : '';
        tanggalContainer.innerHTML += `
            <input type="radio" class="btn-check" name="tanggalradio" id="${radioId}" autocomplete="off" ${checked}>
            <label class="btn radio-btn-custom" for="${radioId}">${label}</label>
        `;
    }

    const jamContainer = document.getElementById('jamOptions');
    for (let jam = 9; jam <= 19; jam++) {
        const label = `${jam.toString().padStart(2, '0')}.00`;
        const radioId = `jamradio${jam}`;
        const checked = jam === 9 ? 'checked' : '';
        jamContainer.innerHTML += `
            <input type="radio" class="btn-check" name="jamradio" id="${radioId}" autocomplete="off" ${checked}>
            <label class="btn radio-btn-custom" for="${radioId}">${label}</label>
        `;
    }

    let maxQty = 11;
    function getSelectedJam() {
        const selectedJamRadio = document.querySelector('input[name="jamradio"]:checked');
        return parseInt(selectedJamRadio?.id.replace('jamradio', '') || '9');
    }
    function updateMaxQty() {
        const jam = getSelectedJam();
        const max = 20 - jam;
        maxQty = max;
        const input = document.getElementById('qty-input');
        if (parseInt(input.value) > maxQty) {
            input.value = maxQty;
        }
    }
    document.querySelectorAll('input[name="jamradio"]').forEach(radio => {
        radio.addEventListener('change', updateMaxQty);
    });

    function increaseQty() {
        const input = document.getElementById('qty-input');
        let current = parseInt(input.value) || 1;
        if (current < maxQty) {
            input.value = current + 1;
        }
    }

    function decreaseQty() {
        const input = document.getElementById('qty-input');
        let current = parseInt(input.value) || 1;
        if (current > 1) {
            input.value = current - 1;
        }
    }

    document.getElementById('simpanBtn').addEventListener('click', () => {
        console.log('Action Type:', actionType);
        if (actionType === 'cart') {
            window.location.href = "{{ route('cart.show') }}";
        } else if (actionType === 'order') {
            window.location.href = "{{ route('order.show') }}";
        } else {
            alert('Aksi tidak diketahui.');
        }
    });
    </script>

</section>
@endsection
