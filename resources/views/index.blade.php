@extends('layout.app')
@section('content')
  <h1 class="mt-4">Cadastro de Endereços</h1>

  <hr />
  
  <h2 class="mb-4">Cadastro de Usuário</h2>

  <!-- Messages -->
  @if(session()->has('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session()->get('message') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>  
  @endif

  <form class="row g-3" method="POST" action="{{ route('pessoas.store') }}">
    @csrf

    <div class="col-md-4">
      <label for="nome" class="form-label">Nome</label>
      <input type="text" class="form-control" id="nome" name="nome">
    </div>

    <div class="col-md-4">
      <label for="sobrenome" class="form-label">Sobrenome</label>
      <input type="text" class="form-control" id="sobrenome" name="sobrenome">
    </div>

    <div class="col-md-4">
      <label for="idade" class="form-label">Idade</label>
      <input type="number" class="form-control" id="idade" name="idade">
    </div>

    <div class="col-md-6">
      <label for="login" class="form-label">Login</label>
      <input type="text" class="form-control" id="login" name="login">
    </div>


    <div class="col-md-6">
      <label for="senha" class="form-label">Senha</label>
      <input type="password" class="form-control" id="senha" name="senha">
    </div>

    

  </form>

  
  <h3 class="mt-4 mb-4">Cadastrar Endereço</h3>

  <hr>

  <div class="row g-3">
    <div class="col-4">
      <label for="rua" class="form-label">Rua</label>
      <input type="text" class="form-control" id="rua" name="rua" />
    </div>

    <div class="col-4">
      <label for="numero" class="form-label">Número</label>
      <input type="text" class="form-control" id="numero" name="numero">
    </div>

    <div class="col-4">
      <label for="bairro" class="form-label">Bairro</label>
      <select id="bairro" name="bairro" class="form-select">
        <option selected disabled>Escolha...</option>
        <@foreach($bairros as $bairro)
          <option value="{{ $bairro->codigo_bairro }}">{{ $bairro->nome }}</option>
        @endforeach
      </select>
    </div>  

    <div class="col-4">
      <label for="cep" class="form-label">CEP</label>
      <input type="text" class="form-control" id="cep" name="cep">
    </div>

    <div class="col-2">
      <label for="uf" class="form-label">UF</label>
      <select id="uf" name="uf" class="form-select">
        <option selected disabled>Escolha...</option>
        @foreach ($ufs as $uf)
          <option value="{{ $uf->codigo_uf }}">{{ $uf->sigla }}</option>
        @endforeach
      </select>
    </div>

    <div class="col-6">
      <label for="municipio" class="form-label">Município</label>
      <select id="municipio" name="municipio" class="form-select">
        <option selected disabled>Escolha...</option>
        @foreach ($municipios as $municipio)
          <option value="{{ $municipio->codigo_municipio }}">{{ $municipio->nome }}</option>
        @endforeach
      </select>
    </div>

    <div class="col-12">
      <label for="complemento" class="form-label">Complemento</label>
      <input type="text" class="form-control" id="complemento" name="complemento">
    </div>

  </div>

  <div class="col-12">
    <button type="submit" class="btn btn-primary">Cadastrar</button>
  </div>

@endsection