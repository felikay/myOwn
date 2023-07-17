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
   <link rel="stylesheet" href="{{asset('css/style.css')}}">

   <style>
      #wrapper {
    width: 100%;
    border: 1px solid white;
    overflow: hidden; /* will contain if #first is longer than #second */
    display:block;
    height:flex;
     }
    #first {
    width: 701px;
    border: 1px solid purple;
    display:inline-block;
    height:100%;
    margin:20px;
    text-align:center;
    border-radius:1px;
    padding-bottom:10px;
    }

   
    

  
    
   </style>
   
   </head>

@include('bidderHeader');
<body>
<div id="wrapper">
    
    
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
  
   <div id="first">
   <img height= "500px;" width="698px;" src="{{ asset('uploads/files/' .$products->image) }}">
   
   <p style="color:#666; font-size:20px;"> Art Name : <span style="color:purple; font-size:20px;">{{$products->name}}</span> </p>
   <p style="color:#666; font-size:20px;"> Reserve Price : <span style="color:purple; font-size:20px;">ETH. {{$products->reserve_price}}</span> </p>
   
    <!-- Bid form  -->
   <div>
   <input type="number" class="box" name="" min="{{$products->reserve_price}}" placeholder="Min. bidding price: {{$products->reserve_price}}" value="" style="width: 350px; height: 50px; font-size:20px; border: 2px solid #666; border-radius: 4px;padding:20px 40px;" >
   <button class="option-btn" style="background-color:#98777b;">Bid</button>
   </div>

     
  
   <a href="{{url('delete_cart/' . $products->id) }}" style="text-decoration: none;" class="delete-btn">Remove from cart</a>
   

   </div>
@endforeach
@else
<p style="color:red; font-size:30px;"> <span>The are no products in the cart</span> </p>
@endif

</div>


    

</body>
</html>