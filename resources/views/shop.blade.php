<!-- bidder-panel.blade.php (View) -->

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Bidder Panel</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="{{asset('css/style.css')}}">

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
</style>
</head>

@include('bidderHeader');
<body>

<h3 style="text-align:center; font-size:50px;">Art Shop</h3>
   
   @if(Session::has('success'))
      <div class="alert-success">{{Session::get('success')}}</div>
   @endif
   @if(Session::has('fail'))
      <div class="alert-danger">{{Session::get('fail')}}</div>
   @endif

   @foreach($data as $product)
      <div id="wrapper">
         <div id="first">
            <img height="500px;" width="698px;" src="{{ asset('uploads/files/' .$product->image) }}">
         </div>
         <div id="second">
            <p style="color:#666; font-size:15px; text-align:left;"> Art Name: <span style="color:black; font-size:15px;">{{ $product->product_name }}</span></p>
            <p style="color:#666; font-size:15px; text-align:left;"> Description: <span style="color:black; font-size:15px;">{{ $product->description }}</span></p>
            <p style="color:#666; font-size:15px; text-align:left;"> Available Units: <span style="color:black; font-size:15px;">{{ $product->available_units }}</span></p>
            <p style="color:#666; font-size:15px; text-align:left;"> Minimum Price: <span style="color:black; font-size:15px;">Ksh. {{ $product->reserve_price }}</span></p>

            <p style="color:#666; font-size:15px; text-align:left;" id="countdown_{{ $product->product_id }}"></p>

            
            
               <form action="{{ url('/bid', $product->product_id) }}" method="post" id="form_{{ $product->product_id }}">
                  @csrf
                  <input type="hidden" name="product_id" value="{{ $product->product_id }}" required>

                  <input type="hidden" name="bidder_email" value="{{ Auth::user()->email }}">
                  
                  <p style="color:#666; font-size:15px; text-align:left;"> Enter the number of art pieces you would like to buy. <span style="color:#722e08;">Minimum number is 1</span></p>
                  <input type="number" class="box" name="requested_units" min="0" max="{{ $product->available_units }}" style="width: 350px; height: 40px; font-size:15px; border: 2px solid #666; border-radius: 4px;padding:15px 40px;" >
                  @if($errors->has('requested_units'))
                     <span class="text-danger">{{ $errors->first('requested_units') }}</span>
                  @endif
                   
                  <p style="color:#666; font-size:15px; text-align:left;"> Enter your bidding price. <span style="color:#722e08;">Minimum price is {{ $product->reserve_price }}</span></p>
                  <input type="number" class="box" name="amount" min="{{ $product->reserve_price }}" style="width: 350px; height: 40px; font-size:15px; border: 2px solid #666; border-radius: 4px;" >
                  @if($errors->has('amount'))
                     <span class="text-danger">{{ $errors->first('amount') }}</span>
                  @endif
                   
                  <br>

                  <button type="submit" class="option-btn" style="background-color:#722e08;">Bid</button>
               </form>
           

            <!-- Add to cart -->
            <form action="{{ route('shop') }}" method="post" enctype="multipart/form-data">
               @csrf
               <input type="hidden" name="image" value="{{ $product->image }}">
               <input type="hidden" name="product_name" value="{{ $product->product_name }}">
               <input type="hidden" name="description" value="{{ $product->description }}">
               <input type="hidden" name="available_units" value="{{ $product->available_units }}">
               <input type="hidden" name="reserve_price" value="{{ $product->reserve_price }}">
               <input type="hidden" name="email" value="{{ Auth::user()->email }}">
               <input type="hidden" name="start_time" value="{{ $product->start_time }}">
               <input type="hidden" name="end_time" value="{{ $product->end_time }}">
               <input type="submit" name="shop" value="Add to cart" class="option-btn">
            </form>

            <script>
               var startTime_{{ $product->product_id }} = new Date('{{ $product->start_time }}').getTime();
               var endTime_{{ $product->product_id }} = new Date('{{ $product->end_time }}').getTime();

               function updateCountdown() {
                  var currentTime = new Date().getTime();
                  var timeDiffStart = startTime_{{ $product->product_id }} - currentTime;
                  var timeDiffEnd = endTime_{{ $product->product_id }} - currentTime;

                  var countdownElement = document.getElementById('countdown_{{ $product->product_id }}');
                  var formElement = document.getElementById('form_{{ $product->product_id }}');

                  if (timeDiffStart > 0) {
                     countdownElement.innerHTML = 'Bidding starts in: ' + getTimeRemaining(timeDiffStart);
                     countdownElement.style.color = 'green';
                     formElement.style.display = 'none';
                  } else if (timeDiffEnd > 0) {
                     countdownElement.innerHTML = 'Bidding ends in: ' + getTimeRemaining(timeDiffEnd);
                     countdownElement.style.color = 'red';
                     formElement.style.display = 'block';
                  } else {
                     countdownElement.innerHTML = 'Bidding period Expired';
                     countdownElement.style.color = 'black';
                     formElement.style.display = 'none';
                  }
               }

               // Initial update
               updateCountdown();

               // Update countdown every second (1000 milliseconds)
               setInterval(updateCountdown, 1000);

               function getTimeRemaining(timeDiff) {
                  var days = Math.floor(timeDiff / (1000 * 60 * 60 * 24));
                  var hours = Math.floor((timeDiff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                  var minutes = Math.floor((timeDiff % (1000 * 60 * 60)) / (1000 * 60));
                  var seconds = Math.floor((timeDiff % (1000 * 60)) / 1000);

                  return days + 'd ' + hours + 'h ' + minutes + 'm ' + seconds + 's';
               }
            </script>
         </div>
      </div>
   @endforeach

</body>
</html>
