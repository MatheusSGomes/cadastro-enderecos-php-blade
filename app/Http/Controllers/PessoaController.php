<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    Pessoa,
    Endereco
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

    public function store(Request $request)
    {
        $pessoa = new Pessoa;
        $pessoa->nome = $request->input('nome');
        $pessoa->sobrenome = $request->input('sobrenome');
        $pessoa->idade = $request->input('idade');
        $pessoa->login = $request->input('login');
        $pessoa->senha = $request->input('senha');
        $pessoa->status = 1;

        // ENDEREÇOS LOOP
        $endereco = new Endereco;
        $endereco->codigo_pessoa = $pessoa->codigo_pessoa;
        $endereco->codigo_bairro = $request->input('bairro');
        $endereco->complemento = $request->input('complemento');
        $endereco->cep = $request->input('cep');
        $endereco->uf = $request->input('uf');
        $endereco->municipio = $request->input('municipio');

        return redirect('pessoas')
            ->with('messages', 'Pessoa e endereço cadastrados com sucesso');
    }

    public function show($id)
    {
        
    }
    
    public function update(Request $request, $id)
    {
        
    }

    public function destroy($id)
    {
        
    }
}
