<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css')
    <style type="text/css">
        .div_center
        {
            text-align: center;
            padding-top: 40px;
        }
        .center
        {
          margin: auto;
          width: 50%;
          text-align: center;
          margin-top: 40px;
          border: 2px solid white;
        }
        .h2_font
        {
            font-size: 40px;
            padding-bottom: 40px;
        }
        .img_size
        {
            width: 100px;
            height: 100px;
        }
        .th_color
        {
            background: skyblue;
        }
        .th_space
        {
            padding: 20px;
        }
        .green{
            color: green;
        }
        </style>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      @include('admin.sidebar')
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
        @include('admin.header')
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">

            @if(session()->has('message'))
              <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                {{session()->get('message')}}</div>
            @endif

            <div class="div_center">
                <h2 class="h2_font">All Orders</h1>
                <table class="center">
                    <tr class="th_color">
                        <th class="th_space">Name</th>
                        <th class="th_space">Email</th>
                        <th class="th_space">Phone</th>
                        <th class="th_space">Address</th>
                        <th class="th_space">Product Title</th>
                        <th class="th_space">Quantity</th>
                        <th class="th_space">Price</th>
                        <th class="th_space">Payment Status</th>
                        <th class="th_space">Delivery Status</th>
                        <th class="th_space">Image</th>
                        <th class="th_space">Print PDF</th>
                        <th class="th_space">Delivered</th>
                        
                        <th class="th_space">Delete</th>
                    </tr>
                    @foreach($orders as $order)
                    <tr>
                        <td>{{$order->name}}</td>
                        <td>{{$order->email}}</td>
                        <td class="th_space">{{$order->phone}}</td>
                        <td>{{$order->address}}</td>
                        <td>{{$order->product_title}}</td>
                        <td>{{$order->quantity}}</td>
                        <td>${{$order->price}}</td>
                        <td>{{$order->payment_status}}</td>
                        <td>{{$order->delivery_status}}</td>
                        <td>
                            <img class="img_size" src="/product/{{$order->image}}">
                        </td>
                        <td><a class="btn btn-secondary" href="{{route('print_orderinfo', $order->id)}}">Print</a></td>
                        @if($order->delivery_status == 'Processing')
                        <td><a class="btn btn-primary" onclick="return confirm('Are your sure this product is delivered')" href="{{route('delivered', $order->id)}}">If delivered</a></td>
                        @else
                        <td><p class="green">Complited</p></td>
                        <td><a class="btn btn-primary" href="{{route('order_delete', $order->id)}}">Delete</a></td>
                        @endif
                    </tr>
                    @endforeach
                </table>
                </div>
            </div>
        </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')    
    <!-- End custom js for this page -->
  </body>
</html>