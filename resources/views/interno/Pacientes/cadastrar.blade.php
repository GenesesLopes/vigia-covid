@extends('layouts.home')
@section('css')
<link rel="stylesheet" href="{{asset('Adminlte/plugins/sweetalert2/sweetalert2.min.css')}}">
<link rel="stylesheet" href="{{asset('Adminlte/plugins/datepicker/css/bootstrap-datepicker.min.css')}}">
@endsection
@section('content')
<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 mt-2">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title"><strong>Formulário de paciêntes</strong></h2>
                        <br />
                        <h6>Campo Obrigatório&nbsp;<span class="text-red"><strong>*</strong></span></h6>
                    </div>
                    <form role="form">
                        <div class="card-body">
                            <ul class="nav nav-tabs nav-justified" id="tab-info" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pessoais-tab" data-toggle="pill" role="tab" aria-controls="pessoais" aria-selected="false">
                                        Informações Pessoais
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="clinicas-tab" data-toggle="pill" role="tab" aria-controls="clinicas" aria-selected="true">
                                        Informações Clinicas
                                    </a>
                                </li>
                            </ul>
                            <br />
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="pessoais" role="tabpanel" aria-labelledby="pessoais-tab">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="cpf">
                                                    CPF
                                                    <span class="text-red"><strong>*</strong></span>
                                                </label>
                                                <input type="text" class="form-control required" id="cpf" name="cpf" placeholder="Ex.: 111.111.111-11">
                                                <div class="invalid-feedback">
                                                    Cpf inválido
                                                </div>
                                                <div class="valid-feedback">
                                                    Válido
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="nome">
                                                    Nome Completo
                                                    <span class="text-red"><strong>*</strong></span>
                                                </label>
                                                <input type="text" class="form-control required" id="nome" name="nome" placeholder="Digite o nome completo">
                                                <div class="invalid-feedback">
                                                    Nome inválido
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="mae">
                                                    Nome da mãe
                                                    <span class="text-red"><strong>*</strong></span>
                                                </label>
                                                <input type="text" class="form-control required" id="mae" name="mae" placeholder="Digite o nome da mãe">
                                                <div class="invalid-feedback">
                                                    Nome inválido
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="nascimento">
                                                    Data de Nascimento
                                                    <span class="text-red"><strong>*</strong></span>
                                                </label>
                                                <input type="text" class="form-control required" id="nascimento" name="nascimento" im-insert="false">
                                                <div class="invalid-feedback">
                                                    Data inválida
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label>Sexo <span class="text-red"><strong>*</strong></span> </label>
                                            <div class="form-group clearfix">
                                                <div class="icheck-primary d-inline">
                                                    <input type="radio" id="masculino" name="sexo" value="m" checked>
                                                    <label for="masculino">
                                                        Masculino
                                                    </label>
                                                </div>
                                                <div class="icheck-primary d-inline">
                                                    <input type="radio" id="feminino" name="sexo" value="f">
                                                    <label for="feminino">
                                                        Feminino
                                                    </label>
                                                </div>
                                                <div class="icheck-primary d-inline">
                                                    <input type="radio" id="ignorado" name="sexo" value="i">
                                                    <label for="ignorado">
                                                        Ignorado
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="form-group">
                                                <label for="logradouro">
                                                    Logradouro
                                                    <span class="text-red"><strong>*</strong></span>
                                                </label>
                                                <input type="text" class="form-control required" id="logradouro" name="logradouro" placeholder="Rua A ...">
                                                <div class="invalid-feedback">
                                                    Logradouro inválida
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="numero">Nº</label>
                                                <input type="number" min="0" class="form-control" id="numero" name="numero" placeholder="10">
                                                <div class="invalid-feedback">
                                                    Número inválida
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="bairro">
                                                    Bairro
                                                    <span class="text-red"><strong>*</strong></span>
                                                </label>
                                                <input type="text" class="form-control required" id="bairro" name="bairro" placeholder="Bairro A">
                                                <div class="invalid-feedback">
                                                    Bairro inválida
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="cidade">
                                                    Cidade
                                                    <span class="text-red"><strong>*</strong></span>
                                                </label>
                                                <input type="text" class="form-control required" id="cidade" name="cidade" placeholder="Cidade A">
                                                <div class="invalid-feedback">
                                                    Cidade inválida
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="telefone">Telefone</label>
                                                <input type="text" class="form-control" id="telefone" name="telefone" placeholder="(99) 99999-9999">
                                                <div class="invalid-feedback">
                                                    Telefone inválida
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <label>Profissional da Saúde <span class="text-red"><strong>*</strong></span></label>
                                            <div class="form-group clearfix">
                                                <div class="icheck-primary d-inline">
                                                    <input type="radio" id="profissional_nao" name="profissional" value="false" checked>
                                                    <label for="profissional_nao">
                                                        Não
                                                    </label>
                                                </div>
                                                <div class="icheck-primary d-inline">
                                                    <input type="radio" id="profissional_sim" name="profissional" value="true">
                                                    <label for="profissional_sim">
                                                        Sim
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="tab-pane fade" id="clinicas" role="tabpanel" aria-labelledby="clinicas-tab">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Coleta indicada/realizada?</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <input type="checkbox" id="ck_coleta" name="ck_coleta">
                                                        </span>
                                                    </div>
                                                    <input type="text" id="coleta" name="coleta" role="datapicker" disabled class="form-control">
                                                    <div class="invalid-feedback">
                                                        Data inválida
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="instituicao">
                                                    Intituição de Origem
                                                    <span class="text-red"><strong>*</strong></span>
                                                </label>
                                                <input type="text" class="form-control required" id="instituicao" name="instituicao" placeholder="Posto de saúde ou hospital onde o paciente foi atendido pela primeira vez" />
                                                <div class="invalid-feedback">
                                                    Instituição inválida
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Tosse</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <input type="checkbox" id="ck_tosse" name="ck_tosse">
                                                        </span>
                                                    </div>
                                                    <input type="text" id="tosse" role="datapicker" name="tosse" disabled class="form-control">
                                                    <div class="invalid-feedback">
                                                        Data inválida
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Febre</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <input type="checkbox" id="ck_febre" name="ck_febre">
                                                        </span>
                                                    </div>
                                                    <input type="text" id="febre" role="datapicker" name="febre" disabled class="form-control">
                                                    <div class="invalid-feedback">
                                                        Data inválida
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Dor de garganta</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <input type="checkbox" id="ck_garganta" name="ck_garganta">
                                                        </span>
                                                    </div>
                                                    <input type="text" id="garganta" role="datapicker" name="garganta" disabled class="form-control">
                                                    <div class="invalid-feedback">
                                                        Data inválida
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Viagem nos últimos 14 dias</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <input type="checkbox" id="ck_viagem" name="ck_viagem">
                                                        </span>
                                                    </div>
                                                    <input type="text" id="viagem" name="viagem" disabled placeholder="Para onde?" class="form-control">
                                                    <div class="invalid-feedback">
                                                        Viagem inválida
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Contato com caso suspeito ou confirmado ? <span class="text-red"><strong>*</strong></span></label>
                                            <div class="form-group clearfix">
                                                <div class="icheck-primary d-inline">
                                                    <input type="radio" id="contato_nao" name="contato" value="false" checked>
                                                    <label for="contato_nao">
                                                        Não
                                                    </label>
                                                </div>
                                                <div class="icheck-primary d-inline">
                                                    <input type="radio" id="contato_sim" name="contato" value="true">
                                                    <label for="contato_sim">
                                                        Sim
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <h5>Fatores de risco</h5>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <ul>
                                                    <li>
                                                        <div class="icheck-primary">
                                                            <input type="checkbox" id="idade-65" name="fatores[]" value="Idade maior ou igual a 65 anos">
                                                            <label for="idade-65">
                                                                1: Idade maior ou igual a 65 anos
                                                            </label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="icheck-primary">
                                                            <input type="checkbox" id="doenca-pumonar" name="fatores[]" value="Doença Pulmonar Obstrutiva Crônica">
                                                            <label for="doenca-pumonar">
                                                                2: Doença Pulmonar Obstrutiva Crônica
                                                            </label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="icheck-primary">
                                                            <input type="checkbox" id="doenca-cerebrovascular" name="fatores[]" value="Doença Cerebrovascular">
                                                            <label for="doenca-cerebrovascular">
                                                                3: Doença Cerebrovascular
                                                            </label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="icheck-primary">
                                                            <input type="checkbox" id="cardiopatias" name="fatores[]" value="Cardiopatias, incluindo hipertensão arterial severa">
                                                            <label for="cardiopatias">
                                                                4: Cardiopatias, incluindo hipertensão arterial severa
                                                            </label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="icheck-primary">
                                                            <input type="checkbox" id="diabetes" name="fatores[]" value="Diabetes insulino-dependente">
                                                            <label for="diabetes">
                                                                5: Diabetes insulino-dependente
                                                            </label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="icheck-primary">
                                                            <input type="checkbox" id="doenca-renal" name="fatores[]" value="Doença renal crônica">
                                                            <label for="doenca-renal">
                                                                6: Doença renal crônica
                                                            </label>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <li><strong>7: Imunossuprimidos</strong>
                                                    <ul>
                                                        <li>
                                                            <div class="icheck-primary">
                                                                <input type="checkbox" id="leucemia" name="fatores[]" value="Leucemia ou Linfoma">
                                                                <label for="leucemia">
                                                                    7.1: Leucemia ou Linfoma
                                                                </label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="icheck-primary">
                                                                <input type="checkbox" id="hiv" name="fatores[]" value="HIV com CD4 < 350">
                                                                <label for="hiv">
                                                                    7.2: HIV com CD4 < 350 </label> </div> </li> <li>
                                                                        <div class="icheck-primary">
                                                                            <input type="checkbox" id="transplantados" name="fatores[]" value="Transplantados">
                                                                            <label for="transplantados">
                                                                                7.3: Transplantados </label>
                                                                        </div>
                                                        </li>
                                                        <li>
                                                            <div class="icheck-primary">
                                                                <input type="checkbox" id="quimioterapia" name="fatores[]" value="Quimioterapia nos últimos 30 dias">
                                                                <label for="quimioterapia">
                                                                    7.4: Quimioterapia nos últimos 30 dias
                                                                </label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="icheck-primary">
                                                                <input type="checkbox" id="corticoides" name="fatores[]" value="Uso de corticóides por mais de 15 dias
                                                                        (Predinisona, Hidrocortisona, Metilpredinisolona ou
                                                                        Dexametasona)">
                                                                <label for="corticoides">
                                                                    7.5: Uso de corticóides por mais de 15 dias
                                                                    (Predinisona, Hidrocortisona, Metilpredinisolona ou
                                                                    Dexametasona)
                                                                </label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="icheck-primary">
                                                                <input type="checkbox" id="doencas-autoimunes" name="fatores[]" value="Doenças autoimunes (Lupus, Artrite reumatóide e
                                                                        outras)">
                                                                <label for="doencas-autoimunes">
                                                                    7.6: Doenças autoimunes (Lupus, Artrite reumatóide e
                                                                    outras)
                                                                </label>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <ul>
                                                    <li>
                                                        <div class="icheck-primary">
                                                            <input type="checkbox" id="gestantes" name="fatores[]" value="Gestantes">
                                                            <label for="gestantes">
                                                                8: Gestante
                                                            </label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="icheck-primary">
                                                            <input type="checkbox" id="obesidade" name="fatores[]" value="Obesidade">
                                                            <label for="obesidade">
                                                                9: Obesidade
                                                            </label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="icheck-primary">
                                                            <input type="checkbox" id="comorbidade" name="fatores[]" value="Uma ou mais comorbidade">
                                                            <label for="comorbidade">
                                                                10: Uma ou mais comorbidade
                                                            </label>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Acompanhamento</label>
                                            <div class="form-group clearfix">
                                                <div class="icheck-primary d-inline">
                                                    <input type="radio" id="acompanhamento_nao" name="acompanhamento" value="false" checked>
                                                    <label for="acompanhamento_nao">
                                                        Não
                                                    </label>
                                                </div>
                                                <div class="icheck-primary d-inline">
                                                    <input type="radio" id="acompanhamento_sim" name="acompanhamento" value="true">
                                                    <label for="acompanhamento_sim">
                                                        Sim
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Data de Cadasto</label>
                                                <input type="text" id="data_cadastro" class="form-control" value="{{date('d/m/Y',strtotime('now'))}}" disabled />
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Responsável pelo cadastro</label>
                                                <input type="text" id="responsavel" class="form-control" value="usuário logado" disabled />
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="observacoes">Observações</label>
                                                <textarea class="form-control" id="observacoes" name="observacoes" rows="3" placeholder="Descrever Observações do paciênte "></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-default reset">Limpar</button>
                            <button type="submit" class="btn btn-success float-right prox">Próximo</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@section('script')
<script src="{{ asset('Adminlte/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
<script src="{{asset('Adminlte/plugins/sweetalert2/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('Adminlte/plugins/datepicker/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('Adminlte/plugins/datepicker/locales/bootstrap-datepicker.pt-BR.min.js')}}"></script>
<script src="{{asset('js/pacientes/index.js')}}"></script>
@endsection
@endsection