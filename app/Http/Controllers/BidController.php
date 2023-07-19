<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posted;
use App\Models\Bid;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;
use Auth;





class BidController extends Controller
{



    public function sellerApprovedproducts(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'product_name' => 'required',
            'description' => 'required',
            'reserve_price' => 'required|numeric',
            'image' => 'required',
            'seller_email' => 'required',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'available_units' => 'required',
         
        ]);


        $data = new Posted();

            $data->product_id= $request->input('product_id');
            $data->product_name = $request->input('product_name');
            $data->description = $request->input('description');
            $data->available_units = $request->input('available_units');
            $data->reserve_price = $request->input('reserve_price');
            $data->image = $request->input('image');
            $data->seller_email = $request->input('seller_email');
            $data->start_time = $request->input('start_time');
            $data->end_time = $request->input('end_time');

            if($request->hasfile('image'))
            {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time().'.'.$extension;
                $file->move('uploads/files/',$filename);
                $data->image = $filename;

            }

            $data->save();
            if($data)
            {
                return redirect()->back()->with('success', 'The Art Piece is up for sale');  
            }else{
                return redirect()->back()->with('fail', 'Failed. Try again later');  
            }
    
    }




    public function store(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required|numeric|min:0',
            'bidder_email' => 'required',
            'product_id' => 'required',
            'requested_units' => 'required',
        ]);
    
        $product = Posted::find($request->input('product_id'));
    
        // Check if the current user has already placed a bid for the product
        $user = Auth::user();
        $existingBid = $product->bids()->where('bidder_email', $user->email)->first();
        if ($existingBid) {
            return redirect()->back()->with('fail', 'You have already placed a bid for this art piece.');
        }
    
        Bid::create([
            'amount' => $request->input('amount'),
            'product_id' => $request->input('product_id'),
            'bidder_email' => $request->input('bidder_email'),
            'requested_units' => $request->input('requested_units'),
        ]);
    
        return redirect()->back()->with('success', 'Your bid has been submitted.');
    }

   




    
}
