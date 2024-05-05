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
        $data = catagory::all();
        return view('admin.catagory', compact('data'));
    }

    public function add_catagory(Request $request){
        $data= new catagory;
        $data->catagory_name = $request->catagory;
        $data->save();
        return redirect()->back()->with('message', 'Catagory Added Successfully');
    }

    public function delete_catagory($id){
        $data = catagory::find($id);
        $data->delete();
        return redirect()->back()->with('message', 'Catagory Deleted Successfully');
    }

    public function view_product(){
        $catagorys = catagory::all();
        return view('admin.product', compact('catagorys'));
    }

    public function add_product(Request $request){
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
    }

    public function show_product(){
        $products = product::all();
        return view('admin.show_product', compact('products'));
    }

    public function delete_product($id){
        $product = product::find($id);
        $product->delete();
        return redirect()->back()->with('message', 'Product Deleted Successfully');
    }

    public function update_product($id){
        $product = product::find($id);
        $catagorys = catagory::all();
        return view('admin.update_product', compact('product', 'catagorys'));
    }

    public function update_product_confirm(Request $request, $id){
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
    }

    public function order(){
        $orders = order::all();
        return view('admin.order', compact('orders'));
    }

    public function delivered($id){
        $orders = order::find($id);
        $orders->delivery_status = "Delivered";
        $orders->payment_status = "Paid";
        $orders->save();
        return redirect()->back();
    }

    public function order_delete($id){
        $orders = order::find($id);
        $orders->delete();
        return redirect()->back()->with('message', 'Order Deleted Successfully');
    }

    public function print_orderinfo($id){
        $orders = order::find($id);
        $pdf = pdf::loadView('admin.pdf', compact('orders'));
        return $pdf->download('order_details.pdf');
    }
}
