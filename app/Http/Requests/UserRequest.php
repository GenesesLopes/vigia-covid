<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Rules\NomeCompleto;
use App\User;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'cpf' => 'required|cpf',
            'nome'  => ['required','string',new NomeCompleto],
            'papel' => 'required',
            'senha' => 'required|confirmed',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'ck_coleta' => 'Flag Coleta',
            'nome' => 'Nome Completo',
            'senha_confirmation' => 'Confirmação de senha'
        ];
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $user = (new User())->getCpf($this->cpf);
            /**Validando cpf */
            if(!is_null($user))
                $validator->errors()->add('cpf','Cpf Já cadastrado em base de dados');
        });
    }

}
