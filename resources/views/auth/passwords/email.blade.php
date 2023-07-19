@include('loginHeader');



<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Account Activation</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="{{asset('css/style.css')}}">
   

</head>

<body>


   
<div class="form-container" >

   <form action="{{ route('password.email') }}" method="post" style="margin-top: 0px;">
      @csrf
      @if(Session::has('success'))
       <div class="alert-success">{{Session::get('success')}}</div>
       @endif
       @if(Session::has('success'))
       <div class="alert-danger">{{Session::get('fail')}}</div>
       @endif


      <h3>login now</h3>
      <div class="box">
      <input type="email" name="email" placeholder="enter your email" value="{{old('email')}}" size="35%" >
      
      </div>
      @if($errors->has('email'))
      <span class="text-danger">{{$errors->first('email')}}</span>
      @endif
      <input type="submit" name="submit" value="Send Password Reset Link" name="{{ route('password.email') }}"class="btn">
      
      


             
       <p>don't have an account? <a href="register">register now</a></p>
      
    
      
      
   </form>

</div>


</body>
</html>