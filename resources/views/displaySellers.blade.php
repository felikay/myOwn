<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Sellers</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="{{asset('css/admin_style.css')}}">
   <link rel="stylesheet" href="{{asset('css/delete.css')}}">

</head>
<body>

@include('adminHeader');
<section class="users">
@if(Session::has('success'))
       <div class="alert-success">{{Session::get('success')}}</div>
       @endif
       @if(Session::has('fail'))
       <div class="alert-danger">{{Session::get('fail')}}</div>
       @endif

       <h3 style="text-align:center; font-size:50px;">Sellers' Accounts</h3>

@if($data->count() > 0)
   
   <div class="box-container">
   @php 
   $i = 1;
   @endphp
   @foreach($data as $sellers)

   <div class="box">
   <p> Number : <span>{{$i++}}</span> </p>
   <p> Name : <span>{{$sellers->name}}</span> </p>
   <p> Email : <span>{{$sellers->email}}</span> </p>
   <p> Type : <span>{{ $sellers->type }}</span> </p>
   
   <a href="{{route('status.update', ['user_id' => $sellers->id, 'status_code' => 0]) }}" style="text-decoration: none; background-color:#98777b;" class="delete-btn">Block</a>
   <a href="#modal" role="button" class="delete-btn" style="text-decoration:none; ">Delete</a> 


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

      <button><a href="{{url('delete_sellers/' . $sellers->id) }}" style="text-decoration: none;" class="delete-btn">Delete</a></button>

      <br></br>
   </div>
   
	
	<a href="#!" class="outside-trigger"></a>
</div>
  
   </div>
@endforeach
</div>
@else
<p style="color:red; font-size:30px;"> <span>There are no registered sellers accounts</span> </p>
@endif

</section>

<!-- custom admin js file link  -->
<script src="{{asset('js/admin_script.js')}}"></script>

</body>



</html>