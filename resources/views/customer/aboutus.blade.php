@extends('base.base')
@section('content')

<!-- Hero Section -->
<section 
  class="d-flex align-items-center mb-5"
  style="
    background-image: url('{{ asset('Images/TentangKami-1-1.png') }}');
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    min-height: 100vh;
  "
>
  <div class="container-fluid px-0">
    <div class="row gx-0 align-items-stretch" style="min-height: 100vh;">

      <!-- Text Column -->
      <div class="col-md-3 d-flex align-items-center text-center text-md-start">
        <div class="mx-auto" style="max-width: 500px; color: #014A3F; font-family: 'Montserrat', sans-serif;">
          <h1 style="font-weight: 700; font-size:40px" class="mb-5">
            Bersih,<br>Praktis,<br>Profesional
          </h1>
        </div>
      </div>

      <!-- Image Column -->
      <div class="col-md-9 d-flex justify-content-center align-items-center">
        <img 
          src="{{ asset('Images/TentangKami-1-2.png') }}" 
          class="img-fluid h-100" 
          style="object-fit: cover; width: 100%;"
        >
      </div>
    </div>
  </div>
</section>


<!-- Nilai Kami Section -->
<section class="py-5 text-center mb-5">
    <div class="container">
          <h2 class="fw-bold" style="color:#014A3F;">Misi Kami</h2>
          <p class="text-muted">Membantu keluarga dan individu menikmati hunian yang sehat, bersih, dan terawat tanpa repot.</p>
    </div>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center mb-4">
                <h2 class="fw-bold" style="color:#014A3F;">Nilai Kami</h2>
            </div>
        </div>
        <div class="row g-4">
            @php
                $values = [
                    ['Kepercayaan', 'Selalu jujur dan profesional di setiap kunjungan.'],
                    ['Efisiensi', 'Cepat dalam layanan, tanpa mengurangi kualitas.'],
                    ['Kebersihan Maksimal', 'Gunakan alat, produk, dan teknik terbaik.'],
                    ['Ramah Lingkungan', 'Gunakan bahan dan metode yang eco-friendly.']
                ];
            @endphp

            @foreach ($values as [$title, $desc])
                <div class="col-md-6 col-lg-3">
                    <div class="border rounded p-4 h-100 text-center">
                        <i class="bi bi-shield-check" style="font-size:20px;color:#014A3F;"></i>
                        <h5 class="mt-3 fw-bold" style="color:#014A3F;">{{ $title }}</h5>
                        <p class="mb-0 text-muted">{{ $desc }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Tim Kami Section -->
<section 
  class="mb-5"
  style="
    background-image: url('{{ asset('Images/TentangKami-2-1.png') }}');
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    min-height: 100vh;
    display: flex;
    align-items: center;
  "
>
  <div class="container-fluid px-0">
    <div class="row align-items-center gx-0">
      <div class="col-md-6 mb-md-0">
        <img src="{{ asset('Images/TentangKami-2-2.png') }}" class="img-fluid mx-auto d-block" style="max-height: 700px">
      </div>

      <div class="mt-3 col-md-6 text-center text-md-start">
        <div style="max-width: 500px; color: #014A3F; font-family: 'Montserrat', sans-serif; margin: auto;">
          <h1 class="fw-bold mb-3"> Tim Kami </h1>
          <p>Seluruh petugas kami telah melalui pelatihan khusus dan verifikasi data diri. Mereka bekerja dengan sopan, rapi, dan siap membantu Anda dari awal hingga akhir proses.</p>
          <p>Kami tidak hanya mengirim <b>cleaner</b>, kami kirim <b> kebersihan terpercaya.</b></p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Area Layanan Section -->
<section 
  class="mb-5"
  style="background-image: url('{{ asset('Images/TentangKami-3-1.png') }}'); 
          min-height: 50vh; 
          min-width: 100%; 
          margin: 0; 
          background-size: cover; 
          background-position: center;
          display: flex; 
          align-items: center; 
          justify-content: center;">
  <div class="container-fluid px-0">
  <div class="row align-items-center gx-0">
    <!-- Teks -->
    <div class="col-md-6 d-flex justify-content-center">
      <div class="d-flex flex-column justify-content-center text-center"
          style="max-width: 500px; color: #014A3F; font-family: 'Montserrat', sans-serif;">
        <h1 class="fw-bold mt-3 mb-3">Area Layanan</h1>
        <p>
          Kami melayani area Surabaya dan akan segera hadir di lebih banyak kota.
          Semua layanan kami datang langsung ke rumah Anda tanpa perlu repot ke luar rumah.
        </p>
      </div>
    </div>

    <!-- Gambar -->
    <div class="col-md-6 mb-md-0">
      <img src="{{ asset('Images/TentangKami-3-2.png') }}" class="img-fluid mx-auto d-block" style="max-height: 500px">
    </div>
  </div>
</div>

</section>
@endsection

