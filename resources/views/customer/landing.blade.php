@php
  $logged_in = session('logged_in', false);
@endphp
@extends('base.base')
@section('content')

<style>
  .section-separator {
  width: 200px;
  height: 4px;
  background-color: #1A3C34;
  border-radius: 2px;
}
</style>

{{-- Bagian Hero / Paling atas --}}
<section 
  style="
    background-image: url('{{ asset('Images/HeroLanding-1.png') }}');
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
      <div class="col-md-6">
        <img src="{{ asset('Images/HeroLanding-2.png') }}" class="img-fluid">
      </div>

      <div class="col-md-6 text-center text-md-start">
        <div style="max-width: 500px; color: #014A3F; font-family: 'Montserrat', sans-serif; margin: auto;">
            <a href="{{ Auth::guard('customer')->check() ? route('layanan_customer.show', ['kategori' => 'cleaning', 'category_id' => 'C01']) : route('login.show') }}" 
          class="px-3 py-1 mt-3 mb-3" 
          style="background-color: #E0EAB8; color: #014A3F; border-radius: 20px; text-decoration: none; display: inline-block;">
            Pesan Sekarang <i class="bi bi-arrow-down-right" style="font-size: 10px"></i>
        </a>
          <h1 style="font-weight: 700" class="mb-5">
            Tempat bersih seketika dalam <span style="color: #A0BC94">satu klik</span>
          </h1>
          <img src="{{ asset('Images/HeroLanding-3.png')}}" class="img-fluid">
        </div>
      </div>
    </div>
  </div>
</section>

<div class="section-separator mx-auto my-5"></div>

{{-- Bagian Mengapa Memilih Kami --}}
<section class="py-5">
  <div class="container" style="color: #014A3F; font-family: 'Montserrat', sans-serif">
    <h2 class="text-center mb-5 fw-bold">Mengapa Memilih Kami?</h2>
    <div class="row">
      <div class="col-md-4 mb-4">
        <div style="display: flex; flex-direction: column; justify-content: center; border: 1px solid #ddd; border-radius: 12px; padding: 24px; height: 100%; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);">
          <h4 class="fw-bold">
            <i class="bi bi-shield-fill-plus"></i> 
            Aman & Terpercaya </h4>
          <p> BersihIn hanya bekerja sama dengan cleaner yang telah melewati proses seleksi untuk memastikan pembersihan maksimal. </p>
        </div>
      </div>

      <div class="col-md-4 mb-4">
        <div style="display: flex; flex-direction: column; justify-content: center; border: 1px solid #ddd; border-radius: 12px; padding: 24px; height: 100%; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);">
          <h4 class="fw-bold">
            <i class="bi bi-bucket"></i>
            Bersih Cepat, Tanpa Repot</h4>
          <p>Kami datang sesuai waktu, bekerja cepat, dan Anda tak perlu repot menyediakan alat, semua kami bawa sendiri.</p>
        </div>
      </div>            
      <div class="col-md-4 mb-4">
        <div style="display: flex; flex-direction: column; justify-content: center; border: 1px solid #ddd; border-radius: 12px; padding: 24px; height: 100%; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);">
          <h4 class="fw-bold">
            <i class="bi bi-laptop"></i>
            Layanan Fleksibel dan Transparan</h4>
          <p>Pesan mudah lewat website, pilih waktu dan layanan sesuai kebutuhan, tanpa biaya tersembunyi.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="section-separator mx-auto my-5"id="layanan-kami"></div>

{{-- Bagian Layanan Kami --}}
<section class="py-5 text-center">
  <div class="container" style="color: #014A3F; font-family: 'Montserrat', sans-serif">
    <h2 class="fw-bold mb-4">Layanan Kami</h2>
    @php
      $services = [
        ['img' => 'cleaning.png', 'label' => 'CLEANING', 'kategori' => 'cleaning', 'category_id' => 'C01'],
        ['img' => 'disinfektan.png', 'label' => 'DISINFECTION', 'kategori' => 'disinfection', 'category_id' => 'C04'],
        ['img' => 'laundry.png', 'label' => 'LAUNDRY', 'kategori' => 'laundry', 'category_id' => 'C02'],
        ['img' => 'pipa.png', 'label' => 'MAINTENANCE', 'kategori' => 'maintenance', 'category_id' => 'C03'],
      ];
    @endphp
    <div class="row">
      @foreach ($services as $i => $s)
        <div class="col-md-6 mb-4">
          <a href="{{ route('layanan_customer.show', ['kategori' => $s['kategori'], 'category_id' => $s['category_id']]) }}" class="d-block text-white text-decoration-none rounded-3 p-4"
             style="background: url('/Images/{{ $s['img'] }}') center/cover no-repeat; height: 200px;">
            <div class="d-flex h-100 align-items-center justify-content-center">
              <h4 class="fw-bold" style="color: #E0EAB8">{{ $s['label'] }}</h4>
            </div>
          </a>
        </div>
        @if ($i % 2 == 1)</div><div class="row">@endif
      @endforeach
    </div>
  </div>
</section>



<div class="section-separator mx-auto my-5"></div>

