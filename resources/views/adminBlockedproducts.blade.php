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

@include('adminHeader');
<body>
<div id="wrapper">
    
    
    @if(Session::has('success'))
       <div class="alert-success">{{Session::get('success')}}</div>
       @endif
       @if(Session::has('fail'))
       <div class="alert-danger">{{Session::get('fail')}}</div>
       @endif
 
@if($data->count() > 0)
   
   
   @php 
   $i = 1;
   @endphp
   @foreach($data as $products)
  
   <div id="first">
   <img height= "500px;" width="698px;" src="{{ asset('uploads/files/' .$products->image) }}">
   <p style="color:#666; font-size:20px;"> Number : <span style="color:purple; font-size:20px;">{{$i++}}</span> </p>
   <p style="color:#666; font-size:20px;"> Email : <span style="color:purple; font-size:20px;">{{$products->email}}</span> </p>
   <p style="color:#666; font-size:20px;"> Name : <span style="color:purple; font-size:20px;">{{$products->name}}</span> </p>
   <p style="color:#666; font-size:20px;"> Category : <span style="color:purple; font-size:20px;">{{$products->category}}</span> </p>
   <p style="color:#666; font-size:20px;"> Price : <span style="color:purple; font-size:20px;">{{$products->reserve_price}}</span> </p>
   <p style="color:#666; font-size:20px;"> Start Date : <span style="color:purple; font-size:20px;">{{$products->start_date}}</span> </p>
   <p style="color:#666; font-size:20px;"> End Date : <span style="color:purple; font-size:20px;">{{$products->start_date}}</span> </p>
   <p style="color:#666; font-size:20px;"> Status : <span style="color:purple; font-size:20px;">{{$products->blocked}}</span> </p>
   <a href="{{route('product.status', ['user_id' => $products->id, 'status_code' => 'Accepted']) }}" style="text-decoration: none; background-color:#47d247;" class="option-btn" >Accept</i></a>
   <a href="{{url('delete_products/' . $products->id) }}" style="text-decoration: none;" class="delete-btn">Delete</a>
>
   </div>
@endforeach
@else
<p style="color:red; font-size:30px;"> <span>The are no products</span> </p>
@endif

</div>


    

</body>
</html>