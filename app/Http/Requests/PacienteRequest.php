<?php

namespace App\Http\Requests;

use App\Paciente;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\NomeCompleto;

class PacienteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'cpf' => 'required|min:14|cpf',
            'nome'  => ['required','string',new NomeCompleto],
            'mae'  => ['required','string',new NomeCompleto],
            'nascimento' => 'required|date_format:d/m/Y',
            'sexo' => 'required',
            'logradouro' => 'required',
            'numero' => 'nullable|numeric',
            'bairro' => 'required|string',
            'cidade' => 'required|string',
            'telefone' => 'nullable|string',
            'profissional' => 'required|boolean',
            'instituicao' => 'required|string',
            'fatores' => 'nullable|array',
            'coleta' => 'required_with:ck_coleta|date_format:d/m/Y',
            'tosse' => 'required_with:ck_tosse|date_format:d/m/Y',
            'febre' => 'required_with:ck_febre|date_format:d/m/Y',
            'garganta' => 'required_with:ck_garganta|date_format:d/m/Y',
            'viagem' => 'required_with:ck_viagem|string',
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
            'ck_tosse' => 'Flag Tosse',
            'ck_febre' => 'Flag Febre',
            'ck_garganta' => 'Flag Garganta',
            'ck_viagem' => 'Flag Viagem',
            'nascimento' => 'Data de Nascimento',
            'mae' => 'Nome da mãe',
            'nome' => 'Nome Completo'
        ];
    }

    public function withValidator($validator)
    {
        // $validator->after(function ($validator) {
        //     $paciente = (new Paciente())->getPaciente($this->cpf);
        //     /**Validando cpf */
        //     if(!is_null($paciente))
        //         $validator->errors()->add('cpf','Paciente Já cadastrado na base de dados');
        // });
    }

}
