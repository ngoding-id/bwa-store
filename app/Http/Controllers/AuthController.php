<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min_digits:8',
            'is_store_open' => 'nullable',
            'store_name' => 'required|string'
        ]);

        try {
            DB::beginTransaction();

            $user = new User();
            $user->name = $request->full_name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->store_status = $request->has('is_store_open');
            $user->store_name = $request->store_name;

            $user->save();
            DB::commit();

            return redirect()->route('auth.register.success');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors();
        }
    }

    public function registerSuccess()
    {
        return view('auth.register-success');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function auth(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required'
        ]);

        try {
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();

                return redirect()->route('home')->with('successMessage', 'Login berhasil!');
            } else {
                return back()->withInput()->with('errorMessage', 'Alamat Email/Kata Sandi Salah!');
            }
        } catch (Exception $e) {

        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
 
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
