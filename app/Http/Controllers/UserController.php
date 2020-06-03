<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\{
    UserRequest,
    UserUpdateRequest
};
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('interno.Users.index');
    }
 
    public function getUser(string $cpf): ?array
    {
        $user = (new User())->getCpf($cpf);
        if( $user !== null){
            return [
                'cpf' => $user->cpf,
                'nome' => $user->nome,
                'papel' => $user->getRoleNames()->first(),
                'id' => $user->id
            ];
        }
        return [];
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\UserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = new User();
        $user->cpf = $request->cpf;
        $user->nome = $request->nome;
        $user->password = Hash::make($request->senha);
        if($request->papel !== 'adm sys')
            $user->user_adm = Auth::user()->id;
        $user->save();
        $user->assignRole($request->papel);
        return ['Cadastro realizado com Sucesso'];
    }
  
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UserUpdateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request)
    {
        $user = User::find($request->id);

        $user->nome = $request->nome;
        $user->cpf = $request->cpf;
        if($request->papel !== 'adm sys')
            $user->user_adm = Auth::user()->id;
        if(isset($request->senha))
            $user->password = Hash::make($request->senha);
        $user->syncRoles([$request->papel]);
        $user->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $user = User::find($request->id);
        $user->delete();

    }
}
