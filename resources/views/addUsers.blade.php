<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Panel</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="{{asset('css/style.css')}}">
   <link rel="stylesheet" href="{{asset('css/delete.css')}}">

   <style>
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
@include('adminHeader')
<body>

<div class="form-container">
   <form id="userForm" action="{{route('add.users')}}" method="post">
      @csrf
      @if(Session::has('success'))
         <div class="alert-success">{{Session::get('success')}}</div>
      @endif
      @if(Session::has('fail'))
         <div class="alert-danger">{{Session::get('fail')}}</div>
      @endif

      <h3>Add a User</h3>

      <div class="box">
         <input type="name" name="name" id="nameInput" placeholder="Enter your name" value="{{old('name')}}" size="35%">
      </div>
      @if($errors->has('name'))
         <span class="text-danger">{{$errors->first('name')}}</span>
      @endif

      <div class="box">
         <input type="email" name="email" id="emailInput" placeholder="Enter your email" value="{{old('email')}}" size="35%">
      </div>
      @if($errors->has('email'))
         <span class="text-danger">{{$errors->first('email')}}</span>
      @endif

      <select name="type" style="color:#666;" class="box" required>
         <option>---Enter user type---</option>
         <option value="0">Bidder</option>
         <option value="1">Admin</option>
         <option value="2">Seller</option>
      </select>
      @if($errors->has('type'))
         <span class="text-danger">{{$errors->first('type')}}</span>
      @endif

      <a href="#modal" role="button" class="option-btn" style="text-decoration:none;">Create Account</a>

      <div class="modal-wrapper" id="modal">
         <div class="modal-body card">
            <div class="modal-header">
               <h2></h2>
               <br></br>
               <a href="#!" role="button" class="close" aria-label="close this modal" style="color: red;">
                  <svg viewBox="0 0 24 24">
                     <path d="M24 20.188l-8.315-8.209 8.2-8.282-3.697-3.697-8.212 8.318-8.31-8.203-3.666 3.666 8.321 8.24-8.206 8.313 3.666 3.666 8.237-8.318 8.285 8.203z" />
                  </svg>&nbsp;&nbsp;
               </a>
            </div>

            <h2 style="text-align:center; font-size:20px;">Arge Auction Shop</h2>
            
            <div class="box" style="margin:0px; padding:0; background-color:#add8e6;">
               <p style="padding-left:60px; text-align:left; font-size:20px; color:red;">Name: <span id="modalName"></span></p>
               <p style="padding-left:60px; text-align:left; font-size:20px; color:red;">Email: <span id="modalEmail"></span></p>
               <p style="padding-left:60px; text-align:left; font-size:20px; color:red;">Type: <span id="modalType"></span></p>
   </div>

            <p style="padding-left:60px; text-align:left; font-size:20px; color:black;">Do you really want to create this account?</p>

            <button type="button" id="submitBtn" style="" class="option-btn">Create Account</button>

            <br></br>
         </div>

         <a href="#!" class="outside-trigger"></a>
      </div>
   </form>
</div>

<script>
   // Capture form data and populate modal
   document.querySelector('a[href="#modal"]').addEventListener('click', function() {
      var nameInput = document.getElementById('nameInput').value;
      var emailInput = document.getElementById('emailInput').value;
      var typeInput = document.querySelector('select[name="type"]').value;

      document.getElementById('modalName').textContent = nameInput;
      document.getElementById('modalEmail').textContent = emailInput;
      document.getElementById('modalType').textContent = typeInput;

      // Open modal
      document.getElementById('modal').style.display = 'flex';
   });

   // Submit form when modal button is clicked
   document.getElementById('modal').addEventListener('click', function(event) {
      if (event.target.id === 'submitBtn') {
         document.getElementById('userForm').submit();
      }
   });
</script>

</body>
</html>
