<?php

namespace App\Http\Controllers;

use Illuminate\Http\{
    Request,
    Response
};

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('login');
    }

    //Login na plataforma
    public function login(Request $request)
    {
        sleep(3);
        
    }

    public function logout()
    {
        
        return redirect()->route('index');

    }
    
}
