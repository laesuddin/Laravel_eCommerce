<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Catagory;
use App\Models\Product;
use App\Models\Order;
use PDF;

class AdminController extends Controller
{
    public function index(){
        $total_product = product::all()->count();
        $total_order = order::all()->count();
        $total_customer = user::all()->count();
        $total_delivered = order::where('delivery_status', '=', 'Delivered')->get()->count();
        $total_processing = order::where('delivery_status', '=', 'Processing')->get()->count();
        $orders = order::all();
        $total_revenue = 0;
        foreach($orders as $order){
            if($order->delivery_status == 'Delivered'){
                $total_revenue = $total_revenue + $order->price;
            }
        }
        return view('admin.dashboard', compact('total_product','total_order','total_customer', 'total_revenue', 'total_delivered', 'total_processing'));
    }

    public function view_catagory(){
        if(Auth::id()){
            $data = catagory::all();
            return view('admin.catagory', compact('data'));
        }else{
            return redirect('login');
        }

    }

    public function add_catagory(Request $request){
        if(Auth::id()){
        $data= new catagory;
        $data->catagory_name = $request->catagory;
        $data->save();
        return redirect()->back()->with('message', 'Catagory Added Successfully');
        }else{
            return redirect('login');
        }
    }

    public function delete_catagory($id){
        if(Auth::id()){
        $data = catagory::find($id);
        $data->delete();
        return redirect()->back()->with('message', 'Catagory Deleted Successfully');
        }else{
            return redirect('login');
        }
    }

    public function view_product(){
        if(Auth::id()){
        $catagorys = catagory::all();
        return view('admin.product', compact('catagorys'));
        }else{
            return redirect('login');
        }
    }

    public function add_product(Request $request){
        if(Auth::id()){
        $product= new product;
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->discount_price = $request->dis_price;
        $product->catagory = $request->catagory;

        $image = $request->image;
        $imagename = time().'.'.$image->getClientOriginalExtension();
        $request->image->move('product', $imagename);
        $product->image = $imagename;

        $product->save();
        return redirect()->back()->with('message', 'Product Added Successfully');
        }else{
            return redirect('login');
        }
    }

    public function show_product(){
        if(Auth::id()){
        $products = product::all();
        return view('admin.show_product', compact('products'));
        }else{
            return redirect('login');
        }
    }

    public function delete_product($id){
        if(Auth::id()){
        $product = product::find($id);
        $product->delete();
        return redirect()->back()->with('message', 'Product Deleted Successfully');
        }else{
            return redirect('login');
        }
    }

    public function update_product($id){
        if(Auth::id()){
        $product = product::find($id);
        $catagorys = catagory::all();
        return view('admin.update_product', compact('product', 'catagorys'));
        }else{
            return redirect('login');
        }
    }

    public function update_product_confirm(Request $request, $id){
        if(Auth::id()){
        $product = product::find($id);
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->discount_price = $request->dis_price;
        $product->catagory = $request->catagory;

        $image = $request->image;
        if($image)
        {
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $request->image->move('product', $imagename);
            $product->image = $imagename;
        }
        $product->save();
        return redirect()->back()->with('message', 'Product Updated Successfully');
        }else{
        return redirect('login');
        }
    }

    public function order(){
        if(Auth::id()){
        $orders = order::all();
        return view('admin.order', compact('orders'));
        }else{
            return redirect('login');
        }
    }

    public function delivered($id){
        if(Auth::id()){
        $orders = order::find($id);
        $orders->delivery_status = "Delivered";
        $orders->payment_status = "Paid";
        $orders->save();
        return redirect()->back();
        }else{
            return redirect('login');
        }
    }

    public function order_delete($id){
        if(Auth::id()){
        $orders = order::find($id);
        $orders->delete();
        return redirect()->back()->with('message', 'Order Deleted Successfully');
        }else{
            return redirect('login');
        }
    }

    public function print_orderinfo($id){
        if(Auth::id()){
        $orders = order::find($id);
        $pdf = pdf::loadView('admin.pdf', compact('orders'));
        return $pdf->download('order_details.pdf');
        }else{
            return redirect('login');
        }
    }
}
