<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function showLogin(){
        return view('auth.login');
    }

    public function login(Request $request){
        $data = $request->validate([
            'username' => ['required','string'],
            'password' => ['required','string']
        ]);

        if(Auth::attempt($data)){
            $request->session()->regenerate();
            return redirect()
                ->intended(route('products.index'))
                ->with('success', 'Berhasil login. Selamat datang, ' . Auth::user()->nama_lengkap . '!');
        }

        return back()
            ->withErrors(['username' => 'Username atau Password salah'])
            ->onlyInput('username');
    }

    public function logout(Request $request){

        $keranjang = session('keranjang',[]);
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        session(['keranjang' => $keranjang]);  
        
        return redirect()->route('products.index');
    }
    
}
