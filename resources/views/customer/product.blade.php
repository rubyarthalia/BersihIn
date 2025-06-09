@php
    use Illuminate\Support\Facades\Auth;
    $logged_in = Auth::guard('customer')->check();
@endphp

@extends('base.base')

@section('content')
<div style="display: flex; font-family: 'Montserrat', sans-serif; justify-content: center; align-items: flex-start; margin-top: 40px; margin-bottom: 30px; flex-wrap: wrap; gap: 0px;">
    <div style="flex: 1; max-width: 500px;">
        <img src="{{ asset('Images/' . $service->gambar . '.png') }}" alt="{{ $service->nama }}" style="
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
            {{-- Heart Icon untuk wishlist --}}
            <i id="heartIcon" 
               class="fa-heart {{ $isLiked ? 'fa-solid' : 'fa-regular' }}" 
               style="cursor: pointer; font-size: 20px; color: #40744E;" 
               data-service-id="{{ $service->id }}">
            </i>

            {{-- Tombol Tambah ke Keranjang --}}
            <a href="#" class="btn px-5 open-modal-btn" style="
                background-color: white; 
                color: #40744E; 
                border-radius: 5px;
                font-size: 15px;
                font-weight: bold;
                border:1px solid #2E8656;
                padding: 8px 12px;
                font-family: 'Hind', sans-serif;"
                data-mode="cart"
                data-id="{{ $service->id }}"
                data-nama="{{ $service->nama }}"
                data-harga="{{ $service->harga }}"
                data-satuan="{{ $service->satuan }}"
                data-gambar="{{ $service->gambar }}"
                data-bs-toggle="modal"
                data-bs-target="#orderModal">
                <i class="fa-solid fa-cart-shopping mx-1" style="cursor: pointer; font-size: 13px; color: #014A3F;"></i>
                Tambah ke Keranjang
            </a>

            {{-- Tombol Pesan Sekarang --}}
            <a href="#" class="btn px-5 open-modal-btn" style="
                background-color: #40744E; 
                color: white; 
                border-radius: 5px;
                font-size: 15px;
                font-weight: bold;
                margin-right: 5px;
                padding: 8px 16px;
                font-family: 'Hind', sans-serif;"
                data-mode="order"
                data-id="{{ $service->id }}"
                data-nama="{{ $service->nama }}"
                data-harga="{{ $service->harga }}"
                data-satuan="{{ $service->satuan }}"
                data-gambar="{{ $service->gambar }}"
                data-bs-toggle="modal"
                data-bs-target="#orderModal">
                Pesan Sekarang
            </a>
        </div>
    </div>
</div>

<script>
let modalMode = 'order';
let selectedService = {};
const loggedIn = @json($logged_in);

