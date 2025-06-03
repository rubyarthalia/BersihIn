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
                            <img src="{{ asset('images/iconuser.png') }}" alt="Biodata Diri" style="width: 24px; height: 24px; margin-right: 5px;">
                            <a href="{{ route('biodata.show') }}" style="color: #014A3F; text-decoration: none;">Biodata Diri</a>
                        </li>
                        <li class="mb-3">
                            <img src="{{ asset('images/address.png') }}" alt="Daftar Alamat" style="width: 24px; height: 24px; margin-right: 5px;">
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
                            <img src="{{ asset('images/profileheart.png') }}" alt="Wishlist" style="width: 24px; height: 24px; margin-right: 5px;">
                            <a href="{{ route('wishlist.show') }}" style="color: #014A3F; text-decoration: none;">Wishlist</a>
                        </li>
                        <li class="mb-3">
                            <img src="{{ asset('images/transaksi.png') }}" alt="Transaksi" style="width: 24px; height: 24px; margin-right: 5px;">
                            <a href="{{ route('transaksi.show') }}" style="color: #014A3F; text-decoration: none;">Transaksi</a>
                        </li>
                        <li class="mb-3">
                            <img src="{{ asset('images/ulasan.png') }}" alt="Ulasan" style="width: 24px; height: 24px; margin-right: 5px;">
                            <a href="{{ route('ulasan.show') }}" style="color: #014A3F; text-decoration: none;">Ulasan</a>
                        </li>
                    </ul>
                </div>

                <hr class="mb-3">

                <div class="d-flex align-items-center gap-2 mt-4">
                    <img src="{{ asset('images/logout.png') }}" style="width: 18px;">
                    <a href="#" onclick="confirmLogout(event)" style="color: #dc3545; text-decoration: none;">Log Out</a>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-12 col-md-8 col-lg-9">
            <div class="p-4" style="background-color: white; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.05);">
                <div class="d-flex align-items-center mb-3">
                    <img src="{{ asset('images/address.png') }}" style="width: 32px; margin-right: 10px;">
                    <h4 style="color: #2e7d32; margin: 0;">Daftar Alamat</h4>
                </div>
                <hr class="mb-4">

                <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center gap-3 mb-3">
                    <button class="btn text-white" style="background-color: #014A3F;" data-bs-toggle="modal" data-bs-target="#alamatModal">
                        + Tambahkan Alamat
                    </button>

                    <div class="position-relative w-100" style="max-width: 400px;">
                        <input type="text" class="form-control ps-5" placeholder="Nama Jalan/Kota/Provinsi">
                        <img src="{{ asset('images/search.png') }}" style="width: 16px; position: absolute; left: 15px; top: 50%; transform: translateY(-50%);">
                    </div>
                </div>

                <strong style="color: #014A3F;">Alamat Saya</strong>

                {{-- kalau belum ada alamat --}}
                {{-- <div class="text-center py-5">
                    <p style="color: #777;">Tidak ada alamat</p>
                </div> --}}

                <!-- Address Card 1 -->
                <div id="address-1" class="address-card mt-3 p-3" style="border: 1px solid #dee2e6; background-color: rgba(160, 188, 148, 0.5) ;border-radius: 8px; border-color:#2e7d32 ;margin-bottom: 20px; transition: all 0.3s ease;">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="d-flex align-items-center mb-2">
                                <h6 style="color: #014A3F; margin: 0;"><strong>Rumah</strong></h6>
                            </div>
                            <p class="mb-1"><strong>SHERIN YONATAN</strong></p>
                            <p class="mb-1">089543221905</p>
                            <p class="mb-0">Waterfront WP 1 No. 8 Nord Kost, Made, Sambikerep, 60219</p>
                        </div>
                        <div style="display: flex; flex-direction: column; align-items: flex-end;">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <button class="btn btn-sm btn-outline-secondary p-1" onclick="togglePrimary('address-1', this)" style="width: 32px; height: 32px;">
                                    <img src="{{ asset('images/unpin.png') }}" style="width: 16px; height: 16px;" id="pin-icon-1">
                                </button>
                                <button class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#editAlamatModal">
                                    <i class="bi bi-pencil-fill"></i> Ubah
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Address Card 2 -->
                <div id="address-1" class="address-card mt-3 p-3" style="border: 1px solid #dee2e6; border-radius: 8px; margin-bottom: 20px; transition: all 0.3s ease;">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="d-flex align-items-center mb-2">
                                <h6 style="color: #014A3F; margin: 0;"><strong>Rumah</strong></h6>
                            </div>
                            <p class="mb-1"><strong>RUBY ARTHALIA</strong></p>
                            <p class="mb-1">0814445326</p>
                            <p class="mb-0">Waterfront WP 1 No. 1 Sambikerep, 60219</p>
                        </div>
                        <div style="display: flex; flex-direction: column; align-items: flex-end;">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <button class="btn btn-sm btn-outline-secondary p-1" onclick="togglePrimary('address-1', this)" style="width: 32px; height: 32px;">
                                    <img src="{{ asset('images/maupin.png') }}" style="width: 16px; height: 16px;" id="pin-icon-1">
                                </button>
                                <button class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#editAlamatModal">
                                    <i class="bi bi-pencil-fill"></i> Ubah
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Alamat -->
<div class="modal fade" id="alamatModal" tabindex="-1" aria-labelledby="alamatModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="alamatModalLabel" style="color:#014A3F">Tambah Alamat Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Nama Penerima</label>
                    <input type="text" name="nama_penerima" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nomor Telepon</label>
                    <input type="text" name="nomor_hp" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Label Alamat</label>
                    <select name="label_alamat" class="form-select" required>
                        <option value="Rumah">Rumah</option>
                        <option value="Kos">Kos</option>
                        <option value="Kantor">Kantor</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Alamat Lengkap</label>
                    <textarea name="alamat_lengkap" class="form-control" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Kota</label>
                    <input type="text" name="kota" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Provinsi</label>
                    <input type="text" name="provinsi" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Kode Pos</label>
                    <input type="text" name="kode_pos" class="form-control" required>
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" value="1" id="pin_alamat" name="pin_alamat">
                    <label class="form-check-label" for="pin_alamat">
                        Jadikan alamat utama
                    </label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Simpan</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            </div>
        </div>
    </form>
  </div>
