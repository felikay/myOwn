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

   <h1 class="title">Add Products</h1>

   <form action="{{route('add.products')}}" method="post" enctype="multipart/form-data">
      @csrf
       @if(Session::has('success'))
       <div class="alert-success">{{Session::get('success')}}</div>
       @endif
       @if(Session::has('fail'))
       <div class="alert-danger">{{Session::get('fail')}}</div>
       @endif

       <br></br>
       

      <h3>Add product</h3>

      <div class="box">
      <input type="name" name="name" placeholder="enter product name" value="{{old('name')}}" size="35%" >
      </div>
      @if($errors->has('name'))
      <span class="text-danger">{{$errors->first('name')}}</span>
      @endif


      <div class="box">
      <input type="name" name="category" placeholder="enter category of the product" value="{{old('category')}}" size="35%" >
      </div>
      @if($errors->has('category'))
      <span class="text-danger">{{$errors->first('category')}}</span>
      @endif

      

      <div class="box">
      <input type="name" name="description" placeholder="enter the product description"  size="35%" value="{{old('description')}}">
      </div>
      @if($errors->has('description'))
      <span class="text-danger">{{$errors->first('description')}}</span>
      @endif


      <div class="box">
      <input type="number" name="reserve_price" placeholder="enter the product reserve price"  size="35%" value="{{old('price')}}">
      </div>
      @if($errors->has('reserve_price'))
      <span class="text-danger">{{$errors->first('reserve_price')}}</span>
      @endif

          
      <p style="text-decoration: none; color:#666; font-size:20px; text-align:left;">enter the start date for bidding </p>
      <div class="box">
      <input type="file" name="image" placeholder="Upload Product image"  size="35%" value="{{old('image')}}">
      </div>
      @if($errors->has('image'))
      <span class="text-danger">{{$errors->first('image')}}</span>
      @endif
      
      <p style="text-decoration: none; color:#666; font-size:20px; text-align:left;">enter the start date for bidding </p>
      <div class="box">
      <input type="datetime-local" min="{{Carbon\Carbon::now()->format('d-m-Y H:i:s')}}" name="start_date" size="35%" value="{{old('start_date')}}">
      </div>
      @if($errors->has('start_date'))
      <span class="text-danger">{{$errors->first('start_date')}}</span>
      @endif
      
      <p style="text-decoration: none; color:#666; font-size:20px; text-align:left;">enter the end date for bidding </p>
      <div class="box">
      <input type="datetime-local" name="end_date" size="35%" value="{{old('end_date')}}">
      </div>
      @if($errors->has('end_date'))
      <span class="text-danger">{{$errors->first('end_date')}}</span>
      @endif

     
      <input type="hidden" name="email"  size="35%" value="{{ Auth::user()->email }}">
      

      <input type="submit" name="add_product" value="Add Product" class="option-btn">

   </form>

</section>

<script src="js/admin_script.js"></script>

</body>
</html>