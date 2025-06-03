@extends('base.admin')
@section('content')

<section class="py-5">
  <div class="container bg-white rounded shadow-sm p-4" style="color: #014A3F; font-family: 'Montserrat', sans-serif;">
    <div class="row g-4 align-items-start">

      <div class="col-md-5 d-flex flex-column align-items-center">
        <img 
          src="{{ asset('Images/' . $service->gambar.'.png') }}" 
          alt="{{ $service->nama }}" 
          class="img-fluid rounded mb-3"
          style="max-height: 400px; object-fit: contain;"
          id="preview-image"
        >
        
        <input 
          type="file" 
          id="gambar" 
          name="gambar" 
          class="form-control"
          accept="image/*"
          form="form-layanan"
          style="max-width: 400px;"
        >
      </div>

      <div class="col-md-7">
        <form method="POST" action="{{ route('layanan.update', $service->id) }}" enctype="multipart/form-data" id="form-layanan">
          @csrf
          @method('PUT')

          <div class="mb-3">
            <label for="nama" class="form-label fw-bold">Nama</label>
            <input 
              type="text" 
              id="nama" 
              name="nama" 
              class="form-control" 
              value="{{ old('nama', $service->nama) }}">
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="harga" class="form-label fw-bold">Harga</label>
              <input 
                type="number" 
                id="harga" 
                name="harga" 
                class="form-control" 
                value="{{ old('harga', $service->harga) }}">
            </div>
            <div class="col-md-6 mb-3">
              <label for="satuan" class="form-label fw-bold">Satuan</label>
              <select id="satuan" name="satuan" class="form-select">
                <option value="Meter Persegi" {{ $service->satuan == 'Meter Persegi' ? 'selected' : '' }}>Meter Persegi</option>
                <option value="Meter" {{ $service->satuan == 'Meter' ? 'selected' : '' }}>Meter</option>
                <option value="Jam" {{ $service->satuan == 'Jam' ? 'selected' : '' }}>Jam</option>
                <option value="Unit" {{ $service->satuan == 'Unit' ? 'selected' : '' }}>Unit</option>
                <option value="Pasang" {{ $service->satuan == 'Pasang' ? 'selected' : '' }}>Pasang</option>
                <option value="Dudukan" {{ $service->satuan == 'Dudukan' ? 'selected' : '' }}>Dudukan</option>
              </select>
            </div>
          </div>

          <div class="mb-3">
            <label for="promo" class="form-label fw-bold">Kalimat Promosi</label>
            <textarea 
              id="promo" 
              name="kalimat_promosi" 
              class="form-control" 
              rows="2">{{ old('kalimat_promosi', $service->kalimat_promosi) }}</textarea>
          </div>

          <div class="mb-3">
            <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
            <textarea 
              id="deskripsi" 
              name="deskripsi" 
              class="form-control" 
              rows="4">{{ old('deskripsi', $service->deskripsi) }}</textarea>
          </div>

          <div class="text-end">
            <button type="submit" class="px-3 py-2 mt-3 mb-3 fw-bold" style="border:none; color:white; background-color: #40744E; border-radius: 10px; min-width:150px">
              Simpan Perubahan
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

@endsection