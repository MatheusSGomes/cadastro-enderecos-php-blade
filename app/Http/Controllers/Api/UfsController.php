<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\UF;
use App\Http\Requests\UfRequest;
use Exception;

class UfsController extends Controller
{
    public function __construct(UF $ufs)
    {
        $this->model = $ufs;
    }
    
    /**
     * @OA\Get(
     *     tags={"UFs"},
     *     summary="Retorna uma lista de UFs",
     *     description="Retorna um Array com todos os UFs cadastrados",
     *     path="/uf",
     *     @OA\Response(response="200", description="Array com UFs"),
     *     @OA\Response(response="503", description="JSON com mensagem de que não foi possível pesquisar uma determinada UF")
     * )
    */
    public function index(Request $request)
    {
        try {
            $busca = $this->model->filter([
                'codigoUF' => $request->query('codigoUF'),
                'sigla' => $request->query('sigla'),
                'nome' => $request->query('nome'),
                'status' => $request->query('status'),
            ]);
    
            if($request->query() !== [])
                return response()->json($busca, 200);
    
            return response()->json(UF::all(), 200);
        } catch (Exception $e) {
            return response()->json([
                "mensagem" => "Não foi possível pesquisar a UF.",
                "status" => 503
            ], 503);
        }
    }

    public function create()
    {
        //
    }

    /**
     * @OA\Post(
     *      path="/uf",
     *      description="Armazena uma nova UF",
     *      tags={"UFs"},
     *      summary="Retorna a UF cadastrada",
     *      @OA\Parameter(
     *          name="request",
     *          in="path",
     *          description="Dados da requisição",
     *          required=true,
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="UF cadastrada com sucesso.",
     *      ),
     *      @OA\Response(
     *          response=503,
     *          description="Não foi possível cadastrar a UF.",
     *      ),
     * )
     */
    public function store(UfRequest $request)
    {
        try {
            $ufs = UF::create($request->all());
            return response()->json(["mensagem" => "UF cadastrada com sucesso."], 200);
        } catch (Exception $e) {
            return response()->json([
                "mensagem" => "Não foi possível cadastrar a UF.",
                "status" => 503
            ], 503);
        }
    }

    /**
     * @OA\Get(
     *     tags={"UFs"},
     *     summary="Retorna uma lista de UFs",
     *     description="Retorna um Array com todos os UFs cadastrados",
     *     path="/uf/{id}",
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="id da UF",
     *          required=true,
     *      ),
     *     @OA\Response(response="200", description="Retorna UF em formato JSON"),
     *     @OA\Response(response="503", description="Json com mensagem de que não foi possível encontrar uma determinada UF.")
     * )
    */
    public function show($id)
    {
        $uf = UF::where('codigo_uf', $id)->first();
        return response()->json($uf, 200);
    }

    public function edit($id)
    {
        //
    }

    /**
     * @OA\Put(
     *      path="/uf/{id}",
     *      description="Atualiza uma nova UF",
     *      tags={"UFs"},
     *      summary="Retorna a UF atualizada",
     *      @OA\Parameter(
     *          name="request",
     *          in="path",
     *          description="Dados da requisição",
     *          required=true,
     *      ),
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="Id da UF que será atualizada.",
     *          required=true,
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="UF atualizada com sucesso.",
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Não foi possível alterar, pois não existe um registro com a UF cadastrada.",
     *      ),
     *      @OA\Response(
     *          response=503,
     *          description="Não foi possível alterar a UF.",
     *      ),
     * )
     */
    public function update(Request $request, $id)
    {
        try{
            $uf = UF::where('codigo_uf', $id)->update($request->all());
            if($uf === 0)
                return response()->json([
                    "mensagem" => "Não foi possível alterar, pois não existe um registro com a UF cadastrada.",
                    "status" => 400
                ], 400);
            return response()->json(Uf::all(), 200);
        } catch(Exception $e) {
            return response()->json([
                "mensagem" => "Não foi possível alterar a UF.",
                "status" => 503
            ], 503);
        }
    }

    /**
     * @OA\Delete(
     *      path="/uf/{id}",
     *      description="Apaga uma nova UF",
     *      tags={"UFs"},
     *      summary="Retorna um array vazio.",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="Id da UF que será apagada.",
     *          required=true,
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="UF apagada com sucesso.",
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Não foi possível encontrar a UF.",
     *      ),
     * )
     */
    public function destroy($id)
    {
        try {
            $uf = UF::findOrFail($id);
            $uf->delete();
        } catch(Exception $e) {
            return response()->json(['message' => 'UF inexistente.'], 404);
        }
    }
}
