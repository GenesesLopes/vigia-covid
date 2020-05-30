@extends('layouts.login')

@section('css')
<link rel="stylesheet" href="{{asset('Adminlte/plugins/sweetalert2/sweetalert2.min.css')}}">
@endsection

@section('content')
<div class="login-logo">
  <a href=#"><b>Vigia-Covid</b></a>
</div>
<!-- /.login-logo -->
<div class="card">
  <div class="card-body login-card-body">
    <p class="login-box-msg">Insira suas credencias para iniciar a sessão</p>

    <form id="form-login">
      <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="cpf" id="cpf" name="cpf" required>
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-ad"></span>
          </div>
        </div>
        <div class="invalid-feedback cpf">
          Login inválido
        </div>
      </div>
      <div class="input-group mb-3">
        <input type="password" class="form-control" placeholder="Senha" id="senha" name="senha" required>
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-lock"></span>
          </div>
        </div>
        <div class="invalid-feedback senha">
          Senha Invalida.
        </div>
      </div>
      <div class="row">
        <div class="col-8">
          <div class="icheck-primary">
            <input type="checkbox" id="remember">
            <label for="remember">
              Lembrar-me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-4">
          <button type="submit" class="btn btn-outline-primary btn-block">
            <div id="spinner" hidden>
              <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
              Aguarde...
            </div>
            <div id="texto">
            Entrar
            </div>
            
          </button>
        </div>
        <!-- /.col -->
      </div>
    </form>

  </div>
  <!-- /.login-card-body -->
</div>
@section('script')
<script src="{{ asset('Adminlte/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
<script src="{{ asset('Adminlte/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('js/login/index.js') }}"></script>
@endsection
@endsection