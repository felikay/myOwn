<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Panel</title>

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

       <h3 style="text-align:center; font-size:50px;">Denied Applications</h3>

@if($data->count() > 0)
   
   
   @php 
   $i = 1;
   @endphp
   @foreach($data as $applications)
 
   <div class="box-container" style="border: 5px solid purple; border-radius:5px; padding:20px; width:150%; margin-bottom:20px;">

   <div class="box">
   <p style="color:green;">Personal Details</p>
   <p> Number : <span>{{$i++}}</span> </p>
   <p> Name : <span>{{$applications->user_name}}</span> </p>
   <p> Number : <span>{{$applications->number}}</span> </p>
   <p> Email : <span>{{$applications->email}}</span> </p>
   <p> Date of Birth : <span>{{$applications->date_of_birth}}</span> </p>
   <p> Country : <span>{{$applications->country}}</span> </p>
   </div>

   <div class="box">
   <p style="color:green;">Account Details</p>
   <p> User Name : <span>{{ $applications->name }}</span> </p>
   <p> Email: <span>{{$applications->email}}</span> </p>
   <p> Status: <span>{{$applications->status}}</span> </p>
   </div>

   <div class="box">
   <p style="color:green;">Documents</p>
   <p> ID F : <span><a style="text-decoration:none; color:purple;" href="{{route('display.nationalfront', $applications->id)}}">View</a>|<a style="text-decoration:none; color:purple;" href="{{route('download.nationalfront', $applications->national_id_front)}}">Download</a></span> </p>
   <p> ID B : <span><a style="text-decoration:none; color:purple;" href="{{route('display.nationalback', $applications->id)}}">View</a>|<a style="text-decoration:none; color:purple;" href="{{route('download.nationalback', $applications->national_id_back)}}">Download</a></span> </p>
   <p> Proof F : <span><a style="text-decoration:none; color:purple;" href="{{route('display.prooffront', $applications->id)}}">View</a>|<a style="text-decoration:none; color:purple;" href="{{route('download.prooffront', $applications->proof_front)}}">Download</a></span> </p>
   <p> proof B : <span><a style="text-decoration:none; color:purple;" href="{{route('display.proofback', $applications->id)}}">View</a>|<a style="text-decoration:none; color:purple;" href="{{route('download.proofback', $applications->proof_back)}}">Download</a></span> </p>
<<<<<<< HEAD
   
=======
   <a href="#modal" role="button" class="delete-btn" style="text-decoration:none; ">Delete</a> 
   <a href="{{route('applications.status', ['user_id' => $applications->id, 'status_code' => 'Accepted']) }}" style="text-decoration: none; background-color:#47d247;" class="option-btn" >Accept</i></a>

>>>>>>> 0bc6781e98c1ae8072f375423024b831edc5835f
   
   
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

      <button><a href="{{url('delete_applications/' . $applications->id) }}" style="text-decoration: none;" class="delete-btn">Delete</a></button>

      <br></br>
   </div>
   
	
	<a href="#!" class="outside-trigger"></a>
</div>
  
   </div>
@endforeach
</div>
@else
<<<<<<< HEAD
<p style="color:red; font-size:30px;"> <span></span> </p>
=======
<p style="color:red; font-size:30px;"> <span>There are no Denied  Accounts</span> </p>
>>>>>>> 0bc6781e98c1ae8072f375423024b831edc5835f
@endif

</section>

<!-- custom admin js file link  -->
<script src="{{asset('js/admin_script.js')}}"></script>

</body>



</html>