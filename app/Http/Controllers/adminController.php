<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Application;
use App\Models\Products;
use DB;
use Illuminate\Support\Facades\Stroage;


class adminController extends Controller
{

  /*------------------------------------------
--------------------------------------------
Display Admin side
--------------------------------------------
--------------------------------------------*/

    
    public function displayBidders()
    {

      $data = User::where('type', 0)->where('status', 1)->get();
      return view('displayBidders',compact('data'));
    }

    
    public function displaySellers()
    {

      $data = User::where('type', 2)->where('status', 1)->get();
      return view('displaySellers',compact('data'));
    }

    public function displayAdmins()
    {

      $data = User::where('type', 1)->where('status', 1)->get();
      return view('displayAdmins',compact('data'));
    }

    public function displayBlocked()
    {

      $data = User::where ( 'status','0')->get();
      return view('displayBlocked',compact('data'));
    }

    public function displayAccounts()
    {

      $data = User::get();
      return view('displayAccounts',compact('data'));
    }

    public function displayApplications()
    {

      $data = Application::where ( 'status','Accepted')->get();
      return view('displayApplications',compact('data'));
    }

   public function displayDeactivated()
    {

      $data = User::whereNull ( 'password')->get();
      $tokens = DB::table('password_reset_tokens')->where('email', '$data->email')->get();
      return view('displayDeactivated',compact('data','tokens'));
    }

    public function adminViewproducts()
    {
      $data = Products::where ( 'blocked','Accepted')->get();
      return view('adminViewproducts',compact('data'));
    }

    public function adminBlockedproducts()
    {

      $data = Products::where ( 'blocked','Denied')->get();
      return view('adminBlockedproducts',compact('data'));
    }

    public function adminNewproducts()
    {

      $data = Products::where ( 'blocked','No Reviews')->get();
      return view('adminNewproducts',compact('data'));
    }

    public function displayUnapprovedapplications()
    {
      $data = Application::where ( 'status','No Reviews')->get();
      return view('displayUnapprovedapplications',compact('data'));
    }

    public function displayDeniedapplications()
    {
      $data = Application::where ( 'status','Denied')->get();
      return view('displayDeniedapplications',compact('data'));
    }



/*------------------------------------------
--------------------------------------------
See Images
--------------------------------------------
--------------------------------------------*/
public function displayNationalfront($id){
  $data = Application::find($id);
  return view('displayNationalfront',compact('data'));
}

public function displayNationalback($id){
  $data = Application::find($id);
  return view('displayNationalback',compact('data'));
}

public function displayProoffront($id){
  $data = Application::find($id);
  return view('displayProoffront',compact('data'));
}

public function displayProofback($id){
  $data = Application::find($id);
  return view('displayProofback',compact('data'));
}

/*------------------------------------------
--------------------------------------------
Download Images
--------------------------------------------
--------------------------------------------*/
public function downloadNationalfront(Request $request,$national_id_front)
{
  return response()->download(public_path('/uploads/files/'.$national_id_front));
}

public function downloadNationalback(Request $request,$national_id_back)
{
  return response()->download(public_path('/uploads/files/'.$national_id_back));
}

public function downloadProoffront(Request $request,$proof_front)
{
  return response()->download(public_path('/uploads/files/'.$proof_front));
}

public function downloadProofback(Request $request,$proof_back)
{
  return response()->download(public_path('/uploads/files/'.$proof_back));
}

    

    /*------------------------------------------
--------------------------------------------
Delete Buttons
--------------------------------------------
--------------------------------------------*/


  public function delete_bidders($id)
    
    {

      $delete_user = User::find($id);
      $delete_user -> delete();
      return redirect()->back()->with('success','Bidder Account Successfully deleted');
     
    }

    public function delete_sellers($id)
    
    {

      $delete_user = User::find($id);
      $delete_user -> delete();
      return redirect()->back()->with('success','Sellers Account Successfully deleted');
     
    }

    public function delete_admins($id)
    
    {

      $delete_user = User::find($id);
      $delete_user -> delete();
      return redirect()->back()->with('success','Admin Account Successfully deleted');
     
    }

    public function delete_accounts($id)
    
    {

      $delete_user = User::find($id);
      $delete_user -> delete();
      return redirect()->back()->with('success','Account Successfully deleted');
     
    }
    
    public function delete_applications($id)
    
    {

      $delete_user = Application::find($id);
      $delete_user -> delete();
      return redirect()->back()->with('success','Application Successfully deleted');
     
    }

    public function delete_blocked($id)
    
    {

      $delete_user = User::find($id);
      $delete_user -> delete();
      return redirect()->back()->with('success','Blocked account successfully deleted');
     
    }

    public function delete_products($id)
    
    {

      $delete_products = Products::find($id);
      $delete_products -> delete();
      return redirect()->back()->with('success','Art Piece successfully deleted');
     
    }

    public function delete_deactivated($id)
    
    {

      $delete_user = User::find($id);
      $delete_user -> delete();
      return redirect()->back()->with('success','Deactivated account deleted successfully');
     
    }



    /*------------------------------------------
--------------------------------------------
Disable accounts
--------------------------------------------
--------------------------------------------*/


    /**
     * Show the application dashboard.
     *
     * @param Integer $user_id
     * @param Integer $Status_code
     * @param Success Response
     */

     public function updateStatus($user_id, $status_code)
     {
        try{
            $update_user = User::whereId($user_id)->update([
                'status' => $status_code
            ]);

            if($update_user){
                
              return redirect()->back()->with('success', 'Acceptance Status of the account has been Successfully updated');  
              }

              return redirect()->back()->with('error','Failed to update the status');

           
        } catch (\Throwable $th) {
            throw $th;

        }
     }


     /**
     * Show the application dashboard.
     *
     * @param Integer $user_id
     * @param Integer $Status_code
     * @param Success Response
     */

     public function appliactionStatus($user_id, $status_code)
     {
        try{
            $update_user = Application::whereId($user_id)->update([
                'status' => $status_code
            ]);

            if($update_user){
                
              return redirect()->back()->with('success', 'Acceptance Status of the application has been Successfully Updated ');  
              }

              return redirect()->back()->with('error','Failed to update the status');
        } catch (\Throwable $th) {
            throw $th;

        }
     }



     public function productStatus($user_id, $status_code)
     {
        try{
            $update_user = Products::whereId($user_id)->update([
                'blocked' => $status_code
            ]);

            if($update_user){
                
                return redirect()->back()->with('success', 'Acceptance Status of the product has been Successfully Updated ');  
                }

                return redirect()->back()->with('error','Failed to update the status');
        } catch (\Throwable $th) {
            throw $th;

        }
     }


     /*------------------------------------------
--------------------------------------------
Navigations 
--------------------------------------------
--------------------------------------------*/


     public function addUsers()
    {
   
        return view('addUsers');
    }
   
    



      
   
    }



