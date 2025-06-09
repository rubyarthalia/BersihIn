<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Ulasan;
use App\Models\Address;
use App\Models\LikeService;
use App\Models\Subdistrict;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    //
    public function show(){
        return view('customer.profile.biodata');
    }

    public function alamat_show(){
        $customerId = Auth::guard('customer')->user()->id;

        $addresses = Address::where('customer_id', $customerId)
            ->with('subdistrict')
            ->get();
        $subdistricts = Subdistrict::where('status_del', 0)->get();

        return view('customer.profile.alamat', compact('addresses', 'subdistricts'));
    }
    public function alamat_store(Request $request){
        $request->validate([
        'label_alamat' => 'required|string',
        'alamat_lengkap' => 'required|string',
        'subdistrict_id' => 'required|exists:subdistricts,id',
        ]);

        Address::create([
            'customer_id' => Auth::guard('customer')->id(),
            'alamat' => $request->alamat_lengkap,
            'subdistrict_id' => $request->subdistrict_id,
            'status' => $request->label_alamat,
            'status_del' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return back()->with('success', 'Alamat berhasil ditambahkan');
    }
    public function alamat_update(Request $request, $id){
        $request->validate([
            'label_alamat' => 'required|string',
            'alamat_lengkap' => 'required|string',
            'subdistrict_id' => 'required|exists:subdistricts,id',
        ]);

        $alamat = Address::findOrFail($id);
        $alamat->update([
            'alamat' => $request->alamat_lengkap,
            'subdistrict_id' => $request->subdistrict_id,
            'status' => $request->label_alamat,
            'status_del' => (int) $request->input('status_del'),
            'updated_at' => now(),
        ]);


        return back()->with('success', 'Alamat berhasil diperbarui');
    }

    public function wishlist_show()
    {
        if (!Auth::guard('customer')->check()) {
            return redirect()->route('login.show')->with('error', 'Silakan login terlebih dahulu.');
        }

        $customerId = Auth::guard('customer')->user()->id;

        $wishlist = LikeService::with('service')
            ->where('customer_id', $customerId)
            ->where('status_del', 0)
            ->paginate(4);

        return view('customer.profile.wishlist', compact('wishlist'));
    }

    public function toggleWishlist(Request $request)
    {
        if (!Auth::guard('customer')->check()) {
            return response()->json(['success' => false, 'message' => 'Anda harus login terlebih dahulu.'], 401);
        }

        $customerId = Auth::guard('customer')->user()->id;
        $serviceId = $request->input('service_id');

        $likeService = LikeService::where('customer_id', $customerId)
            ->where('service_id', $serviceId)
            ->first();

        if ($likeService) {
            $likeService->status_del = $likeService->status_del == 0 ? 1 : 0;
            $likeService->save();

            $liked = $likeService->status_del == 0;
            $message = $liked ? 'Ditambahkan ke wishlist' : 'Dihapus dari wishlist';
        } else {
            LikeService::create([
                'customer_id' => $customerId,
                'service_id' => $serviceId,
                'status_del' => 0,
            ]);

            $liked = true;
            $message = 'Ditambahkan ke wishlist';
        }

        return response()->json(['success' => true, 'liked' => $liked, 'message' => $message]);
    }

    public function transaksi_show(Request $request){
        $customerId = Auth::guard('customer')->user()->id;

        $statusFilter = $request->input('status', 'semua'); // default semua
        $dateFilter = $request->input('date', 'semua');

        $query = Order::with(['orderservices.service', 'orderservices.cleaner', 'customer'])
            ->where('status_del', 0)
            ->where('customer_id', $customerId);

        // Filter status
        if ($statusFilter !== 'semua') {
            $query->where('status_layanan', $statusFilter);
        }

        // Filter tanggal
        if ($dateFilter !== 'semua') {
            $today = \Carbon\Carbon::today();

            if ($dateFilter === 'hari-ini') {
                $query->whereDate('tanggal_jadwal', $today);
            } elseif ($dateFilter === 'minggu-ini') {
                $startOfWeek = $today->copy()->startOfWeek();
                $endOfWeek = $today->copy()->endOfWeek();
                $query->whereBetween('tanggal_jadwal', [$startOfWeek, $endOfWeek]);
            } elseif ($dateFilter === 'bulan-ini') {
                $startOfMonth = $today->copy()->startOfMonth();
                $endOfMonth = $today->copy()->endOfMonth();
                $query->whereBetween('tanggal_jadwal', [$startOfMonth, $endOfMonth]);
            }
        }

        $orders = $query->orderBy('tanggal_jadwal', 'desc')->paginate(5);

        // Kirim filter yang dipakai ke view biar dropdown bisa default ke pilihan user
        return view('customer.profile.transaksi', compact('orders', 'statusFilter', 'dateFilter'));
    }

    public function detailtransaksi_show($id)
    {
        $order = Order::with(['orderServices.service', 'orderServices.cleaner'])->find($id);

        if (!$order) {
            return response()->json(['message' => 'Order tidak ditemukan'], 404);
        }

        return response()->json([
            'id' => $order->id,
            'tanggal_jadwal' => $order->tanggal_jadwal,
            'metode_pembayaran' => $order->metode_pembayaran,
            'status_layanan' => $order->status_layanan,
            'biaya_transportasi' => $order->ongkos_kirim,
            'harga_total' => $order->harga_total,
            // 'cleaner' => optional($order->orderServices->first()->cleaner), 
            'items' => $order->orderServices->map(function ($item) {
                return [
                    'jumlah' => $item->jumlah,
                    'harga' => $item->service ? $item->service->harga : 0,
                    'sub_total' => $item->sub_total,
                    'service' => $item->service ? [
                        'nama' => $item->service->nama,
                        'satuan' => $item->service->satuan,
                        'harga' => $item->service->harga,
                    ] : null
                ];
            })
        ]);
    }


    public function ulasan_show(){
        $customerId = Auth::guard('customer')->user()->id;

        $orders = Order::with('ulasan')
            ->where('customer_id', $customerId)
            ->where('status_layanan', 'Selesai')
            ->orderBy('created_at', 'desc')
            ->paginate(4);

        return view('customer.profile.ulasan', compact('orders'));
    }
    public function ulasan_add(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'nilai' => 'required|integer|min:1|max:5',
            'komen' => 'nullable|string|max:1000',
        ]);

        $customerId = Auth::guard('customer')->user()->id;

        $order = Order::where('id', $request->order_id)
                    ->where('customer_id', $customerId)
                    ->where('status_layanan', 'Selesai')
                    ->firstOrFail();

        $existingUlasan = $order->ulasan;
        if ($existingUlasan) {
            return redirect()->back()->with('error', 'Ulasan untuk pesanan ini sudah ada.');
        }
        $lastReview = Ulasan::where('id', 'like', 'REV%')
                        ->orderBy('id', 'desc')
                        ->first();

        if ($lastReview) {
            $lastNumber = intval(substr($lastReview->id, 3));
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }
        $newID ='REV' . str_pad($newNumber, 6, '0', STR_PAD_LEFT);

        Ulasan::create([
            'id'=>$newID,
            'order_id' => $order->id,
            'customer_id' => $customerId,
            'nilai' => $request->nilai,
            'komen' => $request->komen,
            'tanggal_ulasan'=>now()
        ]);

        return response()->json(['success' => true, 'message' => 'Ulasan berhasil disimpan']);
    }

}
