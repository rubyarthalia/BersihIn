<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Service;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //
    public function layanan_admin_show($kategori, $category_id){

         
        $category = Category::where('id', $category_id)->firstOrFail();

        if (strtolower($category->nama) !== strtolower($kategori)) {
            abort(404); 
        }

        $services = Service::where('category_id', $category_id)->get();

    return view('admin.catalog', compact('category', 'services'));
    }
    public function addServices_show($kategori, $category_id)
    {
        if (!$category_id || $category_id == '0') {
            return abort(404, "Category ID tidak valid");
        }

        // Cari kategori dengan where karena id bertipe string
        $category = Category::where('id', $category_id)->first();
        if (!$category) {
            return abort(404, "Kategori tidak ditemukan");
        }

        $services = Service::where('ID', $category_id)->where('status_del', 0)->get();

        return view('admin.add', compact('kategori', 'category_id', 'category', 'services'));
    }

    public function addServices_add(Request $request, $kategori, $category_id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:50',
            'harga' => 'required|numeric|min:0',
            'satuan' => 'required|in:Meter Persegi,Meter,Jam,Unit,Pasang,Dudukan',
            'promo' => 'required|string',
            'deskripsi' => 'required|string',
            'gambar' => 'required|image|mimes:png|max:2048',
        ], [
                'nama.required' => 'Nama layanan wajib diisi.',
                'nama.max' => 'Nama layanan maksimal 50 karakter.',
                'harga.required' => 'Harga wajib diisi.',
                'harga.numeric' => 'Harga harus berupa angka.',
                'harga.min' => 'Harga tidak boleh negatif.',
                'promo.required' => 'promo wajib diisi.',
                'deskripsi.required' => 'deskripsi wajib diisi.',
                'gambar.required' => 'gambar wajib diisi.',
            ]);

        try {
            $category = Category::findOrFail($category_id);

            $lastService = Service::orderBy('id', 'desc')->first();
            $lastNumber = $lastService ? intval(substr($lastService->id, 4)) : 0;
            $newId = 'SRVC' . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);

            $gambar = $request->file('gambar');
            $gambarName = $gambar->getClientOriginalName(); 
            $gambar->storeAs('public/Images', $gambarName); 


            Service::create([
                'id' => $newId,
                'nama' => $validated['nama'],
                'harga' => $validated['harga'],
                'satuan' => $validated['satuan'],
                'kalimat_promosi' => $validated['promo'],
                'deskripsi' => $validated['deskripsi'],
                'category_id' => $category->id,
                'gambar' => $gambarName,
                'status_del' => 0
            ]);


            return redirect()
                ->route('layanan_admin.show', [
                    'kategori' => strtolower($kategori),
                    'category_id' => $category->id
                ])
                ->with('success', 'Layanan berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Gagal menambahkan layanan: ' . $e->getMessage());
        }
    }

    public function editServices_show($service_id)
    {
        $service = Service::findOrFail($service_id);
        return view('admin.edit', compact('service'));
    }
    
    public function updateService(Request $request, $service_id)
    {
        try {
            $service = Service::findOrFail($service_id);

            $validated = $request->validate([
                'nama' => 'required|string|max:50',
                'harga' => 'required|numeric|min:0',
                'satuan' => 'required|string|in:Meter Persegi,Meter,Jam,Unit,Pasang,Dudukan',
                'kalimat_promosi' => 'required|string',
                'deskripsi' => 'required|string'
            ], [
                'nama.required' => 'Nama layanan wajib diisi.',
                'nama.max' => 'Nama layanan maksimal 50 karakter.',
                'harga.required' => 'Harga wajib diisi.',
                'harga.numeric' => 'Harga harus berupa angka.',
                'harga.min' => 'Harga tidak boleh negatif.',
            ]);

            $validated['ID'] = $service->category_id;

            $service->update($validated);

            return redirect()
            ->route('layanan_admin.show', [
                'kategori' => $service->categories->nama,   
                'category_id' => $service->category_id
            ])
            ->with('success', 'Layanan berhasil diperbarui');

        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Gagal memperbarui layanan karena '.$e->getMessage());
        }
    }

    public function softDelete($service_id)
    {
        $service = Service::findOrFail($service_id);
        $service->status_del = 1;
        $service->save();

        return redirect()->back()->with('success', 'Layanan berhasil dihapus.');
    }
    public function restore($service_id)
    {
        $service = Service::findOrFail($service_id);
        $service->status_del = 0;
        $service->save();

        return redirect()->back()->with('success', 'Layanan berhasil dipulihkan.');
    }

    public function landing_show()
    {
        $orders = Order::with('customer')->orderBy('created_at')->get();
        return view('admin.landing', compact('orders'));  // <-- kirim variabel $orders ke view
    }

    public function order_show($id)
    {
        $order = Order::with(['customer', 'orderServices.service'])
        ->findOrFail($id);
        return view('admin.order', compact('order'));
    }

}
