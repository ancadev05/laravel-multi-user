<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $data = Auth::user()->name;
        // dd($data);
        return view('admin')->with('data', $data);
    }
}
