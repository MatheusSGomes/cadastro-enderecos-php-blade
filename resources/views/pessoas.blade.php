@extends('layout.app')
@section('content')
  <h2 class="mt-4">Lista de Pessoas</h2>
    
  <hr />
  <a href="{{ route('index') }}" class="btn btn-primary mb-4">Cadastrar Pessoa</a>

  <ul class="list-group mb-4">
    <li class="list-group-item d-flex justify-content-between align-items-center">
      Pessoa 1
      <div>
        <button type="button" class="btn btn-primary">Editar</button>
        <button type="button" class="btn btn-danger">Apagar</button>
      </div>
    </li>

    <li class="list-group-item d-flex justify-content-between align-items-center">
      Pessoa 2
      <div>
        <button type="button" class="btn btn-primary">Editar</button>
        <button type="button" class="btn btn-danger">Apagar</button>
      </div>
    </li>

    <li class="list-group-item d-flex justify-content-between align-items-center">
      Pessoa 3
      <div>
        <button type="button" class="btn btn-primary">Editar</button>
        <button type="button" class="btn btn-danger">Apagar</button>
      </div>
    </li>
  </ul>
@endsection