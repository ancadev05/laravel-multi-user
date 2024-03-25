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
            // mengarahkan kehalaman sesuai dengan jenis role 
            if(Auth::user()->role == 'operator'){
                return redirect('admin/operator');
            } elseif (Auth::user()->role == 'keuangan'){
                return redirect('admin/keuangan');
            } elseif (Auth::user()->role == 'marketing'){
                return redirect('admin/marketing');
            }
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
