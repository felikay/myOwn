
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin panel</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="{{asset('css/admin_style.css')}}">
   

</head>

@include('adminHeader');
<body>

<!-- admin dashboard section starts  -->

<section class="dashboard">

   <h1 class="title">dashboard</h1>

   <div class="box-container">


   <div class="box">
      <h2 style="color: red;">[--{{$newproducts}}--]</h2>
         <p> <a href="{{ route('admin.newproducts') }}" style="text-decoration: none; color:black;">New Products</a> </p>
      </div>
   

      <div class="box">
      <h2 style="color: red;">[--{{$newapplications}}--]</h2>
         <p> <a href="{{ route('display.unapprovedapplications') }}" style="text-decoration: none; color:black;">New Applications</a> </p>
      </div>

      <div class="box1" >
      </div>

      <div class="box1" >
      </div>


      <div class="box" >
        
         <h2>{{$totalbidders}}</h2>
         <p> <a href="{{ route('display.bidders') }}" style="text-decoration: none; color:black;">bidder accounts</a> </p>
      </div>
     

      <div class="box">
        
         <h2>{{$totaladmins}}</h2>
         <p> <a href="{{ route('display.admins') }}" style="text-decoration: none; color:black;">Admin accounts</a> </p>
      </div>

      <div class="box">
         
         <h2>{{$totalsellers}}</h2>
         <p> <a href="{{ route('display.sellers') }}" style="text-decoration: none; color:black;">Sellers accounts</a> </p>
      </div>

      <div class="box">
         
         <h2>{{$blocked}}</h2>
         <p> <a href="{{ route('display.blocked') }}" style="text-decoration: none; color:black;">Blocked accounts</a> </p>
      </div>

      

      <div class="box">
         
         <h2>{{$totalaccounts}}</h2>
         <p> <a href="{{ route('display.accounts') }}" style="text-decoration: none; color:black;">Total accounts</a> </p>
      </div>

      <div class="box">
      <h2>{{$applications}}</h2>
         <p> <a href="{{ route('display.applications') }}" style="text-decoration: none; color:black;">Applications</a> </p>
      </div>

      <div class="box">
      <h2>{{$deactivated}}</h2>
         <p> <a href="{{ route('display.deactivated') }}" style="text-decoration: none; color:black;">Deactivated Accounts</a> </p>
      </div>

      
      <div class="box" >

         <h2>{{$totalproducts}}</h2>
         <p> <a href="{{ route('admin.viewproducts') }}" style="text-decoration: none; color:black;">Total Products</a> </p>
      </div>

     

      
   </div>

</section>

<!-- admin dashboard section ends -->




@include('footer');




<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>

</body>
</html>