@extends('base.base')

@section('content')
<section style="font-family: 'Montserrat', sans-serif; background-color: #f9fdf8; min-height: 100vh; padding: 20px;">
    <form method="POST" action="{{ route('order.store') }}">
        @csrf
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

                @php
                    $total_jasa = 0;
                @endphp

                @foreach (session('selected_services', []) as $service)
                    @php
                        $subtotal = $service['harga'] * $service['qty'];
                        $total_jasa += $subtotal;
                    @endphp
                    <div style="display: grid; grid-template-columns: 60px 2fr 1fr 1fr 1fr 1fr; align-items: center; padding: 15px 0; border-bottom: 1px solid #eee;">
                        <div style="width: 50px; height: 50px; overflow: hidden; border-radius: 5px;">
                            <img src="{{ asset('Images/' . $service['gambar'].'.png') }}" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <div>
                            <p style="font-weight: bold; margin: 0;">{{ $service['nama'] }}</p>
                            <p style="font-size: 13px; color: #666; margin: 0;">{{ $service['tanggal'] }} | Mulai dari jam {{ $service['jam'] }}</p>
                        </div>
                        <div style="text-align: right;">Rp {{ number_format($service['harga'], 0, ',', '.') }}</div>
                        <div style="text-align: right;">{{ $service['satuan'] }}</div>
                        <div style="text-align: right;">{{ $service['qty'] }}</div>
                        <div style="text-align: right; font-weight: bold;">Rp {{ number_format($subtotal, 0, ',', '.') }}</div>
                    </div>
                @endforeach
            </div>

            <div style="border-top: 1px solid #ddd; margin: 25px 0;"></div>

            <h2 style="color: #014A3F; font-size: 20px; font-weight: bold; margin-bottom: 20px;">Detail Pesanan</h2>

            <div style="margin-bottom: 20px;">
                <label for="nama" style="font-weight: bold; display: block; margin-bottom: 5px;">Nama</label>
                <input type="text" id="nama" name="nama" value="{{ Auth::guard('customer')->user()->nama }}" readonly style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; margin-bottom: 15px;">

                <label for="kontak" style="font-weight: bold; display: block; margin-bottom: 5px;">Nomor Kontak</label>
                <input type="text" id="kontak" name="kontak" value="{{ Auth::guard('customer')->user()->nomor_telepon }}" readonly style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
            </div>

            <div style="margin-bottom: 20px;">
                <p style="font-weight: bold; margin-bottom: 5px;">Alamat</p>
                <select name="alamat_id" id="alamat" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; background-color: white;">
                    <option value="">Pilih Alamat</option>
                    @foreach($addresses as $alamat)
                        <option value="{{ $alamat->ID }}" data-ongkir="{{ $alamat->ongkos_kirim }}">{{ $alamat->alamat }}</option>
                    @endforeach
                </select>
            </div>

            <div style="margin-bottom: 20px;">
                <p style="font-weight: bold; margin-bottom: 5px;">Catatan (Opsional)</p>
                <textarea name="catatan" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; min-height: 80px; resize: none;"></textarea>
            </div>

            <input type="hidden" name="ongkos_kirim" id="input_ongkir" value="{{ $ongkos_kirim }}">
            <input type="hidden" name="harga_total" id="input_total" value="{{ $total_jasa + $ongkos_kirim }}">
            

            <div style="border-top: 2px solid #014A3F; padding-top: 20px;">
                <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                    <p style="font-weight: bold;">Biaya Transportasi</p>
                    <p style="" data-role="ongkir">Rp {{ number_format($ongkos_kirim, 0, ',', '.') }}</p>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                    <p style="font-weight: bold;">Biaya Jasa</p>
                    <p>Rp {{ number_format($total_jasa, 0, ',', '.') }}</p>
                </div>
                <div style="display: flex; justify-content: space-between; margin-top: 15px; padding-top: 10px; border-top: 1px solid #eee;">
                    <p style="font-weight: bold; font-size: 18px;">Total Biaya</p>
                    <p style="font-weight: bold; font-size: 18px; color: #014A3F;" data-role="total">Rp {{ number_format($total_jasa + $ongkos_kirim, 0, ',', '.') }}</p>
                </div>

                <button type="submit" style="display: inline-block; text-align: center; background-color: #014A3F; color: white; border: none; padding: 12px; font-weight: bold; border-radius: 5px; width: 100%; margin-top: 25px; cursor: pointer;">
                    Bayar
                </button>
            </div>
        </div>
    </form>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const alamatSelect = document.getElementById('alamat');
        const ongkirDisplay = document.querySelector('p[data-role="ongkir"]');
        const totalDisplay = document.querySelector('p[data-role="total"]');
        const inputOngkir = document.getElementById('input_ongkir');
        const inputTotal = document.getElementById('input_total');
        const biayaJasa = {{ $total_jasa }};

        alamatSelect.addEventListener('change', function () {
            const selectedOption = alamatSelect.options[alamatSelect.selectedIndex];
            const ongkir = parseInt(selectedOption.dataset.ongkir || 0);
            const total = ongkir + biayaJasa;

            function formatRupiah(number) {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0, 
                    maximumFractionDigits: 0
                }).format(number);
            }

            if (ongkirDisplay) ongkirDisplay.textContent = formatRupiah(ongkir);
            if (totalDisplay) totalDisplay.textContent = formatRupiah(total);
            if (inputOngkir) inputOngkir.value = ongkir;
            if (inputTotal) inputTotal.value = total;
        });
    });
    </script>
</section>
@endsection
