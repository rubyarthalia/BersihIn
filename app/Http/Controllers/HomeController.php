<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function layanan_customer_show($kategori, $category_id){

         // Validasi kategori dan category_id cocok
        $category = Category::where('id', $category_id)->firstOrFail();

        if (strtolower($category->nama) !== strtolower($kategori)) {
            abort(404); // atau redirect jika perlu
        }

        $services = Service::where('category_id', $category_id)->get();

    return view('customer.catalog', compact('category', 'services'));
    }
    public function produk_detail_show($id){
        $service = Service::where('id', $id)->firstOrFail();
        return view('customer.product', compact('service'));
    }
    public function cart_show(){
        return view('customer.cart');
    }
    public function landing_show()
    {
        return view('customer.landing');
    }

    public function aboutus_show()
    {
        return view('customer.aboutus');
    }
    public function order_show()
    {
        return view('customer.order');
    }
    
}
