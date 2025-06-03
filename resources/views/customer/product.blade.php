@php
  $logged_in = session('logged_in', false);
@endphp
@extends('base.base')

@section('content')
<div style="display: flex;font-family: 'Montserrat', sans-serif; justify-content: center; align-items: flex-start; margin-top: 40px; margin-bottom: 30px; flex-wrap: wrap; gap: 0px;">
    <div style="flex: 1; max-width: 500px;">
        <img src="{{ asset('Images/' . $service->gambar . '.png') }}" alt="{{ $service->name }}" style="
            width: 400px;
            height: auto;
            border-radius: 8px;
            object-fit: cover;
        ">
    </div>

    <div class="service-card" style="
        flex: 1;
        min-width: 500px;
        max-width: 500px;
        padding: 20px;
        border-radius: 8px;
        color: #014A3F;
        background-color: transparent;
    ">
        <h2 style="font-size: 24px; font-family: 'Montserrat', sans-serif; margin-bottom: 2px; font-weight: bold;">
            {{ $service->nama }}
        </h2>
        <p style="font-size: 15px; font-family: 'Montserrat', sans-serif; margin-bottom: 5px;">
            Rp{{ number_format($service->harga, 0, ',', '.') }}/{{ $service->satuan }}
        </p>
        <p style="font-size: 20px; font-family: 'Montserrat', sans-serif; color: #107535; margin-bottom: 5px; font-weight: bold;">Deskripsi</p>
        <p style="font-size: 14px; font-family: 'Hind', sans-serif; margin-bottom: 1px;">
            {{ $service->kalimat_promosi }}
        </p>

        <ul style="font-size: 14px; font-family: 'Hind', sans-serif; padding-left: 20px; margin-bottom: 20px;">
            @foreach (explode('.', $service->deskripsi) as $item)
                @php $item = trim($item); @endphp
                @if(!empty($item))
                    <li style="margin-bottom: 8px;">{{ $item }}.</li>
                @endif
            @endforeach
        </ul>

        <div style="display: flex; justify-content: flex-start; align-items: center; gap: 10px; width: 100%; min-width: 600px; max-width: 600px;">
            <i id="heartIcon" class="fa-regular fa-heart" style="cursor: pointer; font-size: 20px; color: #40744E;"></i>
            <a href="#" class="btn px-5" style="
                background-color: white; 
                color: #40744E; 
                border-radius: 5px;
                font-size: 15px;
                font-weight: bold;
                border:1px solid #2E8656;
                padding: 8px 12px;
                font-family: 'Hind', sans-serif;"
                onclick="actionType = 'cart';"
                data-bs-toggle="modal"
                data-bs-target="#staticBackdrop">
                <i class="fa-solid fa-cart-shopping mx-1" style="cursor: pointer; font-size: 13px; color: #014A3F;">  </i>
                Tambah ke Keranjang
            </a>
            <a href="#" class="btn px-5" style="
                background-color: #40744E; 
                color: white; 
                border-radius: 5px;
                font-size: 15px;
                font-weight: bold;
                margin-right: 5px;
                padding: 8px 16px;
                font-family: 'Hind', sans-serif;"
                onclick="actionType = 'order';"
                data-bs-toggle="modal"
                data-bs-target="#staticBackdrop">
                Pesan Sekarang
            </a>
        </div>
    </div>
</div>

<!-- MODAL -->
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
const heart = document.getElementById('heartIcon');
heart.addEventListener('click', () => {
    heart.classList.toggle('fa-regular');
    heart.classList.toggle('fa-solid');
});

document.getElementById('simpanBtn').addEventListener('click', () => {
    if (actionType === 'cart') {
        window.location.href = "{{ route('cart.show') }}";
    } else if (actionType === 'order') {
        window.location.href = "{{ route('order.show') }}";
    }
});
</script>

@endsection
