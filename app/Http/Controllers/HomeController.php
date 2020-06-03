<?php

namespace App\Http\Controllers;

use Illuminate\Http\{
    Request,
    Response
};
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    
    public function index()
    {
        //Redirecionar regstrador para a pagina de registros
        if(Auth::user()->getRoleNames()->first() == 'registrador')
            return redirect()->route('pacientes.index');
        else if(Auth::user()->getRoleNames()->first() == 'adm sys')
            return redirect()->route('users.index');
        return view('interno.index');
    }

   
}
