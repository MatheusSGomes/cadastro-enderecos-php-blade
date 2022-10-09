<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    Bairro,
    Pessoa,
    Endereco,
    Municipio,
    UF
};

class PessoaController extends Controller
{
    public function __construct(Pessoa $pessoa)
    {
        $this->model = $pessoa;
    }

    public function index(Request $request)
    {
        $pessoas = Pessoa::all();
        return view('pessoas.index', compact('pessoas'));
    }

    public function store(Request $request) { }

    public function show($id) { }

    public function edit($id)
    {
        $pessoa = Pessoa::with('enderecos')->find($id);
        $data = [
            'Bairros' => Bairro::all(),
            'UFs' => UF::all(),
            'Municipios' => Municipio::all(),
        ];
        return view('pessoas.edit', compact('pessoa', 'data'));
    }
    
    public function update(Request $request, $id)
    {
        $pessoa = Pessoa::find($id);
        $pessoa->nome = $request->input('nome');
        $pessoa->sobrenome = $request->input('sobrenome');
        $pessoa->idade = $request->input('idade');
        $pessoa->login = $request->input('login');

        if($request->input('senha')) {
            $pessoa->senha = $request->input('senha');
        }

        foreach ($request->enderecos as $key => $end) {            
            $endereco = $pessoa->enderecos[$key];
            $endereco->nome_rua = $end['rua'];
            $endereco->numero = $end['numero'];
            $endereco->codigo_bairro = $end['bairro'];
            $endereco->cep = $end['cep'];
            $endereco->complemento = $end['complemento'];
            // $endereco->uf = $end['uf'];
            // $endereco->municipio = $end['municipio'];
            $endereco->save();
        }

        $pessoa->save();
        return redirect('pessoas')
            ->with('message', 'Pessoa atualizada com sucesso');
    }

    public function destroy($id)
    {
        $pessoa = Pessoa::find($id);
        $pessoa->delete();
        return redirect('pessoas')
            ->with('message', 'Pessoa apagada com sucesso');
    }
}
