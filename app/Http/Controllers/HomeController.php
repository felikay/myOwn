<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Application;
use App\Models\Products;
use App\Models\Cart;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     * 
     * 
     */

     public function bidderHome()
     {
        $userId = Auth::user()->email;
        $list = Cart::where ('email',  $userId)->count();
        $nolist = '';
        return view('bidderHome',compact('list','nolist'));

     }

     public function welcome()
     {
        
        return view('welcome');

     }

    

   public function sellerHome()
    {   
        $userId = Auth::user()->email;
        $totalproducts = Products::where ('email',  $userId)->count();
        $unapprovedproducts = Products::where('blocked', 'No Reviews')->where ('email',  $userId)->count();
        $approvedproducts = Products::where('blocked', 'Accepted')->where ('email',  $userId)->count();
        $blockedproducts = Products::where('blocked', 'Denied')->where ('email',  $userId)->count();
        $soldproducts = Products::where('status', '1')->where ('email',  $userId)->count();
        $postedproducts = Products::where ( 'status', 0 )->where ('email',  $userId)->where ( 'posted', 'Posted' )->where('blocked', 'Accepted')->count();
        return view('sellerHome', compact('totalproducts','unapprovedproducts','approvedproducts','blockedproducts','soldproducts','postedproducts'));
    }

    public function adminHome()
    {
        $totalbidders = User::where ('type','0')->count();
        $totalsellers = User::where ('type','2')->count();
        $totaladmins = User::where ('type','1')->count();
        $totalaccounts = User::count();
        $applications = Application::count();
        $newapplications = Application::where('status', 'No Reviews')->count();
        $newproducts = Products::where('blocked', 'No Reviews')->count();
        $deactivated = User::whereNull ( 'password')->count();
        $totalproducts = Products::count();
        return view('adminHome',compact('totalbidders','totalsellers','totaladmins', 'totalaccounts','applications','deactivated','newapplications','totalproducts','newproducts'));
      
    }



     public function logoutPrompt()
    {
        return view('logoutPrompt');
    }

    public function addProducts()
     {
         return view('addProducts');
     }

     public function cart()
     {

        $userId = Auth::user()->email;
        $data = Cart::where ('email',  $userId)->get();
        $list = Cart::where ('email',  $userId)->count();
        return view('cart', compact('data','list'));
     }

     public function wonBidsbidders()
     {
         return view('wonBidsbidders');
     }


    
     

   
   
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
       //applications
    
    public function orders()
    {
      $userId = Auth::user()->email;
      $list = Cart::where ('email',  $userId)->count();
        return view('orders',compact('list'));
    }

    public function shop()
    {

      
      $userId = Auth::user()->email;
      $list = Cart::where ('email',  $userId)->count();
      $data = Products::where ( 'status', 0 )->where ( 'blocked','Accepted')->where ( 'posted', 'Posted' )->get();

      return view('shop',compact('data','list'));
    }

    

}
