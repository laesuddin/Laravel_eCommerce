<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Cart;

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

    public function add_cart(Request $request, $id){
        if(Auth::id()){
             $user = Auth::user();
             $product = product::find($id);
             $cart = new cart;
             $cart->name = $user->name;
             $cart->email = $user->email;
             $cart->user_id = $user->id;
             $cart->product_title = $product->title;
             
             if($product->discount_price != null)
             {
                $cart->price = $product->discount_price * $request->quantity;
             }
             else{
                $cart->price = $product->price * $request->quantity;
             }

             $cart->image = $product->image;
             $cart->product_id = $product->id;
             $cart->quantity = $request->quantity;
             $cart->save();
             return redirect()->back();
        }
        else{
            return redirect('login');
        }
    }
}
