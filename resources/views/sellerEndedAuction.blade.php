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
   <link rel="stylesheet" href="{{asset('css/delete.css')}}">
   <style>
   #wrapper {
      border: 1px solid white;
      margin: 30px;
      align: center;
      display: block;
      border: 1px solid white;
      height: 500px;
      width: 100%;
      overflow: hidden; /* Add overflow property to prevent content from overflowing */
   }

   #modalImageDelete {
  display: block;
  margin: 0 auto;
  width: 200px; /* Adjust the width as needed */
  height: 200px; /* Adjust the height as needed */
}

   #first {
      height: 500px;
      width: 698px;
      position: static;
      display: inline-block;
      padding-right: 10px;
      float: left;
      margin-right:10px;
      border: 1px solid white;
      overflow: hidden; /* Add overflow property to prevent content from overflowing */
   }

   #second {
      height: 500px;
      display: inline-block;
      position: static;
      float: left;
      border: 1px solid white;
      padding-right:10px;
      width: calc(100% - 728px); /* Calculate the remaining width after considering the width of the first div and its margin */
      word-wrap: break-word; /* Add word-wrap property to break long words and wrap text within the second div */
   }

   .modal-wrapper {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
      z-index: 9999; /* Make sure it appears on top of other elements */
      display: flex;
      align-items: center;
      justify-content: center;
   }

   .modal-body {
      background-color: white;
      padding: 20px;
      border-radius: 5px;
      max-width: 400px;
      width: 100%;
   }
</style>
   
   </head>
@include('sellerHeader');
<body>
   <h3 style="text-align:center; font-size:50px;">Ended auctions</h3>
   @if(Session::has('success'))
      <div class="alert-success">{{Session::get('success')}}</div>
   @endif
   @if(Session::has('fail'))
      <div class="alert-danger">{{Session::get('fail')}}</div>
   @endif

   @foreach($data as $products)
      @php
         $endTime = strtotime($products->end_time);
         $currentTime = time();
         $biddingExpired = $currentTime > $endTime;
      @endphp

      @if($biddingExpired)
         <div id="wrapper">
            <div style="float: left; margin-right: 10px;" id="first">
               <img height="500px;" width="698px;" src="{{ asset('uploads/files/' .$products->image) }}">
            </div>
            <div id="second">
               <!-- Display product information -->
               <p style="text-decoration: none; color:#666; font-size:15px; text-align:left;">Art Name: <span style="color:black; font-size:15px;">{{ $products->product_name }}</span></p>
               <p style="text-decoration: none; color:#666; font-size:15px; text-align:left;">Description: <span style="color:black; font-size:15px;">{{$products->description}}</span></p>
               <p style="text-decoration: none; color:#666; font-size:15px; text-align:left;">Available Units: <span style="color:black; font-size:15px;">{{$products->available_units}}</span></p>
               <p style="text-decoration: none; color:#666; font-size:15px; text-align:left;">Reserve Price: <span style="color:black; font-size:15px;">Ksh. {{$products->reserve_price}}</span></p>
               <p style="color:#666; font-size:20px; text-align:left;" id="countdown_{{$products->product_id}}"></p>
               <p style="color:#666; font-size:20px; text-align:left;">Highest Bidder:<span style="color:black; font-size:15px;"> {{ $products->highest_bidder_email }}</span></p>
               <p style="color:#666; font-size:20px; text-align:left;">Highest Bid Amount:<span style="color:black; font-size:15px;"> @if ($products->highest_bid_amount === 'No Amount') {{ $products->highest_bid_amount }} @else Ksh. {{ $products->highest_bid_amount }} @endif</span></p>
               <!-- Add the rest of your code here for the bidding form and other elements -->
               <button type="submit" class="delete-btn" style="">Delete</button>
               <button type="submit" class="option-btn" style="">Repost</button>
               <button type="submit" class="option-btn" style="background-color:#98777b;">Notify Bidder</button>
               
            </div>
         </div>
      @endif

   @endforeach

   <!-- JavaScript code for countdown updates (outside the loop) -->
   <script>
      function updateCountdown(endTime, productId) {
         var currentTime = new Date().getTime();
         var timeDiff = endTime - currentTime;
         var countdownElement = document.getElementById('countdown_' + productId);
         var formElement = document.getElementById('form_' + productId);

         if (timeDiff > 0) {
            countdownElement.innerHTML = 'Bidding ends in: ' + getTimeRemaining(timeDiff);
            countdownElement.style.color = 'red';
            formElement.style.display = 'none';
         } else {
            countdownElement.innerHTML = 'Bidding period Expired';
            countdownElement.style.color = 'black';
            formElement.style.display = 'none';
         }
      }

      function getTimeRemaining(timeDiff) {
         var days = Math.floor(timeDiff / (1000 * 60 * 60 * 24));
         var hours = Math.floor((timeDiff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
         var minutes = Math.floor((timeDiff % (1000 * 60 * 60)) / (1000 * 60));
         var seconds = Math.floor((timeDiff % (1000 * 60)) / 1000);
         return days + 'd ' + hours + 'h ' + minutes + 'm ' + seconds + 's';
      }

      // Call the updateCountdown function for each product with their respective end times
      @foreach($data as $products)
         var endTime_{{$products->product_id}} = new Date('{{$products->end_time}}').getTime();
         updateCountdown(endTime_{{$products->product_id}}, {{$products->product_id}});
      @endforeach
   </script>
</body>
</html>







