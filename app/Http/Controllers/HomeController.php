<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function rootpage(){
        $products = product::paginate(10);
        return view('home.userpage', compact('products'));
    }
    
    public function index(){
        return view('admin.dashboard');
    }

    public function product_details($id){
        $product = product::find($id);
        return view('home.product_details', compact('product'));
    }
}
