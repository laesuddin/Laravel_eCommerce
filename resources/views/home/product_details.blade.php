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
   </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
         @include('home.header')
         <!-- end header section -->

      <div class="col-sm-6 col-md-4 col-lg-4" style="margin: auto; width: 50%; padding: 30px">
            @if(session()->has('message'))
              <div class="alert alert-success">
                {{session()->get('message')}}
               </div>
            @endif

                     <div class="img-box" style="padding: 20px">
                        <img src="/product/{{$product->image}}" height="350px" width="400px" alt="">
                     </div>
                     <div class="detail-box">
                        <h5>
                           {{$product->title}}
                        </h5>

                        @if($product->discount_price != null)
                        <h6 style="color: green;">
                        ${{$product->discount_price}}
                        </h6>

                        <h6 style="text-decoration: line-through; color: red;">
                        ${{$product->price}}
                        </h6>

                        @else
                        <h6 style="color: green;">
                        ${{$product->price}}
                        </h6>
                        @endif

                        <h6>Product Catagory:
                        {{$product->catagory}}
                        </h6>

                        <h6>Product Description:
                        {{$product->description}}
                        </h6>

                        <h6>Product Quantity:
                        {{$product->quantity}}
                        </h6>

                        <form action="{{route('add_cart', $product->id)}}" method="POST">
                              @csrf
                              <div class="row">
                                 <div class="col-md-4">
                                    <input type="number" name="quantity" value="1" min="1" style="width: 100px"> 
                                 </div>
                                 <div class="col-md-4">
                                    <input type="submit" value="Add To Cart">
                                 </div>
                              </div>
                           </form>

                     </div>
                  </div>
               </div>

      <!-- footer start -->
      @include('home.footer')
      <!-- footer end -->
      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved<br>
            
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