</div>

<!-- Edit Address Modal -->
<div class="modal fade" id="editAlamatModal" tabindex="-1" aria-labelledby="editAlamatModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="">
        @csrf
        @method('PUT')
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAlamatModalLabel" style="color:#014A3F">Ubah Alamat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Nama Penerima</label>
                    <input type="text" name="nama_penerima" class="form-control" value="SHERIN YONATAN" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nomor Telepon</label>
                    <input type="text" name="nomor_hp" class="form-control" value="089543221905" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Label Alamat</label>
                    <select name="label_alamat" class="form-select" required>
                        <option value="Rumah" selected>Rumah</option>
                        <option value="Kos">Kos</option>
                        <option value="Kantor">Kantor</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Alamat Lengkap</label>
                    <textarea name="alamat_lengkap" class="form-control" rows="3" required>Waterfront WP 1 No. 8 Nord Kost, Made, Sambikerep, 60219</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Kota</label>
                    <input type="text" name="kota" class="form-control" value="Sambikerep" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Provinsi</label>
                    <input type="text" name="provinsi" class="form-control" value="Jawa Timur" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Kode Pos</label>
                    <input type="text" name="kode_pos" class="form-control" value="60219" required>
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" value="1" id="edit_pin_alamat" name="pin_alamat">
                    <label class="form-check-label" for="edit_pin_alamat">
                        Jadikan alamat utama
                    </label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success" onclick="simpanPerubahan()">Simpan Perubahan</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger ms-auto" onclick="confirmDelete()">Hapus Alamat</button>
            </div>
        </div>
    </form>
  </div>
</div>

<script>
function confirmLogout(event) {
    //event.preventDefault();
    if (confirm('Apakah Anda yakin ingin keluar?')) {
        // document.getElementById('logout-form').submit();
          alert('Logout');
    }
}

function simpanPerubahan() {
      if (confirm('Apakah yakin dengan perubahan ini?')) {
          alert('Alamat berhasil diperbarui');
        $('#editAlamatModal').modal('update');
    }
}

function confirmDelete() {
    if (confirm('Apakah Anda yakin ingin menghapus alamat ini?')) {
        alert('Alamat berhasil dihapus');
        $('#editAlamatModal').modal('hide');
    }
}

function toggleSection(sectionId) {
    const section = document.getElementById(sectionId + 'Section');
    if (section.style.display === 'none') {
        section.style.display = 'block';
    } else {
        section.style.display = 'none';
    }
}
</script>
@endsection
