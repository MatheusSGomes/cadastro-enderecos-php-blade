<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Municipio;
use App\Http\Requests\MunicipioRequest;

class MunicipioController extends Controller
{
    public function __construct(Municipio $municipio)
    {
        $this->model = $municipio;
    }

    /**
     * @OA\Get(
     *     tags={"Municípios"},
     *     summary="Retorna uma lista de municípios cadastrados",
     *     description="Retorna um Array com todos os municípios cadastrados",
     *     path="/municipio",
     *     @OA\Response(response="200", description="Array com municípios"),
     *     @OA\Response(response="503", description="JSON com mensagem de que não foi possível pesquisar um determinado município.")
     * )
    */
    public function index(Request $request)
    {
        try {
            $busca = $this->model->filter([
                'codigoUF' => $request->query('codigoUF'),
                'codigoMunicipio' => $request->query('codigoMunicipio'),
                'nome' => $request->query('nome'),
                'status' => $request->query('status')
            ]);
    
            if($request->query() !== [])
                return response()->json($busca, 200);
    
            return response()->json(Municipio::all(), 200);
        } catch (\Exception $e) {
            return response()->json([
                "mensagem" => "Não foi possível pesquisar o Município.",
                "status" => 503
            ], 503);
        } 
    }

    /**
     * @OA\Post(
     *      path="/municipio",
     *      description="Armazena um novo Município.",
     *      tags={"Municípios"},
     *      summary="Retorna o município cadastrado",
     *      @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  @OA\Property(
     *                      property="codigo_uf",
     *                      type="integer"
     *                  ),
     *                  @OA\Property(
     *                      property="nome",
     *                      type="string"
     *                  ),
     *                  @OA\Property(
     *                      property="status",
     *                      type="integer"
     *                  ),
     *              example={"codigo_uf": "1", "nome": "TAGUATINGA", "status": 1}
     *              ),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Município cadastrado com sucesso.",
     *      ),
     *      @OA\Response(
     *          response=503,
     *          description="Não foi possível cadastrar o Município.",
     *      ),
     * )
     */
    public function store(MunicipioRequest $request)
    {
        try {
            $municipio = Municipio::create($request->all());
            return response()->json($municipio, 200);
        } catch (Exception $e) {
            return response()->json([
                "mensagem" => "Não foi possível cadastrar o Município.",
                "status" => 503
            ], 503);
        }
    }

    /**
     * @OA\Get(
     *     tags={"Municípios"},
     *     summary="Retorna um município cadastrado",
     *     description="Retorna um JSON com todos o município pesquisado.",
     *     path="/municipio/{id}",
     *     @OA\Response(response="200", description="JSON com o município"),
     *     @OA\Response(response="503", description="JSON com mensagem de que não foi possível encontrar um determinado município.")
     * )
    */
    public function show($id)
    {
        $municipio = Municipio::where('codigo_municipio', $id)->first();
        return response()->json($municipio, 200);
    }

    /**
     * @OA\Put(
     *      path="/municipio/{id}",
     *      description="Atualiza um Município",
     *      tags={"Municípios"},
     *      summary="Retorna um município atualizado.",
     *      @OA\Parameter(
     *          name="request",
     *          in="path",
     *          description="Dados da requisição",
     *          required=true,
     *      ),
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="Id do município que será atualizado.",
     *          required=true,
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Município atualizado com sucesso.",
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Não foi possível encontrar o município.",
     *      ),
     * )
     */
    public function update(Request $request, $id)
    {
        try {
            $municipio = Municipio::where('codigo_municipio', $id)->update($request->all());

            if($municipio === 0)
                return response()->json([
                    "mensagem" => "Não foi possível alterar, pois não existe um registro de Município com o mesmo nome para a UF informada.",
                    "status" => 400
                ], 400);

            return response()->json(Municipio::all(), 200);
        } catch (\Exception $e) {
            return response()->json([
                "mensagem" => "Não foi possível alterar o Muncípio.",
                "status" => 503
            ], 503);
        }
    }

    /**
     * @OA\Delete(
     *      path="/municipio/{id}",
     *      description="Apaga uma município",
     *      tags={"Municípios"},
     *      summary="Retorna um array vazio.",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="Id do município que será apagado.",
     *          required=true,
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Município apagado com sucesso.",
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Não foi possível encontrar o município.",
     *      ),
     * )
     */
    public function destroy($id)
    {
        try {
            $municipio = Municipio::findOrFail($id);
            $municipio->delete();
        } catch(Exception $e) {
            return response()->json(['message' => 'Município inexistente.'], 404);
        }
    }
}
