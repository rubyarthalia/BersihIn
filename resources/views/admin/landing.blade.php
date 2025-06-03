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
                        <th style="padding: 12px 15px; text-align: left; font-weight: bold; border-bottom: 2px solid #ddd;">Payment URL</th>
                        <th style="padding: 12px 15px; text-align: left; font-weight: bold; border-bottom: 2px solid #ddd;">Order Date</th>
                        <th style="padding: 12px 15px; text-align: center; font-weight: bold; border-bottom: 2px solid #ddd;">View Order</th>
                    </tr>
                </thead>
                <tbody>
                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 12px 15px;">INV-20250509-5OVY8U</td>
                        <td style="padding: 12px 15px;">User1</td>
                        <td style="padding: 12px 15px; text-align: right;">Rp 90.000</td>
                        <td style="padding: 12px 15px;">
                            <span style="display: inline-block; padding: 4px 8px; background-color: #d4edda; color: #155724; border-radius: 4px; font-size: 14px;">Paid</span>
                        </td>
                        <td style="padding: 12px 15px;">-</td>
                        <td style="padding: 12px 15px;">09 May 2025 01:59</td>
                        <td style="padding: 12px 15px; text-align: center;">
                            <a href="{{ route('order_admin.show') }}" style="display: inline-block; padding: 6px 12px; background-color: #E0EAB8; color: #014A3F; border-radius: 4px; text-decoration: none; font-size: 14px;">View Details</a>
                        </td>
                    </tr>
                    
                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 12px 15px;">INV-20250509-3ZAFQK</td>
                        <td style="padding: 12px 15px;">User1</td>
                        <td style="padding: 12px 15px; text-align: right;">Rp 190.000</td>
                        <td style="padding: 12px 15px;">
                            <span style="display: inline-block; padding: 4px 8px; background-color: #fff3cd; color: #856404; border-radius: 4px; font-size: 14px;">Pending</span>
                        </td>
                        <td style="padding: 12px 15px;">
                            <a href="#" style="display: inline-block; padding: 6px 12px; background-color: #014A3F; color: white; border-radius: 4px; text-decoration: none; font-size: 14px;">Pay Now</a>
                        </td>
                        <td style="padding: 12px 15px;">09 May 2025 01:17</td>
                        <td style="padding: 12px 15px; text-align: center;">
                            <a href="#" style="display: inline-block; padding: 6px 12px; background-color: #E0EAB8; color: #014A3F; border-radius: 4px; text-decoration: none; font-size: 14px;">View Details</a>
                        </td>
                    </tr>
                    
                    <tr>
                        <td style="padding: 12px 15px;">INV-20250506-EL19MR</td>
                        <td style="padding: 12px 15px;">User1</td>
                        <td style="padding: 12px 15px; text-align: right;">Rp 200.000</td>
                        <td style="padding: 12px 15px;">
                            <span style="display: inline-block; padding: 4px 8px; background-color: #fff3cd; color: #856404; border-radius: 4px; font-size: 14px;">Pending</span>
                        </td>
                        <td style="padding: 12px 15px;">-</td>
                        <td style="padding: 12px 15px;">06 May 2025 06:07</td>
                        <td style="padding: 12px 15px; text-align: center;">
                            <a href="#" style="display: inline-block; padding: 6px 12px; background-color: #E0EAB8; color: #014A3F; border-radius: 4px; text-decoration: none; font-size: 14px;">View Details</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection