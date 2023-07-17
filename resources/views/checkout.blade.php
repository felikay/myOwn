<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Application</title>

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

   <form action="{{route('checkout')}}" method="post" enctype="multipart/form-data" id="checkout-form" >
   @csrf
       @if(Session::has('success'))
       <div class="alert-success">{{Session::get('success')}}</div>
       @endif
       @if(Session::has('fail'))
       <div class="alert-danger">{{Session::get('fail')}}</div>
       @endif

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

     
</section>






@include('footer');

<!-- custom js file link  -->

<script src="{{('js/script.js')}}"></script>

</body>
</html>