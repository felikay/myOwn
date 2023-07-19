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
   <link rel="stylesheet" href="{{asset('css/delete.css')}}">
   <style>
   #wrapper {
      border: 1px solid white;
      margin: 30px;
      align: center;
      display: block;
      border: 1px solid white;
      height: 500px;
      width: 100%;
      overflow: hidden; /* Add overflow property to prevent content from overflowing */
   }

   #modalImageDelete {
  display: block;
  margin: 0 auto;
  width: 200px; /* Adjust the width as needed */
  height: 200px; /* Adjust the height as needed */
}

   #first {
      height: 500px;
      width: 698px;
      position: static;
      display: inline-block;
      padding-right: 10px;
      float: left;
      margin-right:10px;
      border: 1px solid white;
      overflow: hidden; /* Add overflow property to prevent content from overflowing */
   }

   #second {
      height: 500px;
      display: inline-block;
      position: static;
      float: left;
      border: 1px solid white;
      padding-right:10px;
      width: calc(100% - 728px); /* Calculate the remaining width after considering the width of the first div and its margin */
      word-wrap: break-word; /* Add word-wrap property to break long words and wrap text within the second div */
   }

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

@include('sellerHeader');



<body>
   
    
    @if(Session::has('success'))
       <div class="alert-success">{{Session::get('success')}}</div>
       @endif
       @if(Session::has('fail'))
       <div class="alert-danger">{{Session::get('fail')}}</div>
       @endif

       <h3 style="text-align:center; font-size:50px;">Art Pieces yet to be approved</h3>
 
@if($data->count() > 0)
   
   
   @php 
   $i = 1;
   @endphp
   @foreach($data as $products)

   
   
   <div id="wrapper">
   
  
   <div id="first">
   <img height= "500px;"id="modalImage" width="698px;" src="{{ asset('uploads/files/' .$products->image) }}"> 
   </div>

   <div id="second">
   <p style="color:#721c08; font-size:15px; text-align:left;"> <span style="color:#721c08; font-size:15px;"> Hello {{Auth::user()->name}},&#x1F525;&#x1F389; </span></p>
   <p style="color:#721c08; font-size:15px; text-align:left;"> <span style="color:#721c08; font-size:15px;"> You new uploaded art piece has been submitted for review. Patients!  </span></p>
   <br>
   <p style="color:#666; font-size:15px; text-align:left;"> Number : <span style="color:black; font-size:15px;">{{$i++}}</span> </p>
   <p style="color:#666; font-size:15px; text-align:left;"> Name : <span style="color:black; font-size:15px;">{{$products->name}}</span> </p>
   <p style="color:#666; font-size:15px; text-align:left;"> Description : <span style="color:black; font-size:15px;">{{$products->description}}</span> </p>
   <p style="color:#666; font-size:15px; text-align:left;"> Status : <span style="color:black; font-size:15px;">{{$products->blocked}}</span></p>
   <p style="color:#666; font-size:15px; text-align:left;"> Created At : <span style="color:black; font-size:15px;">{{$products->created_at}}</span></p>
   <a href="{{url('seller/editproducts/' . $products->id) }}" style="text-decoration: none;" class="option-btn">Update</a>


   
   <button>  <a href="#modal" role="button" class="delete-btn" style="text-decoration:none; ">Delete</a> </button>




<!-- Modal -->
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
      
      <p style="text-align:center; font-size:15px; color:black;">Arge Auction Shop</p>
      <img id="modalImageDelete" style="display: block; margin: 0 auto; width: 200px; height: 200px;" src="" alt="Art Piece Image">
      
      <p style="text-align:center; font-size:20px;">Are you sure you want to delete?</p>

      <button><a href="{{url('delete_products/' . $products->id) }}" style="text-decoration: none; " class="delete-btn">Delete</a></button>

      <br></br>
   </div>
	
   <a href="#!" class="outside-trigger"></a>
</div>










<script>
   // Capture form data and populate modal
   document.querySelectorAll('a[href="#modal"]').forEach(function(link) {
      link.addEventListener('click', function() {
         var imageSrc = this.closest('#wrapper').querySelector('img').src;
         document.getElementById('modalImageDelete').src = imageSrc;
         
         // Open modal
         document.getElementById('modal').style.display = 'flex';
      });
   });
</script>




</div>

</div>

@endforeach


@else
<p style="color:red; font-size:30px;"> <span>There are no Approved products</span> </p>
@endif



    

</body>
</html>