document.addEventListener('DOMContentLoaded', function () {
    // Wishlist toggle icon
    const heartIcon = document.getElementById('heartIcon');
    if (heartIcon) {
        heartIcon.addEventListener('click', function () {
            if (!loggedIn) {
                alert('Anda harus login terlebih dahulu untuk menggunakan fitur wishlist.');
                return;
            }

            const serviceId = this.getAttribute('data-service-id');
            const token = '{{ csrf_token() }}';
            const icon = this;

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
                    icon.classList.toggle('fa-solid', data.liked);
                    icon.classList.toggle('fa-regular', !data.liked);
                } else {
                    alert(data.message || 'Terjadi kesalahan.');
                }
            })
            .catch(() => {
                alert('Gagal menghubungi server.');
            });
        });
    }

    // Saat tombol open modal ditekan
    document.querySelectorAll('.open-modal-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            // Ambil data service dari atribut data-*
            selectedService = {
                id: btn.dataset.id,
                nama: btn.dataset.nama,
                harga: btn.dataset.harga,
                satuan: btn.dataset.satuan,
                gambar: btn.dataset.gambar
            };
            modalMode = btn.dataset.mode;

            // Update tombol modal sesuai mode
            const modalActionBtn = document.getElementById('modalActionBtn');
            if (modalMode === 'cart') {
                modalActionBtn.textContent = 'Tambah ke Keranjang';
                modalActionBtn.classList.remove('btn-primary');
                modalActionBtn.classList.add('btn-success');
            } else {
                modalActionBtn.textContent = 'Pesan Sekarang';
                modalActionBtn.classList.remove('btn-success');
                modalActionBtn.classList.add('btn-primary');
            }
        });
    });

    // Handler tombol di modal
    const modalActionBtn = document.getElementById('modalActionBtn');
    modalActionBtn?.addEventListener('click', () => {
        if (!loggedIn) {
            alert('Silakan login terlebih dahulu untuk melakukan aksi ini.');
            return;
        }

        const tanggal = document.querySelector('input[name="tanggalradio"]:checked')?.nextElementSibling?.textContent || '';
        const jam = document.querySelector('input[name="jamradio"]:checked')?.nextElementSibling?.textContent || '';
        const qty = document.getElementById('qty-input').value || 1;

        if (modalMode === 'cart') {
            // Tambah ke keranjang via API
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
                    // Bisa ditambah reset modal / close modal jika perlu
                    var modal = bootstrap.Modal.getInstance(document.getElementById('orderModal'));
                    modal.hide();
                } else {
                    alert(data.error || "Gagal menambahkan ke keranjang.");
                }
            })
            .catch(() => {
                alert('Terjadi kesalahan saat menambahkan ke keranjang.');
            });
        } else {
            // Redirect ke halaman order_show dengan query params lengkap
            const url = new URL("{{ route('order.show') }}", window.location.origin);
            Object.entries(selectedService).forEach(([key, val]) => url.searchParams.append(key, val));
            url.searchParams.append("tanggal", tanggal);
            url.searchParams.append("jam", jam);
            url.searchParams.append("qty", qty);
            window.location.href = url.toString();
        }
    });

    // Isi pilihan tanggal (7 hari ke depan)
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

    // Isi pilihan jam (09.00 - 19.00)
    const jamContainer = document.getElementById('jamOptions');
    for (let j = 9; j <= 19; j++) {
        const label = `${j.toString().padStart(2, '0')}.00`;
        const id = `jamradio${j}`;
        jamContainer.innerHTML += `<input type="radio" class="btn-check" name="jamradio" id="${id}" autocomplete="off" ${j === 9 ? 'checked' : ''}>
            <label class="btn radio-btn-custom" for="${id}">${label}</label>`;
    }
});

// Fungsi tambah dan kurang jumlah
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

<!-- Modal -->
<div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-center w-100" id="orderModalLabel" style="font-weight: bold;">Detail Pesanan</h1>
                <button type="button" class="btn-close position-absolute end-0 me-3" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="fw-bold">Tanggal</p>
                <div class="d-flex flex-wrap gap-2 mb-3" id="tanggalOptions"></div>

                <p class="fw-bold">Jam</p>
                <div class="d-flex flex-wrap gap-2 mb-3" id="jamOptions"></div>

                <p class="fw-bold">Jumlah</p>
                <div id="quantity-container" class="d-flex align-items-center border rounded" style="width: fit-content;">
                    <button type="button" onclick="decreaseQty()" style="width: 40px; height: 40px; border: none; background: white; font-size: 20px; color: #014A3F;">−</button>
                    <input id="qty-input" type="text" value="1" class="form-control text-center" style="width: 50px; border: none;">
                    <button type="button" onclick="increaseQty()" style="width: 40px; height: 40px; border: none; background: white; font-size: 20px; color: #014A3F;">+</button>
                </div>
            </div>
            <div class="modal-footer">
                @auth('customer')
                        <button 
                            id="modalActionBtn"
                            class="btn py-2 px-4" 
                            style="background-color: #40744E; color: white; border-radius: 5px; width: 100%; font-size: 14px; font-weight: bold;">
                            Pesan Sekarang
                        </button>
                    @else
                    <button id="modalActionBtn" type="button" class="btn" disabled
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

@endsection
