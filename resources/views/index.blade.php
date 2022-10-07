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

    {{-- <div class="col-12">
      <button type="submit" class="btn btn-primary">Cadastrar</button>
    </div> --}}

    <div class="col-12">
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Cadastrar
      </button>
    </div>
    
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Cadastrar Endereço</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
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
                  <option selected>Choose...</option>
                  <option>...</option>
                </select>
              </div>  
        
              <div class="col-8">
                <label for="complemento" class="form-label">Complemento</label>
                <input type="text" class="form-control" id="complemento" name="complemento">
              </div>
        
              <div class="col-4">
                <label for="cep" class="form-label">CEP</label>
                <input type="text" class="form-control" id="cep" name="cep">
              </div>
        
        
              <div class="col-6">
                <label for="uf" class="form-label">UF</label>
                <select id="uf" name="uf" class="form-select">
                  <option selected>Choose...</option>
                  <option>...</option>
                </select>
              </div>
        
              <div class="col-6">
                <label for="municipio" class="form-label">Município</label>
                <select id="municipio" name="municipio" class="form-select">
                  <option selected>Choose...</option>
                  <option>...</option>
                </select>
              </div>
      
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-primary">Salvar</button>
          </div>
        </div>
      </div>
      
    </div>
  </form>
@endsection