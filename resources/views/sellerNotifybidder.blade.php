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
<div id="wrapper">
    
    
    @if(Session::has('success'))
       <div class="alert-success">{{Session::get('success')}}</div>
       @endif
       @if(Session::has('fail'))
       <div class="alert-danger">{{Session::get('fail')}}</div>
       @endif
       <h3 style="text-align:center; font-size:50px;">Pending sales</h3>

   
  
  
      @foreach($productData as $productItem)
      
      
      <div id="first">
      @foreach($productItem['image'] as $image)
         <img height="500px;" width="698px;" src="{{ asset('uploads/files/'. $image->image) }}">
         <p style="color:#666; font-size:20px; text-align:left;"> Art Piece: <span style="color:purple; font-size:20px;"> {{ $image->product_name }}</span></p>
         <p style="color:#666; font-size:20px; text-align:left;"> Description: <span style="color:purple; font-size:20px;"> {{ $image->description }}</span></p>
         <p style="color:#666; font-size:20px; text-align:left;"> Minimum set Price: <span style="color:purple; font-size:20px;"> Ksh. {{ $image->reserve_price }}</span></p>
         <p style="color:#666; font-size:20px; text-align:left;"> Auction period: <span style="color:red; font-size:20px;"> Expired</span></p>

      @endforeach

      <br></br>

      <p style="color:black; font-size:20px; text-align:left;"> Requested Units: <span style="color:orange; font-size:20px;"> {{ $productItem['highestBidder']->requested_units }}</span></p>

      <p style="color:black; font-size:20px; text-align:left;">Highest Bid:  <span style="color:orange; font-size:20px;">Ksh.  {{ $productItem['highestBid'] }}</span></p>
      @if($productItem['highestBidder'])
         <p style="color:black; font-size:20px; text-align:left;">Highest Bidder:  <span style="color:orange; font-size:20px;">{{ $productItem['highestBidder']->bidder_email }}</span></p>
      @else
         <p style="color:black; font-size:20px; text-align:left;">Highest Bidder:  <span style="color:orange; font-size:20px;">No bidder</span></p>
      @endif
   

   <button> <a href="#modal" role="button" class="delete-btn" style="text-decoration:none; align-content:left;">Delete</a></button>
   <a href="{{ url('seller/restartauction/' . $productItem['highestBidder']->product_id) }}" style="text-decoration: none;" class="option-btn">Repost</a>
   <a href="{{route('expire.status', ['user_id' => $productItem['highestBidder']->requested_units , 'status_code' => 'Cannot Buy']) }}" style="text-decoration: none; background-color:#98777b;" class="delete-btn" >Decline</i></a>
   
   </div>



   
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

         <p style="text-align:center; font-size:20px; color:purple;">Arge Auction Shop</p>

         <p style="text-align:center; font-size:20px;">Are You sure you want to delete ? </p>

         <button><a href="{{url('delete_posted/' . $productItem['highestBidder']->product_id) }}" style="text-decoration: none; " class="delete-btn">Delete</a></button>

         <br></br>
      </div>
      
      <a href="#!" class="outside-trigger"></a>
   </div>
@endforeach

</div>

    

</body>
</html>