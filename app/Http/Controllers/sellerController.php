<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;
use Auth;

class sellerController extends Controller
{


    public function adminViewproducts()
    
    {
    
      return view('adminViewproducts');
     
    }


    public function sellerPostedproducts()
    
    {
      $userId = Auth::user()->email;
      $data = Products::where ( 'status', 0 )->where ('email',  $userId)->where ( 'posted', 'Posted' )->get();
      return view('sellerPostedproducts',compact('data'));
    
     
     
    }

   

    
    
     public function addProducts(Request $request){
        

        $request->validate([
            'name' => 'required',
            'reserve_price' => 'required',
            'email' => 'required',
            'image' => 'required',
                

        ]);


        $data = new Products();

            $data->name = $request->input('name');
            $data->reserve_price = $request->input('reserve_price');
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
            'reserve_price' => 'required',
            'email' => 'required',
            'image' => 'required',
                

        ]);


        

        $input = $request->all();
        $products = Products::find($id);

            $products->name = $input['name'];
            $products->reserve_price = $input['reserve_price'];
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
                return redirect('seller/unapprovedproducts')->withSuccess('The art piece information has been successfully updated'); 
            }else{
                return redirect('seller/unapprovedproducts')->withFail('Products not updated');
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
      return redirect('seller/displayproducts')->with('success','Art Piece has been successfully deleted.');
     
    }


     /*------------------------------------------
--------------------------------------------
display items
--------------------------------------------
--------------------------------------------*/

public function soldProducts()
{

    $userId = Auth::user()->email;
    $data = Products::where ( 'status', 1 )->where ('email',  $userId)->get();
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
      $data = Products::where ( 'status', 0 )->where ( 'blocked','Accepted')->where ( 'posted', 'Not Posted' )->where ('email',  $userId)->get();
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

    
  

}
