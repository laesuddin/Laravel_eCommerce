<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function rootpage(){
        return view('home.userpage');
    }
    
    public function index(){
        return view('admin.dashboard');
    }
}
