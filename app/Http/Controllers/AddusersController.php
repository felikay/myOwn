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
            return redirect()->back()->with('success', 'New Account created successfully ');
        }else{
            return redirect()->back()->with('error','Failed , try again later');
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
        return redirect()->back()->with('success', 'A New Account is successfully created ');
    }else{
        return redirect()->back()->with('error','Failed , Try again later');
    }

}
}