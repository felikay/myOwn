<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<style>
   a{
    text-decoration: none;
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



   <div class="header-1">
      <div class="flex">
         <div class="share">
            <a href="#" class="fab fa-facebook-f" style="text-decoration: none;"></a>
            <a href="#" class="fab fa-twitter" style="text-decoration: none;"></a>
            <a href="#" class="fab fa-instagram" style="text-decoration: none;"></a>
            <a href="#" class="fab fa-linkedin" style="text-decoration: none;"></a>
         </div>
         <p> new <a href="login" style="text-decoration: none;">login</a> | <a href="register" style="text-decoration: none;">register</a> </p>
      </div>
   </div>

   <div class="header-2">
      <div class="flex">
         <a href="home" style="text-decoration: none;"class="logo">Arge.</a>

         <nav class="navbar">
            <a style="text-decoration: none;" href="home">home</a>
            <a style="text-decoration: none;" href="about">about</a>
            <a style="text-decoration: none;" href="shop">shop</a>
            <a style="text-decoration: none;" href="contact">contact</a>
            <a style="text-decoration: none;" href="orders">orders</a>
         </nav>

         <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <a href="search_page.php" style="text-decoration: none;" class="fas fa-search"></a>
            <div id="user-btn"  class="fas fa-user"></div>
            
            <a href="cart" style="text-decoration: none;"> <i class="fas fa-shopping-cart"></i> <span></span> </a>
         </div>

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
                            <li class="nav-item dropdown">
                                <a style="font-size: 20px; decoration: none; color:purple" id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a style="font-size: 20px; text-decoration: none; color:purple; background-color:#FF7276;" class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest


                        
      </div>
   </div>

</header>