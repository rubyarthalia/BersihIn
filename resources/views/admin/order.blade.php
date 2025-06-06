{{-- order --}}
@extends('base.admin')

@section('content')
<div style="font-family: 'Montserrat', sans-serif; padding: 30px; background-color: #f9fdf8; min-height: 100vh;">
    <div style="max-width: 800px; margin: 0 auto; background: white; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); padding: 25px;">
        <h2 style="color: #014A3F; font-size: 24px; font-weight: bold; margin-bottom: 25px; border-bottom: 2px solid #E0EAB8; padding-bottom: 10px;">Order Details</h2>
        
        <table style="width: 100%; border-collapse: collapse; margin-bottom: 30px;">
            <tr style="border-bottom: 1px solid #eee;">
                <th style="padding: 12px 15px; text-align: left; width: 30%;">Invoice Number</th>
                <td style="padding: 12px 15px;">{{ $order->invoice_number ??  $order->id }}</td>
            </tr>
            <tr style="border-bottom: 1px solid #eee;">
                <th style="padding: 12px 15px; text-align: left;">Customer</th>
                <td style="padding: 12px 15px;">{{ $order->customer_id ?? 'Unknown' }}</td>
            </tr>
            <tr style="border-bottom: 1px solid #eee;">
                <th style="padding: 12px 15px; text-align: left;">Total Price</th>
                <td style="padding: 12px 15px; font-weight: bold;">Rp {{ number_format($order->harga_total, 0, ',', '.') }}</td>
            </tr>
            <tr style="border-bottom: 1px solid #eee;">
                <th style="padding: 12px 15px; text-align: left;">Shipping Fee </th>
                <td style="padding: 12px 15px; font-weight: bold;">Rp {{ number_format($order->ongkos_kirim, 0, ',', '.') }}</td>
            </tr>
            <tr style="border-bottom: 1px solid #eee;">
                <th style="padding: 12px 15px; text-align: left;">Status</th>
                <td style="padding: 12px 15px;">
                    @if($order->status_pembayaran === 'Paid')
                    <span style="display: inline-block; padding: 4px 8px; background-color: #d4edda; color: #155724; border-radius: 4px; font-size: 14px;">Paid</span>
                    @elseif($order->status_pembayaran === 'Pending')
                    <span style="display: inline-block; padding: 4px 8px; background-color: #fff3cd; color: #856404; border-radius: 4px; font-size: 14px;">Pending</span>
                    @else
                    <span style="display: inline-block; padding: 4px 8px; background-color: #ffcdcd; color: #850404; border-radius: 4px; font-size: 14px;">{{ $order->status_pembayaran }}</span>
                    @endif
                </td>
            </tr>
            {{-- <tr style="border-bottom: 1px solid #eee;">
                <th style="padding: 12px 15px; text-align: left;">Payment URL</th>
                <td style="padding: 12px 15px;">{{ $order->payment_url ?? '-' }}</td>
            </tr> --}}
            <tr>
                <th style="padding: 12px 15px; text-align: left;">Order Date</th>
                <td style="padding: 12px 15px;">{{ $order->created_at->format('d M Y H:i') }}</td>
            </tr>
        </table>

        <h4 style="color: #014A3F; font-size: 20px; margin: 30px 0 15px 0; border-bottom: 2px solid #E0EAB8; padding-bottom: 8px;">Order Items</h4>
        
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; margin-bottom: 30px;">
                <thead>
                    <tr style="background-color: #f2f2f2;">
                        <th style="padding: 12px 15px; text-align: left; border-bottom: 2px solid #ddd;">#</th>
                        <th style="padding: 12px 15px; text-align: left; border-bottom: 2px solid #ddd;">Nama Produk</th>
                        <th style="padding: 12px 15px; text-align: left; border-bottom: 2px solid #ddd;">Jumlah</th>
                        <th style="padding: 12px 15px; text-align: left; border-bottom: 2px solid #ddd;">Satuan</th>
                        <th style="padding: 12px 15px; text-align: right; border-bottom: 2px solid #ddd;">Harga</th>
                        <th style="padding: 12px 15px; text-align: right; border-bottom: 2px solid #ddd;">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->orderServices as $index => $item)
                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 12px 15px;">{{ $index + 1 }}</td>
                        <td style="padding: 12px 15px;">{{ $item->service->nama ?? $item->nama_produk ?? 'Produk Tidak Diketahui' }}</td>
                        <td style="padding: 12px 15px;">{{ $item->jumlah }}</td>
                        <td style="padding: 12px 15px;">{{ $item->service->satuan }}</td>
                        <td style="padding: 12px 15px; text-align: right;">Rp {{ number_format($item->service->harga, 0, ',', '.') }}</td>
                        <td style="padding: 12px 15px; text-align: right; font-weight: bold;">Rp {{ number_format($item->sub_total, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <a href="{{ route('landing_admin.show') }}" style="display: inline-block; padding: 10px 20px; background-color: #014A3F; color: white; text-decoration: none; border-radius: 5px; font-weight: bold; margin-top: 20px;">
            Back to Orders
        </a>
    </div>
</div>
@endsection
