<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Application;
use App\Models\Products;
use App\Models\Posted;
use App\Models\Bid;
use App\Models\Cart;
use Carbon\Carbon;
use Auth;
use DB;

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

     public function contacts()
     {
       $userId = Auth::user()->email;
       $list = Cart::where ('email',  $userId)->count();
       return view('contacts',compact('list'));
     }


     public function about()
     {
       $userId = Auth::user()->email;
       $list = Cart::where ('email',  $userId)->count();
       return view('about',compact('list'));
     }

     public function bidderHome()
     {
        $userId = Auth::user()->email;
        $list = Cart::where ('email',  $userId)->where('end_time', '>', Carbon::now()->timezone('Africa/Nairobi'))->count();
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
        $postedproducts = Posted::where('seller_email',  $userId)->count();
        $expired = Posted::where('end_time', '<=', Carbon::now()->timezone('Africa/Nairobi'))->where('seller_email',  $userId)->count();
        return view('sellerHome', compact('expired','totalproducts','unapprovedproducts','approvedproducts','blockedproducts','soldproducts','postedproducts'));
    }

    public function adminHome()
    {
        $totalbidders = User::where ('type','0')->count();
        $totalsellers = User::where ('type','2')->count();
        $totaladmins = User::where ('type','1')->count();
        $totalaccounts = User::count();
        $blocked = User::where ('status','0')->count();

        $applications = Application::count();
        $newapplications = Application::where('status', 'No Reviews')->count();
        $newproducts = Products::where('blocked', 'No Reviews')->count();
        $deactivated = User::whereNull ( 'password')->count();
        $totalproducts = Products::count();
        return view('adminHome',compact('blocked','totalbidders','totalsellers','totaladmins', 'totalaccounts','applications','deactivated','newapplications','totalproducts','newproducts'));
      
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
        $data = DB::table('carts')
    ->where('email', $userId)
    ->where('end_time', '>', Carbon::now()->timezone('Africa/Nairobi'))
    ->get();
        $list = Cart::where ('email',  $userId)->where('end_time', '>', Carbon::now()->timezone('Africa/Nairobi'))->count();
        return view('cart', compact('data','list'));
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
      $list = Cart::where ('email',  $userId)->where('end_time', '>', Carbon::now()->timezone('Africa/Nairobi'))->count();
        return view('orders',compact('list'));
    }

    public function shop()
    {

      $data = Posted::where('end_time', '>', Carbon::now()->timezone('Africa/Nairobi'))->get();
      $userId = Auth::user()->email;
      $list = Cart::where ('email',  $userId)->where('end_time', '>', Carbon::now()->timezone('Africa/Nairobi'))->count();
      $data = DB::table('posteds')
    ->where('end_time', '>', Carbon::now()->timezone('Africa/Nairobi'))
    ->get();
      return view('shop',compact('data','list'));
    }


    public function bidderWonbids()
{
    $userId = Auth::user()->email;
    $list = Cart::where ('email',  $userId)->where('end_time', '>', Carbon::now()->timezone('Africa/Nairobi'))->count();
    $won = Bid::where('bidder_email', $userId)
        ->where('notify', 'Can Buy')
        ->with(['posted'])
        ->get();

    return view('bidderWonbids', compact('won','list'));
}
    

}
