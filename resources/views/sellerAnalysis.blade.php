
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
</body>


@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        {!! $chart->html() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {!! $chart->script() !!}

    <style>
        .ct-series-a .ct-slice-donut {
            fill: #ff0000; /* Red color for Bidders */
        }

        .ct-series-b .ct-slice-donut {
            fill: #00ff00; /* Green color for Sellers */
        }

        .ct-series-c .ct-slice-donut {
            fill: #800080; /* Purple color for Admins */
        }
    </style>
@endsection


</html>