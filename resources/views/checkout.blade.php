<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Checkout</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="{{asset('css/style.css')}}">


 
   

</head>
<body>
   
@include('loginHeader');



<section class="display-order">


</section>

<section class="checkout">

   <form action="{{route('checkoutpost')}}" method="post" enctype="multipart/form-data" id="checkout-form" >
   @csrf
       @if(Session::has('success'))
       <div class="alert-success">{{Session::get('success')}}</div>
       @endif
       @if(Session::has('fail'))
       <div class="alert-danger">{{Session::get('fail')}}</div>
       @endif

      <h3>Check Out</h3>
      <div class="flex">

      
     
   <input style="color:black;" type="hidden" id="productName" name="productName" value="{{ $productName }}" >
   <input type="hidden" name="user_email" placeholder="enter your email" value="{{ $user_email }}">
   <input type="hidden" name="description" value="{{ $description }}">
   <input type="hidden" name="units" value="{{ $units }}">
   <input type="hidden" name="amount" value="{{ $amount }}">
   <input type="hidden" name="sellerEmail" value="{{ $sellerEmail }}">
   
   <div class="inputBox">
   <span>Your name:</span>
   <input style="color:black;" type="text" name="name" value="{{old('name')}}" >
   </div>

   <div class="inputBox">
   <span>Your email:</span>
   <input style="color:black;" type="text" name="email" value="{{old('email')}}" >
   </div>

   <div class="inputBox">
   <span>Your phone number:</span>
   <input style="color:black;" type="number" name="number" value="{{old('number')}}" >
   </div>

   <div class="inputBox">
   <span>Your address:</span>
   <input style="color:black;" type="text" name="address" value="{{old('address')}}">
   </div>

   <div class="inputBox">
   <span>County:</span>
   <input style="color:black;" type="text" name="county" value="{{old('county')}}" >
   </div>

  
   


</div>  

<input type="submit" value="Make Order" style="margin-left: 60%; background-color:black; " class="white-btn" name="submit">
   

<!-- <input type="submit" value="Pay now with M-Pesa" style="margin-left: 60%; background-color:green; " class="white-btn" name="submit"> -->
<a href="http://127.0.0.1:8000/payments/initiatepush" style="margin-left: 60%; background-color: green;" class="white-btn">Pay now with M-Pesa</a>

  

</form>
     
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

</section>


<!-- Add Web3.js library -->
<script src="https://cdn.jsdelivr.net/npm/web3@1.6.0/dist/web3.min.js"></script>

<script>
    // Check if MetaMask is installed
    if (typeof web3 !== 'undefined') {
        web3 = new Web3(web3.currentProvider);
    } else {
        // Handle the case when MetaMask is not installed or not available
        console.log('MetaMask not found. Please install MetaMask to interact with the smart contract.');
    }
</script>

<script>
    // Replace with the actual deployed smart contract address
    const contractAddress = '0x7809FbC56a4aA1Bd00748dF676B370e4A785D8c6';

    // Get the ABI of the deployed smart contract
    const contractABI = [
        // Replace with the actual ABI of your smart contract
        // ...
    ];

    // Create a contract instance using the ABI and contract address
    const contract = new web3.eth.Contract(contractABI, contractAddress);

    // Call the "recordTransaction" function on the smart contract to get the transaction details
    contract.methods.recordTransaction().call((error, result) => {
        if (error) {
            console.error('Error fetching transaction details:', error);
            return;
        }

        // Extract the transaction details from the "result" object
        const transactionDetails = {
            amount: web3.utils.fromWei(result.amount, 'ether'), // Convert the amount from Wei to Ether
            receiver: result.receiver,
            timestamp: new Date(result.timestamp * 1000), // Convert the timestamp to a readable date
            // Add other transaction details if needed
            // ...
        };

        // Display the transaction details in the page
        document.getElementById('transactionDetails').innerHTML = `
            <h2>Transaction Details</h2>
            <p><strong>Amount:</strong> ${transactionDetails.amount} ETH</p>
            <p><strong>Receiver:</strong> ${transactionDetails.receiver}</p>
            <p><strong>Timestamp:</strong> ${transactionDetails.timestamp}</p>
        `;
    });
</script>

<div id="transactionDetails"></div>





<!-- custom js file link  -->

<script src="{{('js/script.js')}}"></script>

</body>
</html>