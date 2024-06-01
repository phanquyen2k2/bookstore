<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if ($user) {
            return redirect()->route('dashboard');
        } else {
            return view('dashboard');
        }
    }

    public function admin()
    {
        return view("Admin.HomeAdmin");
    }

    public function user()
    {
        return view("user");
    }

    public function seller()
    {
        return view("seller");
    }
}

