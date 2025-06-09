@extends('base.admin')

@section('content')
<div style="font-family: 'Montserrat', sans-serif; padding: 30px; background-color: #f9fdf8; min-height: 100vh;">
    <div style="max-width: 1200px; margin: 0 auto; background: white; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); padding: 25px;">
        <h2 style="color: #014A3F; font-size: 24px; font-weight: bold; margin-bottom: 25px;">All Orders</h2>
        <form method="GET" action="{{ route('landing_admin.show') }}" style="display: flex; flex-wrap: wrap; gap: 15px; margin-bottom: 20px;">
    <div>
        <label for="filterPembayaran">Status Pembayaran:</label><br>
        <select name="status_pembayaran" id="filterPembayaran" style="padding: 5px;">
            <option value="">Semua</option>
            <option value="Paid" {{ request('status_pembayaran') == 'Paid' ? 'selected' : '' }}>Paid</option>
            <option value="Unpaid" {{ request('status_pembayaran') == 'Unpaid' ? 'selected' : '' }}>Unpaid</option>
        </select>
    </div>

    <div>
        <label for="filterPelaksanaan">Status Pelaksanaan:</label><br>
        <select name="status_pelaksanaan" id="filterPelaksanaan" style="padding: 5px;">
            <option value="">Semua</option>
            <option value="Selesai" {{ request('status_pelaksanaan') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
            <option value="Belum Dilaksanakan" {{ request('status_pelaksanaan') == 'Belum Dilaksanakan' ? 'selected' : '' }}>Belum Dilaksanakan</option>
        </select>
    </div>

    <div>
        <label for="filterTanggal">Tanggal Order:</label><br>
        <input type="date" name="tanggal" id="filterTanggal" value="{{ request('tanggal') }}" style="padding: 5px;">
    </div>

    <div style="align-self: flex-end;">
        <button type="submit" style="padding: 5px 10px; background-color: #40744E; color: white; border: none; border-radius: 4px;">Filter</button>
    </div>
</form>


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
                    <tr class="order-row"
                    data-pembayaran="{{ $order->status_pembayaran }}"
                    data-pelaksanaan="{{ $order->status_pelaksanaan ?? 'Belum Dilaksanakan' }}"
                    data-tanggal="{{ $order->created_at->format('Y-m-d') }}"
                    style="border-bottom: 1px solid #eee;">
                        <td style="padding: 12px 15px;">{{ $order->id }}</td>
                        <td style="padding: 12px 15px;">{{ $order->customer_id ?? 'Unknown' }}</td>
                        <td style="padding: 12px 15px; text-align: right;">Rp {{ number_format($order->harga_total, 0, ',', '.') }}</td>
                        <td style="padding: 12px 15px;">
                            @if($order->status_pembayaran === 'Paid')
                                <span style="display: inline-block; padding: 4px 8px; background-color: #d4edda; color: #155724; border-radius: 4px; font-size: 14px;">Paid</span>

                            @else
                                <span style="display: inline-block; padding: 4px 8px; background-color: #ffcdcd; color: #850404; border-radius: 4px; font-size: 14px;">{{ $order->status_pembayaran }}</span>
                            @endif
                        </td>
                        <td style="padding: 12px 15px;">
                            @if($order->status_layanan === 'Selesai')
                                <span style="display: inline-block; padding: 4px 8px; background-color: #d4edda; color: #155724; border-radius: 4px; font-size: 14px;">{{ $order->status_layanan }} </span>
                            @else
                                <span style="display: inline-block; padding: 4px 8px; background-color: #ffcdcd; color: #850404; border-radius: 4px; font-size: 14px;">{{ $order->status_layanan }}</span>
                            @endif</td>
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
    <nav aria-label="Transaction pagination" class="d-flex justify-content-center mt-4">
                    {{ $orders->links() }}
                </nav>
                <style>
                .pagination .page-link {
                    color: #40744E;
                    border: 1px solid #40744E;
                }

                .pagination .page-item.active .page-link {
                    background-color: #40744E;
                    border-color: #40744E;
                    color: white;
                }

                .pagination .page-link:hover {
                    background-color: #40744E;
                    color: white;
                    border-color: #40744E;
                }
            </style>
</div>
@endsection
