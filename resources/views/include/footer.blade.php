<footer style="padding-top: 30px; background-color: #043400; color: #E0EAB8; font-family: 'Hind', sans-serif; font-size: 18px;">
  <div class="container p-4">
    <div class="row justify-content-center"> 
      <div class="col-lg-3 mb-4" style="margin-left: 50px;">
        <img src="{{ asset('Images/LogoBersihIn2.png')}}" alt="Logo BersihIn" class="mb-3 img-fluid"> <!-- Tambahkan img-fluid -->
        <p style="font-size: clamp(16px, 2vw, 18px);">BersihIn didirikan pada tahun 2025 untuk membantu masyarakat memiliki lingkungan yang lebih bersih</p>
      </div>

      <div class="col-lg-3 mb-4" style="margin-left: 130px;">
        <h5 style="font-weight: 700; font-size: clamp(18px, 2vw, 20px);">Halaman Kami</h5>
        <ul class="list-unstyled">
          <li class="mb-2"><a href="{{ route('landing.show') }}" style="color: #E0EAB8; text-decoration: none;">Beranda</a></li>
          <li class="mb-2"><a href="{{ route('aboutus.show') }}" style="color: #E0EAB8; text-decoration: none;">Tentang Kami</a></li>
          <li><a href="{{ route('landing.show') }}#layanan-kami" style="color: #E0EAB8; text-decoration: none;">Layanan Kami</a></li>
        </ul>
      </div>

      <div class="col-lg-3 mb-4" style="margin-left: 50px;">
        <h5 style="font-weight: 700; font-size: clamp(18px, 2vw, 20px);">Hubungi Kami</h5>
        <div class="mb-2"><i class="fa-solid fa-phone me-2"></i>+62123456789</div>
        <div class="mb-2"><i class="fa-solid fa-location-dot me-2"></i>Universitas Ciputra Surabaya</div>
        <div class="mb-3"><i class="fa-solid fa-envelope me-2"></i>customerservice@goclean</div>
        
        <h5 style="font-weight: 700; font-size: clamp(18px, 2vw, 20px);">Sosial Media Kami</h5>
        <div>
          <a href="#" class="text-decoration-none me-3" style="color: #E0EAB8;"><i class="fab fa-linkedin"></i></a>
          <a href="" class="text-decoration-none me-3" style="color: #E0EAB8;"><i class="fab fa-instagram"></i></a>
          <a href="#" class="text-decoration-none" style="color: #E0EAB8;"><i class="fab fa-facebook"></i></a>
        </div>
      </div>
    </div>

    <!-- Bottom copyright -->
    <div class="row">
      <div class="col text-center border-top pt-3" style="font-size: 14px;">
        © 2025, BersihIn
      </div>
    </div>
  </div>
</footer>
