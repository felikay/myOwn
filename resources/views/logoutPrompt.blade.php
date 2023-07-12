<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
 
<link rel="stylesheet" href="{{asset('css/popup.css')}}">
</head>
<body>
<div class="container">
        <button id="open">click me</button>
    </div>



    <div class="model-container">
      <div class="model">
                  
        <p STYLE="color:purple">ARGE AUCTION SHOP</p>
                
        <p>Do you want to logout?</p>
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
</body>
</html>

















