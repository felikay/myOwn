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

    
    
    @if(Session::has('success'))
       <div class="alert-success">{{Session::get('success')}}</div>
       @endif
       @if(Session::has('fail'))
       <div class="alert-danger">{{Session::get('fail')}}</div>
       @endif
       <h3 style="text-align:center; font-size:50px;">Art Pieces available for sale</h3>

   @foreach($data as $products)
   
   <div id="wrapper">
   <div id="first">
   <img height= "500px;" width="698px;" src="{{ asset('uploads/files/' .$products->image) }}">
   </div>

   <div id="second">

   <p style="color:#666; font-size:20px; text-align:left;"> Art Piece : <span style="color:black; font-size:20px;">{{$products->name}}</span> </p>
   
   <!-- seller sets the bidding  -->
   
   <form action="{{route('seller.approvedproducts')}}" method="post" enctype="multipart/form-data">
   @csrf
   <input type="hidden" class="box" name="product_id"  value="{{$products->id}}"  >
   <input type="hidden" class="box" name="product_name"  value="{{$products->name}}"  >
   <input type="hidden" class="box" name="description"  value="{{$products->description}}"  >
   <input type="hidden" class="box" name="image"  value="{{$products->image}}"  >
   <input type="hidden" class="box" name="seller_email"  value="{{$products->email}}"  >

   <p style="text-decoration: none; color:#666; font-size:15px; text-align:left;">enter the available units </p>
   <input type="number" class="box" name="available_units"min="1" max = "100"placeholder="Minimum: 1;  Maximum: 100;"value="{{old('available_units')}}" style="width: 350px; height: 30px; font-size:15px; border: 2px solid #666; border-radius: 4px;padding:20px 40px;" >
   <br></br>  
   @if($errors->has('available_units'))
      <span class="text-danger">{{$errors->first('available_units')}}</span>
   @endif

   <p style="text-decoration: none; color:#666; font-size:15px; text-align:left;">enter the minimum bidding price </p>
   <input type="number" class="box" name="reserve_price" value="{{old('reserve_price')}}" placeholder="Ksh. " style="width: 350px; height: 30px; font-size:15px; border: 2px solid #666; border-radius: 4px;padding:20px 40px;" >
   <br></br>  
   @if($errors->has('reserve_price'))
      <span class="text-danger">{{$errors->first('reserve_price')}}</span>
   @endif

   <p style="text-decoration: none; color:#666; font-size:15px; text-align:left;">enter the start date for bidding </p>
   <input type="datetime-local" class="box" name="start_time" min="{{ \Carbon\Carbon::now()->format('Y-m-d\TH:i') }}"  value="{{old('start_time')}}" style="width: 350px; height: 30px; font-size:15px; border: 2px solid #666; border-radius: 4px;padding:20px 40px;" >
   <br></br>
   @if($errors->has('start_time'))
      <span class="text-danger">{{$errors->first('start_time')}}</span>
   @endif

   <p style="text-decoration: none; color:#666; font-size:15px; text-align:left;">enter the end date for bidding </p>
   <input type="datetime-local" class="box" name="end_time" min="{{ \Carbon\Carbon::now()->format('Y-m-d\TH:i') }}"  value="{{old('end_time')}}" style="width: 350px; height: 30px; font-size:15px; border: 2px solid #666; border-radius: 4px;padding:20px 40px;" >
   <br></br>
   @if($errors->has('end_time'))
      <span class="text-danger">{{$errors->first('end_time')}}</span>
   @endif
   <button> <a href="#modal" role="button" class="delete-btn" style="text-decoration:none; align-content:left;">Delete</a></button>
      
   <input type="submit" name="add_product" value="Sell" class="option-btn" style="text-decoration: none; background-color:#ff4500;">
   
   </form>

  
    
   


</div>

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
      
   <p style="text-align:center; font-size:20px; color:black;">Arge Auction Shop</p>

		<p style="text-align:center; font-size:20px;">Are You sure you want to delete ? </p>

      <button><a href="{{url('delete_products/' . $products->id) }}" style="text-decoration: none; " class="delete-btn">Delete</a></button>

      <br></br>
   </div>
   
	
	<a href="#!" class="outside-trigger"></a>
</div>
</div>

@endforeach 

</body>
</html>