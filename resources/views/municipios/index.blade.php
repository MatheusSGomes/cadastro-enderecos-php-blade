@extends('layout.app')
@section('content')
  <h2 class="mt-4">Lista de Municípios</h2>

  <hr />
  <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Cadastrar Município
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Cadastre um Município</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form class="" action="{{ route('municipios.store') }}" method="post">
          @csrf
      
          <div class="modal-body row g-3">        
            <div class="col-9">
              <label for="nome" class="form-label">Nome</label>
              <input type="text" class="form-control" id="nome" name="nome">
            </div>

            <div class="col-3">
              <label for="uf" class="form-label">UF</label>
              <select id="uf" name="uf" class="form-select">
                <option selected disabled>Escolha...</option>
                
                @foreach ($ufs as $uf)
                  <option value="{{ $uf->codigo_uf }}">{{ $uf->sigla }}</option>
                @endforeach

              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-primary">Salvar</button>
          </div>
        
        </form>
      </div>
    </div>
  </div>

  <!-- Messages -->
  @if(session()->has('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session()->get('message') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>  
  @endif

  <ul class="list-group mb-4">
    @foreach ($municipios as $municipio)  
      <li class="list-group-item d-flex justify-content-between align-items-center">
        {{ $municipio->nome }}
        <div>
          <a href="{{ route('municipios.edit', $municipio->codigo_municipio) }}" class="btn btn-primary">Editar</a>

          <form 
            action="{{ route('municipios.destroy', $municipio->codigo_municipio) }}" 
            method="post"
            style="display: inline-block;"
          >
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Apagar</button>
          </form>

        </div>
      </li>
    @endforeach
  </ul>
@endsection