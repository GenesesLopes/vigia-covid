@extends('layouts.home')
@section('css')
<link rel="stylesheet" href="{{asset('Adminlte/plugins/sweetalert2/sweetalert2.min.css')}}">
<link rel="stylesheet" href="{{asset('Adminlte/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('Adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection
@section('content')
<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 mt-2">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Formulário de Usuários</h2>
                        <br />
                        <h6>Campo Obrigatório&nbsp;<span class="text-red"><strong>*</strong></span></h6>
                        <h6><span class="text-red"><strong>Campos de senha não são obrigatórios em operações de atualização e exclusão!</strong></span></h6>
                        </br>
                        <h6><strong>Para edição de dados, basta digitar o cpf que os campos serão preenchidos automaticamente</strong></h6>
                        
                    </div>
                    <form role="form">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="cpf">
                                            Cpf
                                            <span class="text-red"><strong>*</strong></span>
                                        </label>
                                        <input type="text" class="form-control" required id="cpf" name="cpf" placeholder="Digitar o cpf">
                                        <div class="invalid-feedback cpf">
                                            Cpf inválido
                                        </div>
                                        <div class="valid-feedback cpf">
                                            Válido
                                        </div>
                                        <div class="warning-feedback cpf">
                                            Cpf Existente
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="cpf">Nome Completo
                                            <span class="text-red"><strong>*</strong></span>
                                        </label>
                                        <input type="text" class="form-control" required id="nome" name="nome" placeholder="Digitar o Nome completo">
                                        <div class="invalid-feedback">
                                            Nome Inválido
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        @inject('papeis', 'Spatie\Permission\Models\Role')
                                        <label for="papel">Papel <span class="text-red"><strong>*</strong></span></label>
                                        <select class="form-control select2" required name="papel" id="papel" style="width: 100%;">
                                            @foreach($papeis::all() as $papel)
                                            @if($papel->name === 'adm sys' && Auth::user()->hasRole('adm sys'))
                                            <option value="{{$papel->name}}">{{$papel->name}}</option>
                                            @elseif($papel->name !== 'adm sys')
                                            <option value="{{$papel->name}}">{{$papel->name}}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            Papel Inválido
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="senha">Senha <span class="text-red"><strong>*</strong></span></label>
                                        <input type="password" class="form-control" required id="senha" name="senha" placeholder="Digitar a Senha">
                                        <div class="invalid-feedback senha">
                                            Senha inválida
                                        </div>
                                        <div class="valid-feedback senha">
                                            Válido
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="senha_confirmation">Confirmação de Senha <span class="text-red">
                                            <strong>*</strong></span></label>
                                        <input type="password" required class="form-control" id="senha_confirmation" name="senha_confirmation" placeholder="Digite novamente a senha">
                                        <div class="invalid-feedback senha_confirmation">
                                            Senhas Distintas
                                        </div>
                                        <div class="valid-feedback senha_confirmation">
                                            Senha Válida
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-default reset">Limpar</button>
                            <button type="submit" class="btn btn-success float-right">
                                <div id="spinner" hidden>
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                    Aguarde...
                                </div>
                                <div id="texto">
                                    Salvar
                                </div>
                            </button>
                            <button type="button" hidden id="del" class="btn btn-danger float-right">Excluir</button>
                        </div>
                        <input type="hidden" id="id" name="id" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@section('script')
<script src="{{ asset('Adminlte/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
<script src="{{asset('Adminlte/plugins/sweetalert2/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('Adminlte/plugins/select2/js/select2.full.min.js')}}"></script>
<script src="{{asset('js/users/index.js')}}"></script>
@endsection
@endsection