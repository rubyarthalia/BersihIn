@extends('base.base')

@section('content')
<div style="max-width: 800px; margin: 0 auto; font-family: 'Montserrat', sans-serif; padding: 16px; position: relative;">

    <div style=" font-weight: bold; cursor: pointer; font-size: 24px; color: #014A3F; margin-bottom:10px">
    <i class="fa-solid fa-cart-shopping" ></i> Keranjang
    </div> 

    <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 16px;">
  <i id="checkIcon" class="cursor: pointer; fa-regular fa-square" style="color: #014A3F; font-size: 20px;"></i>

  <div style="background-color: white; border: 1px solid #e0e0e0; border-radius: 8px; padding: 16px; flex: 1; display: flex; flex-direction: column; justify-content: space-between; height: 100%;">
      
      <div style="display: flex; gap: 12px;">
          <div style="flex-shrink: 0;">
              <img src="{{ asset('Images/pembersihan_ruangan.png') }}" alt="Cleaning Service" style="
                  width: 150px;
                  height: auto;
                  border-radius: 8px;
                  object-fit: cover;
              ">
          </div>

          <div style="flex: 1; display: flex; flex-direction: column; justify-content: space-between;">
              <div>
                <h2 style="font-size: 20px; color: #014A3F; margin-bottom: 4px; font-family: 'Montserrat', sans-serif; font-weight: bold;">Cuci AC</h2>
                <p style="font-size: 16px; color: #014A3F; font-family: 'Hind', sans-serif; margin-bottom: 4px;">15 Mei 2025 | Mulai dari jam 12.00</p>
                <p style="font-size: 16px; color: #014A3F; font-family: 'Hind', sans-serif; margin-bottom: 12px;">Rp90.000/Unit</p>
              </div>
              <div style="display: flex; align-items: center; justify-content: space-between; margin-top: 12px;">
                
                <div style="display: flex; align-items: center; gap: 8px;">
                  <span style="font-weight: 600; font-size: 16px; color: #014A3F; font-family: 'Hind', sans-serif;">
                    Jumlah Unit:
                  </span>
                  <div id="quantity-container" style="display: flex; gap: 0px; border: 1px solid #ddd; border-radius: 4px; overflow: hidden; align-items: center;">
                    <button onclick="decreaseQty()" style="width: 32px; height: 32px; border: none; background: white; font-size: 18px; cursor: pointer;">-</button>
                    <input id="qty-input" type="text" value="1" style="color: #014A3F; width: 40px; text-align: center; font-weight: bold; border: none; outline: none;" inputmode="numeric" pattern="[0-9]*">
                    <button onclick="increaseQty()" style="width: 32px; height: 32px; border: none; background: white; font-size: 18px; cursor: pointer;">+</button>
                  </div>
                </div>

                <div style="font-weight: bold; font-size: 20px; color: #014A3F; font-family: 'Hind', sans-serif;">
                  Subtotal: <span id="subtotal">Rp90.000</span>
                </div>
              </div>
          </div>
      </div>

  </div>
</div>


    <div style="display: flex; justify-content: flex-end; margin-bottom: 25px; margin-top: 25px;">
        <div style="
            padding: 16px;
            text-align: right;
            border: 1px solid #2E8656;
            border-radius: 10px;
            max-width: 350px;
            width: 100%;
        ">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                <span style="font-size: 16px; font-family: 'Montserrat', sans-serif; color: #014A3F; font-weight: bold;">Total</span>
                <span style="font-size: 18px; font-family: 'Montserrat', sans-serif; color: #014A3F; font-weight: bold;">Rp0</span>
            </div>
            <a href="{{ route('order.show') }}" style="
                display: inline-block;
                background-color: #014A3F;
                color: white;
                border: none;
                padding: 10px 16px;
                border-radius: 4px;
                font-weight: bold;
                cursor: pointer;
                width: 100%;
                font-family: 'Montserrat', sans-serif;
                text-align: center;
                text-decoration: none;
            ">
            Checkout Sekarang
            </a>

        </div>
    </div>
</div>

<!-- Script -->
<script>
    function increaseQty() {
        const input = document.getElementById('qty-input');
        let current = parseInt(input.value) || 1;
        input.value = current + 1;
    }

    function decreaseQty() {
        const input = document.getElementById('qty-input');
        let current = parseInt(input.value) || 1;
        if (current > 1) {
            input.value = current - 1;
        }
    }

    const check = document.getElementById('checkIcon');
    const totalElem = document.querySelector('div[style*="display: flex"][style*="justify-content: space-between"] span:nth-child(2)');

    check.addEventListener('click', () => {
        check.classList.toggle('fa-regular');
        check.classList.toggle('fa-solid');
         if (check.classList.contains('fa-solid')) {
            totalElem.textContent = 'Rp90.000';
        } else {
            totalElem.textContent = 'Rp0';
        }
    });
</script>
@endsection
