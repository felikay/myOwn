<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Seller Panel</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="{{asset('css/admin_style.css')}}">
   <link rel="stylesheet" href="{{asset('css/delete.css')}}">
   <style>
   #wrapper {
      border: 1px solid white;
      margin: 30px;
      align: center;
      display: block;
      border: 1px solid white;
      height: 500px;
      width: 100%;
      overflow: hidden; /* Add overflow property to prevent content from overflowing */
   }

   #first {
      height: 500px;
      width: 698px;
      position: static;
      display: inline-block;
      padding-right: 10px;
      float: left;
      margin-right:10px;
      border: 1px solid white;
      overflow: hidden; /* Add overflow property to prevent content from overflowing */
   }

   #second {
      height: 500px;
      display: inline-block;
      position: static;
      float: left;
      border: 1px solid white;
      padding-right:10px;
      width: calc(100% - 728px); /* Calculate the remaining width after considering the width of the first div and its margin */
      word-wrap: break-word; /* Add word-wrap property to break long words and wrap text within the second div */
   }

   .modal-wrapper {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
      z-index: 9999; /* Make sure it appears on top of other elements */
      display: flex;
      align-items: center;
      justify-content: center;
   }

   .modal-body {
      background-color: white;
      padding: 20px;
      border-radius: 5px;
      max-width: 400px;
      width: 100%;
   }
</style>
   
   </head>

  

@include('adminHeader');
<body>

<h3 style="text-align:center; font-size:50px;">Approved Art pieces</h3>





    
    
    @if(Session::has('success'))
       <div class="alert-success">{{Session::get('success')}}</div>
       @endif
       @if(Session::has('fail'))
       <div class="alert-danger">{{Session::get('fail')}}</div>
       @endif
 
@if($data->count() > 0)
   
   
   @php 
   $i = 1;
   @endphp
   @foreach($data as $products)
   
   
  <div id="wrapper">

   <div id="first">
   <img height= "500px;" width="698px;" src="{{ asset('uploads/files/' .$products->image) }}">
<<<<<<< HEAD
=======
   <p style="color:#666; font-size:20px;"> Number : <span style="color:purple; font-size:20px;">{{$i++}}</span> </p>
   <p style="color:#666; font-size:20px;"> Email : <span style="color:purple; font-size:20px;">{{$products->email}}</span> </p>
   <p style="color:#666; font-size:20px;"> Name : <span style="color:purple; font-size:20px;">{{$products->name}}</span> </p>
   <p style="color:#666; font-size:20px;"> Price : <span style="color:purple; font-size:20px;">ETH. {{$products->reserve_price}}</span> </p>


   
   
   
>
>>>>>>> 0bc6781e98c1ae8072f375423024b831edc5835f
   </div>

   <div id="second">
   <p style="color:#666; font-size:20px;"> Art Piece : <span style="color:purple; font-size:20px;">{{$products->name}}</span> </p>
   <p style="color:#666; font-size:20px;"> Seller Email: <span style="color:purple; font-size:20px;">{{$products->email}}</span> </p>
   <p style="color:#666; font-size:20px;"> Description : <span style="color:purple; font-size:20px;">{{$products->description}}</span> </p>
   
   </div>

</div>
@endforeach
@else
<p style="color:red; font-size:30px;"> <span></span> </p>
@endif

</div>


    

</body>
</html>