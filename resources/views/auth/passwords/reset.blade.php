@include('loginHeader');

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



<div class="dropdown" onkeyup="return validate()">
  <button onclick="myFunction()" class="dropbtn" id="pass_btn" onkeyup="return validate()"  >Password rules</button>
  <div id="myDropdown" class="dropdown-content">
   <ul>
    <li id='length'> Must be at least 8 characters</li>
    <li id='upper'>Must have upper case character(s)</li>
    <li id='lower'>Must have lower case character(s)</li>
    <li id='number'>Must have at least one number</li>
    <li id='symbol'>Must have symbol character(s) e.g #.$,*</li>
    <li id='confirmpassword2'>The 2 passwords must match</li>
    

</ul>
  </div>
</div>



   <form action="{{ route('password.update') }}" method="post" >
      @csrf
      <input type="hidden" name="token" value="{{ $token }}">
       @if(Session::has('success'))
       <div class="alert-success">{{Session::get('success')}}</div>
       @endif
       @if(Session::has('fail'))
       <div class="alert-danger">{{Session::get('fail')}}</div>
       @endif

       <br></br>
       

      <h3>Reset Password</h3>

      
       <div class="box">
      <input type="email" name="email" placeholder="enter your email" value="{{ $email ?? old('email') }}" size="35%" >
      
      </div>
      @if($errors->has('email'))
      <span class="text-danger">{{$errors->first('email')}}</span>
      @endif

      

      <div class="box">
      <input type="password" name="password" placeholder="enter your password"  id="password"  size="35%" value="{{old('password')}}" onCopy="return false" onDrag="return false" onDrop="return false" onPaste="return false" onkeyup="return validate()">
      <i class="fa-solid fa-eye" id="showpassword" onclick="showpass()"></i>
      </div>
      
      @if($errors->has('password'))
      <span class="text-danger">{{$errors->first('password')}}</span>
      @endif

      <div class="box">

      <input type="password" name="password_confirmation" id='confirmpassword' placeholder="confirm your password" size="35%"  value="{{old('confirmpassword')}}" onCopy="return false" onDrag="return false" onDrop="return false" onPaste="return false" onkeyup="return validate()">
      <i class="fa-solid fa-eye" id="showpasswordconfirm" onclick="showpass1()"></i>
   </div>
      @if($errors->has('password_confirmation'))
      <span class="text-danger">{{$errors->first('password_confirmation')}}</span>
      @endif
      <br></br>
      
      <input type="submit" name="{{ route('password.update') }}" value="register now" class="btn">
      
   </form>

   

</div>


<script>
function myFunction() {
   document.getElementById("myDropdown").classList.toggle("show");
}

document.querySelector('.myDropdown').addEventListener('click', function(event) {
   event.preventDefault();
});



</script>



<script>

   function validate(){

      var pass_btn = document.getElementById('pass_btn');
      var password = document.getElementById('password').value;
      var upper = document.getElementById('upper');
      var lower = document.getElementById('lower');
      var number = document.getElementById('number');
      var length = document.getElementById('length');
      var symbol = document.getElementById('symbol');
      var confirmpassword3 = document.getElementById('confirmpassword2');
      var confirmpassword2 = document.getElementById('confirmpassword').value;
      


      if(password.match(/[0-9]/)){
         number.style.color = "green"
      }else{
         number.style.color = "red"
      }

      if(password.match(/[A-Z]/)){
         upper.style.color = "green"
      }else{
         upper.style.color = "red"
      }

      if(password.match(/[a-z]/)){
         lower.style.color = "green"
      }else{
         lower.style.color = "red"
      }

      if(password.length > 8){
         length.style.color = "green"
      }else{
         length.style.color = "red"
      }

      if(password.match(/[!\@\#\$\%\^\&\*\(\)\[\]\-\_\+\=\?\<\>\.\'\"\:\;\,]/)){
         symbol.style.color = "green"
      }else{
         symbol.style.color = "red"
      }

      if(password = confirmpassword2){
         confirmpassword3.style.color = "green"
      }else{
         confirmpassword3.style.color = "red"
      }

      
      


      if((password.match(/[!\@\#\$\%\^\&\*\(\)\[\]\-\_\+\=\?\<\>\.\'\"\:\;\,]/))&&(password.length > 8)&&(password = confirmpassword2)&&(password.match(/[a-z]/))&&(password.match(/[A-Z]/))&&(password.match(/[0-9]/))){
         pass_btn.style.background = "green"
      }else{
         pass_btn.style.background = "red"
      }


   }
   </script>

   <script>
 function showpass(){

  var showpassword = document.getElementById('showpassword');
  var passwordField = document.getElementById('password');
  
  


  showpassword.addEventListener("click", function() {
   this.classList.toggle("fa-eye-slash");
   const type = passwordField.getAttribute("type")==="password" ? "text" : "password";
   passwordField.setAttribute("type", type);
  })

  
 }
 </script>

<script>
 function showpass1(){

  var showpassword1 = document.getElementById('showpasswordconfirm');
  var passwordField1 = document.getElementById('confirmpassword');
  
  


  showpassword1.addEventListener("click", function() {
   this.classList.toggle("fa-eye-slash");
   const type = passwordField1.getAttribute("type")==="password" ? "text" : "password";
   passwordField1.setAttribute("type", type);
  })

  
 }
 </script>

</body>
</html>
