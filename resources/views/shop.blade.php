<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Bidder Panel</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="{{asset('css/style.css')}}">

   <style>
      #wrapper {
    width: 100%;
    border: 1px solid white;
    overflow: hidden; /* will contain if #first is longer than #second */
    display:block;
    height:flex;
     }
    #first {
    width: 701px;
    border: 1px solid purple;
    display:inline-block;
    height:100%;
    margin:20px;
    text-align:center;
    border-radius:1px;
    padding-bottom:10px;
    }

   
    

  
    
   </style>
   
   </head>

@include('bidderHeader');
<body>
<div id="wrapper">
    
    
    @if(Session::has('success'))
       <div class="alert-success">{{Session::get('success')}}</div>
       @endif
       @if(Session::has('fail'))
       <div class="alert-danger">{{Session::get('fail')}}</div>
       @endif
 
@if($data->count() > 0)
   
   
   @php 
   $i = 1;
   @endphp
   @foreach($data as $products)
  
   <div id="first">
   <img height= "500px;" width="698px;" src="{{ asset('uploads/files/' .$products->image) }}">
   
   <p style="color:#666; font-size:20px;"> Name : <span style="color:purple; font-size:20px;">{{$products->name}}</span> </p>
   <p style="color:#666; font-size:20px;"> Reserve Price : <span style="color:purple; font-size:20px;">Ksh. {{$products->reserve_price}}</span> </p>
   <p style="color:#666; font-size:20px;"> Time Left : <span style="color:purple; font-size:20px;">{{$products->start_date}}</span> </p>

<script src="https://cdn.jsdelivr.net/gh/ethereum/web3.js@1.0.0-beta.36/dist/web3.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" crossorigin="anonymous"></script>

<script src="{{ asset('path/to/web3.min.js') }}"></script> <!-- Adjust the path to your web3.min.js file -->

<script>
  // Connect to the Ethereum network using Web3.js
  const web3 = new Web3(Web3.givenProvider);

  // Get the user's Ethereum account address
  async function getAccount() {
    const accounts = await web3.eth.requestAccounts();
    return accounts[0];
  }

  // Get the contract instance
  const contractAddress = 'CONTRACT_ADDRESS'; // Replace with your contract address
  const contractAbi = CONTRACT_ABI; // Replace with your contract ABI
  const contract = new web3.eth.Contract(contractAbi, contractAddress);

  // Function to handle the "Place Bid" button click event
  async function placeBid() {
    const account = await getAccount();

    const bidValue = web3.utils.toWei('BID_AMOUNT_ETHER', 'ether'); // Replace BID_AMOUNT_ETHER with the actual bid amount in Ether

    // Send the bid transaction
    contract.methods.bid().send({ from: account, value: bidValue })
      .on('transactionHash', function (hash) {
        console.log('Bid transaction sent:', hash);
      })
      .on('receipt', function (receipt) {
        console.log('Bid transaction confirmed:', receipt);
        // Handle success or display a confirmation message

        // Update the bid history
        updateBidHistory();
      })
      .on('error', function (error) {
        console.error('Error occurred during bid:', error);
        // Handle error or display an error message
      });
  }

  // Function to retrieve and display the bid history
  async function updateBidHistory() {
    const bidHistoryElement = document.getElementById('bid-history');

    const bidderCount = await contract.methods.getBidderCount().call();
    const bidHistory = [];

    for (let i = 0; i < bidderCount; i++) {
      const bidderAddress = await contract.methods.getBidderAddress(i).call();
      const bidTime = await contract.methods.getBidTime(bidderAddress).call();
      bidHistory.push({ bidder: bidderAddress, time: bidTime });
    }

    // Update the HTML with the bid history
    let html = '<ul>';
    for (const bid of bidHistory) {
      html += `<li>Bidder: ${bid.bidder}<br>Time: ${new Date(bid.time * 1000)}</li>`;
    }
    html += '</ul>';

    bidHistoryElement.innerHTML = html;
  }
</script>

<!-- Add the "Place Bid" button -->
<button onclick="placeBid()">Place Bid</button>

<!-- Add a section to display the bid history -->
<div id="bid-history"></div>





   <form action="{{route('shop')}}" method="post" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="image"  value="{{ $products->image }}">
      <input type="hidden" name="name"   value="{{$products->name}}"  >
      <input type="hidden" name="reserve_price" value="{{$products->reserve_price}}"  >
      <input type="hidden" name="email"  value="{{ Auth::user()->email }}">
      <input type="hidden" name="start_date" value="{{$products->start_date}}"  >
      <input type="hidden" name="end_date" value="{{$products->end_date}}"  >
      <input type="submit" name="shop" value="Add to cart" class="option-btn">
   
   </form>


   
  
   
   </div>
@endforeach
@else
<p style="color:red; font-size:30px;"> <span>The are no registered Bidders</span> </p>
@endif

</div>


    

</body>
</html>