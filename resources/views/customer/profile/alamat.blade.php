{{-- alamat --}}
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
                </div>

                <strong style="color: #014A3F;">Alamat Saya</strong>

                @forelse ($addresses as $address)
                <div class="address-card mt-3 p-3" style="border: 1px solid #dee2e6; background-color: rgba(160, 188, 148, 0.5) ;border-radius: 8px; border-color:#2e7d32 ;margin-bottom: 20px; transition: all 0.3s ease;">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="d-flex align-items-center mb-2">
                                <h6 style="color: #014A3F; margin: 0;"><strong>{{ $address->status }}</strong></h6>
                            </div>
                            <p class="mb-0">{{ $address->alamat }}</p>
                            <small class="text-muted">{{ $address->subdistrict->nama ?? '' }}</small>
                        </div>
                        <div style="display: flex; flex-direction: column; align-items: flex-end;">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <button class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#editAlamatModal" data-id="{{ $address->id }}"data-label="{{ $address->status }}"
                                    data-alamat="{{ $address->alamat }}"
                                    data-subdistrict="{{ $address->subdistrict_id }}" data-status_del="{{ $address->status_del }}">
                                    <i class="bi bi-pencil-fill"></i> Ubah
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <p class="text-muted mt-3">Belum ada alamat yang ditambahkan.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Alamat -->
<div class="modal fade" id="alamatModal" tabindex="-1" aria-labelledby="alamatModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="{{ route('alamat.store') }}">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="alamatModalLabel" style="color:#014A3F">Tambah Alamat Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
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
                    <label class="form-label">Kecamatan</label>
                    <select name="subdistrict_id" class="form-select" required>
                        @foreach ($subdistricts as $subdistrict)
                            <option value="{{ $subdistrict->id }}">{{ $subdistrict->nama }}</option>
                        @endforeach
                    </select>
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
    <form method="POST" id="editAlamatForm">
        @csrf
        @method('PUT')
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAlamatModalLabel" style="color:#014A3F">Ubah Alamat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body">
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
                    <label class="form-label">Kecamatan</label>
                    <select name="subdistrict_id" class="form-select" required>
                        @foreach ($subdistricts as $subdistrict)
                        <option value="{{ $subdistrict->id }}">{{ $subdistrict->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Status Alamat</label>
                    <select name="status_del" class="form-select" required>
                        <option value="0" selected>Tidak Hapus</option>
                        <option value="1">Hapus</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-success" onclick="simpanPerubahan()">Simpan Perubahan</button>
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
document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('editAlamatModal');
    modal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;

        const id = button.getAttribute('data-id');
        const label = button.getAttribute('data-label');
        const alamat = button.getAttribute('data-alamat');
        const subdistrict = button.getAttribute('data-subdistrict');
        const statusDel = button.getAttribute('data-status_del');

        // Set form action
        const form = document.getElementById('editAlamatForm');
        form.action = `/alamat/${id}`;

        // Set input values
        form.querySelector('select[name="label_alamat"]').value = label;
        form.querySelector('textarea[name="alamat_lengkap"]').value = alamat;
        form.querySelector('select[name="subdistrict_id"]').value = subdistrict;
        form.querySelector('select[name="status_del"]').value = statusDel
    });
});
</script>
@endsection
