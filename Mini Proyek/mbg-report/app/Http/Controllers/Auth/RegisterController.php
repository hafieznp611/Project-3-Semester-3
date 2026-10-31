<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'email'        => ['required', 'email', 'max:255', 'unique:users,email'],
            'username'     => ['required', 'string', 'max:50', 'alpha_dash', 'unique:users,username'],
            'no_hp'        => ['nullable', 'string', 'max:20'],
            'password'     => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([
            'nama_lengkap' => $data['nama_lengkap'],
            'email'        => $data['email'],
            'username'     => $data['username'],
            'no_hp'        => $data['no_hp'] ?? null,
            'password'     => $data['password'],
            'role'         => 'complainant', // role diisi sistem, bukan dari form
        ]);

        return redirect()
            ->route('login')
            ->with('success', 'Registrasi berhasil. Silakan login.');
    }
}