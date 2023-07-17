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
      <h2 style="color: brown;">[--{{$unapprovedproducts}}--]</h2>
         <p> <a href="{{ route('seller.unapprovedproducts') }}" style="text-decoration: none; color:brown;">Waiting List</a> </p>
      </div>

      <div class="box">
      <h2 style="color: green;">[--{{$approvedproducts}}--]</h2>
         <p> <a href="{{ route('seller.approvedproducts') }}" style="text-decoration: none; color:green;">Approved arts</a> </p>
      </div>

      <div class="box">
        <h2 style="color: #808000;">[--{{$postedproducts}}--]</h2>
        <p> <a href="{{route('seller.postedproducts')}}" style="text-decoration: none; color:#808000;">On sale</a> </p>
        </div>


      <div class="box">
      <h2 style="color: red;">[--{{$blockedproducts}}--]</h2>
         <p> <a href="{{ route('seller.blockedproducts') }}" style="text-decoration: none; color:red;">Blocked Arts</a> </p>
      </div>

      <div class="box">
        <h2 style="color: #000080;">[--{{$soldproducts}}--]</h2>
        <p> <a href="{{route('sold.products')}}" style="text-decoration: none; color:#000080;">Sold Arts</a> </p>
        </div>

        <div class="box">
      <h2 style="color: orange;">[--{{$expired}}--]</h2>
         <p> <a href="{{ route('seller.endedauction') }}" style="text-decoration: none; color:orange;">Expired auctions</a> </p>
      </div>

      

      <div class="box">
        <h2 style="color: purple;">[--{{$totalproducts}}--]</h2>
        <p> <a href="{{route('seller.displayproducts')}}" style="text-decoration: none; color:purple;">Total Art Pieces</a> </p>
      </div>

     

        


        


     

   </div>

</section>


<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>

</body>
</html> 