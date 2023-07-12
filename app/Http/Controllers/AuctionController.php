<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use Illuminate\Http\Request;

class AuctionController extends Controller
{

    public function store(Request $request)
    {
        // Return the view before processing further
    return view('seller_auction');

    $data = $request->validate([
        'title' => 'required|string',
        'description' => 'required|string',
        //'starting_price' => 'required|numeric',
        'reserve_price' =>'required|numeric',
        'start_time'  =>   ['required','before:ending_time'],
        'end_time' => 'required|date',
        'image' => 'required|image',
    ]);

    $auction = Auction::create($data);

    // Perform blockchain operations here, such as creating a smart contract, recording auction details, etc.

    return response()->json(['message' => 'Auction created successfully', 'auction' => $auction]);
}

};