@extends('base.admin')

@section('content')
<div style="font-family: 'Montserrat', sans-serif; padding: 30px; background-color: #f9fdf8; min-height: 100vh;">
    <div style="max-width: 1200px; margin: 0 auto; background: white; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); padding: 25px;">
        <h2 style="color: #014A3F; font-size: 24px; font-weight: bold; margin-bottom: 25px;">All Orders</h2>

        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background-color: #f2f2f2;">
                        <th style="padding: 12px 15px; text-align: left; font-weight: bold; border-bottom: 2px solid #ddd;">Invoice Number</th>
                        <th style="padding: 12px 15px; text-align: left; font-weight: bold; border-bottom: 2px solid #ddd;">User</th>
                        <th style="padding: 12px 15px; text-align: right; font-weight: bold; border-bottom: 2px solid #ddd;">Total Price</th>
                        <th style="padding: 12px 15px; text-align: left; font-weight: bold; border-bottom: 2px solid #ddd;">Status</th>
                        <th style="padding: 12px 15px; text-align: left; font-weight: bold; border-bottom: 2px solid #ddd;">Metode Pembayaran</th>
                        <th style="padding: 12px 15px; text-align: left; font-weight: bold; border-bottom: 2px solid #ddd;">Order Date</th>
                        <th style="padding: 12px 15px; text-align: center; font-weight: bold; border-bottom: 2px solid #ddd;">View Order</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 12px 15px;">{{ $order->id }}</td>
                        <td style="padding: 12px 15px;">{{ $order->customer_id ?? 'Unknown' }}</td>
                        <td style="padding: 12px 15px; text-align: right;">Rp {{ number_format($order->harga_total, 0, ',', '.') }}</td>
                        <td style="padding: 12px 15px;">
                            @if($order->status_pembayaran === 'Paid')
                                <span style="display: inline-block; padding: 4px 8px; background-color: #d4edda; color: #155724; border-radius: 4px; font-size: 14px;">Paid</span>
                            @elseif($order->status_pembayaran === 'Pending')
                                <span style="display: inline-block; padding: 4px 8px; background-color: #fff3cd; color: #856404; border-radius: 4px; font-size: 14px;">Pending</span>
                            @else
                                <span style="display: inline-block; padding: 4px 8px; background-color: #ffcdcd; color: #850404; border-radius: 4px; font-size: 14px;">{{ $order->status_pembayaran }}</span>
                            @endif
                        </td>
                        <td style="padding: 12px 15px;">{{ $order->metode_pembayaran }}</td>
                        <td style="padding: 12px 15px;">{{ $order->created_at->format('d M Y H:i') }}</td>
                        <td style="padding: 12px 15px; text-align: center;">
                            <a href="{{ route('order_admin.show', $order->id) }}" style="display: inline-block; padding: 6px 12px; background-color: #E0EAB8; color: #014A3F; border-radius: 4px; text-decoration: none; font-size: 14px;">View Details</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
