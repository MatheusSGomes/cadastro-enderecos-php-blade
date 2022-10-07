@extends('layout.app')
@section('content')

  {{-- dd($bairro) --}}
  <h2 class="mt-4">Editar Município</h2>
  <hr />

  <form action="{{ route('bairros.update', $bairro->codigo_bairro) }}" method="POST">
      @csrf
      @method('PUT')
  
      <div class="row g-3">
        <div class="col-6">
          <label for="nome" class="form-label">Nome</label>
          <input type="text" class="form-control" id="nome" name="nome" value="{{ $bairro->nome }}">
        </div>
  
        <div class="col-6">
          <label for="municipio" class="form-label">Município</label>
          <select id="municipio" name="municipio" class="form-select">
            <option disabled>Escolha...</option>
            @foreach ($municipios as $municipio)
              @if ($bairro->municipio->codigo_municipio == $municipio->codigo_municipio)
                <option selected value="{{ $municipio->codigo_municipio }}">{{ $municipio->nome }}</option>
              @else
                <option value="{{ $municipio->codigo_municipio }}">{{ $municipio->nome }}</option>
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