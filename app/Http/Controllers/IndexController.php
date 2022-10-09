<?php

namespace App\Http\Controllers;

use App\Models\{
    Municipio,
    UF,
    Bairro
};
use App\Models\Endereco;
use App\Models\Pessoa;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $ufs = UF::all();
        $municipios = Municipio::all();
        $bairros = Bairro::all();

        return view('index', compact('ufs','bairros', 'municipios'));
    }

    public function store(Request $request)
    {
        $pessoa = new Pessoa;
        $pessoa->nome = $request->input('nome');
        $pessoa->sobrenome = $request->input('sobrenome');
        $pessoa->idade = $request->input('idade');
        $pessoa->login = $request->input('login');
        $pessoa->senha = $request->input('senha');
        $pessoa->status = 1;
        $pessoa->save();

        foreach ($request->enderecos as $end) {            
            $endereco = new Endereco;
            $endereco->codigo_pessoa = $pessoa->codigo_pessoa;
            $endereco->nome_rua = $end['rua'];
            $endereco->numero = $end['numero'];
            $endereco->codigo_bairro = $end['bairro'];
            $endereco->cep = $end['cep'];
            $endereco->complemento = $end['complemento'];
            // $endereco->uf = $end['uf'];
            // $endereco->municipio = $end['municipio'];
            $endereco->save();
        }
        
        return redirect('pessoas')
            ->with('message', 'Pessoa salva com sucesso');
    }
}
