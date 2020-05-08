<?php

namespace App\Http\Controllers;

use Illuminate\Http\{
    Request,
    Response
};

class HomeController extends Controller
{
    
    public function index()
    {
        return view('interno.index');
    }

   
}
