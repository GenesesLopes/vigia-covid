<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\{
    Auth,
    Hash
};
use App\User;
use Illuminate\Http\Request;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return !Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'cpf' => 'required|min:1s|string',
            'senha' => 'required|string|min:6|max:9'
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $user = (new User())->getCpf($this);
            /**Validando cpf */
            if(is_null($user))
                $validator->errors()->add('cpf','Credencial de login não conferem');
            /**Validando credenciasi de senha */
            else if(!Hash::check($this->senha,$user->password))
                $validator->errors()->add('senha','Credencial de senha não conferem');
            else
                Auth::login($user);
        });
    }

   
}