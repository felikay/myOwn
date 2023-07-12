@include('adminHeader');

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="{{asset('css/style.css')}}">

</head>
<body>




   
<div class="form-container">







   <form action="{{route('add.users')}}" method="post" >
      @csrf
       @if(Session::has('success'))
       <div class="alert-success">{{Session::get('success')}}</div>
       @endif
       @if(Session::has('fail'))
       <div class="alert-danger">{{Session::get('fail')}}</div>
       @endif

       <br></br>
       

      <h3>Add a User</h3>

      <div class="box">
      <input type="name" name="name" placeholder="enter your name" value="{{old('name')}}" size="35%" >
       </div>
      @if($errors->has('name'))
      <span class="text-danger">{{$errors->first('name')}}</span>
      @endif
       <div class="box">
      <input type="email" name="email" placeholder="enter your email" value="{{old('email')}}" size="35%" >
      </div>
      @if($errors->has('email'))
      <span class="text-danger">{{$errors->first('email')}}</span>
      @endif
       
       
       <select name="type" style="color:#666;" class="box" placeholder="enter your email" required>
         <option >---Enter user user type---</option>
         <option value="0">Bidder</option>
         <option value="1">Admin</option>
         <option value="2">Seller</option>
      </select>
      @if($errors->has('type'))
      <span class="text-danger">{{$errors->first('type')}}</span>
      @endif
      
      

      
      
      <input type="submit" name="register" value="Add User" class="btn">
      
   </form>

   

</div>


