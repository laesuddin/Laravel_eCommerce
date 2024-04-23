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

            @if(session()->has('message'))
              <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                {{session()->get('message')}}</div>
            @endif

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
                        <th class="th_space">Delete</th>
                        <th class="th_space">Edit</th>
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
                        <td><a class="btn btn-danger" onclick="return confirm('Are You Sure to Delete this')" href="{{route('delete_product', $product->id)}}">Delete</a></td>
                        <td><a class="btn btn-success" href="{{route('update_product', $product->id)}}">Edit</a></td>
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