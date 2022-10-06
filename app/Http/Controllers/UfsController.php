<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UF;

class UfsController extends Controller
{
    private $model;

    public function __construct(UF $ufs)
    {
        $this->model = $ufs;
    }

    public function index(Request $request)
    {
        $ufs = $this->model->all();
        return view('ufs.index', compact('ufs'));
    }

    public function store(Request $request)
    {
        $ufs = UF::create([
            'nome' => $request->input('nome'),
            'sigla' => $request->input('sigla'),
            'status' => 1
        ]);

        return redirect('ufs')
            ->with('message', 'UF Cadastrada com sucesso');
    }

    public function edit($id)
    {
        $uf = UF::find($id);
        return view('ufs.edit', compact('uf'))
            ->with('message', 'UF Editada com sucesso');
    }

    public function update(Request $request, $id)
    {
        $uf = UF::find($id);
        $uf->sigla = $request->input('sigla');
        $uf->nome = $request->input('nome');
        $uf->save();

        return redirect('ufs')
            ->with('message', "UF {$uf->nome} atualizada com sucesso");
    }

    public function destroy($id)
    {
        $uf = UF::find($id);
        $uf->delete();
        return redirect('ufs')
            ->with('message', "UF {$uf->nome} apagada com sucesso");
    }
}
