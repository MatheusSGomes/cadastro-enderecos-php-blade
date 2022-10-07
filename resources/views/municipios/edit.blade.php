@extends('layout.app')
@section('content')

  {{-- dd($municipio) --}}
  <h2 class="mt-4">Editar Município</h2>
  <hr />

  <form action="{{ route('municipios.update', $municipio->codigo_municipio) }}" method="POST">
      @csrf
      @method('PUT')
  
      <div class="row g-3">
        <div class="col-8">
          <label for="nome" class="form-label">Nome</label>
          <input type="text" class="form-control" id="nome" name="nome" value="{{ $municipio->nome }}">
        </div>
  
        <div class="col-4">
          <label for="uf" class="form-label">UF</label>
          <select id="uf" name="uf" class="form-select">
            <option disabled>Escolha...</option>
            @foreach ($ufs as $uf)
              @if ($municipio->uf->codigo_uf == $uf->codigo_uf)
                <option selected value="{{ $uf->codigo_uf }}">{{ $uf->sigla }}</option>
              @else
                <option value="{{ $uf->codigo_uf }}">{{ $uf->sigla }}</option>
              @endif
            @endforeach
          </select>
        </div>

        <div class="col-12">
          <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
      </div>
  </form>
@endsection