<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Seller Panel</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="{{asset('css/admin_style.css')}}">
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
@include('sellerHeader')
<body>
   


<!-- product CRUD section starts  -->

<section class="add-products">

   <h1 class="title">Add New Art Piece</h1>

   <form id="userForm" action="{{route('add.products')}}" method="post" enctype="multipart/form-data">
      @csrf
       @if(Session::has('success'))
       <div class="alert-success">{{Session::get('success')}}</div>
       @endif
       @if(Session::has('fail'))
       <div class="alert-danger">{{Session::get('fail')}}</div>
       @endif

       <br></br>
       

      <h3>Add New Art Piece</h3>

      <div class="box">
      <input type="name" id="nameInput" name="name" placeholder="enter product name" value="{{old('name')}}" size="35%">
      </div>
      @if($errors->has('name'))
      <span class="text-danger">{{$errors->first('name')}}</span>
      @endif

     
      <div class="box">
      <input type="text" id="descriptionInput" name="description" placeholder="enter the product description" style="width:82%;"  size="35%" value="{{old('description')}}">
      </div>
      @if($errors->has('description'))
      <span class="text-danger">{{$errors->first('description')}}</span>
      @endif

          
      <p style="text-decoration: none; color:#666; font-size:20px; text-align:left;">enter the art image </p>
      <div class="box">
      <input type="file" id="imageInput" name="image" placeholder="Upload Product image"  size="35%" value="{{old('image')}}">
      </div>
      @if($errors->has('image'))
      <span class="text-danger">{{$errors->first('image')}}</span>
      @endif
      
           
      <input type="hidden" name="email"  size="35%" value="{{ Auth::user()->email }}">


      <a href="{{route('seller.home') }}" style="text-decoration: none; background-color:black;" class="option-btn">Go Back</a>
      <a href="#modal" role="button" class="option-btn" style="text-decoration:none;">Add new art piece</a>


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
            
            <div class="box" style=" background-color:white;">
            <img id="modalImage" style="width: 100px; height:100px;" src="" alt="Art Piece Image">
            <p style="padding-left:0px; text-align:left; font-size:15px; color:red;">Name: <span style="color:black;" id="modalName"></span></p>
            <p style="padding-left:0px; text-align:left; font-size:15px; color:red;">Description: <span style="color:black;" id="modalDescription"></span></p>
               
            </div>

            <p style="padding-left:60px; text-align:left; font-size:20px; color:black;">Do you really want to create this new art piece?</p>

            <button type="button" id="submitBtn" style="" class="option-btn">Create New Art</button>

            <br></br>
         </div>

         <a href="#!" class="outside-trigger"></a>
      </div>
   </form>
</div>
      

     




     

   </form>

</section>


<script>
   // Capture form data and populate modal
   document.querySelector('a[href="#modal"]').addEventListener('click', function() {
      var nameInput = document.getElementById('nameInput').value;
      var descriptionInput = document.getElementById('descriptionInput').value;
      var imageInput = document.getElementById('imageInput').files[0]; // Get the selected file

      document.getElementById('modalName').textContent = nameInput;
      document.getElementById('modalDescription').textContent = descriptionInput;

      // Read the image file and set it as the source of the <img> tag
      var reader = new FileReader();
      reader.onload = function(e) {
         document.getElementById('modalImage').src = e.target.result;
      };
      reader.readAsDataURL(imageInput);

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

<script src="js/admin_script.js"></script>

</body>
</html>
