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
       <h3 style="text-align:center; font-size:50px;">Art Pieces available for sale</h3>
@if($data->count() > 0)
   
   
   @php 
   $i = 1;
   @endphp
   @foreach($data as $products)
   
  
   <div id="first">
   <img height= "500px;" width="698px;" src="{{ asset('uploads/files/' .$products->image) }}">
   <p style="color:#666; font-size:20px; text-align:left;"> Number : <span style="color:purple; font-size:20px;">{{$i++}}</span> </p>
   <p style="color:#666; font-size:20px; text-align:left;"> Art Piece : <span style="color:purple; font-size:20px;">{{$products->name}}</span> </p>
   <p style="color:#666; font-size:20px; text-align:left;"> Description : <span style="color:purple; font-size:20px;">[--{{$products->description}}--]</span> </p>

   <!-- seller sets the bidding  -->
   
   <form action="{{route('seller.approvedproducts')}}" method="post" enctype="multipart/form-data">
   @csrf
   <input type="hidden" class="box" name="product_id"  value="{{$products->id}}"  >
   <input type="hidden" class="box" name="product_name"  value="{{$products->name}}"  >
   <input type="hidden" class="box" name="description"  value="{{$products->description}}"  >
   <input type="hidden" class="box" name="image"  value="{{$products->image}}"  >
   <input type="hidden" class="box" name="seller_email"  value="{{$products->email}}"  >

   <p style="text-decoration: none; color:#666; font-size:20px; text-align:center;">enter the available units </p>
   <input type="number" class="box" name="available_units"min="1" max = "100"placeholder="Minimum: 1;  Maximum: 100;"value="{{old('available_units')}}" style="width: 350px; height: 50px; font-size:20px; border: 2px solid #666; border-radius: 4px;padding:20px 40px;" >
   <br></br>  
   @if($errors->has('available_units'))
      <span class="text-danger">{{$errors->first('available_units')}}</span>
   @endif

   <p style="text-decoration: none; color:#666; font-size:20px; text-align:center;">enter the minimum bidding price </p>
   <input type="number" class="box" name="reserve_price" placeholder="Ksh. " value="{{old('reserve_price')}}" style="width: 350px; height: 50px; font-size:20px; border: 2px solid #666; border-radius: 4px;padding:20px 40px;" >
   <br></br>  
   @if($errors->has('reserve_price'))
      <span class="text-danger">{{$errors->first('reserve_price')}}</span>
   @endif

   <p style="text-decoration: none; color:#666; font-size:20px; text-align:center;">enter the start date for bidding </p>
   <input type="datetime-local" class="box" name="start_time" min="{{ \Carbon\Carbon::now()->format('Y-m-d\TH:i') }}"  value="{{old('start_time')}}" style="width: 350px; height: 50px; font-size:20px; border: 2px solid #666; border-radius: 4px;padding:20px 40px;" >
   <br></br>
   @if($errors->has('start_time'))
      <span class="text-danger">{{$errors->first('start_time')}}</span>
   @endif

   <p style="text-decoration: none; color:#666; font-size:20px; text-align:center;">enter the end date for bidding </p>
   <input type="datetime-local" class="box" name="end_time" min="{{ \Carbon\Carbon::now()->format('Y-m-d\TH:i') }}"  value="{{old('end_time')}}" style="width: 350px; height: 50px; font-size:20px; border: 2px solid #666; border-radius: 4px;padding:20px 40px;" >
   <br></br>
   @if($errors->has('end_time'))
      <span class="text-danger">{{$errors->first('end_time')}}</span>
   @endif
   <br></br>
   <input type="submit" name="add_product" value="Sell" class="option-btn" style="text-decoration: none; background-color:#ff4500;">
      
   </form>

  <button> <a href="#modal" role="button" class="delete-btn" style="text-decoration:none; align-content:left;">Delete</a></button>
    
    
   


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

      <button><a href="{{url('delete_products/' . $products->id) }}" style="text-decoration: none; " class="delete-btn">Delete</a></button>

      <br></br>
   </div>
   
	
	<a href="#!" class="outside-trigger"></a>
</div>



</div>
@endforeach
@else
<p style="color:red; font-size:30px;"> <span>You have no approved art pieces</span> </p>
@endif

</div>

    

</body>
</html>