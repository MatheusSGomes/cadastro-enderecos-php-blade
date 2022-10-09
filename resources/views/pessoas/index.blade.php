@extends('layout.app')
@section('content')
  <h2 class="mt-4">Lista de Pessoas</h2>
    
  <hr />
  <a href="{{ route('index') }}" class="btn btn-primary mb-4">Cadastrar Pessoa</a>

  <!-- Messages -->
  @if(session()->has('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session()->get('message') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>  
  @endif

  <ul class="list-group mb-4">
    @foreach($pessoas as $pessoa)
      <li class="list-group-item d-flex justify-content-between align-items-center">
        {{ $pessoa->nome }}
        <div>
          <a href="{{ route('pessoas.edit', $pessoa->codigo_pessoa) }}" class="btn btn-primary">Editar</a>
          <form 
            action="{{ route('pessoas.destroy', $pessoa->codigo_pessoa) }}" 
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