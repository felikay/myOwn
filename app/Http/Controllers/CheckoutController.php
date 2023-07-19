<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
<<<<<<< HEAD
use App\Models\Orders;
use Illuminate\Support\Facades\Validator;

class CheckoutController extends Controller
{


    
    public function checkout(Request $request)
    {
        $productName = $request->input('productName');
        $user_email = $request->input('user_email');
        $description = $request->input('description');
        $units = $request->input('units');
        $amount = $request->input('amount');
        $sellerEmail = $request->input('sellerEmail');
        $image = $request->input('image');

        if ($request->isMethod('post')) {
            // Retrieve the form data
            $formData = $request->only(['name', 'user_email', 'number', 'county', 'address', 'street']);

            // Validate the form data
            $validator = \Validator::make($formData, [
                'name' => 'required',
                'email' => 'required|email',
                'number' => 'required',
                'county' => 'required',
                'address' => 'required',
                
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // Store the form data in the database
            $order = new Orders();
            
            $order->productName = $productName;
            $order->user_email = $user_email;
            $order->description = $description;
            $order->units = $units;
            $order->amount = $amount;
            $order->sellerEmail = $sellerEmail;
            $order->image = $image;
            $order->name = $formData['name'];
            $order->email = $formData['email'];
            $order->number = $formData['number'];
            $order->county = $formData['county'];
            $order->address = $formData['address'];

            // Set other fields as needed
            $order->save();

            if ($order) {
                return redirect('/bidder/wonbids')->withSuccess('Your application has been successfully delivered. We will get back to you once it is verified.');
            } else {
                return redirect('/bidder/wonbids')->withFail('Failed, please try again later.');
            }
        }

        // Pass the variables to the view
        return view('checkout', compact('productName', 'user_email', 'description', 'units', 'amount', 'sellerEmail', 'image'));
    }













public function checkoutpost(Request $request)
    {
        
        

            // Validate the form data
            $validator = \Validator::make($formData, [
                'name' => 'required',
                'email' => 'required|email',
                'number' => 'required',
                'county' => 'required',
                'address' => 'required',
                
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            
            $order = new Orders();

        $productName = $request->input('productName');
        $user_email = $request->input('user_email');
        $description = $request->input('description');
        $units = $request->input('units');
        $amount = $request->input('amount');
        $sellerEmail = $request->input('sellerEmail');
        $image = $request->input('image');

            
            $order->productName = $productName;
            $order->user_email = $user_email;
            $order->description = $description;
            $order->units = $units;
            $order->amount = $amount;
            $order->sellerEmail = $sellerEmail;
            $order->image = $image;
            $order->name = $formData['name'];
            $order->email = $formData['email'];
            $order->number = $formData['number'];
            $order->county = $formData['county'];
            $order->address = $formData['address'];

            // Set other fields as needed
            $order->save();

            if ($order) {
                return redirect('/bidder/wonbids')->withSuccess('Your application has been successfully delivered. We will get back to you once it is verified.');
            } else {
                return redirect('/bidder/wonbids')->withFail('Failed, please try again later.');
            }
        }

    
}
=======

class CheckoutController extends Controller
{
    
    public function checkout()
    {
   
        return view('checkout');
    }
   

    public function checkoutpost()
    {
   
        return view('checkoutpost');
    }
   
}
>>>>>>> 0bc6781e98c1ae8072f375423024b831edc5835f
