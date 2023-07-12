<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Bidders</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="{{asset('css/admin_style.css')}}">

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
 
@if($data->count() > 0)
   
   <div class="box-container">
   @php 
   $i = 1;
   @endphp
   @foreach($data as $bidders)

   <div class="box">
   <p> Number : <span>{{$i++}}</span> </p>
   <p> Name : <span>{{$bidders->name}}</span> </p>
   <p> Email : <span>{{$bidders->email}}</span> </p>
   <p> Type : <span>{{ $bidders->type }}</span> </p>
  <a href="{{url('delete_bidders/' . $bidders->id) }}" style="text-decoration: none;" class="delete-btn">Delete</a>
  <a href="{{route('status.update', ['user_id' => $bidders->id, 'status_code' => 0]) }}" style="text-decoration: none; background-color:#98777b;" class="delete-btn">Block</a>
  
   </div>
@endforeach
</div>
@else
<p style="color:red; font-size:30px;"> <span>The are no registered Bidders</span> </p>
@endif

</section>

<!-- custom admin js file link  -->
<script src="{{asset('js/admin_script.js')}}"></script>

</body>



</html>