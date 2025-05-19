<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // عرض صفحة تسجيل الدخول
    public function showLogin()
    {
        return view('auth.login');
    }

    // معالجة عملية تسجيل الدخول
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required','email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('/')->with('status', 'You have successfully registered!');
        }

        return back()
            ->withErrors(['email' => 'بيانات الاعتماد هذه غير صحيحة.'])
            ->onlyInput('email');
    }

    // تسجيل الخروج
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    // عرض صفحة التسجيل
    public function showRegister()
    {
        return view('auth.register');
    }

    // معالجة عملية التسجيل
    public function register(Request $request)
    {
        $data = $request->validate([
            'name'     => ['required','string','max:255'],
            'email'    => ['required','string','email','max:255','unique:users'],
            'password' => ['required','confirmed','min:8'],
        ]);

        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        Auth::login($user);
        return redirect('/')->with('status', 'You have successfully registered!');
    }
}
