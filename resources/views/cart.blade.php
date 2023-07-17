<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Cart</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="{{asset('css/style.css')}}">
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

@include('bidderHeader');
<body>

<h3 style="text-align:center; font-size:50px;">{{ Auth::user()->name }}'s&nbsp;cart</h3>

   
      @if(Session::has('success'))
         <div class="alert-success">{{Session::get('success')}}</div>
      @endif
      @if(Session::has('fail'))
         <div class="alert-danger">{{Session::get('fail')}}</div>
      @endif

      
         

         @foreach($data as $products)

         <div id="wrapper">

            <div id="first" >
               <img height="500px;" width="698px;" src="{{ asset('uploads/files/' .$products->image) }}">
            </div>

         <div id="second">
               <p style="color:#666; font-size:15px; text-align:left;"> Art Name: <span style="color:black; font-size:15px;">{{ $products->product_name }}</span></p>
               <p style="color:#666; font-size:15px; text-align:left;"> Description: <span style="color:black; font-size:15px;">{{$products->description}}</span></p>
               <p style="color:#666; font-size:15px; text-align:left;"> Available Units: <span style="color:black; font-size:15px;">{{$products->available_units}}</span></p>
               <p style="color:#666; font-size:15px; text-align:left;"> Reserve Price: <span style="color:black; font-size:15px;">Ksh. {{$products->reserve_price}}</span></p>

               <p style="color:#666; font-size:15px; text-align:left;" id="countdown_{{$products->id}}"></p>

               <form action=" {{ url('/bid', ['product_id' => $products->id]) }}" method="post" id="form_{{$products->id}}">
                  @csrf
                  <input type="hidden" name="product_id" value="{{ $products->id }}" required>
                  <input type="hidden" name="bidder_email" value="{{ Auth::user()->email }}">
                  <input type="number" class="box" name="amount" min="{{$products->reserve_price}}" placeholder="Minimum price:Ksh. {{$products->reserve_price}}" value="" style="width: 390px; height: 40px; font-size:15px; border: 2px solid #666; border-radius: 4px;padding:15px 40px;" >
                 
                  <br><br>
                  @if($errors->has('amount'))
                     <span class="text-danger">{{$errors->first('amount')}}</span>
                  @endif

                  <input type="number" class="box" name="requested_units" max="{{$products->available_units}}" placeholder="Number of arts you want"  style="width: 390px; height: 40px; font-size:15px; border: 2px solid #666; border-radius: 4px;padding:15px 40px;" >
                  @if($errors->has('requested_units'))
                     <span class="text-danger">{{$errors->first('requested_units')}}</span>
                  @endif
<br>
                  <button type="submit" class="option-btn" style="background-color:#722e08;">Bid</button>
               </form>

             <button>  <a href="#modal" role="button" class="delete-btn" style="text-decoration:none; ">Remove from cart</a> </button>

               
               
               
               <script>
                  var startTime_{{$products->id}} = new Date('{{$products->start_time}}').getTime();
                  var endTime_{{$products->id}} = new Date('{{$products->end_time}}').getTime();

                  function updateCountdown() {
                     var currentTime = new Date().getTime();
                     var timeDiffStart = startTime_{{$products->id}} - currentTime;
                     var timeDiffEnd = endTime_{{$products->id}} - currentTime;

                     var countdownElement = document.getElementById('countdown_{{$products->id}}');
                     var formElement = document.getElementById('form_{{$products->id}}');

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

   






<div class="modal-wrapper" id="modal">
	<div class="modal-body card">
		<div class="modal-header">
			<h2 ></h2>
         <br></br>
			<a href="#!" role="button" class="close" aria-label="close this modal" style="color: red;">
				<svg viewBox="0 0 24 24">
					<path d="M24 20.188l-8.315-8.209 8.2-8.282-3.697-3.697-8.212 8.318-8.31-8.203-3.666 3.666 8.321 8.24-8.206 8.313 3.666 3.666 8.237-8.318 8.285 8.203z" />
				</svg>&nbsp;&nbsp;
			</a>
		</div>
      
      <img style="margin-left:30%;" height="200px;" width="200px;" src="{{ asset('uploads/files/' .$products->image) }}">
      
   <p style="text-align:center; font-size:15px; color:black;">Arge Auction Shop</p>

		<p style="text-align:center; font-size:15px;">Are you sure you want to remove this item from the cart ? </p>

      <button><a href="{{url('delete_cart/' . $products->id) }}" style="text-decoration: none;" class="delete-btn">Remove from cart</a></button>

      <br></br>
   </div>


   
	
	<a href="#!" class="outside-trigger"></a>
</div>





@endforeach 
   

</body>
</html>
