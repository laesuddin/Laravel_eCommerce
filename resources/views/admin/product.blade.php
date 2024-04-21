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
        .h2_font
        {
            font-size: 40px;
            padding-bottom: 40px;
        }
        .input_color
        {
            color: black;
        }
        label
        {
            display: inline-block;
            width: 200px;
        }
        .div_design
        {
            padding-bottom: 15px; 
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
                <div class="div_center">
                    <h2 class="h2_font">Add Product</h1>

                    <div class="div_design">
                    <label>Product Title :</label>
                    <input class="input_color" type="text" name="title" placeholder="Write a title" required="">
                    </div>
                    
                    <div class="div_design">
                    <label>Product Description :</label>
                    <input class="input_color" type="text" name="description" placeholder="Write a description" required="">
                    </div>

                    <div class="div_design">
                    <label>Product Price :</label>
                    <input class="input_color" type="text" name="price" placeholder="Write a price" required="">
                    </div>

                    <div class="div_design">
                    <label>Discount Price :</label>
                    <input class="input_color" type="number" name="dis_price" placeholder="Write a discount if apply" >
                    </div>

                    <div class="div_design">
                    <label>Product Quantity</label>
                    <input class="input_color" type="number" min="0" name="quantity" placeholder="Write a quantity" required="">
                    </div>

                    <div class="div_design">
                    <label>Product Catagory :</label>
                    <select class="input_color" name="catagory" required="">
                        <option value="" selected="">Add a catagory here</option>
                        <option>Shirt</option>
                    </select>
                    </div>

                    <div class="div_design">
                    <label>Product Image Here :</label>
                    <input type="file" name="image" required="">
                    </div>

                    <div class="div_design">
                    <input type="submit" value="Add Product" class="btn btn-primary">
                    </div>
                </div>
            </div>
        </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')    
    <!-- End custom js for this page -->
  </body>
</html>