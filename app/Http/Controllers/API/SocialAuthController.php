<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Auth;

class SocialAuthController extends Controller


{
   

   

    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
        
    }

    public function handleCallback()
    {
        
            $user = Socialite::driver('google')->stateless()->user();
            
           
            $data = User::where('email', $user->email)->first();

            if(is_null($data)){

                $users['name'] = $user->name;
                $users['email'] = $user->email;
                $data = User::create($users);
                  
        }
        Auth::login($data);
        return redirect('/bidder/home');
     
    }
}
