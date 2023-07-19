<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use phpseclib\Crypt\RSA;
use Ethereum\Contract;

class MpesaPaymentController extends Controller
{
    public function processPayment(Request $request)
    {
        // Your existing code for processing M-Pesa payment

        // Get the M-Pesa transaction data
        $amount = 0.1; // Replace with the actual transaction amount
        $receiver = '0x966Ba7DDCef9D6946BF0ED6A51B5202F7e8e7049'; // Replace with the Ethereum address of the receiver

        // Create a connection to the Ethereum node
        $provider = new Ethereum('https://sepolia.infura.io/v3/8b4c98e30c994c8baebe61174f5d8458');
        $contract = new Contract($provider);

        // Set the address of the deployed smart contract
        $contractAddress = '0x7809FbC56a4aA1Bd00748dF676B370e4A785D8c6'; // Replace with the actual deployed contract address

        // Record the M-Pesa transaction data on the blockchain
        $transaction = $contract->at($contractAddress)->send('recordTransaction', $amount, $receiver);

        // Handle the response from the smart contract (optional)
        // You can get the transaction ID, timestamp, etc. from the response if needed.

        // Redirect back to the form page with a success message
        return redirect()->route('checkoutpost')->with('success', 'Payment processed successfully and recorded on the blockchain!');
    }

}