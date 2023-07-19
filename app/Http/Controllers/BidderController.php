<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Cart;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;
use Auth;

class BidderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

     public function index()
    {
        return view('welcome');
    }
       
   

    

    public function applications()
    {
        return view('applications');
    }

    
    
     
    public function shop(Request $request){

            $data = new Cart();
            $data->product_name = $request->input('product_name');
            $data->description = $request->input('description');
            $data->reserve_price = $request->input('reserve_price');
            $data->available_units = $request->input('available_units');
            $data->start_time =$request->input('start_time');
            $data->end_time = $request->input('end_time');
            $data->email = $request->input('email');
            $data->image = $request->input('image');
            $data->save();

            if($data)
            {
                return redirect()->back()->with('success', 'Art Piece has been successfully added to your Cart');  
            }else{
                return redirect()->back()->with('error','Failed, Please try again');
            }
}



public function delete_cart($id)
    
    {

      $delete_cart = Cart::find($id);
      $delete_cart -> delete();
      return redirect('cart')->with('success','Art Piece has been successfully removed from your cart.');
     
    }
}