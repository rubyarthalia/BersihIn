<?php

namespace App\Http\Controllers;

use Midtrans\Snap;
use App\Models\Cart;
use Midtrans\Config;
use App\Models\Order;
use App\Models\Service;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\LikeService;
use App\Models\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //
    public function layanan_customer_show($kategori, $category_id){

        $category = Category::where('id', $category_id)->firstOrFail();

        if (strtolower($category->nama) !== strtolower($kategori)) {
            abort(404); 
        }

        $services = Service::where('category_id', $category_id)
                   ->where('status_del', 0)
                   ->paginate(8);


    return view('customer.catalog', compact('category', 'services'));
    }
    public function produk_detail_show($id)
    {
        $service = Service::where('id', $id)->firstOrFail();

        $isLiked = false;
        if (Auth::guard('customer')->check()) {
            $customerId = Auth::guard('customer')->user()->id;
            $isLiked = LikeService::where('customer_id', $customerId)
                ->where('service_id', $service->id)
                ->where('status_del', 0)
                ->exists();
        }

        return view('customer.product', compact('service', 'isLiked'));
    }
    public function cart_show()
    {
        if (!Auth::guard('customer')->check()) {
            return redirect()->route('login.show')->with('error', 'Silakan login terlebih dahulu.');
        }

        $customerId = Auth::guard('customer')->user()->id;
        $cart = Cart::where('customer_id', $customerId)->where('status_del', 0)->first();
        $cartItems = [];

        if ($cart) {
            $cartItems = CartItem::with('service')
                ->where('cart_id', $cart->id)
                ->where('status_del', 0)
                ->get();
        }

        return view('customer.cart', compact('cartItems'));
    }
    public function landing_show()
    {
        return view('customer.landing');
    }

    public function aboutus_show()
    {
        return view('customer.aboutus');
    }
    // public function ordercart_show(Request $request)
    // {
    //     $user = Auth::guard('customer')->user();

    //     $cart = Cart::where('id', $user->id)->where('status_del', 0)->first();

    //     if (!$cart) {
    //         return redirect()->back()->with('error', 'Cart kosong.');
    //     }

    //     $selected_services = CartItem::where('cart_id', $cart->id)
    //         ->where('status_pilih', true)
    //         ->where('status_del', 0)
    //         ->with('service')  
    //         ->get()
    //         ->map(function($item) {
    //             return [
    //                 'id' => $item->service->id,
    //                 'nama' => $item->service->nama,
    //                 'harga' => $item->service->harga,
    //                 'satuan' => $item->service->satuan,  
    //                 'gambar' => $item->service->gambar,
    //                 'qty' => $item->jumlah,
    //             ];
    //         });

    //     session(['selected_services' => $selected_services]);

    //     $addresses = $user->addresses()
    //         ->where('status_del', 0)
    //         ->with('subdistrict')
    //         ->get()
    //         ->map(function ($address) {
    //             $address->ongkos_kirim = $address->subdistrict->ongkos_kirim ?? 0;
    //             return $address;
    //         });

    //     $ongkos_kirim = $addresses->first()->ongkos_kirim ?? 0;

    //     return view('customer.order', compact('addresses', 'ongkos_kirim'));
    // }

    // public function order_show(Request $request)
    // {
    //     $data = [
    //         'id' => $request->query('id'),
    //         'nama' => $request->query('nama'),
    //         'harga' => $request->query('harga'),
    //         'satuan' => $request->query('satuan'),
    //         'gambar' => $request->query('gambar'),
    //         'tanggal' => $request->query('tanggal'),
    //         'jam' => $request->query('jam'),
    //         'qty' => $request->query('qty'),
    //     ];

    //     $selected_services = [$data];
    //     session(['selected_services' => $selected_services]);

    //     $user = Auth::guard('customer')->user();

    //     $addresses = $user->addresses()
    //         ->where('status_del', 0)
    //         ->with('subdistrict')
    //         ->get()
    //         ->map(function ($address) {
    //             $address->ongkos_kirim = $address->subdistrict->ongkos_kirim ?? 0;
    //             return $address;
    //         });

    //     $ongkos_kirim = $addresses->first()->ongkos_kirim ?? 0;

    //     return view('customer.order', compact('addresses', 'ongkos_kirim'));
    // }
    public function order_show(Request $request)
{
    $user = Auth::guard('customer')->user();

    if ($request->has(['id', 'nama', 'harga', 'satuan', 'gambar', 'qty'])) {
        $data = [
            'id' => $request->query('id'),
            'nama' => $request->query('nama'),
            'harga' => $request->query('harga'),
            'satuan' => $request->query('satuan'),
            'gambar' => $request->query('gambar'),
            'qty' => $request->query('qty'),
            'tanggal' => $request->query('tanggal'),
            'jam' => $request->query('jam'),
        ];

        $selected_services = [$data];
    } else {
        $cart = Cart::where('customer_id', $user->id)->where('status_del', 0)->first();
        if (!$cart) {
            return redirect()->back()->with('error', 'Cart kosong.');
        }
        $jam = $request->query('jam');
        $tanggal = $request->query('tanggal');

        $selected_services = CartItem::where('cart_id', $cart->id)
            ->where('status_del', 0)
            ->with('service')
            ->get()
            ->map(function($item) use ($tanggal, $jam) {
                return [
                    'id' => $item->service->id,
                    'nama' => $item->service->nama,
                    'harga' => $item->service->harga,
                    'satuan' => $item->service->satuan,
                    'gambar' => $item->service->gambar,
                    'qty' => $item->jumlah,
                    'tanggal' => $tanggal,
                    'jam' => $jam,
                ];
            });

    }

    // Simpan ke session
    session(['selected_services' => $selected_services]);

    // Ambil alamat customer
    $addresses = $user->addresses()
        ->where('status_del', 0)
        ->with('subdistrict')
        ->get()
        ->map(function ($address) {
            $address->ongkos_kirim = $address->subdistrict->ongkos_kirim ?? 0;
            return $address;
        });

    $ongkos_kirim = $addresses->first()->ongkos_kirim ?? 0;

    return view('customer.order', compact('addresses', 'ongkos_kirim'));
}

    public function store(Request $request)
    {
        $tanggal = Carbon::now()->format('dmy');
        $todayOrderCount = Order::whereDate('created_at', Carbon::today())->count() + 1;
        $urut = str_pad($todayOrderCount, 4, '0', STR_PAD_LEFT);
        $orderId = $tanggal . $urut;

        $customer = Auth::guard('customer')->user();
        $alamatId = $request->input('alamat');
        $catatan = $request->input('catatan');

        $selected_services = session('selected_services', []);

        $tanggal_modal_raw = $selected_services[0]['tanggal'] ?? '';
        $tanggal_modal = trim(explode(',', $tanggal_modal_raw)[1] ?? '');
        $tahun = date('Y');
        $tanggal_full = $tanggal_modal . ' ' . $tahun;

        $jam = str_replace('.', ':', $selected_services[0]['jam'] ?? '00:00');

        $tanggal_jadwal = date('Y-m-d H:i:s', strtotime("$tanggal_full $jam"));

        $selected_services = session('selected_services', []);
        $total_jasa = 0;

        foreach ($selected_services as $service) {
            $total_jasa += $service['harga'] * $service['qty'];
        }
    
        $order = Order::create([
            'id' => $orderId,
            'customer_id' => $customer->id,
            'tanggal_jadwal' => $tanggal_jadwal,
            'ongkos_kirim' => $request->input('ongkos_kirim'),
            'harga_total' => $total_jasa + $request->input('ongkos_kirim'),
            'metode_pembayaran' => $request->input('metode_pembayaran', 'eWallet'), 
            'status_pembayaran' => 'Unpaid',
            'status_layanan' => 'Belum Dilaksanakan',
            'created_at' => now(),
            'updated_at' => now(),
            'status_del' => 0,
        ]);

        foreach ($selected_services as $service) {
            OrderService::create([
                'order_id' => $order->id,
                'service_id' => $service['id'], 
                'cleaner_id' => 'CLN250427001',
                'jumlah' => $service['qty'],
                'catatan' => $catatan ?? '',
                'sub_total' => $service['harga'] * $service['qty'],
                'created_at' => now(),
                'updated_at' => now(),
                'status_del' => 0,
            ]);
        }
        // Hapus item yang sudah dipilih dari cart
        $cart = Cart::where('customer_id', $customer->id)->where('status_del', 0)->first();

        if ($cart) {
            CartItem::where('cart_id', $cart->id)
                ->where('status_del', 0)
                ->delete();
        }


        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $order->harga_total,
            ],
            'customer_details' => [
                'first_name' => Auth::guard('customer')->user()->nama,
                'email' => Auth::guard('customer')->user()->email,
                'phone' => Auth::guard('customer')->user()->nomor_telepon,
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        return view('customer.payment', compact('snapToken', 'order'));
    }

    public function paymentSuccess(Request $request)
    {
        $orderId = $request->input('order_id');

        $order = Order::findOrFail($orderId);
        $order->status_pembayaran = 'Paid';
        $order->save();

        return response()->json(['message' => 'Payment status updated']);
    }
    public function addToCart(Request $request)
    {
        if (!Auth::guard('customer')->check()) {
            return response()->json(['error' => 'Silakan login terlebih dahulu.'], 401);
        }

        $customer = Auth::guard('customer')->user();
        $serviceId = $request->input('service_id');
        $jumlah = $request->input('jumlah', 1);

        $cart = Cart::firstOrCreate(
            ['customer_id' => $customer->id, 'status_del' => 0],
            ['created_at' => now(), 'updated_at' => now()]
        );

        $existingItem = CartItem::where('cart_id', $cart->id)
            ->where('service_id', $serviceId)
            ->where('status_del', 0)
            ->first();

        if ($existingItem) {
            $existingItem->jumlah += $jumlah;
            $existingItem->updated_at = now();
            $existingItem->save();
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'service_id' => $serviceId,
                'jumlah' => $jumlah,
                'status_pilih' => 1,
                'status_del' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return response()->json(['success' => 'Layanan berhasil ditambahkan ke keranjang.']);
    }

    public function updateQuantity(Request $request)
{
    $cartItemId = $request->input('cart_item_id');
    $newQty = (int) $request->input('jumlah');

    if (!$cartItemId || $newQty < 1) {
        return response()->json(['success' => false, 'message' => 'Parameter tidak lengkap atau jumlah tidak valid']);
    }

    $cartItem = CartItem::with('service')->find($cartItemId);

    if (!$cartItem || $cartItem->status_del != 0) {
        return response()->json(['success' => false, 'message' => 'Item tidak ditemukan']);
    }

    if (!$cartItem->service) {
        return response()->json(['success' => false, 'message' => 'Service tidak ditemukan']);
    }

    $cartItem->jumlah = $newQty;
    $cartItem->updated_at = now();
    $cartItem->save();

    $customerId = Auth::guard('customer')->user()->id ?? null;
    $total = 0;

    if ($customerId) {
        $cart = Cart::where('customer_id', $customerId)->where('status_del', 0)->first();
        if ($cart) {
            $total = CartItem::with('service')
                ->where('cart_id', $cart->id)
                ->where('status_del', 0)
                ->get()
                ->sum(fn($item) => $item->jumlah * ($item->service->harga ?? 0));
        }
    }

    $subtotal = $cartItem->jumlah * $cartItem->service->harga;

    return response()->json([
        'success' => true,
        'subtotal' => $subtotal,
        'subtotal_formatted' => number_format($subtotal, 0, ',', '.'),
        'total' => $total,
        'total_formatted' => number_format($total, 0, ',', '.'),
    ]);
}

public function deleteCartItem(Request $request)
{
    $cartItemId = $request->input('cart_item_id');

    if (!$cartItemId) {
        return response()->json(['success' => false, 'message' => 'ID item tidak ditemukan.']);
    }

    $cartItem = CartItem::find($cartItemId);

    if (!$cartItem || $cartItem->status_del != 0) {
        return response()->json(['success' => false, 'message' => 'Item tidak ditemukan.']);
    }

    $cartItem->status_del = 1;
    $cartItem->updated_at = now();
    $cartItem->save();

    return response()->json(['success' => true]);
}



}
