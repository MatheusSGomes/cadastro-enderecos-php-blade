@extends('layout.app')
@section('content')
  <h2 class="mt-4">Lista de UFs</h2>

  <hr />
  <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Cadastrar UF
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Cadastre uma UF</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form class="" action="/teste" method="post">
          @csrf
      
          <div class="modal-body row g-3">        
            <div class="col-9">
              <label for="nome" class="form-label">Nome</label>
              <input type="text" class="form-control" id="nome" name="nome">
            </div>

            <div class="col-3">
              <label for="sigla" class="form-label">Sigla</label>
              <input type="text" class="form-control" id="sigla" name="sigla">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Salvar</button>
          </div>
        
        </form>
      </div>
    </div>
  </div>

  <ul class="list-group mb-4">
    <li class="list-group-item d-flex justify-content-between align-items-center">
      UF 1
      <div>
        <button type="button" class="btn btn-primary">Editar</button>
        <button type="button" class="btn btn-danger">Apagar</button>
      </div>
    </li>

    <li class="list-group-item d-flex justify-content-between align-items-center">
      UF 2
      <div>
        <button type="button" class="btn btn-primary">Editar</button>
        <button type="button" class="btn btn-danger">Apagar</button>
      </div>
    </li>

    <li class="list-group-item d-flex justify-content-between align-items-center">
      UF 3
      <div>
        <button type="button" class="btn btn-primary">Editar</button>
        <button type="button" class="btn btn-danger">Apagar</button>
      </div>
    </li>
  </ul>
@endsection