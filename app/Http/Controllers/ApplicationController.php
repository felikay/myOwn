<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;

class applicationController extends Controller
{
    //
   


    public function applications(Request $request){
        

        $request->validate([
            'user_name' => 'required',
            'number' =>'required',
            'email' => 'required|email|unique:users',
            'date_of_birth' => 'required',
            'address' => 'required',
            'street' => 'required',
            'country' => 'required',
            'county' => 'required',
            'city' => 'required',
            'pin_code' => 'required',
            'name' =>'required',
            'type' => 'required',
            'national_id_front' => 'required', 
            'national_id_back' => 'required', 
            'proof_front' => 'required', 
            'proof_back' => 'required', 
            File::types(['pdf'])
            

        ]);

        $data = new Application();

            $data->user_name = $request->input('user_name');
            $data->number =$request ->input('number');
            $data->email = $request->input('email');
            $data->date_of_birth = $request->input('date_of_birth');
            $data->address =$request->input('address');
            $data->street = $request->input('street');
            $data->country = $request->input('country');
            $data->county = $request->input('county');
            $data->city = $request->input('city');
            $data->pin_code = $request->input('pin_code');
            $data->name = $request->input('name');
            $data->type = $request->input('type');


            if($request->hasfile('national_id_front'))
            {
                $file = $request->file('national_id_front');
                $extension = $file->getClientOriginalExtension();
                $filename = time().'.'.$extension;
                $file->move('uploads/files/',$filename);
                $data->national_id_front = $filename;
            }

            if($request->hasfile('national_id_back'))
            {
                $file1 = $request->file('national_id_back');
                $extension1 = $file1->getClientOriginalExtension();
                $filename1 = time().'.'.$extension1;
                $file1->move('uploads/files/',$filename1);
                $data->national_id_back = $filename1;
            }

            if($request->hasfile('proof_front'))
            {
                $file2 = $request->file('proof_front');
                $extension2 = $file2->getClientOriginalExtension();
                $filename2 = time().'.'.$extension2;
                $file2->move('uploads/files/',$filename2);
                $data->proof_front = $filename2;
            }

            if($request->hasfile('proof_back'))
            {
                $file3 = $request->file('proof_back');
                $extension3 = $file3->getClientOriginalExtension();
                $filename3 = time().'.'.$extension3;
                $file3->move('uploads/files/',$filename3);
                $data->proof_back = $filename3;
            }
            $data->save();
            if($data)
            {
                return redirect('applications')->withSuccess('Application successfully delivered'); 
            }else{
                return redirect('applications')->withFail('Application not successfull');
            }
    

    }
  

}