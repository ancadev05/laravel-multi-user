<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SesiController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate(
            [
                'email' => 'required',
                'password' => 'required',
            ],
            [
                'email.required' => 'email wajib diisi',
                'password.required' => 'password wajib diisi'
            ]
        );

        // menampung isi emali dan password
        $infologin = [
            'email' => $request->email,
            'password' => $request->password
        ];

        //  proses pengecekan jika email dan password terdaftar
        if (Auth::attempt($infologin)) {
            return redirect('/admin');
            exit();
        } else {
            return redirect('')->withErrors('username dan password tidak sesuai')->withInput();
        }
    }

    // function logout
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
