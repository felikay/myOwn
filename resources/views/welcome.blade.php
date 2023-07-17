
            
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
   


@include('loginHeader');

<section class="home">

   <div class="content">
      <h3>Arge Auction Shop.</h3>
      <p>Bid Farewell To High Prices. Bid It To Win It. Our Auctions Are Fair & Profitable.</p>
      <a href="{{ route('shop') }}"style="text-decoration: none;" class="white-btn">Shop Now</a>
   </div>

</section>

<section class="products">

   <h1 class="title">latest products</h1>

   <div class="box-container">

      
   </div>

   <div class="load-more" style="margin-top: 2rem; text-align:center">
      <a style="text-decoration: none;" href="shop" class="option-btn">load more</a>
   </div>

</section>

<section class="about">

   <div class="flex">

      <div class="image">
         <img src="images/about-img.jpg" alt="">
      </div>

      <div class="content">
         <h3>about us</h3>
         <p>At ‘Organization Name’ , all that you see is hand-picked and 100% true – sourced straight from the best brands and their approved affiliates from US and over the world, only for you.

We present to you the most up to date – it’s in-season and on-incline; if it’s on the racks, it’s on the web. Also, it’s nowest – have it conveyed ASAP to you, from a store close you, when you utilize our Phygital services.</p>
         <a href="about" class="btn">read more</a>
      </div>

   </div>

</section>

<section class="home-contact">

   <div class="content">
      <h3>have any questions?</h3>
      <p>Would you like to reach us? We are always ready and available for you. Press bellow to find our contacts.</p>
      <a href="contact" style="text-decoration: none;" class="white-btn">contact us</a>
   </div>

</section>





@include('footer');

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>