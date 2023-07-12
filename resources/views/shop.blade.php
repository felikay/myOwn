<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Bidder Panel</title>

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
   
   <p style="color:#666; font-size:20px;"> Name : <span style="color:purple; font-size:20px;">{{$products->name}}</span> </p>
   <p style="color:#666; font-size:20px;"> Reserve Price : <span style="color:purple; font-size:20px;">Ksh. {{$products->reserve_price}}</span> </p>
   <p style="color:#666; font-size:20px;"> Time Left : <span style="color:purple; font-size:20px;">{{$products->start_date}}</span> </p>
   
   <form action="" method="post" >
      @csrf
      <input type="hidden" name="name" placeholder="enter your name" value=""  >
      <input type="hidden" name="email" placeholder="enter your email" value=""  >
      <input type="hidden" name="type" placeholder="enter your email" value=""  >
      <input type="number" class="box" name="type" placeholder="enter your bidding price" value="" style="width: 350px; height: 50px; font-size:20px; border: 2px solid #666; border-radius: 4px;
      padding:20px 40px;" >
      <br></br>
      <a href="" style="text-decoration: none; background-color:#98777b;" class="delete-btn">Bid</a>
   </form>

   <form action="{{route('shop')}}" method="post" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="image"  value="{{ $products->image }}">
      <input type="hidden" name="name"   value="{{$products->name}}"  >
      <input type="hidden" name="reserve_price" value="{{$products->reserve_price}}"  >
      <input type="hidden" name="email"  value="{{ Auth::user()->email }}">
      <input type="hidden" name="start_date" value="{{$products->start_date}}"  >
      <input type="hidden" name="end_date" value="{{$products->end_date}}"  >
      <input type="submit" name="shop" value="Add to cart" class="option-btn">
   
   </form>


   
  
   
   </div>
@endforeach
@else
<p style="color:red; font-size:30px;"> <span>The are no registered Bidders</span> </p>
@endif

</div>


    

</body>
</html>