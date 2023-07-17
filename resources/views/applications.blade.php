<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Application</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="{{asset('css/style.css')}}">
   

</head>
<body>
   
@include('loginHeader');

<div class="heading">
   <h3>Apply as a vendor</h3>
   <p> <a href="{{ route('bidder.home') }}">home</a> / application </p>
 
</div>

<section class="display-order">


</section>
 

<section class="checkout">

   <form action="{{route('applications')}}" method="post" enctype="multipart/form-data" >
   @csrf
       @if(Session::has('success'))
       <div class="alert-success">{{Session::get('success')}}</div>
       @endif
       @if(Session::has('fail'))
       <div class="alert-danger">{{Session::get('fail')}}</div>
       @endif


      <fieldset>
      <h3>Step 1: Personal Details</h3>
      <div class="flex">

         <div class="inputBox">
            <span>your name :</span>
            <input type="text" name="user_name"  placeholder="enter your name" value="{{old('user_name')}}">
            @if($errors->has('user_name'))
            <span class="text-danger">{{$errors->first('user_name')}}</span>
            @endif
         </div>


         <div class="inputBox">
            <span>your phone number :</span>
            <input type="text" name="number"  placeholder="enter your number" value="{{old('number')}}">
            @if($errors->has('number'))
            <span class="text-danger">{{$errors->first('number')}}</span>
            @endif
         </div>

         <div class="inputBox">
            <span>your date of birth :</span>
            <input type="date" name="date_of_birth"  placeholder="enter your date of birth" value="{{old('date_of_birth')}}">
            @if($errors->has('date_of_birth'))
            <span class="text-danger">{{$errors->first('date_of_birth')}}</span>
            @endif
         </div>
                           
         <div class="inputBox">
            <span>address line  :</span>
            <input type="number" min="0"  name="address"  placeholder="e.g. flat no. eg 123" value="{{old('address')}}">
            @if($errors->has('address'))
            <span class="text-danger">{{$errors->first('address')}}</span>
            @endif
         </div>

         <div class="inputBox">
            <span>your street of residence :</span>
            <input type="text" name="street"  placeholder="e.g. street name - Mbagathi" value="{{old('street')}}">
            @if($errors->has('street'))
            <span class="text-danger">{{$errors->first('street')}}</span>
            @endif
         </div>

         <div class="inputBox">
            <span>Country :</span>
            <input type="text" name="country"  placeholder="e.g. Kenya" value="{{old('country')}}">
            @if($errors->has('country'))
            <span class="text-danger">{{$errors->first('country')}}</span>
            @endif
         </div>

         <div class="inputBox">
            <span>County :</span>
            <input type="text" name="county"  placeholder="e.g. Nakuru" value="{{old('county')}}">
            @if($errors->has('county'))
            <span class="text-danger">{{$errors->first('county')}}</span>
            @endif
         </div>

         <div class="inputBox">
            <span>city :</span>
            <input type="text" name="city"  placeholder="e.g. Nakuru" value="{{old('city')}}">
            @if($errors->has('city'))
            <span class="text-danger">{{$errors->first('city')}}</span>
            @endif
         </div>

         <div class="inputBox">
            <span>pin code :</span>
            <input type="number"  name="pin_code"  placeholder="e.g. 123456" value="{{old('pin_code')}}">
            @if($errors->has('pin_code'))
            <span class="text-danger">{{$errors->first('pin_code')}}</span>
            @endif
         </div>
      </div>
      <input type="button" value="Continue later?" class="option-btn" name="pause">
      
</fieldset>



<fieldset>
      <h3>Step 2: Account Details</h3>
      <div class="flex">

         <div class="inputBox">
            <span>your name :</span>
            <input type="text" name="name"  placeholder="enter your name" value="{{old('name')}}">
            @if($errors->has('name'))
            <span class="text-danger">{{$errors->first('name')}}</span>
            @endif
         </div>
         <div class="inputBox">
            <span>your email :</span>
            <input type="email" name="email"  placeholder="enter your email" value="{{old('email')}}">
            @if($errors->has('email'))
            <span class="text-danger">{{$errors->first('email')}}</span>
            @endif
         </div> 
              
         <div class="inputBox">
            <span></span>
            <input type="hidden" name="type" value="2" value="{{old('type')}}">
            @if($errors->has('type'))
            <span class="text-danger">{{$errors->first('type')}}</span>
            @endif
         </div>
        </div> 

      <input type="button" value="Continue later?" class="option-btn" name="pause">

      </fieldset>




<fieldset>
      <h3>Step 3: Upload Documents</h3>
      <div class="flex">
         <div class="inputBox">
            <span>your national ID - front side:</span>
            <input type="file" name="national_id_front"  placeholder="upload the front side of the national ID" multiple data-preview-file-type="any" value="{{old('national_id_front')}}">
            @if($errors->has('national_id_front'))
            <span class="text-danger">{{$errors->first('national_id_front')}}</span>
            @endif
         </div>
         <div class="inputBox">
            <span>your national ID - back side :</span>
            <input type="file" name="national_id_back"  placeholder="upload the back side of the national ID" multiple data-preview-file-type="any" value="{{old('national_id_back')}}">
            @if($errors->has('national_id_back'))
            <span class="text-danger">{{$errors->first('national_id_back')}}</span>
            @endif
         </div>

         <div class="inputBox" >
            <span>proof of residence - Submit a document that proves you have a residence e.g, electricity bill, water bill, WI-FI bill etc</span>
            <span>your proof of residence - first copy :</span>
            <input type="file" name="proof_front"  placeholder="upload the front side of the Proof of residence" multiple data-preview-file-type="any" value="{{old('proof_front')}}" >
            @if($errors->has('name'))
            <span class="text-danger">{{$errors->first('proof_front')}}</span>
            @endif
         </div>
         <div class="inputBox">
            <span>proof of residence - Submit a document that proves you have a residence e.g, electricity bill, water bill, WI-FI bill etc</span>
            <span>your proof of residence - Second copy :</span>
            <input type="file" name="proof_back"  placeholder="upload the back side of the Proof of residence" multiple data-preview-file-type="any" value="{{old('proof_back')}}">
            @if($errors->has('proof_back'))
            <span class="text-danger">{{$errors->first('proof_back')}}</span>
            @endif
         </div>
         
      </div>
      <input type="button" value="Continue later?" class="option-btn" name="pause">
      <input type="submit" value="apply" style="margin-left: 70%; background-color:green; " class="white-btn" name="submit">
      
</fieldset>





   </form>

</section>






@include('footer');

<!-- custom js file link  -->

<script src="{{('js/script.js')}}"></script>

</body>
</html>