{{-- Bagian Review --}}
<section class="py-5">
  <div class="container pt-5 pl-5" style="background-color: #2E8656; border-radius: 20px; padding-top: 20px; color: #014A3F; font-family: 'Montserrat', sans-serif">
    <div class="row align-items-center">
      <!-- Kolom kiri: Judul dan Gambar -->
      <div class="col-md-6 text-center">
        <h2 class="mb-4 fw-bold" style="color: #E0EAB8">Apa yang dikatakan orang tentang kita?</h2>
        <img src="/Images/Home-2.png" alt="Gambar Hero" class="img-fluid" style="max-height: 300px;">
      </div>
      <div class="col-md-6 text-center">
        @php
          $testimonials = [
            ['quote' => 'Biasanya saya stres bersih-bersih sebelum tamu datang. Sekarang tinggal pesan Bersihin, rumah langsung kinclong tanpa capek.', 'name' => 'Putri Sari', 'stars' => 5],
            ['quote' => 'Awalnya coba-coba, sekarang malah langganan. Rumah jadi selalu rapi tanpa harus capek sendiri. Tapi belum ada sistem langganan.', 'name' => 'Bryan Wijaya', 'stars' => 4],
            ['quote' => 'Timnya sopan dan hasil bersihnya memuaskan. Recommended!', 'name' => 'Nina', 'stars' => 5],
          ];
        @endphp

        <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">
            @foreach ($testimonials as $i => $t)
              <div class="carousel-item @if ($i == 0) active @endif">
                <div class="p-3 bg-white rounded shadow-sm mx-auto d-flex flex-column justify-content-center mb-5" style="max-width: 400px; min-height: 320px; width: 100%;">
                  <h4 class="fw-bold">{{ $t['name'] }}</h4>
                  <h3 class="text-warning mb-2 ">
                    @for ($s = 0; $s < $t['stars']; $s++) ★ @endfor
                    @for ($s = $t['stars']; $s < 5; $s++) ☆ @endfor
                  </h3>
                  <p class="text-muted mb-0 px-4">{{ $t['quote'] }}</p>
                </div>
              </div>
            @endforeach
          </div>
          <button class="carousel-control-prev mr-4" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev" style="color: rgba(1, 74, 63, 0.8);">
            <span class="carousel-control-prev-icon" aria-hidden="true" style="filter: invert(1); width: 20px; height: 20px;"></span>
            <span class="visually-hidden">Sebelumnya</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next" style="color: rgba(1, 74, 63, 0.8);">
            <span class="carousel-control-next-icon" aria-hidden="true" style="filter: invert(1); width: 20px; height: 20px;"></span>
            <span class="visually-hidden">Berikutnya</span>
          </button>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="section-separator mx-auto my-5"></div>

{{-- Bagian FAQs --}}
<section class="py-5">
  <div class="container" style="color: #014A3F; font-family: 'Montserrat', sans-serif">
    <div class="row align-items-center">
      <div class="col-md-6 mb-4 mb-md-0 text-center">
        <img src="/Images/FAQ.png" alt="Gambar FAQ" class="img-fluid" style="max-height: 420px;">
      </div>
      <div class="col-md-6">
        <h2 class="fw-bold mb-3">Frequently Asked Question</h2>
        <p style="font-size: 16px;">
          Ada pertanyaan seputar BersihIn? Berikut jawaban dari pertanyaan yang sering diajukan sejauh ini.
        </p>
        @php
          $faqs = [
            [
              'question' => 'Apakah saya harus menyediakan peralatan pembersih sendiri?',
              'answer' => 'Tidak perlu. Tim BersihIn akan membawa semua perlengkapan dan bahan pembersih standar yang dibutuhkan.'
            ],
            [
              'question' => 'Apakah saya bisa memesan layanan di hari yang sama?',
              'answer' => 'Tidak, untuk sekarang layanan bisa dipesan minimal sehari sebelumnya (H-1) dan maksimal seminggu setelah hari pemesanan (H+7).'
            ],
            [
              'question' => 'Apakah BersihIn bisa dipanggil ke apartemen?',
              'answer' => 'Tentu saja. Kami melayani pemesanan ke rumah tinggal dan apartemen.'
            ],
            [
              'question' => 'Berapa lama proses pembersihan berlangsung?',
              'answer' => 'Durasi tergantung pada jenis layanan, tapi umumnya antara 1 hingga 3 jam per sesi.'
            ],
            [
              'question' => 'Apa saja area yang dilayani oleh BersihIn?',
              'answer' => 'Saat ini, BersihIn hanya tersedia di Surabaya, dan kami terus memperluas jangkauan layanan.'
            ],
          ];
        @endphp
        <div class="accordion" id="faqAccordion">
            @foreach ($faqs as $i => $faq)
              <div class="accordion-item mb-2 border-0">
                <h2 class="accordion-header" id="faq{{ $i }}">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#answer{{ $i }}" 
                    aria-expanded="false" aria-controls="answer{{ $i }}" style="background-color: #E0EAB8">
                    {{ $faq['question'] }}
                  </button>
                </h2>
                <div id="answer{{ $i }}" class="accordion-collapse collapse" aria-labelledby="faq{{ $i }}" data-bs-parent="#faqAccordion">
                  <div class="accordion-body">
                    {{ $faq['answer'] }}
                  </div>
                </div>
              </div>
            @endforeach
        </div>
      </div>
    </div>
  </div>
</section>
@endsection