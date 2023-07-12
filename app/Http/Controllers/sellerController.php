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

    
    
     public function addProducts(Request $request){
        

        $request->validate([
            'name' => 'required|unique:products',
            'category' =>'required',
            'description' => 'required',
            'reserve_price' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'email' => 'required',
            'image' => 'required',
                

        ]);


        $data = new Products();

            $data->name = $request->input('name');
            $data->category =$request ->input('category');
            $data->description = $request->input('description');
            $data->reserve_price = $request->input('reserve_price');
            $data->start_date =$request->input('start_date');
            $data->end_date = $request->input('end_date');
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
                return redirect('add/products')->withSuccess('Products successfully uploaded'); 
            }else{
                return redirect('add/products')->withFail('Products not apploaded');
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
            'name' => 'required|unique:products',
            'category' =>'required',
            'description' => 'required',
            'reserve_price' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'email' => 'required',
            'image' => 'required',
                

        ]);


        

        $input = $request->all();
        $products = Products::find($id);

            $products->name = $input['name'];
            $products->category = $input['category'];
            $products->description = $input['description'];
            $products->reserve_price = $input['reserve_price'];
            $products->start_date =$input['start_date'];
            $products->end_date = $input['end_date'];
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
                return redirect('seller/unapprovedproducts')->withSuccess('Products successfully updated'); 
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
      return redirect('seller/displayproducts')->with('success','Data deleted');
     
    }


     /*------------------------------------------
--------------------------------------------
display items
--------------------------------------------
--------------------------------------------*/



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
      $data = Products::where ( 'blocked','Accepted')->where ('email',  $userId)->get();
      return view('sellerApprovedproducts',compact('data'));
    }

    
  

}
