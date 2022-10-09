@extends('layout.app')
@section('content')

  <h1 class="mt-4">Formulário editar pessoa</h1>

  <form class="row g-3 mb-5" method="POST" action="{{ route('pessoas.update', $pessoa->codigo_pessoa) }}">
    @csrf
    @method('PUT')

    <div class="pessoa">
      <div class="row g3">
        <div class="col-md-4">
          <label for="nome" class="form-label">Nome</label>
          <input type="text" class="form-control" id="nome" name="nome" value="{{ $pessoa->nome }}" required>
        </div>
    
        <div class="col-md-4">
          <label for="sobrenome" class="form-label">Sobrenome</label>
          <input type="text" class="form-control" id="sobrenome" name="sobrenome" value={{ $pessoa->sobrenome }} required>
        </div>
    
        <div class="col-md-4">
          <label for="idade" class="form-label">Idade</label>
          <input type="number" class="form-control" id="idade" name="idade" value="{{ $pessoa->idade }}" required>
        </div>
    
        <div class="col-md-6">
          <label for="login" class="form-label">Login</label>
          <input type="text" class="form-control" id="login" name="login" value="{{ $pessoa->login }}" required>
        </div>
        
        <div class="col-md-6">
          <label for="senha" class="form-label">Senha</label>
          <input type="password" class="form-control" id="senha" name="senha" />
        </div>
      </div>
    </div>

    <div class="enderecos" id="enderecos">
      @foreach($pessoa->enderecos as $key => $endereco)
      <div class="endereco">
        <h3 class="mt-4 mb-4">Cadastrar Endereço</h3>
        <hr>
      
        <div class="row g-3">
          <div class="col-4">
            <label for="rua" class="form-label">Rua</label>
            <input type="text" class="form-control" id="rua" name="enderecos[{{ $key }}][rua]" value="{{ $endereco->nome_rua}}">
          </div>
      
          <div class="col-4">
            <label for="numero" class="form-label">Número</label>
            <input type="text" class="form-control" id="numero" name="enderecos[{{ $key }}][numero]" value="{{ $endereco->numero}}">
          </div>
      
          <div class="col-4">
            <label for="bairro" class="form-label">Bairro</label>
            <select id="bairro" class="form-select" name="enderecos[{{ $key }}][bairro]">
            @foreach($data['Bairros'] as $bairro)
              @if($bairro->codigo_bairro == $endereco->bairro->codigo_bairro)
                <option selected value="{{ $bairro->codigo_bairro }}">{{ $bairro->nome }}</option>
              @else
                <option value="{{ $bairro->codigo_bairro }}">{{ $bairro->nome }}</option>
              @endif
            @endforeach
            </select>
          </div>  
      
          <div class="col-4">
            <label for="cep" class="form-label">CEP</label>
            <input type="text" class="form-control" id="cep" name="enderecos[{{ $key }}][cep]" value="{{ $endereco->cep}}">
          </div>
      
          {{--<div class="col-2">
            <label for="uf" class="form-label">UF</label>
            <select id="uf" class="form-select" name="enderecos[{{ $key }}][uf]">
             @foreach ($data['UFs'] as $uf)
              @if ($uf->codigo_uf == $endereco->uf->codigo_uf)
              <option selected value="{{ $uf->codigo_uf }}">{{ $uf->sigla }}</option>
              @else
              <option value="{{ $uf->codigo_uf }}">{{ $uf->sigla }}</option>
              @endif  
            @endforeach 
            </select>
          </div>--}}

          {{--<div class="col-6">
            <label for="municipio" class="form-label">Município</label>
            <select id="municipio" class="form-select" name="enderecos[{{ $key }}][municipio]">
               @foreach ($data['Municipios'] as $municipio)
              @if ($municipio->codigo_municipio == $endereco->municipio->codigo_municipio)
              <option selected value="{{ $municipio->codigo_municipio }}">{{ $municipio->sigla }}</option>
              @else
              <option value="{{ $municipio->codigo_municipio }}">{{ $municipio->sigla }}</option>
              @endif  
            @endforeach 
            </select>
          </div>--}}
      
          <div class="col-8">
            <label for="complemento" class="form-label">Complemento</label>
            <input type="text" class="form-control" id="complemento" name="enderecos[{{ $key }}][complemento]" value="{{ $endereco->complemento}}">
          </div>
        </div>

        <button type="button" class="btn btn-danger mt-2 d-none" id="remover-endereco" onclick="removeEndereco(event)">Remover endereço</button>
      </div>
      @endforeach
    </div>

    <div class="col-12">
      <button type="submit" class="btn btn-primary">Atualizar</button>
    </div>
  </form>
@endsection