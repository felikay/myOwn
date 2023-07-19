
            
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="{{asset('css/style.css')}}">

</head>
<body>
   


@include('bidderHeader');

<section class="home">

   <div class="content">
      <h3>FE.</h3>
      <p>Bid Farewell To High Prices. Bid It To Win It. Our Auctions Are Fair & Profitable.</p>
      <a href="{{ route('shop') }}"style="text-decoration: none;" class="white-btn">Shop Now</a>
   </div>

</section>



<section class="about">

   <div class="flex">

      

   </div>

</section>

<section class="home-contact">

   <div class="content">
      <h3>have any questions?</h3>
      <p>Would you like to reach us? We are always ready and available for you. Press bellow to find our contacts.</p>
      <a href="{{ route('contacts') }}" style="text-decoration: none;" class="white-btn">contact us</a>
   </div>

</section>





@include('footer');

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>