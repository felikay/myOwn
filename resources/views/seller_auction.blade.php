<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Seller - Add Auction</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="{{asset('css/admin_style.css')}}">


</head>

@include('sellerHeader');
<body>

<section class="dashboard">

   <h1 class="title">create auction</h1>

<div class="form-container">

   <form action="{{route('create.Auction')}}" method="post">
      @csrf
      @if(Session::has('success'))
       <div class="alert-success">{{Session::get('success')}}</div>
       @endif
       @if(Session::has('success'))
       <div class="alert-danger">{{Session::get('fail')}}</div>
       @endif

      <div class="box">
      <input type="product" name="product" placeholder="enter product name" value="{{old('product')}}" size="35%" >
      <a href="" class="view"></a>
      </div>
      @if($errors->has('product'))
      <span class="text-danger">{{$errors->first('product')}}</span>
      @endif


      <div class="box">
      <input type="description" name="description" placeholder="description"  id="description"  size="35%" value="{{old('description')}}" onCopy="return false" onDrag="return false" onDrop="return false" onPaste="return false" onkeyup="return validate()">
      </div>
      @if($errors->has('descriprion'))
      <span class="text-danger">{{$errors->first('description')}}</span>
      @endif

      <div class="box">
      <input type="reserve price" name="reserve price" placeholder="reserve price"  id="reserve price"  size="35%" value="{{old('reserve price')}}" onCopy="return false" onDrag="return false" onDrop="return false" onPaste="return false" onkeyup="return validate()">
      </div>
      @if($errors->has('reserve price'))
      <span class="text-danger">{{$errors->first('reserve price')}}</span>
      @endif

      <div class="box">
    <label for="start_date">{{ __('Start Date') }}</label>
    <input id="end_date" type="date" class="form-control @error('end_date') is-invalid @enderror" name="end_date" value="{{ old('end_date') }}" required>

    @error('end_date')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

      <div class="box">
    <label for="end_date">{{ __('End Date') }}</label>
    <input id="end_date" type="date" class="form-control @error('end_date') is-invalid @enderror" name="end_date" value="{{ old('end_date') }}" required>

    @error('end_date')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>


    <label for="image"></label>
    <input id="image" type="file" class="form-control-file @error('image') is-invalid @enderror" name="image" accept="image/*" required>

    @error('image')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror

    <br>
    <br>
    <br>
    <br>
    <br>


      <a href="{{ route('create.Auction') }}" class="btn" STYLE="background-color:#8e44ad" size="100%" >Create Auction</a>

   </form>
</div>
   </section>

</body>
</html>