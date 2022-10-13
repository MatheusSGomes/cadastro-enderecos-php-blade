<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bairro;
use Exception;
use App\Http\Requests\BairroRequest;
use App\Models\Municipio;
use App\Models\UF;

class BairroController extends Controller
{
    public function __construct(Bairro $bairro)
    {
        $this->model = $bairro;
    }

    public function index(Request $request)
    {
        $bairros = $this->model->all();
        $municipios = Municipio::all();
        return view('bairros.index', compact('bairros', 'municipios'));
    }
    
    public function store(Request $request)
    {
        $bairro = Bairro::create([
            'nome' => $request->input('nome'),
            'codigo_municipio' => $request->input('municipio'),
            'status' => 1
        ]);

        return redirect('bairros');
    }

    public function edit($id)
    {
        $bairro = Bairro::find($id);
        $municipios = Municipio::all();
        return view('bairros.edit', compact('bairro', 'municipios'));
    }

    public function update(Request $request, $id)
    {
        $bairro = Bairro::find($id);

        if ($request->nome) {
            $bairro->nome = $request->input('nome');
        }

        if ($request->municipio) {
            $bairro->codigo_municipio = $request->input('municipio');
        }

        $bairro->save();

        return redirect('bairros')
            ->with('message', 'Bairro editado com sucesso');
    }

    public function destroy($id)
    {
        $bairro = Bairro::find($id);
        $bairro->delete();
        return redirect('bairros')
            ->with('message', 'Bairro excluído com sucesso');
    }
}
