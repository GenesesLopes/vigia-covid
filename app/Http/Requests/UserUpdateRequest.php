<?php

namespace App\Http\Requests;

use App\Rules\NomeCompleto;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserUpdateRequest extends FormRequest
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
            'nome'  => ['required', 'string', new NomeCompleto],
            'papel' => 'required',
            'id' => 'required',
            'senha' => 'nullable|confirmed'
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

}
