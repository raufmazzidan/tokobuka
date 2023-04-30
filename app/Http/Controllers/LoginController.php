<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\Rules\Password;

class LoginController extends Controller
{
    protected $maxAttempts = 1;
    protected $decayMinutes = 1;
    public function index()
    {
        return view('login');
    }

    public function authenticate(Request $request)
    {
        if (RateLimiter::tooManyAttempts(request()->ip(), 3)) {
            $request->session()->flash('count', 30);
            return back()->with('errorMessage', 'Anda telah memasukkan password salah sebanyak 3 kali. ');
        }
        $request->validate([
            'username' => [
                'required',
            ],
            'password' => Password::min(8)->mixedCase()->numbers(),
            'captcha' => 'required|captcha'
        ]);

        $credentials = [
            'username' => $request['username'],
            'password' => $request['password'],
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            RateLimiter::clear(request()->ip());

            if (Auth::user()->role == 'admin' || Auth::user()->role == 'staff') {
                return redirect()->intended('/product');
            } else {
                return redirect()->intended('/');
            }
        } else {
            RateLimiter::hit(request()->ip(), 30);
        }

        return back()->with('errorMessage', 'Email, atau password yang Anda masukkan salah');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function reloadCaptcha()
    {
        return response()->json(['captcha' => captcha_img()]);
    }
}