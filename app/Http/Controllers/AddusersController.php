<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class AddusersController extends Controller
{
    public function addusers(Request $request){
        

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'type' => 'required',

        ]);

        $data = new User();
        $data->name = $request->name;
        $data->email =$request ->email;
        $data->type =$request ->type;
        $data->save();

        if($data)
        {
            return redirect()->route('add.users')->withSuccess('Account Successfully Created'); 
        }else{
            return redirect()->route('add.users')->withFail('Account Successfully Created');
        }

}

public function displayapplications(Request $request){
        

    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'type' => 'required',

    ]);

    $data = new User();
    $data->name = $request->name;
    $data->email =$request ->email;
    $data->type =$request ->type;
    $data->save();

    if($data)
    {
        return redirect()->route('display.applications')->withSuccess('Account Successfully Created'); 
    }else{
        return redirect()->route('display.applications')->withFail('Account Successfully Created');
    }

}
}