<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Checkout</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="{{asset('css/style.css')}}">


 
   

</head>
<body>
   
@include('loginHeader');



<section class="display-order">


</section>

<section class="checkout">

   <form action="{{route('checkoutpost')}}" method="post" enctype="multipart/form-data" id="checkout-form" >
   @csrf
       @if(Session::has('success'))
       <div class="alert-success">{{Session::get('success')}}</div>
       @endif
       @if(Session::has('fail'))
       <div class="alert-danger">{{Session::get('fail')}}</div>
       @endif

      <h3>Check Out</h3>
      <div class="flex">

      
     
   <input style="color:black;" type="hidden" id="productName" name="productName" value="{{ $productName }}" >
   <input type="hidden" name="user_email" placeholder="enter your email" value="{{ $user_email }}">
   <input type="hidden" name="description" value="{{ $description }}">
   <input type="hidden" name="units" value="{{ $units }}">
   <input type="hidden" name="amount" value="{{ $amount }}">
   <input type="hidden" name="sellerEmail" value="{{ $sellerEmail }}">
   
   <div class="inputBox">
   <span>Your name:</span>
   <input style="color:black;" type="text" name="name" value="{{old('name')}}" >
   </div>

   <div class="inputBox">
   <span>Your email:</span>
   <input style="color:black;" type="text" name="email" value="{{old('email')}}" >
   </div>

   <div class="inputBox">
   <span>Your phone number:</span>
   <input style="color:black;" type="number" name="number" value="{{old('number')}}" >
   </div>

   <div class="inputBox">
   <span>Your address:</span>
   <input style="color:black;" type="text" name="address" value="{{old('address')}}">
   </div>

   <div class="inputBox">
   <span>County:</span>
   <input style="color:black;" type="text" name="county" value="{{old('county')}}" >
   </div>

  
   


</div>  

<input type="submit" value="Make Order" style="margin-left: 60%; background-color:black; " class="white-btn" name="submit">
   

<input type="submit" value="Pay now with M-Pesa" style="margin-left: 60%; background-color:green; " class="white-btn" name="submit">
   
         

</form>
     
</section>






<!-- custom js file link  -->

<script src="{{('js/script.js')}}"></script>

</body>
</html>