<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="{{asset('images/logo-mini.png')}}" type="">
      <title>eCommerce</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="{{asset('home/css/bootstrap.css')}}"/>
      <!-- font awesome style -->
      <link href="{{asset('home/css/font-awesome.min.css')}}" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="{{asset('home/css/style.css')}}" rel="stylesheet" />
      <!-- responsive style -->
      <link href="{{asset('home/css/responsive.css')}}" rel="stylesheet" />
      <style type="text/css">
         .center{
            margin: auto;
            width: 50%;
            text-align: center;
            padding: 30px;
            padding-top: 120px;
         }
         table, th, td{
            border: 1px solid gray;
         }
         .th_style{
            font-size: 20px;
            padding: 5px;
            background: skyblue;
        }
        .img_style{
            height: 100px;
            width: 100px;
        }
        .total_style{
            font-size: 20px;
            padding: 40px;
        }
      </style>
   </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
         @include('home.header')
         <!-- end header section -->
     
        <div class="center">
            <table>
                <tr>
                    <th class="th_style">Product Title</th>
                    <th class="th_style">Quantity</th>
                    <th class="th_style">Price</th>
                    <th class="th_style">Payment Status</th>
                    <th class="th_style">Delivery Status</th>
                    <th class="th_style">Image</th>
                    <th class="th_style">Cancel Order</th>
                </tr>
                @php
                  $totalprice = 0 
               @endphp
                @foreach($order as $order)  
                <tr>
                    <td>{{$order->product_title}}</td>
                    <td>{{$order->quantity}}</td>
                    <td>${{$order->price}}</td>
                    <td>{{$order->payment_status}}</td>
                    <td>{{$order->delivery_status}}</td>
                    <td><img class="img_style" src="/product/{{$order->image}}"></td>
                    <td><a class="btn btn-danger" onclick="return confirm('Are you sure to cancel this order?')" href="{{route('remove_order', $order->id)}}">Cancel Order</a></td>
                </tr>
                @php 
                  $totalprice =  $totalprice + $order->price
                @endphp
                @endforeach
            </table>
            <div>
               <h1 class="total_style">Total Price You Order: ${{$totalprice}}</h1>
            </div>
        </div>

      <!-- footer start -->
      @include('home.footer')
      <!-- footer end -->
      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By<br>
         
         Developed By <a href="https://github.com/laesuddin/" target="_blank">Laes Uddin</a>
         
         </p>
      </div>
      <!-- jQery -->
      <script src="home/js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="home/js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="home/js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="home/js/custom.js"></script>
   </body>
</html>