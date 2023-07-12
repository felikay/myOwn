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
   </head>

@include('sellerHeader');
<body>

<!-- admin dashboard section starts  -->

<section class="dashboard">

   <h1 class="title">dashboard</h1>

   <div class="box-container">




        
        <div class="box">
      <h2>{{$unapprovedproducts}}</h2>
         <p> <a href="{{ route('seller.unapprovedproducts') }}" style="text-decoration: none; color:purple;">Unapproved Products</a> </p>
      </div>

      <div class="box">
      <h2 style="color: red;">{{$blockedproducts}}</h2>
         <p> <a href="{{ route('seller.blockedproducts') }}" style="text-decoration: none; color:purple;">Blocked Products</a> </p>
      </div>

      <div class="box">
      <h2 style="color: green;">{{$approvedproducts}}</h2>
         <p> <a href="{{ route('seller.approvedproducts') }}" style="text-decoration: none; color:purple;">Approved Products</a> </p>
      </div>

      <div class="box">
        <h2>{{$totalproducts}}</h2>
        <p> <a href="{{route('add.products')}}" style="text-decoration: none; color:purple;">Total Products</a> </p>
        </div>
        

        <div class="box">
        <p><a href="{{ route('create.Auction') }}">Add Auction</a></p>
        </div>

     

   </div>

</section>


<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>

</body>
</html> 