<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Municipio;
use App\Models\UF;

class MunicipioController extends Controller
{
    private $model;

    public function __construct(Municipio $municipio)
    {
        $this->model = $municipio;
    }

    public function index(Request $request)
    {
        $municipios = $this->model->all();
        $ufs = UF::all();
        return view('municipios.index', compact('municipios', 'ufs'));
    }

    public function store(Request $request)
    {
        Municipio::create([
            'nome' => $request->input('nome'),
            'codigo_uf' => $request->input('uf'),
            'status' => 1
        ]);

        return redirect('municipios')
            ->with('message', 'Município adicionado com sucesso');
    }

    public function edit($id)
    {
        $municipio = Municipio::with('uf')->find($id);
        $ufs = UF::all();
        return view('municipios.edit', compact('municipio', 'ufs'));
    }

    public function update(Request $request, $id)
    {
        $municipio = Municipio::find($id);
        $municipio->nome = $request->input('nome');
        $municipio->codigo_uf = $request->input('uf');
        $municipio->save();
        return redirect('municipios')
            ->with('message', 'Município atualizado com sucesso');
    }

    public function destroy($id)
    {
        $municipio = Municipio::find($id);
        $municipio->delete();
        return redirect('municipios')
            ->with('message', 'Município apagado com sucesso'); 
    }
}
