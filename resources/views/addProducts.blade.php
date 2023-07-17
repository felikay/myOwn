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
   </head>

@include('sellerHeader');
<body>
   


<!-- product CRUD section starts  -->

<section class="add-products">

   <h1 class="title">Add New Art Piece</h1>

   <form action="{{route('add.products')}}" method="post" enctype="multipart/form-data">
      @csrf
       @if(Session::has('success'))
       <div class="alert-success">{{Session::get('success')}}</div>
       @endif
       @if(Session::has('fail'))
       <div class="alert-danger">{{Session::get('fail')}}</div>
       @endif

       <br></br>
       

      <h3>Add New Art Piece</h3>

      <div class="box">
      <input type="name" name="name" placeholder="enter product name" value="{{old('name')}}" size="35%" >
      </div>
      @if($errors->has('name'))
      <span class="text-danger">{{$errors->first('name')}}</span>
      @endif

     
      <div class="box">
      <input type="text" name="description" placeholder="enter the product description" style="width:82%;"  size="35%" value="{{old('description')}}">
      </div>
      @if($errors->has('description'))
      <span class="text-danger">{{$errors->first('description')}}</span>
      @endif

          
      <p style="text-decoration: none; color:#666; font-size:20px; text-align:left;">enter the art image </p>
      <div class="box">
      <input type="file" name="image" placeholder="Upload Product image"  size="35%" value="{{old('image')}}">
      </div>
      @if($errors->has('image'))
      <span class="text-danger">{{$errors->first('image')}}</span>
      @endif
      
           
      <input type="hidden" name="email"  size="35%" value="{{ Auth::user()->email }}">
      

      <input type="submit" name="add_product" value="Add Product" class="option-btn">
      <a href="{{route('seller.home') }}" style="text-decoration: none; background-color:black;" class="option-btn">Go Back</a>

   </form>

</section>

<script src="js/admin_script.js"></script>

</body>
</html>