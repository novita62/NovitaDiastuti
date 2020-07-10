<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class BerandaController extends Controller
{
    //
    public function index() {    
        return view('beranda');
    }
    public function logout () {
        //logout user
        auth()->logout();
        // redirect to homepage
        return redirect('/login');
    }
}
