<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PessoaRequest;
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pessoas = Pessoa::with(['enderecos'])->get();

        $busca = $this->model->filter([
            'codigoPessoa' => $request->query('codigoPessoa'),
            'login' => $request->query('login'),
            'status' => $request->query('status'),
        ]);

        if($request->query() !== [])
            return response()->json($busca, 200);

        return response()->json($pessoas, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PessoaRequest $request)
    {
        try {
            $pessoa = Pessoa::create($request->all());

            foreach ($request->enderecos as $endereco) {
                Endereco::create([
                    'codigo_pessoa' => $pessoa->codigo_pessoa, 
                    'codigo_bairro' => $endereco['codigoBairro'],
                    'nome_rua' => $endereco['nomeRua'],
                    'numero' => $endereco['numero'],
                    'complemento' => $endereco['complemento'],
                    'cep'  => $endereco['cep']
                ]);
            }
            return response()->json(["mensagem" => "Pessoa cadastrada com sucesso."], 200);
        } catch (Exception $e) {
            return response()->json([
                "mensagem" => "Não foi possível cadastrar a pessoa.",
                "status" => 503
            ], 503);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pessoa = Pessoa::where('codigo_pessoa', $id)->first();
        return response()->json($pessoa, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Pessoa::where('codigo_pessoa', $id)->update($request->all());
        return response()->json(Pessoa::all(), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $pessoa = Pessoa::findOrFail($id);
            $pessoa->delete();
        } catch(Exception $e) {
            return response()->json(['message' => 'Pessoa inexistente.'], 404);
        }
    }
}
