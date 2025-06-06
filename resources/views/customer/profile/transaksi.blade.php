{{-- transaksi --}}
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

        <!-- Transaction Content -->
        <div class="col-12 col-md-8 col-lg-9">
            <div class="bg-white p-4 rounded shadow-sm">
                <div class="d-flex align-items-center mb-3">
                    <img src="{{ asset('Images/transaksi.png') }}" style="width: 32px; margin-right: 10px;">
                    <h4 class="text-success mb-0">Transaksi</h4>
                </div>
                <hr>

                <!-- Filter Section -->
                <div class="row mb-4">
                    <div class="col-md-6 mb-2">
                        <label class="form-label text-muted">Status</label>
                        <select class="form-select" id="statusFilter">
                            <option value="semua">Semua Status</option>
                            <option value="menunggu">Menunggu Pembayaran</option>
                            <option value="diproses">Diproses</option>
                            <option value="selesai">Selesai</option>
                            <option value="dibatalkan">Dibatalkan</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="form-label text-muted">Tanggal</label>
                        <select class="form-select" id="dateFilter">
                            <option value="semua">Semua Tanggal</option>
                            <option value="hari-ini">Hari Ini</option>
                            <option value="minggu-ini">Minggu Ini</option>
                            <option value="bulan-ini">Bulan Ini</option>
                            <option value="custom">Custom</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-2" id="customDateRange" style="display: none;">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label text-muted">Dari</label>
                                <input type="date" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted">Sampai</label>
                                <input type="date" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="form-label text-muted">Cari Transaksi</label>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="No. Transaksi/Nama Layanan">
                            <button class="btn btn-success" type="button">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Transaction List -->
                <div class="transaction-list">
                    <!-- Transaction Item 1 -->
                    <div class="card mb-3 transaction-item" data-status="selesai">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h6 class="mb-1" style="color: #014A3F;"><strong>TRX-20230510-001</strong></h6>
                                    <p class="mb-1">Setrika Pakaian - 2 Jam</p>
                                    <p class="mb-1 text-muted">10 Mei 2025 • 14:30 WIB</p>
                                    <span class="badge bg-success">Selesai</span>
                                </div>
                                <div class="text-end">
                                    <h5 class="mb-2">Rp100.000</h5>
                                    <button class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#detailTransaksiModal">
                                        <i class="bi bi-eye-fill"></i> Detail
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Transaction Item 2 -->
                    <div class="card mb-3 transaction-item" data-status="diproses">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h6 class="mb-1" style="color: #014A3F;"><strong>TRX-20230512-002</strong></h6>
                                    <p class="mb-1">Cuci Sofa - 1 Unit</p>
                                    <p class="mb-1 text-muted">12 Mei 2025 • 10:15 WIB</p>
                                    <span class="badge bg-warning text-dark">Diproses</span>
                                </div>
                                <div class="text-end">
                                    <h5 class="mb-2">Rp150.000</h5>
                                    <button class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#detailTransaksiModal">
                                        <i class="bi bi-eye-fill"></i> Detail
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Transaction Item 3 -->
                    <div class="card mb-3 transaction-item" data-status="menunggu">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h6 class="mb-1" style="color: #014A3F;"><strong>TRX-20230515-003</strong></h6>
                                    <p class="mb-1">Pembersihan Kolam Renang - 10m²</p>
                                    <p class="mb-1 text-muted">15 Mei 2025 • 08:00 WIB</p>
                                    <span class="badge bg-secondary">Menunggu Pembayaran</span>
                                </div>
                                <div class="text-end">
                                    <h5 class="mb-2">Rp200.000</h5>
                                    <button class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#detailTransaksiModal">
                                        <i class="bi bi-eye-fill"></i> Detail
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pagination -->
                <nav aria-label="Transaction pagination" class="mt-4">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">Previous</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Transaction Detail Modal -->
<div class="modal fade" id="detailTransaksiModal" tabindex="-1" aria-labelledby="detailTransaksiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailTransaksiModalLabel" style="color: #014A3F;">Detail Transaksi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h6 class="mb-3" style="color: #014A3F;"><strong>Informasi Transaksi</strong></h6>
                        <table class="table table-sm">
                            <tr>
                                <td width="40%">No. Transaksi</td>
                                <td><strong>TRX-20230510-001</strong></td>
                            </tr>
                            <tr>
                                <td>Tanggal</td>
                                <td>10 Mei 2025, 14:30 WIB</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td><span class="badge bg-success">Selesai</span></td>
                            </tr>
                            <tr>
                                <td>Metode Pembayaran</td>
                                <td>Transfer Bank (BCA)</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h6 class="mb-3" style="color: #014A3F;"><strong>Informasi Pelanggan</strong></h6>
                        <table class="table table-sm">
                            <tr>
                                <td width="40%">Nama</td>
                                <td><strong>Sherin Yonatan</strong></td>
                            </tr>
                            <tr>
                                <td>No. HP</td>
                                <td>089543221905</td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>Waterfront WP 1 No. 8, Sambikerep</td>
                            </tr>
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
                        <tbody>
                            <tr>
                                <td>Setrika Pakaian</td>
                                <td>2 Jam</td>
                                <td>Rp50.000/Jam</td>
                                <td>Rp100.000</td>
                            </tr>
                            <tr>
                                <td>Jasa Transportasi</td>
                                <td>1</td>
                                <td>Rp15.000</td>
                                <td>Rp15.000</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-end"><strong>Total</strong></td>
                                <td><strong>Rp115.000</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    <h6 class="mb-3" style="color: #014A3F;"><strong>Bukti Pembayaran</strong></h6>
                    <div class="border p-2 text-center" style="max-width: 100px;">
                        <button class="btn btn-sm btn-success">Download</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-success">Cetak Invoice</button>
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

// Filter functionality
document.getElementById('dateFilter').addEventListener('change', function() {
    const customDateRange = document.getElementById('customDateRange');
    if (this.value === 'custom') {
        customDateRange.style.display = 'block';
    } else {
        customDateRange.style.display = 'none';
    }
    filterTransactions();
});

document.getElementById('statusFilter').addEventListener('change', filterTransactions);

function filterTransactions() {
    const statusFilter = document.getElementById('statusFilter').value;
    const dateFilter = document.getElementById('dateFilter').value;

    document.querySelectorAll('.transaction-item').forEach(item => {
        const itemStatus = item.getAttribute('data-status');
        let shouldShow = true;

        // Apply status filter
        if (statusFilter !== 'semua' && itemStatus !== statusFilter) {
            shouldShow = false;
        }

        // Apply date filter (simplified for demo)
        // In real app, you would compare dates

        item.style.display = shouldShow ? 'block' : 'none';
    });
}

filterTransactions();
</script>

@endsection
