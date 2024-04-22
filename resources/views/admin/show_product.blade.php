<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css')
    <style type="text/css">
        .h2_font
        {
            text-align: center;
            font-size: 40px;
            padding-bottom: 20px;
        }
        .center
        {
          margin: auto;
          width: 50%;
          text-align: center;
          margin-top: 40px;
          border: 2px solid white;
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
            padding: 30px;
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
            <h2 class="h2_font">All Product</h2>
                <table class="center">
                    <tr class="th_color">
                        <th class="th_space">Product Title</th>
                        <th class="th_space">Description</th>
                        <th class="th_space">Quantity</th>
                        <th class="th_space">Catagory</th>
                        <th class="th_space">Price</th>
                        <th class="th_space">Discount Price</th>
                        <th class="th_space">Product Image</th>
                    </tr>
                    @foreach($products as $product)
                    <tr>
                        <td>{{$product->title}}</td>
                        <td>{{$product->description}}</td>
                        <td>{{$product->quantity}}</td>
                        <td>{{$product->catagory}}</td>
                        <td>{{$product->price}}</td>
                        <td>{{$product->discount_price}}</td>
                        <td>
                            <img class="img_size" src="/product/{{$product->image}}">
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>        
        </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')    
    <!-- End custom js for this page -->
  </body>
</html>