<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Admin;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
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
     
    public function signup_show()
    {
        return view('auth.signup');
    }

    public function signup_auth(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers,email',
            'notelpon' => 'required|string|max:20|unique:customers,nomor_telepon',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $datePart = Carbon::now()->format('ymd');
        $prefix = 'CUST' . $datePart;
        $latestCustomer = Customer::where('id', 'LIKE', $prefix . '%')->latest('id')->first();

        if ($latestCustomer) {
            $lastSerial = (int) substr($latestCustomer->id, -5);
            $newSerial = $lastSerial + 1;
        } else {
            $newSerial = 1;
        }

        $serialPart = str_pad($newSerial, 5, '0', STR_PAD_LEFT);
        $newCustomerId = $prefix . $serialPart;

        $customer = Customer::create([
            'id' => $newCustomerId, 
            'nama' => $request->nama,
            'email' => $request->email,
            'nomor_telepon' => $request->notelpon,
            'password' => Hash::make($request->password),
        ]);

        Auth::guard('customer')->login($customer);
        $request->session()->regenerate();

        return redirect()->route('landing.show');
    }
    public function login_show()
    {
        return view('auth.login');
    }

    public function login_auth(Request $request)
    {
        // ----> ADDED THIS DEFENSIVE LOGIC <----
        // Force a logout of all guards to ensure a clean slate before attempting a new login.
        Auth::guard('admin')->logout();
        Auth::guard('customer')->logout();
        
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
            $request->session()->regenerate();
            return redirect()->route('landing_admin.show');
        }

        // LOGIN CUSTOMER
        $customer = Customer::where(function ($q) use ($username) {
            $q->where('email', $username)
                ->orWhere('nomor_telepon', $username);
        })->where('status_del', 0)->first();

        if ($customer && Hash::check($password, $customer->password)) {
            Auth::guard('customer')->login($customer);
            $request->session()->regenerate();
            return redirect()->route('landing.show');
        }

        return back()->withErrors(['login' => 'Nomor/email atau password salah.']);
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        Auth::guard('customer')->logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.show');
    }
}