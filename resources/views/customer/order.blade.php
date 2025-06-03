@extends('base.base')

@section('content')
<section style="font-family: 'Montserrat', sans-serif; background-color: #f9fdf8; min-height: 100vh; padding: 20px;">
    <div style="max-width: 800px; margin: 0 auto; background: white; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); padding: 25px;">
        <h1 style="color: #014A3F; font-size: 24px; font-weight: bold; margin-bottom: 20px;">Pesanan Anda</h1>
        
        
        <div style="margin-bottom: 30px;">
  <div style="display: grid; grid-template-columns: 60px 2fr 1fr 1fr 1fr 1fr; align-items: center; padding: 10px 0; border-bottom: 2px solid #ccc; font-weight: bold; color: #014A3F;">
    <div></div> 
    <div></div>
    <div style="text-align: right;">Harga</div>
    <div style="text-align: right;">Satuan</div>
    <div style="text-align: right;">Jumlah</div>
    <div style="text-align: right;">Total</div>
  </div>

  <div style="display: grid; grid-template-columns: 60px 2fr 1fr 1fr 1fr 1fr; align-items: center; padding: 15px 0; border-bottom: 1px solid #eee;">
    <div style="width: 50px; height: 50px; overflow: hidden; border-radius: 5px;">
      <img src="{{ asset('Images/maintenance-1.png') }}" style="width: 100%; height: 100%; object-fit: cover;">
    </div>
    <div>
      <p style="font-weight: bold; margin: 0;">Cuci AC</p>
      <p style="font-size: 13px; color: #666; margin: 0;">15 Mei 2025 | Mulai dari jam 12:00</p>
    </div>
    <div style="text-align: right;">Rp 90.000</div>
    <div style="text-align: right;">Unit</div>
    <div style="text-align: right;">1</div>
    <div style="text-align: right; font-weight: bold;">Rp 90.000</div>
  </div>

  <div style="display: grid; grid-template-columns: 60px 2fr 1fr 1fr 1fr 1fr; align-items: center; padding: 15px 0; border-bottom: 1px solid #eee;">
    <div style="width: 50px; height: 50px; overflow: hidden; border-radius: 5px;">
      <img src="{{ asset('Images/cleaning-6.png') }}" style="width: 100%; height: 100%; object-fit: cover;">
    </div>
    <div>
      <p style="font-weight: bold; margin: 0;">Pembersihan Kolam Renang</p>
      <p style="font-size: 13px; color: #666; margin: 0;">15 Mei 2025 | Mulai dari jam 12:00</p>
    </div>
    <div style="text-align: right;">Rp 20.000</div>
    <div style="text-align: right;">m2</div>
    <div style="text-align: right;">10</div>
    <div style="text-align: right; font-weight: bold;">Rp 200.000</div>
  </div>

  <div style="display: grid; grid-template-columns: 60px 2fr 1fr 1fr 1fr 1fr; align-items: center; padding: 15px 0; border-bottom: 1px solid #eee;">
    <div style="width: 50px; height: 50px; overflow: hidden; border-radius: 5px;">
      <img src="{{ asset('Images/cleaning-1.png') }}" style="width: 100%; height: 100%; object-fit: cover;">
    </div>
    <div>
      <p style="font-weight: bold; margin: 0;">Pembersihan Ruangan</p>
      <p style="font-size: 13px; color: #666; margin: 0;">15 Mei 2025 | Mulai dari jam 12:00</p>
    </div>
    <div style="text-align: right;">Rp 70.000</div>
    <div style="text-align: right;">Jam</div>
    <div style="text-align: right;">2</div>
    <div style="text-align: right; font-weight: bold;">Rp 140.000</div>
  </div>
</div>

        
        <div style="border-top: 1px solid #ddd; margin: 25px 0;"></div>
        
        <h2 style="color: #014A3F; font-size: 20px; font-weight: bold; margin-bottom: 20px;">Detali Pesanan</h2>
        
        <div style="margin-bottom: 20px;">
        <label for="nama" style="font-weight: bold; display: block; margin-bottom: 5px;">Nama</label>
        <input type="text" id="nama" name="nama" placeholder="Masukkan nama Anda" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; margin-bottom: 15px;">

        <label for="kontak" style="font-weight: bold; display: block; margin-bottom: 5px;">Nomor Kontak</label>
        <input type="text" id="kontak" name="kontak" placeholder="Masukkan nomor kontak" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
      </div>

        
        <div style="margin-bottom: 20px;">
            <p style="font-weight: bold; margin-bottom: 5px;">Alamat</p>
            <select style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; background-color: white;">
                <option>Pilih Alamat</option>
                <option>Jl. Raya Darmo No. 123, Surabaya</option>
                <option>Jl. Mayjen Sungkono No. 45, Surabaya</option>
            </select>
        </div>
        
        <div style="margin-bottom: 20px;">
            <p style="font-weight: bold; margin-bottom: 5px;">Catatan (Opsional)</p>
            <textarea style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; min-height: 80px; resize: none;"></textarea>        </div>
        
        <div style="border-top: 2px solid #014A3F; padding-top: 20px;">
          <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                <p style="font-weight: bold;">Biaya Transportasi</p>
                <p>Rp 16.000</p>
            </div>
            <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                <p style="font-weight: bold;">Biaya Jasa</p>
                <p>Rp 430.000</p>
            </div>
            <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                <p style="font-weight: bold;">Biaya Transportasi</p>
                <p>Rp 16.000</p>
            </div>
            <div style="display: flex; justify-content: space-between; margin-top: 15px; padding-top: 10px; border-top: 1px solid #eee;">
                <p style="font-weight: bold; font-size: 18px;">Total Biaya</p>
                <p style="font-weight: bold; font-size: 18px; color: #014A3F;">Rp 446.000</p>
            </div>

            <a href="{{ route('transaksi.show') }}" style="display: inline-block; text-align: center; background-color: #014A3F; color: white; text-decoration: none; border: none; padding: 12px; font-weight: bold; border-radius: 5px; width: 100%; margin-top: 25px; cursor: pointer;">
                Bayar
            </a>

            
            {{-- <button style="background-color: #014A3F; color: white; border: none; padding: 12px; font-weight: bold; border-radius: 5px; width: 100%; margin-top: 25px; cursor: pointer;">
                Bayar
            </button> --}}
        </div>
    </div>
</section>
@endsection