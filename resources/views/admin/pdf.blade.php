<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid black;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
        .th_space
        {
            padding: 30px;
        }
        .th_align
        {
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Order Details</h1>
    <div>
        <h2>Customer Information:</h2>
        <p><strong>Customer Name:</strong> {{$orders->name}}</p>
        <p><strong>Email:</strong> {{$orders->email}}</p>
        <p><strong>Customer ID:</strong> {{$orders->user_id}}</p>
    </div>
    <div>
        <h2>Product Information:</h2>
        <table class="center">
            <tr class="th_color">
                <th class="th_space">Product Name</th>
                <th class="th_space">Product Quantity</th>
                <th class="th_space">Payment Status</th>
                <th class="th_space">Product ID</th>
                <th class="th_space">Product Price</th>
            </tr>
            <tr>
                <td class="th_align">{{$orders->product_title}}</td>
                <td class="th_align">{{$orders->quantity}}</td>
                <td class="th_align">{{$orders->payment_status}}</td>
                <td class="th_align">{{$orders->product_id}}</td>
                <td class="th_align">${{$orders->price}}</td>
            </tr>
        </table>
    </div>
</body>
</html>