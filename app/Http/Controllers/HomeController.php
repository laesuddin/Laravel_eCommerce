<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function rootpage(){
        $products = product::all();
        return view('home.userpage', compact('products'));
    }
    
    public function index(){
        return view('admin.dashboard');
    }
}
