<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Posted;
use App\Models\Bid;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;
use Auth;
use Carbon\Carbon;

class sellerController extends Controller
{


    public function adminViewproducts()
    
    {
    
      return view('adminViewproducts');
     
    }

<<<<<<< HEAD





    public function sellerEndedAuction()
{


  $userId = Auth::user()->email;
      $data = Posted::where ('seller_email',  $userId)->where('end_time', '<=', Carbon::now()->timezone('Africa/Nairobi'))->get();
      return view('sellerEndedAuction',compact('data'));
  
 

}









    
=======
    public function sellerEndedAuction()
    {

      $userId = Auth::user()->email;
        
      $currentDateTime = now();

      $products = Posted::where('end_time', '<=', Carbon::now()->timezone('Africa/Nairobi'))
    ->where('seller_email', $userId)
    ->whereHas('bids', function ($query) {
        $query->where('notify', 'Cannot Buy');
    })
    ->get();
      
      
      $productData = [];
    
        foreach ($products as $product) {
            
            $highestBid = Bid::where('product_id', $product->product_id)->max('amount');
            $highestBidder = Bid::where('product_id', $product->product_id)->where('amount', $highestBid)->first();
            $image = Posted::where('end_time', '<=', Carbon::now()->timezone('Africa/Nairobi'))->where('product_id', $product->product_id)->get();


            $productData[] = [
                'image' => $image,
                'highestBid' => $highestBid,
                'highestBidder' => $highestBidder,
            ];
        }
    
        return view('sellerEndedAuction', compact('productData','products'));
    }
>>>>>>> 0bc6781e98c1ae8072f375423024b831edc5835f



    public function sellerNotifybidder()
    {

      $userId = Auth::user()->email;
        
      $currentDateTime = now();

      $products = Posted::where('end_time', '<=', Carbon::now()->timezone('Africa/Nairobi'))
    ->where('seller_email', $userId)
    ->whereHas('bids', function ($query) {
        $query->where('notify', 'Can Buy');
    })
    ->get();
      
      
      $productData = [];
    
        foreach ($products as $product) {
            
            $highestBid = Bid::where('product_id', $product->product_id)->max('amount');
            $highestBidder = Bid::where('product_id', $product->product_id)->where('amount', $highestBid)->first();
            $image = Posted::where('end_time', '<=', Carbon::now()->timezone('Africa/Nairobi'))->where('product_id', $product->product_id)->get();


            $productData[] = [
                'image' => $image,
                'highestBid' => $highestBid,
                'highestBidder' => $highestBidder,
            ];
        }
    
        return view('sellerNotifybidder', compact('productData','products'));
    }


    public function sellerPostedproducts()
    
    {
      $userId = Auth::user()->email;
      $data = Posted::where ('seller_email',  $userId)->where('end_time', '>=', Carbon::now()->timezone('Africa/Nairobi'))->get();
      return view('sellerPostedproducts',compact('data'));
         
    }


   

    
    
     public function addProducts(Request $request){
        

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'email' => 'required',
            'image' => 'required',
                

        ]);


        $data = new Products();

            $data->name = $request->input('name');
            $data->description = $request->input('description');
            $data->email = $request->input('email');

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
                return redirect('add/products')->withSuccess('Your new Art Piece has been successfully delivered for approval.'); 
            }else{
                return redirect('add/products')->withFail('Failed, Please try again');
            }
    

    }

 /*------------------------------------------
--------------------------------------------
edit items
--------------------------------------------
--------------------------------------------*/

