@extends('base.admin')
@section('content')

<section class="py-5">
  <div class="container bg-white p-5 rounded shadow-sm mx-auto" style="max-width: 800px; color: #014A3F; font-family: 'Montserrat', sans-serif;">
    <form method="POST" action="{{ route('layanan.demoSubmit') }}" enctype="multipart/form-data">
      @csrf
      <div class="mb-3">
        <label for="nama" class="form-label fw-bold">Nama</label>
        <input type="text" id="nama" name="nama" class="form-control" placeholder="Masukkan Nama Layanan">
      </div>

      <div class="row mb-3">
        <div class="col-md-6">
          <label for="harga" class="form-label fw-bold">Harga</label>
          <input type="text" id="harga" name="harga" class="form-control">
        </div>
        <div class="col-md-6">
          <label for="satuan" class="form-label fw-bold">Satuan</label>            
          <select class="form-select">
            <option value="" disabled selected>Pilih satuan</option>
            <option value="Meter Persegi">Meter Persegi</option>
            <option value="Meter">Meter</option>
            <option value="Jam">Jam</option>
            <option value="Unit">Unit</option>
            <option value="Pasang">Pasang</option>
            <option value="Dudukan">Dudukan</option>
          </select>
        </div>
      </div>

      <div class="mb-3">
        <label for="kategori" class="form-label fw-bold">Kategori</label>
        <select id="kategori" name="kategori" class="form-select">
          <option value="" disabled selected>Pilih kategori layanan</option>
          <option value="Cleaning">Cleaning</option>
          <option value="Laundry">Laundry</option>
          <option value="Maintenance">Maintenance</option>
          <option value="Disinfection">Disinfection</option>
        </select>
      </div>

      <div class="mb-3">
        <label for="promo" class="form-label fw-bold">Kalimat Promosi</label>
        <textarea id="promo" name="promo" class="form-control" rows="2" placeholder="Masukkan Kalimat Promosi untuk Layanan"></textarea>
      </div>

      <div class="mb-3">
        <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
        <textarea id="deskripsi" name="deskripsi" class="form-control" rows="4" placeholder="Masukkan Deskripsi Layanan"></textarea>
      </div>

      <div class="mb-4">
        <label for="gambar" class="form-label fw-bold">Unggah Gambar</label>
        <input type="file" id="gambar" name="gambar" class="form-control" accept="image/*">
      </div>

      <div class="text-center d-flex justify-content-center gap-3">
        <a href="{{ route('layanan_admin.show', ['kategori' => 'cleaning', 'category_id' => 'C01']) }}" class="px-3 py-2 mt-3 mb-3 fw-bold text-decoration-none" 
           style="color:#40744E; border:2px solid #40744E; border-radius: 10px; min-width:150px; display: inline-block; text-align:center;">
          Batal
        </a>

        <button type="submit" class="px-3 py-2 mt-3 mb-3 fw-bold" 
                style="border:none; color:white; background-color: #40744E; border-radius: 10px; min-width:150px">
          Tambahkan
        </button>
      </div>
    </form>
  </div>
</section>

@endsection
