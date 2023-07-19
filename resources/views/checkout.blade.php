<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
   <title>Checkout</title>
=======
   <title>Application</title>
>>>>>>> 0bc6781e98c1ae8072f375423024b831edc5835f

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="{{asset('css/style.css')}}">
<<<<<<< HEAD


 
=======
>>>>>>> 0bc6781e98c1ae8072f375423024b831edc5835f
   

</head>
<body>
   
@include('loginHeader');



<section class="display-order">


</section>
<<<<<<< HEAD

<section class="checkout">

   <form action="{{route('checkoutpost')}}" method="post" enctype="multipart/form-data" id="checkout-form" >
=======
 

<section class="checkout">

   <form action="{{route('checkout')}}" method="post" enctype="multipart/form-data" id="checkout-form" >
>>>>>>> 0bc6781e98c1ae8072f375423024b831edc5835f
   @csrf
       @if(Session::has('success'))
       <div class="alert-success">{{Session::get('success')}}</div>
       @endif
       @if(Session::has('fail'))
       <div class="alert-danger">{{Session::get('fail')}}</div>
       @endif

<<<<<<< HEAD
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
=======
      <h3> Check Out form</h3>

      
    <h2>Personal Information</h2>

    
    <div class="inputBox">
            <span>your name :</span>
            <input type="text" name="name"  placeholder="enter your name" value="{{old('name')}}">
            @if($errors->has('name'))
            <span class="text-danger">{{$errors->first('name')}}</span>
            @endif
    </div>

    
    <div class="inputBox">
            <span>your email :</span>
            <input type="text" name="email"  placeholder="enter your email" value="{{old('email')}}">
            @if($errors->has('email'))
            <span class="text-danger">{{$errors->first('email')}}</span>
            @endif
    </div>


    <input type="text" name="name" placeholder="Name">
    <input type="email" name="email" placeholder="Email">

    

    <h2>Product Details</h2>
    <input type="text" name="product_name" placeholder="Product Name">
    <input type="text" name="product_price" placeholder="Product Price">

    <h2>Payment Method</h2>
    <input type="radio" name="payment_method" value="now"> Pay Now
    <input type="radio" name="payment_method" value="later"> Pay Later

    <button type="submit">Proceed to Checkout</button>
</form>

>>>>>>> 0bc6781e98c1ae8072f375423024b831edc5835f
     
</section>






<<<<<<< HEAD
=======
@include('footer');

>>>>>>> 0bc6781e98c1ae8072f375423024b831edc5835f
<!-- custom js file link  -->

<script src="{{('js/script.js')}}"></script>

</body>
</html>