public function sellerEditproducts($id)
    
    {

      $products = Products::find($id);
      return view('sellerEditproducts', compact('products'));
     
    }



    public function editProducts(Request $request, $id){
        

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'email' => 'required',
            'image' => 'required',
                

        ]);


        

        $input = $request->all();
        $products = Products::find($id);

            $products->name = $input['name'];
            $products->description = $input['description'];
            $products->email = $input['email'];

            if($request->hasfile('image'))
            {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time().'.'.$extension;
                $file->move('uploads/files/',$filename);
                $products->image = $filename;

            }

            $products->save();
            if($products)
            {
<<<<<<< HEAD
              return redirect('/seller/unapprovedproducts')->with('success', 'The art piece information has been successfully updated');
=======
              return redirect()->back()->with('The art piece information has been successfully updated'); 
>>>>>>> 0bc6781e98c1ae8072f375423024b831edc5835f
            }else{
              return redirect()->back()->with('error','Failed , try agin later');
            }
    

    }






    public function sellerRestartAuction($product_id)
    
    {

      $data = Posted::find($product_id)->where ('product_id',  $product_id)->get();
      return view('sellerRestartAuction', compact('data'));
     
    }



    public function sellerRestart(Request $request, $product_id)
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
    
        $data = Posted::find($product_id);
    
        $data->product_id = $request->input('product_id');
        $data->product_name = $request->input('product_name');
        $data->description = $request->input('description');
        $data->available_units = $request->input('available_units');
        $data->reserve_price = $request->input('reserve_price');
        $data->seller_email = $request->input('seller_email');
        $data->start_time = $request->input('start_time');
        $data->end_time = $request->input('end_time');
    
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/files/', $filename);
            $data->image = $filename;
        }
    
        $data->save();
    
        if ($data) {
            return redirect()->back()->with('success', 'The art piece information has been successfully updated');
        } else {
            return redirect()->back()->with('error', 'Failed to update the art piece information, please try again later');
        }
    }






    /*------------------------------------------
--------------------------------------------
Delete Buttons
--------------------------------------------
--------------------------------------------*/




    public function delete_products($id)
    
    {

      $delete_products = Products::find($id);
      $delete_products -> delete();
      return redirect()->back()->with('success','Art Piece has been successfully deleted.');
     
    }

    public function delete_posted($product_id)
    
    {

      $delete_prod = Posted::find($product_id);
      $delete_prod -> delete();
      return redirect()->back()->with('success','Art Piece has been successfully deleted.');
     
    }
   

     /*------------------------------------------
--------------------------------------------
display items
--------------------------------------------
--------------------------------------------*/

public function soldProducts()
{

    $userId = Auth::user()->email;
    $data = Products::where ( 'status', 'Sold' )->where ('email',  $userId)->get();
  return view('soldProducts',compact('data'));
}




    public function sellerDisplayproducts()
    {

        $userId = Auth::user()->email;
        $data = Products::where ('email',  $userId)->get();
      return view('sellerDisplayproducts',compact('data'));
    }

    public function sellerUnapprovedproducts()
    {
      $userId = Auth::user()->email;
      $data = Products::where ( 'blocked','No Reviews')->where ('email',  $userId)->get();
      return view('sellerUnapprovedproducts',compact('data'));
    }

    public function sellerBlockedproducts()
    {
      $userId = Auth::user()->email;
      $data = Products::where ( 'blocked','Denied')->where ('email',  $userId)->get();
      return view('sellerBlockedproducts',compact('data'));
    }

    public function sellerApprovedproducts()
    {
      $userId = Auth::user()->email;
      
      $data = Products::whereNotIn('id', function ($query) {
        $query->select('product_id')
            ->from('posteds');
    })->where ( 'status', 'Not Sold' )->where ( 'blocked','Accepted')->where ('email',  $userId)->get();


      
      return view('sellerApprovedproducts',compact('data'));
    }


    public function productSold($user_id, $status_code)
     {
        try{
            $update_user = Products::whereId($user_id)->update([
                'status' => $status_code
            ]);

            if($update_user){
                
                return redirect()->back()->with('success', 'The Art Piece is sold');  
                }

                return redirect()->back()->with('error','Failed , try agin later');
        } catch (\Throwable $th) {
            throw $th;

        }
     }


     public function productPosted($user_id, $status_code)
     {
        try{
            $update_user = Products::whereId($user_id)->update([
                'posted' => $status_code
            ]);

            if($update_user){
                
                return redirect()->back()->with('success', 'The Art Piece post status has been successfully updated');  
                }

                return redirect()->back()->with('error','Failed , try agin later');
        } catch (\Throwable $th) {
            throw $th;

        }
     }


     public function expire($user_id, $status_code)
     {
        try{
            $update_user = Bid::where('product_id', $user_id)->update([
                'notify' => $status_code
            ]);

            if($update_user){
                
                return redirect()->back()->with('success', 'The Bidder is notified.');  
                }

                return redirect()->back()->with('error','Failed to update the status');
        } catch (\Throwable $th) {
            throw $th;

        }
     }

    
  

}
