@extends('base.base')
@section('content')
<div class="container mx-auto px-6 py-12 max-w-md mb-5">
  <div class="bg-white rounded-3xl shadow-xl p-8 text-center" style="font-family: 'Montserrat', sans-serif;">
    <h1 class="text-3xl font-extrabold text-green-900 mb-6 pb-5">
      Pembayaran Pesanan
    </h1>
    <p class="text-gray-700 mb-8 text-lg leading-relaxed">
      Klik tombol di bawah ini untuk menyelesaikan pembayaran Anda dengan mudah dan cepat.
    </p>
    <button id="pay-button" type="submit" style="width: 350px; margin-bottom:10px; padding: 12px; background-color: #34A853; color: white; border: none; border-radius: 5px; font-size: 16px; font-weight: bold; cursor: pointer;">
      Bayar Sekarang
    </button>
  </div>
</div>


<script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client') }}"></script>

<script>
    var snapToken = "{{ $snapToken }}";
    var orderId = "{{ $order->id }}";

    document.getElementById('pay-button').onclick = function () {
        snap.pay(snapToken, {
            onSuccess: function (result) {
                console.log('Pembayaran sukses:', result);

                fetch("{{ route('payment.success') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        order_id: orderId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data.message);
                    window.location.href = "{{ route('transaksi.show') }}";
                });
            },
            onPending: function (result) {
                console.log('Pembayaran pending:', result);
            },
            onError: function (result) {
                console.log('Pembayaran gagal:', result);
            },
            onClose: function () {
                alert('Anda menutup popup pembayaran tanpa menyelesaikan pembayaran');
            }
        });
    };
</script>
@endsection
