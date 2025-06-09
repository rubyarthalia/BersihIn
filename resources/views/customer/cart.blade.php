@extends('base.base')

@section('content')
<div style="max-width: 800px; margin: 0 auto; font-family: 'Montserrat', sans-serif; padding: 16px; position: relative;">

    <div style="font-weight: bold; cursor: pointer; font-size: 24px; color: #014A3F; margin-bottom:10px">
        <i class="fa-solid fa-cart-shopping"></i> Keranjang
    </div> 

    @php $total = 0; @endphp

    @foreach($cartItems as $item)
        @php
            $subtotal = $item->jumlah * $item->service->harga;
            $total += $subtotal;
        @endphp

        <div class="cart-item" data-id="{{ $item->id }}" style="display: flex; align-items: center; gap: 10px; margin-bottom: 16px;">
            {{-- <i class="check-icon fa-solid fa-square-check" data-checked="true" data-price="{{ $subtotal }}" style="cursor: pointer; color: #2E8656; font-size: 20px;"></i> --}}

            <div style="background-color: white; border: 1px solid #e0e0e0; border-radius: 8px; padding: 16px; flex: 1; display: flex; flex-direction: column; justify-content: space-between; height: 100%;">

                <div style="display: flex; gap: 12px;">
                    <div style="flex-shrink: 0;">
                        <img src="{{ asset('Images/' . $item->service->gambar . '.png') }}" alt="{{ $item->service->nama }}" style="width: 150px; height: auto; border-radius: 8px; object-fit: cover;">
                    </div>

                    <div style="flex: 1; display: flex; flex-direction: column; justify-content: space-between;">
                        <div>
                            <h2 style="font-size: 20px; color: #014A3F; margin-bottom: 4px; font-weight: bold;">
                                {{ $item->service->nama }}
                            </h2>
                            <p style="font-size: 16px; color: #014A3F; margin-bottom: 12px;">
                                Rp{{ number_format($item->service->harga, 0, ',', '.') }}/Unit
                            </p>
                        </div>
                        <div style="display: flex; align-items: center; justify-content: space-between; margin-top: 12px;">

                            <div style="display: flex; align-items: center; gap: 8px;">
                                <span style="font-weight: 600; font-size: 16px; color: #014A3F;">Jumlah Unit:</span>
                                <div class="quantity-container" data-id="{{ $item->id }}" style="display: flex; gap: 0px; border: 1px solid #ddd; border-radius: 4px; overflow: hidden; align-items: center;">
                                    <button class="decrease-qty" style="width: 32px; height: 32px; border: none; background: white; font-size: 18px; cursor: pointer;">-</button>
                                    <input class="qty-input" type="text" value="{{ $item->jumlah }}" style="color: #014A3F; width: 40px; text-align: center; font-weight: bold; border: none; outline: none;" inputmode="numeric" pattern="[0-9]*" readonly>
                                    <button class="increase-qty" style="width: 32px; height: 32px; border: none; background: white; font-size: 18px; cursor: pointer;">+</button>
                                </div>
                            </div>

                            <div class="item-subtotal" style="font-weight: bold; font-size: 20px; color: #014A3F;">
                                Subtotal: Rp{{ number_format($subtotal, 0, ',', '.') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <div style="display: flex; justify-content: flex-end; margin-bottom: 90px; margin-top: 75px;">
        <div style="padding: 16px; text-align: right; border: 1px solid #2E8656; border-radius: 10px; max-width: 350px; width: 100%;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                <span style="font-size: 16px; font-weight: bold; color: #014A3F;">Total</span>
                <span id="total-price" style="font-size: 18px; font-weight: bold; color: #014A3F;">
                    Rp{{ number_format($total, 0, ',', '.') }}
                </span>
            </div>
            <button type="button" class="btn btn-primary w-100" style="background-color: #014A3F; border: none;" data-bs-toggle="modal" data-bs-target="#orderModal">
                Checkout Sekarang
            </button>
        </div>
    </div>
</div>

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
document.addEventListener('DOMContentLoaded', () => {
    updateTotalPrice();

    document.querySelectorAll('.increase-qty').forEach(button => {
        button.addEventListener('click', function () {
            const container = this.closest('.quantity-container');
            const input = container.querySelector('.qty-input');
            let qty = parseInt(input.value);
            qty++;
            input.value = qty;

            updateSubtotal(container.dataset.id, qty);
        });
    });

    document.querySelectorAll('.decrease-qty').forEach(button => {
        button.addEventListener('click', function () {
            const container = this.closest('.quantity-container');
            const input = container.querySelector('.qty-input');
            let qty = parseInt(input.value);

            const cartItem = container.closest('.cart-item');

            if (qty > 1) {
                qty--;
                input.value = qty;
                updateSubtotal(container.dataset.id, qty);
            } else {
                if (confirm("Apakah Anda ingin menghapus produk ini dari keranjang?")) {
                    const cartItemId = container.dataset.id;

                    fetch('/cart/delete-item', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ cart_item_id: cartItemId })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            cartItem.remove();
                            updateTotalPrice();
                        } else {
                            alert('Gagal menghapus item dari keranjang.');
                        }
                    })
                    .catch(() => {
                        alert('Terjadi kesalahan saat menghapus item.');
                    });
                }
            }
        });
    });
});

function updateSubtotal(cartItemId, qty) {
    fetch('/cart/update-quantity', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            cart_item_id: cartItemId,
            jumlah: qty
        })
    }).then(response => response.json())
    .then(data => {
        if (data.success) {
            const container = document.querySelector(`.quantity-container[data-id='${cartItemId}']`);
            const itemWrapper = container.closest('.cart-item');
            const subtotalElem = itemWrapper.querySelector('.item-subtotal');
            subtotalElem.textContent = 'Subtotal: Rp' + data.subtotal_formatted;


            updateTotalPrice();
        } else {
            alert('Gagal update quantity');
        }
    }).catch(() => {
        alert('Terjadi kesalahan saat mengupdate quantity.');
    });
}

function updateTotalPrice() {
    let total = 0;
    document.querySelectorAll('.item-subtotal').forEach(subtotalElem => {
        const text = subtotalElem.textContent;
        const rupiah = text.replace(/[^0-9]/g, ''); 
        const price = parseInt(rupiah) || 0;
        total += price;
    });

    const totalPriceElem = document.getElementById('total-price');
    if (totalPriceElem) {
        totalPriceElem.textContent = 'Rp' + total.toLocaleString('id-ID');
    }
}

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
    document.addEventListener('DOMContentLoaded', function () {
    const checkoutButton = document.querySelector('button[data-bs-target="#orderModal"]');
    const modal = new bootstrap.Modal(document.getElementById('orderModal'));

    checkoutButton.addEventListener('click', function (e) {
        e.preventDefault();
        modal.show();
    });

    document.getElementById('modalActionBtn').addEventListener('click', function () {
        const selectedTanggal = document.querySelector('input[name="tanggalradio"]:checked');
        const selectedJam = document.querySelector('input[name="jamradio"]:checked');

        if (!selectedTanggal || !selectedJam) {
            alert('Silakan pilih tanggal dan jam terlebih dahulu.');
            return;
        }

        const tanggalLabel = document.querySelector(`label[for="${selectedTanggal.id}"]`).textContent.trim();
        const jamLabel = document.querySelector(`label[for="${selectedJam.id}"]`).textContent.trim();

        const url = new URL("{{ route('order.show') }}", window.location.origin);
        url.searchParams.append('tanggal', tanggalLabel);
        url.searchParams.append('jam', jamLabel);
        window.location.href = url.toString();
    });
});
</script><style>
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
