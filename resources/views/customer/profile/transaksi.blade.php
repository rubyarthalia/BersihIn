{{-- transaksi --}}
@extends('base.base')

@section('content')
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

<div class="container mt-5 mb-5" style="font-family: 'Montserrat', sans-serif;">
    <div class="row">
        <div class="col-12 col-md-4 col-lg-3 mb-4">
            <div id="sidebar" class="p-3" style="position: sticky; top: 20px; overflow-y: auto; background-color: #f5f5f5; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); padding: 20px;">
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

        <div class="col-12 col-md-8 col-lg-9">
            <div class="bg-white p-4 rounded shadow-sm">
                <div class="d-flex align-items-center mb-3">
                    <img src="{{ asset('Images/transaksi.png') }}" style="width: 32px; margin-right: 10px;">
                    <h4 class="text-success mb-0">Transaksi</h4>
                </div>
                <hr>
                   <form method="GET" action="{{ route('transaksi.show') }}">
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select id="status" name="status" class="form-select" onchange="this.form.submit()">
                                <option value="semua" {{ ($statusFilter ?? 'semua') == 'semua' ? 'selected' : '' }}>Semua Status</option>
                                <option value="Belum Dilaksanakan" {{ ($statusFilter ?? '') == 'Belum Dilaksanakan' ? 'selected' : '' }}>Belum Dilaksanakan</option>
                                <option value="Selesai" {{ ($statusFilter ?? '') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="date" class="form-label">Tanggal</label>
                            <select id="date" name="date" class="form-select" onchange="this.form.submit()">
                                <option value="semua" {{ ($dateFilter ?? 'semua') == 'semua' ? 'selected' : '' }}>Semua Tanggal</option>
                                <option value="hari-ini" {{ ($dateFilter ?? '') == 'hari-ini' ? 'selected' : '' }}>Hari Ini</option>
                                <option value="minggu-ini" {{ ($dateFilter ?? '') == 'minggu-ini' ? 'selected' : '' }}>Minggu Ini</option>
                                <option value="bulan-ini" {{ ($dateFilter ?? '') == 'bulan-ini' ? 'selected' : '' }}>Bulan Ini</option>
                            </select>
                        </div>
                    </div>
                </form>
                    <style>
                        body, select, label {
                            font-family: 'Montserrat', sans-serif;
                        }
                        .form-select {
                            border-radius: 0.5rem;
                            box-shadow: 0 0 5px rgba(0,0,0,0.1);
                            transition: box-shadow 0.3s ease;
                        }
                        .form-select:focus {
                            box-shadow: 0 0 8px #014A3F;
                            border-color: #014A3F;
                            outline: none;
                        }
                        label.form-label {
                            font-weight: 600;
                            font-size: 0.9rem;
                            color: #014A3F;
                        }
                        .form-select {
                        border: 1px solid #014A3F;
                        color: #014A3F; 
                        font-weight: 600;
                        background-color: #f9f9f9;
                        transition: box-shadow 0.3s ease, border-color 0.3s ease;
                    }

                    .form-select:focus {
                        border-color: #014A3F;
                        box-shadow: 0 0 8px #014A3F;
                        outline: none;
                    }
                    </style>

                
                <div class="transaction-list">
                    @forelse($orders as $order)
                    <div class="card mb-3 transaction-item" data-status="{{ $order->status_layanan }}" data-date="{{ \Carbon\Carbon::parse($order->tanggal_jadwal)->format('Y-m-d') }}">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h5 class="mb-1" style="color: #014A3F;">
                                        <strong>{{ $order->id }}</strong>
                                    </h5>
                                    <p class="mb-1 text-muted">{{ \Carbon\Carbon::parse($order->tanggal_jadwal)->format('d M Y • H:i') }} WIB</p>

                                    @php
                                        $status = $order->status_layanan;
                                        $badgeClass = '';
                                        if($status == 'Selesai') $badgeClass = 'bg-success';
                                        elseif($status == 'Belum Dilaksanakan') $badgeClass = 'bg-secondary';
                                    @endphp

                                    <span class="badge {{ $badgeClass }}">{{ $status }}</span>
                                </div>
                                <div class="text-end">
                                    <h5 class="mb-2">Rp{{ number_format($order->harga_total, 0, ',', '.') }}</h5>
                                    {{-- Tombol ini sekarang memiliki data-order-id yang akan digunakan oleh JavaScript --}}
                                    <button class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#detailTransaksiModal" data-order-id="{{ $order->id }}">
                                        <i class="bi bi-eye-fill"></i> Detail
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center p-5">
                        <p class="text-muted">Anda belum memiliki riwayat transaksi.</p>
                    </div>
                    @endforelse
                </div>

                <nav aria-label="Transaction pagination" class="d-flex justify-content-center mt-4">
                    {{ $orders->links() }}
                </nav>
                <style>
                .pagination .page-link { color: #40744E; border: 1px solid #40744E; }
                .pagination .page-item.active .page-link { background-color: #40744E; border-color: #40744E; color: white; }
                .pagination .page-link:hover { background-color: #40744E; color: white; border-color: #40744E; }
                </style>
                
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="detailTransaksiModal" tabindex="-1" aria-labelledby="detailTransaksiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailTransaksiModalLabel" style="color: #014A3F;">Detail Transaksi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{-- <div id="modal-loading" class="text-center">
                    <div class="spinner-border text-success" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div> --}}

                <div id="modal-content-wrapper" style="display: none;">
                    <div class="row mb-4">
                        <div class="col-md-8">
                            <h6 class="mb-3" style="color: #014A3F;"><strong>Informasi Transaksi</strong></h6>
                            <table class="table table-sm table-borderless">
                                <tr>
                                    <td width="40%">No. Transaksi</td>
                                    <td><strong id="modal-order-id"></strong></td>
                                </tr>
                                <tr>
                                    <td>Tanggal</td>
                                    <td id="modal-order-date"></td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td><span id="modal-order-status" class="badge"></span></td>
                                </tr>
                                <tr>
                                    <td>Metode Pembayaran</td>
                                    <td id="modal-payment-method"></td>
                                </tr>
                                {{-- <tr>
                                    <td>Cleaner</td>
                                    <td id="modal-cleaner-name"></td>
                                </tr> --}}
                            </table>
                        </div>
                    </div>

                    <h6 class="mb-3" style="color: #014A3F;"><strong>Detail Pesanan</strong></h6>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead style="background-color: #f5f5f5;">
                                <tr>
                                    <th>Layanan</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody id="modal-order-items">
                                </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-end"><strong>Total</strong></td>
                                    <td><strong id="modal-total-price"></strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
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

function toggleSection(sectionId) {
    const section = document.getElementById(sectionId + 'Section');
    if (section) {
        const isClosed = section.style.display === 'none' || section.style.display === '';
        section.style.display = isClosed ? 'block' : 'none';
    }
}



document.addEventListener('DOMContentLoaded', function () {
    const detailModal = document.getElementById('detailTransaksiModal');

    detailModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const orderId = button.getAttribute('data-order-id');

        const modalTitle = detailModal.querySelector('.modal-title');
        const modalContent = document.getElementById('modal-content-wrapper');

        modalTitle.textContent = 'Memuat Detail Transaksi...';
        modalContent.style.display = 'none';
        document.getElementById('modal-order-items').innerHTML = '';

        fetch(`/transaksi/detail/${orderId}`)
            .then(response => {
                if (!response.ok) { throw new Error('Gagal mengambil data'); }
                return response.json();
            })
            .then(data => {
                modalContent.style.display = 'block';
                modalTitle.textContent = 'Detail Transaksi ' + data.id;

                document.getElementById('modal-order-id').textContent = data.id;
                document.getElementById('modal-order-date').textContent = new Date(data.tanggal_jadwal).toLocaleString('id-ID', { dateStyle: 'long', timeStyle: 'short' }) + ' WIB';
                document.getElementById('modal-payment-method').textContent = data.metode_pembayaran || 'N/A';

                const statusBadge = document.getElementById('modal-order-status');
                statusBadge.textContent = data.status_layanan;
                statusBadge.className = 'badge';
                if (data.status_layanan === 'Selesai') statusBadge.classList.add('bg-success');
                else if (data.status_layanan === 'Dalam Proses') statusBadge.classList.add('bg-warning', 'text-dark');
                else if (data.status_layanan === 'Belum Dilaksanakan') statusBadge.classList.add('bg-secondary');
                else if (data.status_layanan === 'Batal') statusBadge.classList.add('bg-danger');
                else statusBadge.classList.add('bg-info');

                const itemsTbody = document.getElementById('modal-order-items');
                let itemsHtml = '';
                if (data.items && data.items.length > 0) {
                    data.items.forEach(item => {
                        const serviceName = item.service ? item.service.nama : 'Layanan Dihapus';
                        const subtotal = item.harga * item.jumlah;
                        itemsHtml += `
                            <tr>
                                <td>${serviceName}</td>
                                <td>${item.jumlah} ${item.service ? (item.service.satuan || '') : ''}</td>
                                <td>Rp${Number(item.harga).toLocaleString('id-ID')}</td>
                                <td>Rp${Number(subtotal).toLocaleString('id-ID')}</td>
                            </tr>
                        `;
                    });
                }
                if (data.biaya_transportasi > 0) {
                    itemsHtml += `
                        <tr>
                            <td>Jasa Transportasi</td>
                            <td>1</td>
                            <td>Rp${Number(data.biaya_transportasi).toLocaleString('id-ID')}</td>
                            <td>Rp${Number(data.biaya_transportasi).toLocaleString('id-ID')}</td>
                        </tr>
                    `;
                }
                itemsTbody.innerHTML = itemsHtml;

                document.getElementById('modal-total-price').textContent = 'Rp' + Number(data.harga_total).toLocaleString('id-ID');
            })
            .catch(error => {
                console.error('Error:', error);
                modalTitle.textContent = 'Gagal Memuat Data';
                modalContent.innerHTML = '<p class="text-center text-danger">Terjadi kesalahan saat mengambil data. Silakan coba lagi.</p>';
                modalContent.style.display = 'block';
            });
    });
});

</script>

@endsection