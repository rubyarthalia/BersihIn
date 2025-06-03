<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function layanan_admin_show($kategori, $category_id){

         // Validasi kategori dan category_id cocok
        $category = Category::where('id', $category_id)->firstOrFail();

        if (strtolower($category->nama) !== strtolower($kategori)) {
            abort(404); // atau redirect jika perlu
        }

        $services = Service::where('category_id', $category_id)->get();

    return view('admin.catalog', compact('category', 'services'));
    }
    public function addServices_show()
    {
        return view('admin.add');
    }

    public function editServices_show($service_id)
    {
        $service = Service::findOrFail($service_id);
        return view('admin.edit', compact('service'));
    }
    
    public function updateService(Request $request, $service_id)
    {
        // dd($service_id);
        
        $service = Service::findOrFail($service_id);
        $validated = $request->validate([
            'nama' => 'required|string|max:50',
            'harga' => 'required|numeric|min:0',
            'satuan' => 'required|string|in:Meter Persegi,Meter,Jam,Unit,Pasang,Dudukan',
            'kategori_id' => 'required|exists:categories,id',
            'kalimat_promosi' => 'required|string',
            'deskripsi' => 'required|string'
        ], [
            'nama.required' => 'Nama layanan wajib diisi.',
            'nama.max' => 'Nama layanan maksimal 50 karakter.',
            'harga.required' => 'Harga wajib diisi.',
            'harga.numeric' => 'Harga harus berupa angka.',
            'harga.min' => 'Harga tidak boleh negatif.'
        ]);
        $service->update($validated);

        return redirect()->route('layanan_admin.show')->with('success', 'Layanan berhasil diperbarui');
    }
    public function landing_show()
    {
        return view('admin.landing');
    }
    public function order_show()
    {
        return view('admin.order');
    }
    public function demoSubmit(Request $request)
    {
        return redirect()->route('layanan_admin.show', ['kategori' => 'cleaning', 'category_id' => 'C01'])->with('success', 'Simulasi pengisian berhasil. (Data tidak disimpan)');
    }
}
