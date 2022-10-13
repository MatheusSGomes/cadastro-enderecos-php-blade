<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests\PessoaRequest;
use App\Models\{
    Pessoa,
    Endereco
};
use Exception;

class PessoaController extends Controller
{
    public function __construct(Pessoa $pessoa)
    {
        $this->model = $pessoa;
    }
    
    /**
     * @OA\Get(
     *     tags={"Pessoas"},
     *     summary="Retorna uma lista de pessoas cadastradas",
     *     description="Retorna um Array com todos as pessoas cadastradas",
     *     path="/pessoa",
     *     @OA\Response(response="200", description="Array com pessoas"),
     *     @OA\Response(response="503", description="JSON com mensagem de que não foi possível pesquisar um determinada pessoa.")
     * )
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
     * @OA\Post(
     *      path="/pessoa",
     *      description="Armazena uma nova pessoa.",
     *      tags={"Pessoas"},
     *      summary="Retorna a pessoa cadastrado",
     *      @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  @OA\Property(property="nome", type="string"),
     *                  @OA\Property(property="sobrenome", type="string"),
     *                  @OA\Property(property="idade", type="integer"),
     *                  @OA\Property(property="login", type="string"),
     *                  @OA\Property(property="senha", type="string"),
     *                  @OA\Property(property="status", type="integer"),
     *                  @OA\Property(property="enderecos",type="object"),
     *                  example={"nome": "José", "sobrenome": "dos Reis", "idade": 27, "login": "jose.login.email", "senha":"senhaDoJosé", "status": 1, "enderecos": {"codigoBairro":4, "nomeRua": "RUA A", "numero":"123", "complemento": "MINHA CASA UM", "cep": "11111-678"}}
     *              ),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Pessoa e endereço cadastrados com sucesso.",
     *      ),
     *      @OA\Response(
     *          response=503,
     *          description="Não foi possível cadastrar a pessoa.",
     *      ),
     * )
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
     * @OA\Get(
     *     tags={"Pessoas"},
     *     summary="Retorna uma pessoa cadastrada",
     *     description="Retorna um JSON com a pessoa pesquisada.",
     *     path="/pessoa/{id}",
     *     @OA\Response(response="200", description="JSON com a pessoa"),
     *     @OA\Response(response="503", description="JSON com mensagem de que não foi possível encontrar uma determinada pessoa.")
     * )
    */
    public function show($id)
    {
        $pessoa = Pessoa::where('codigo_pessoa', $id)->first();
        return response()->json($pessoa, 200);
    }

    /**
     * @OA\Put(
     *      path="/pessoa/{id}",
     *      description="Atualiza uma pessoa",
     *      tags={"Pessoas"},
     *      summary="Retorna a pessoa atualizada.",
     *      @OA\Parameter(
     *          name="request",
     *          in="path",
     *          description="Dados da requisição",
     *          required=true,
     *      ),
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="Id da pessoa que será atualizado.",
     *          required=true,
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Pessoa atualizada com sucesso.",
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Não foi possível encontrar a pessoa.",
     *      ),
     * )
     */
    public function update(Request $request, $id)
    {
        try {
            if ($request->codigo_pessoa) {
                $pessoa = Pessoa::find($id);

                if ($request->nome) {
                    $pessoa->nome = $request->nome;
                }

                if ($request->sobrenome) {
                    $pessoa->sobrenome = $request->sobrenome;
                }

                if ($request->idade) {
                    $pessoa->idade = $request->idade;
                }

                if ($request->login) {
                    $pessoa->login = $request->login;
                }

                if ($request->senha) {
                    $pessoa->senha = $request->senha;
                }

                $pessoa->save();

                if($pessoa === 0) {
                    return response()->json([
                        "mensagem" => "Não foi possível alterar, pois não existe um registro de Bairro no endereço da Pessoa informada.",
                        "status" => 400
                    ], 400);
                }
            }

            if ($request->codigo_endereco) {
                $endereco = Endereco::find($request->codigo_endereco);

                if ($request->cep) {
                    $endereco->cep = $request->cep;
                }
    
                if ($request->codigo_bairro) {
                    $endereco->codigo_bairro = $request->codigo_bairro;
                }
    
                if ($request->complemento) {
                    $endereco->complemento = $request->complemento;
                }
    
                if ($request->nome_rua) {
                    $endereco->nome_rua = $request->nome_rua;
                }
    
                if ($request->numero) {
                    $endereco->numero = $request->numero;
                }
                $endereco->save();
            }

            // if ($request->enderecos) {
                // foreach ($request->enderecos as $endereco) {
                //     Endereco::create([
                //         'codigo_pessoa' => $pessoa->codigo_pessoa, 
                //         'codigo_bairro' => $endereco['codigoBairro'],
                //         'nome_rua' => $endereco['nomeRua'],
                //         'numero' => $endereco['numero'],
                //         'complemento' => $endereco['complemento'],
                //         'cep'  => $endereco['cep']
                //     ]);
                // }
            // }

            return response()->json(Pessoa::all(), 200);
        } catch (\Exception $e) {
            dd($e);
            return response()->json([
                "mensagem" => "Não foi possível alterar a Pessoa.",
                "status" => 503
            ], 503);
        }
    }

    /**
     * @OA\Delete(
     *      path="/pessoa/{id}",
     *      description="Apaga uma pessoa",
     *      tags={"Pessoas"},
     *      summary="Retorna um array vazio.",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="Id da pessoa que será apagada.",
     *          required=true,
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Pessoa apagada com sucesso.",
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Não foi possível encontrar a pessoa.",
     *      ),
     * )
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
