<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\Session;
use Stripe;

class HomeController extends Controller
{
    public function rootpage(){
        $products = product::paginate(10);
        return view('home.userpage', compact('products'));
    }

    public function product_details($id){
        $product = product::find($id);
        return view('home.product_details', compact('product'));
    }

    public function add_cart(Request $request, $id){
        if(Auth::id()){
             $user = Auth::user();
             $userid = $user->id;
             $product = product::find($id);
             $product_exist_id = cart::where('product_id', '=', $id)->where('user_id', '=', $userid)->get('id')->first();
             if($product_exist_id){
                $cart = cart::find($product_exist_id)->first();
                $quantity = $cart->quantity;
                $cart->quantity = $quantity + $request->quantity;
                if($product->discount_price != null)
                {
                   $cart->price = $product->discount_price * $cart->quantity;
                }
                else{
                   $cart->price = $product->price * $cart->quantity;
                }
                $cart->save();
                return redirect()->back()->with('message', 'Product Added Successfully in the Cart');

             }else{
                $cart = new cart;
                $cart->name = $user->name;
                $cart->email = $user->email;
                $cart->phone = $user->phone;
                $cart->address = $user->address;
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
   
                $cart = session()->get('cart', []);
                // Add the item to the cart
                $cart[] = $request->input('product_id');
                // Store the updated cart in the session
                session()->put('cart', $cart);
                // Count the total items in the cart
                $cartCount = count($cart);
   
                return redirect()->back()->with('message', 'Product Added Successfully in the Cart');
             }

        }
        else{
            return redirect('login');
        }
    }

    public function show_cart(){
        if(Auth::id()){
            $id = Auth::user()->id;
            $cart = cart::where('user_id', '=' , $id)->get();
            $cartItems = cart::all();
            if($cartItems->isEmpty()){
                return view('home.empty_cart');
            }else{
                return view('home.showcart', compact('cart'));
            } 
        }
        else{
            return redirect('login');
        }
    }

    public function remove_cart(Request $request ,$id){
        $cart = cart::find($id);
        $cart->delete();

        // Get the cart from the session
        $cart = session()->get('cart', []);
        // Remove the item from the cart
        if (($key = array_search($request->input('product_id'), $cart)) !== false) {
            unset($cart[$key]);
        }
        // Store the updated cart in the session
        session()->put('cart', $cart);
        // Count the total items in the cart
        $cartCount = count($cart);     
        return redirect()->back();
    }

    public function cash_order(Request $request){
        $id = Auth::user()->id;
        $carts = cart::where('user_id', '=' , $id)->get();
        foreach($carts as $cart){
            $order = new order;
            $order->name = $cart->name;
            $order->email = $cart->email;
            $order->phone = $cart->phone;
            $order->address = $cart->address;
            $order->user_id = $cart->user_id;
            $order->product_title = $cart->product_title;
            $order->price = $cart->price;
            $order->quantity = $cart->quantity;
            $order->image = $cart->image;
            $order->product_id = $cart->product_id;
            $order->payment_status = 'Cash on Delivery';
            $order->delivery_status = 'Processing';
            $order->save();

            $cart_id = $cart->id;
            $find_cart = cart::find($cart_id);
            $find_cart->delete();

            // Get the cart from the session
            $cart = session()->get('cart', []);
            // Remove the item from the cart
            if (($key = array_search($request->input('product_id'), $cart)) !== false) {
                unset($cart[$key]);
            }
            // Store the updated cart in the session
            session()->put('cart', $cart);
            // Count the total items in the cart
            $cartCount = count($cart);  
        }
        return view('home.comfirm_product');
    }

    public function stripe($totalprice){
        return view('home.stripe', compact('totalprice'));
    }

    public function stripePost(Request $request, $totalprice)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    
        Stripe\Charge::create ([
                "amount" => $totalprice * 100,
                 "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Thanks for Payment." 
        ]);
        

        $id = Auth::user()->id;
        $carts = cart::where('user_id', '=' , $id)->get();
        foreach($carts as $cart){
            $order = new order;
            $order->name = $cart->name;
            $order->email = $cart->email;
            $order->phone = $cart->phone;
            $order->address = $cart->address;
            $order->user_id = $cart->user_id;
            $order->product_title = $cart->product_title;
            $order->price = $cart->price;
            $order->quantity = $cart->quantity;
            $order->image = $cart->image;
            $order->product_id = $cart->product_id;
            $order->payment_status = 'Paid';
            $order->delivery_status = 'Processing';
            $order->save();

            $cart_id = $cart->id;
            $find_cart = cart::find($cart_id);
            $find_cart->delete();

            // Get the cart from the session
            $cart = session()->get('cart', []);
            // Remove the item from the cart
            if (($key = array_search($request->input('product_id'), $cart)) !== false) {
                unset($cart[$key]);
            }
            // Store the updated cart in the session
            session()->put('cart', $cart);
            // Count the total items in the cart
            $cartCount = count($cart);  
        }

        Session::flash('success', 'Payment successful!');
        return view('home.comfirm_product');
    }

    public function show_order(){
        if(Auth::id()){
            $id = Auth::user()->id;
            $order = order::where('user_id', '=' , $id)->get();
            $orderItems = order::all();
            if($orderItems->isEmpty()){
                return view('home.empty_order');
            }else{
                return view('home.showorder', compact('order'));
            } 
        }
        else{
            return redirect('login');
        }
    }

    public function remove_order($id){
        $order = order::find($id);
        $order->delete();       
        return redirect()->back();
    }

    public function product_search(Request $request){
        $search_text = $request->search;
        $products = product::where('title', 'LIKE', "%$search_text%")->orWhere('catagory', 'LIKE', "$search_text")->paginate(10);      
        return view('home.userpage', compact('products'));
    }

    public function search_product(Request $request){
        $search_text = $request->search;
        $products = product::where('title', 'LIKE', "%$search_text%")->orWhere('catagory', 'LIKE', "$search_text")->paginate(10);      
        return view('home.all_products', compact('products'));
    }

    public function all_products(){   
        $products = product::paginate(10); 
        return view('home.all_products', compact('products'));
    }
}
