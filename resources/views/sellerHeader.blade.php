<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>



<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="{{asset('css/popup.css')}}">
<link rel="stylesheet" href="{{asset('css/admin_style.css')}}">

<style>

    /* Style The Dropdown Button */
.dropbtn1 {
  background-color: white;
  color:#666;
  font-size: 20px;
  border: none;
  cursor: pointer;
  padding-left:30px;
  padding-right:4px;
}

/* The container <div> - needed to position the dropdown content */
.dropdown1 {
  position: relative;
  display: inline-block;
}

/* Dropdown Content (Hidden by Default) */
.dropdown-content1 {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropbtn1:hover{
    color:purple;
}

/* Links inside the dropdown */
.dropdown-content1 a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-decoration: none;
}

/* Change color of dropdown links on hover */
.dropdown-content1 a:hover {background-color: #f1f1f1; text-decoration: none; color:purple;}

/* Show the dropdown menu on hover */
.dropdown1:hover .dropdown-content1 {
  display: block;
}

/* Change the background color of the dropdown button when the dropdown content is shown */
.dropdown1:hover .dropbtn1 {
  background-color: white;
}
</style>
 


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="{{asset('css/style.css')}}">


    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<header class="header">

   <div class="header-2">
      <div class="flex">
         <a href="home" style="text-decoration: none;"class="logo">Arge.</a>

         <nav class="navbar">
            <a style="text-decoration: none;" href="{{ route('sellerHome') }}">Home</a>
                        
            <div class="dropdown1">
            <button class="dropbtn1">Products</button>
            <div class="dropdown-content1">
            <a style="text-decoration: none;" href="{{route('add.products')}}">Add Item</a>
            <a style="text-decoration: none;" href="{{ route('seller.unapprovedproducts') }}">Unapproved</a>
            <a style="text-decoration: none;" href="{{ route('seller.blockedproducts') }}">Blocked</a>
            <a style="text-decoration: none;" href="{{ route('seller.approvedproducts') }}">Approved </a>
            <a style="text-decoration: none;" href="{{ route('display.sellers') }}">Sold Items</a>
           
            </div>
            </div>

                

            
            <div class="dropdown1">
            <button class="dropbtn1">Analysis</button>
            <div class="dropdown-content1">
            <a style="text-decoration: none;" href="{{ route('display.bidders') }}">Graphs</a>
                  
            </div>
            </div>                    
           

           

            
             
            
         </nav>

         

         @guest
                            @if (Route::has('login'))
                                <p class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}"></a>
                                </p>
                            @endif

                            @if (Route::has('register'))
                                <p class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}"></a>
                                </p>
                            @endif

                        @else
                            <li class="nav-item dropdown" >
                                <a style="font-size: 20px; width:100px; decoration: none; color:purple" id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <br>
                                <a class="dropdown-item" style="font-size: 20px; text-decoration: none; width:100%; color:purple" href="{{ route('password.update') }}">Reset Password</a>
                                <a class="dropdown-item" style="font-size: 20px; text-decoration: none; width:100%; color:purple"  id="open" >Logout</a>
                                
                                
                                </div>
                            </li>
                           
                        @endguest


                     
      </div>
   </div>

    <div class="model-container">


      <div class="model">
                
        <p STYLE="color:purple; text-indent: 50px; text-align: justify; letter-spacing: 3px; font-size:20px;">ARGE AUCTION SHOP</p>
                      
        <p STYLE=" text-indent: 50px; text-align: justify; letter-spacing: 3px; font-size:15px;">Do you want to logout?</p>
        
        <br></br>    
       <div class="dis">
        <form id="logout-form" action="{{ route('logout') }}" method="POST" enctype="multipart/form-data">
         @csrf
        <button STYLE="display:inline; float:left; " type="submit" href="{{ route('logout') }}" >Yes</button>
        </form>
       
        <button STYLE="display:block; float:right; background-color:purple;  " id="close_up"  >No</button>
        <div>
        <i class="fa fa-times" id="close"></i>
      </div> 
      
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.js" charset="utf-8"></script>
    <script>

        $(document).ready(function(){

            $('#open').click(function(){
                $('.model-container').css('transform','scale(1)');

        }); 

        $('#close').click(function(){
                $('.model-container').css('transform','scale(0)');

        }); 

        $('#close_up').click(function(){
                $('.model-container').css('transform','scale(0)');

        }); 


    });
    </script>




</header>


