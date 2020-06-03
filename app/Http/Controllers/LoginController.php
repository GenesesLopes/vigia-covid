<?php

namespace App\Http\Controllers;


use App\Http\Requests\LoginRequest;
use App\User;
use Illuminate\Support\Facades\{
    Hash,
    Auth
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
    public function login(LoginRequest $request)
    {
        if(Auth::check())
            return redirect()->route('home');
        /**Recuperando Login */
        // return Response('erro teste',500);

    }

    public function logout()
    {
        Auth::logout(true);
        return redirect()->route('index');

    }
    
}
