<?php

namespace App\Http\Controllers;

use App\Http\Requests\PacienteRequest;
use Illuminate\Http\Request;
use App\{
    Paciente,
    Info_clinicas
};
use App\Events\HistoricoPacienteEvent;
use Illuminate\Support\Facades\Auth;

class PacienteController extends Controller
{

    public function __construct()
    {
        // /*Acesso de registrador */
        // $this->middleware('role:registrador')->except(['acompanhar']);

        // /**Acesso de Acompanhador */
        // $this->middleware('role:acompanhador')->only(['update', 'acompanhar']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('interno.Pacientes.cadastrar');
    }

    public function getPaciente(string $cpf): array
    {

        $paciente = (new Paciente())->getPaciente($cpf);

        $info_pessoais = [];
        $info_clinicas = [];
        if ($paciente !== null) {
            $clinicas = $paciente->info_clinicas()->first();
            $info_pessoais =  [
                'cpf' => $paciente->cpf,
                'nome' => $paciente->nome,
                'mae' => $paciente->nome_mae,
                'nascimento' => $paciente->data_nascimento,
                'sexo' => $paciente->sexo,
                'logradouro' => $paciente->logradouro,
                'numero' => $paciente->numero ?? '',
                'bairro' => $paciente->bairro,
                'cidade' => $paciente->cidade,
                'telefone' => $paciente->telefone ?? '',
                'profissional' => $paciente->pr_saude,
                'responsavel' => $paciente->responsavel->nome ?? '',
                'data_cadastro' => $paciente->created_at,
                'id' => $paciente->id
            ];
            $info_clinicas = [
                'coleta' => $clinicas->data_coleta,
                'instituicao' => $clinicas->instituicao_origem,
                'observacoes' => $clinicas->observacoes,
                'acompanhamento' => $clinicas->status,
                'sintomas' => $clinicas->sintomas
            ];

            return array('info_pessoais' => $info_pessoais, 'info_clinicas' => $info_clinicas);
        }
        return [];
    }

    private function structDate($request, $sintomas, $paciente,$action): array
    {
        $dados_pessoais = $request->only([
            'cpf',
            'nome',
            'mae',
            'nascimento',
            'sexo',
            'logradouro',
            'numero',
            'bairro',
            'cidade',
            'telefone',
            'profissional'
        ]);

        $historico = [];
        data_fill($historico, 'paciente_id', $paciente->id);
        data_fill($historico, 'users_id', Auth::user()->id);
        data_fill($historico, 'action', $action);
        data_fill($historico, 'data.dados_pessoais', $dados_pessoais);
        data_fill($historico, 'data.sintomas', $sintomas);

        return $historico;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PacienteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PacienteRequest $request)
    {

        $sintomas['sintomas'] = $request->fatores;
        data_fill($sintomas, 'contato', $request->contato);
        data_fill($sintomas, 'coleta', $request->coleta ?? '');
        data_fill($sintomas, 'tosse', $request->tosse ?? '');
        data_fill($sintomas, 'febre', $request->febre ?? '');
        data_fill($sintomas, 'garganta', $request->garganta ?? '');
        data_fill($sintomas, 'viagem', $request->viagem ?? '');

        $paciente = new Paciente();
        $paciente->cpf = $request->cpf;
        $paciente->nome = $request->nome;
        $paciente->nome_mae = $request->mae;
        $paciente->data_nascimento = $request->nascimento;
        $paciente->sexo = $request->sexo;
        $paciente->logradouro = $request->logradouro;
        $paciente->numero = $request->numero;
        $paciente->bairro = $request->bairro;
        $paciente->cidade = $request->cidade;
        $paciente->telefone = $request->telefone ?? null;
        $paciente->user_create = Auth::user()->id;
        $paciente->pr_saude = $request->profissional;
        $paciente->save();

        $info_clinicas = new Info_clinicas([
            'data_coleta' => $request->coleta ?? null,
            'instituicao_origem' => $request->instituicao,
            'status' => $request->acompanhamento,
            'observacoes' => $request->observacoes,
            'sintomas' => $sintomas
        ]);

        $paciente->info_clinicas()->save($info_clinicas);
        $historico = (object) $this->structDate($request, $sintomas, $paciente,'create');
        //Disparando evento para gravar historico
        event(new HistoricoPacienteEvent($historico));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PacienteRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PacienteRequest $request)
    {
        // dd($request->all());
        $sintomas['sintomas'] = $request->fatores;
        data_fill($sintomas, 'contato', $request->contato);
        data_fill($sintomas, 'coleta', $request->coleta ?? '');
        data_fill($sintomas, 'tosse', $request->tosse ?? '');
        data_fill($sintomas, 'febre', $request->febre ?? '');
        data_fill($sintomas, 'garganta', $request->garganta ?? '');
        data_fill($sintomas, 'viagem', $request->viagem ?? '');

        $paciente = Paciente::find($request->id);
        $paciente->cpf = $request->cpf;
        $paciente->nome = $request->nome;
        $paciente->nome_mae = $request->mae;
        $paciente->data_nascimento = $request->nascimento;
        $paciente->sexo = $request->sexo;
        $paciente->logradouro = $request->logradouro;
        $paciente->numero = $request->numero;
        $paciente->bairro = $request->bairro;
        $paciente->cidade = $request->cidade;
        $paciente->telefone = $request->telefone ?? null;
        $paciente->pr_saude = $request->profissional;
        $paciente->save();
      
        $paciente->info_clinicas()->update([
            'data_coleta' => $request->coleta ?? null,
            'instituicao_origem' => $request->instituicao,
            'status' => $request->acompanhamento,
            'observacoes' => $request->observacoes,
            'sintomas' => $sintomas
        ]);
        $historico = (object) $this->structDate($request, $sintomas, $paciente,'update');
        //Disparando evento para gravar historico
        event(new HistoricoPacienteEvent($historico));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        $paciente = Paciente::find($request->id);
        $paciente->delete();
    }

    public function acompanhar($id)
    {
        //
    }
}
