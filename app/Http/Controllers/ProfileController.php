<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //
    public function show(){
        return view('customer.profile.biodata');
    }

    public function alamat_show(){
        return view('customer.profile.alamat');
    }

    public function wishlist_show(){
        return view('customer.profile.wishlist');
    }

    public function transaksi_show(){
        return view('customer.profile.transaksi');
    }

    public function ulasan_show(){
        return view('customer.profile.ulasan');
    }
}
