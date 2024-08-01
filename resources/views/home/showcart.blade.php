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
            font-size: 30px;
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
                    <th class="th_style">Product Quantity</th>
                    <th class="th_style">Price</th>
                    <th class="th_style">Image</th>
                    <th class="th_style">Action</th>
                </tr>
                @php
                  $totalprice = 0 
               @endphp
                @foreach($cart as $cart)  
                <tr>
                    <td>{{$cart->product_title}}</td>
                    <td>{{$cart->quantity}}</td>
                    <td>${{$cart->price}}</td>
                    <td><img class="img_style" src="/product/{{$cart->image}}"></td>
                    <td><a class="btn btn-danger" onclick="return confirm('Are you sure to remove this product?')" href="{{route('remove_cart', $cart->id)}}">Remove</a></td>
                </tr>
                @php 
                  $totalprice =  $totalprice + $cart->price
                @endphp
                @endforeach
            </table>
            <div>
               <h1 class="total_style">Total Price: ${{$totalprice}}</h1>
            </div>
            <div>
               <h1 style="font-size: 25px; padding-bottom: 15px;">Proceed to Order</h1>
               <a href="{{route('cash_order')}}" class="btn btn-danger">Cash On Delivery</a>
               <a href="{{route('stripe', $totalprice)}}" class="btn btn-danger">Pay Using Card</a>
            </div>
        </div>

      <!-- footer start -->
      @include('home.footer')
      <!-- footer end -->
      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
         
            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
         
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