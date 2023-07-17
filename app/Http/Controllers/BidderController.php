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
       
    public function about()
    {
      $userId = Auth::user()->email;
      $list = Cart::where ('email',  $userId)->count();
      return view('about',compact('list'));
    }

    public function contacts()
    {
        $userId = Auth::user()->email;
        $list = Cart::where ('email',  $userId)->count();
        return view('contacts',compact('list'));
    }

    public function applications()
    {
        return view('applications');
    }

    
    
     
    public function shop(Request $request){

            $data = new Cart();
            $data->name = $request->input('name');
            $data->reserve_price = $request->input('reserve_price');
            $data->start_date =$request->input('start_date');
            $data->end_date = $request->input('end_date');
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