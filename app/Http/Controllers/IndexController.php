<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class IndexController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function addProducts()
     {
         return view('addProducts');
     }

    
}
?>