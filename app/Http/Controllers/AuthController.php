<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Customer;

class AuthController extends Controller
{
    public function login_show()
    {
        return view('auth.login');
    }
    public function password_show()
    {
        return view('auth.password');
    }
    public function passwordemail_show()
    {
        return view('auth.email');
    }
    public function passwordemail_auth(Request $request)
    {
        return redirect()->route('password.show');
    }

    public function login_auth(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $username = $request->input('username');
        $password = $request->input('password');

        // LOGIN ADMIN
        $admin = Admin::where(function ($q) use ($username) {
            $q->where('email', $username)
                ->orWhere('nomor_telepon', $username);
        })->where('status_del', 0)->first();

        if ($admin && Hash::check($password, $admin->password)) {
            Auth::guard('admin')->login($admin);
            session(['role' => 'admin']);
            session(['user_id' => $admin->id]);
            return redirect()->route('landing_admin.show');
        }

        // LOGIN CUSTOMER
        $customer = Customer::where(function ($q) use ($username) {
            $q->where('email', $username)
                ->orWhere('nomor_telepon', $username);
        })->where('status_del', 0)->first();

        if ($customer && Hash::check($password, $customer->password)) {
            Auth::guard('customer')->login($customer);
            session(['role' => 'customer']);
            session(['user_id' => $customer->id]);
            return redirect()->route('landing.show');
        }

        return back()->withErrors(['login' => 'Nomor/email atau password salah.']);
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        Auth::guard('customer')->logout();
        session()->forget(['role', 'user_id']);

        return redirect()->route('login.show');
    }
}
