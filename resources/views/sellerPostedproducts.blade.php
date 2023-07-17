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
   <link rel="stylesheet" href="{{asset('css/delete.css')}}">
   <style>
      #wrapper {
         width: 100%;
         border: 1px solid white;
         overflow: hidden; /* will contain if #first is longer than #second */
         display:block;
         height:flex;
      }
      #first {
         width: 701px;
         border: 1px solid purple;
         display:inline-block;
         height:100%;
         margin:20px;
         text-align:center;
         border-radius:1px;
         padding-bottom:10px;
      }
   </style>
</head>

@include('sellerHeader');
<body>

<h3 style="text-align:center; font-size:50px;">Art pieces on sale</h3>
   <div id="wrapper">
      @if(Session::has('success'))
         <div class="alert-success">{{Session::get('success')}}</div>
      @endif
      @if(Session::has('fail'))
         <div class="alert-danger">{{Session::get('fail')}}</div>
      @endif

      @if($data->count() > 0)
         @php
            function isBiddingExpired($products) {
               $endTime = strtotime($products->end_time);
               return time() > $endTime;
            }
         @endphp

         @foreach($data as $products)
            <div id="first" style="@if(isBiddingExpired($products)) display:none; @endif">
               <img height="500px;" width="698px;" src="{{ asset('uploads/files/' .$products->image) }}">

               <p style="color:#666; font-size:20px; text-align:left;"> Art Name: <span style="color:purple; font-size:20px;">{{ $products->product_name }}</span></p>
               <p style="color:#666; font-size:20px; text-align:left;"> Description: <span style="color:purple; font-size:20px;">{{$products->description}}</span></p>
               <p style="color:#666; font-size:20px; text-align:left;"> Available Units: <span style="color:purple; font-size:20px;">{{$products->available_units}}</span></p>
               <p style="color:#666; font-size:20px; text-align:left;"> Reserve Price: <span style="color:purple; font-size:20px;">Ksh. {{$products->reserve_price}}</span></p>

               <p style="color:#666; font-size:20px; text-align:left;" id="countdown_{{$products->product_id}}"></p>

               <form action="{{ url('/bid', $products->product_id) }}" method="post" id="form_{{$products->product_id}}">
                  @csrf
                  <input type="hidden" name="product_id" value="{{ $products->product_id }}" required>
                  <input type="hidden" name="bidder_email" value="{{ Auth::user()->email }}">
                  <input type="number" class="box" name="requested_units" max="{{$products->available_units}}" placeholder="Number of arts you want" value="" style="width: 350px; height: 50px; font-size:20px; border: 2px solid #666; border-radius: 4px;padding:20px 40px;" >
                  @if($errors->has('requested_units'))
                     <span class="text-danger">{{$errors->first('requested_units')}}</span>
                  @endif
                  <br><br>

                  <input type="number" class="box" name="amount" min="{{$products->reserve_price}}" placeholder="Min. bidding price:Ksh. {{$products->reserve_price}}" value="" style="width: 350px; height: 50px; font-size:20px; border: 2px solid #666; border-radius: 4px;padding:20px 40px;" >
                  <br><br>
                  <button type="submit" class="option-btn" style="background-color:#98777b;">Bid</button>
                  <br><br>
                  @if($errors->has('amount'))
                     <span class="text-danger">{{$errors->first('amount')}}</span>
                  @endif
               </form>

               <button> <a href="#modal" role="button" class="delete-btn" style="text-decoration:none; align-content:left;">Remove from the shop</a></button>
               <a href="{{ url('seller/restartauction/' . $products->product_id) }}" style="text-decoration: none;" class="option-btn">Edit art</a>

              

               <script>
                  var startTime_{{$products->product_id}} = new Date('{{$products->start_time}}').getTime();
                  var endTime_{{$products->product_id}} = new Date('{{$products->end_time}}').getTime();

                  function updateCountdown() {
                     var currentTime = new Date().getTime();
                     var timeDiffStart = startTime_{{$products->product_id}} - currentTime;
                     var timeDiffEnd = endTime_{{$products->product_id}} - currentTime;

                     var countdownElement = document.getElementById('countdown_{{$products->product_id}}');
                     var formElement = document.getElementById('form_{{$products->product_id}}');

                     if (timeDiffStart > 0) {
                        countdownElement.innerHTML = 'Bidding starts in: ' + getTimeRemaining(timeDiffStart);
                        countdownElement.style.color = 'green';
                        formElement.style.display = 'none';
                     } else if (timeDiffEnd > 0) {
                        countdownElement.innerHTML = 'Bidding ends in: ' + getTimeRemaining(timeDiffEnd);
                        countdownElement.style.color = 'red';
                        formElement.style.display = 'none';
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

               <!-- Modal -->
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
      
      <img style="margin-left:30%;" height="100px;" width="200px;" src="{{ asset('uploads/files/' .$products->image) }}">
      
   <p style="text-align:center; font-size:20px; color:purple;">Arge Auction Shop</p>

		<p style="text-align:center; font-size:20px;">Are you sure you want to remove this item from the cart ? </p>

      <button><a href="{{url('delete_posted/' . $products->product_id) }}" style="text-decoration: none;" class="delete-btn">Remove from shop</a></button>

      <br></br>
   </div>
   
	
	<a href="#!" class="outside-trigger"></a>
</div>


            </div>
         @endforeach
      @else
         <p style="color:red; font-size:30px;">There are no arts available for sale</p>
      @endif
   </div>
</body>
</html>