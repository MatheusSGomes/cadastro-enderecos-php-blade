<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bairro;
use App\Exceptions\MinhaExcecao;
use Exception;
use App\Http\Requests\BairroRequest;


class BairroController extends Controller
{
    public function __construct(Bairro $bairro)
    {
        $this->model = $bairro;
    }

    /**
     * @OA\Get(
     *     tags={"Bairros"},
     *     summary="Retorna uma lista de bairros cadastrados",
     *     description="Retorna um Array com todos os bairros cadastrados",
     *     path="/bairro",
     *     @OA\Response(response="200", description="Array com bairros"),
     *     @OA\Response(response="503", description="JSON com mensagem de que não foi possível pesquisar um determinado bairro.")
     * )
    */
    public function index(Request $request)
    {
        $busca = $this->model->filter([
            'codigoBairro' => $request->query('codigoBairro'),
            'codigoMunicipio' => $request->query('codigoMunicipio'),
            'nome' => $request->query('nome'),
            'status' =>$request->query('status')
        ]);

        if($request->query() !== [])
            return response()->json($busca, 200);

        return response()->json(Bairro::all(), 200);
    }

    /**
     * @OA\Post(
     *      path="/bairro",
     *      description="Armazena um novo bairro.",
     *      tags={"Bairros"},
     *      summary="Retorna o bairro cadastrado",
     *      @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  @OA\Property(
     *                      property="codigo_municipio",
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
     *              example={"codigo_municipio": 5, "nome": "CENTRO", "status": 1}
     *              ),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Bairro cadastrado com sucesso.",
     *      ),
     *      @OA\Response(
     *          response=503,
     *          description="Não foi possível cadastrar o bairro.",
     *      ),
     * )
     */
    public function store(BairroRequest $request)
    {
        try {
            $bairro = Bairro::create($request->all());
            return response()->json(["mensagem" => "Bairro cadastrado com sucesso."], 200);
        } catch (Exception $e) {
            return response()->json([
                "mensagem" => "Não foi possível cadastrar o bairro.",
                "status" => 503
            ], 503);
        }
    }

    /**
     * @OA\Get(
     *     tags={"Bairros"},
     *     summary="Retorna um bairro cadastrado",
     *     description="Retorna um JSON com o bairro pesquisado.",
     *     path="/bairro/{id}",
     *     @OA\Response(response="200", description="JSON com o bairro"),
     *     @OA\Response(response="503", description="JSON com mensagem de que não foi possível encontrar um determinado bairro.")
     * )
    */
    public function show($id)
    {
        $bairro = Bairro::where('codigo_bairro', $id)->first();
        return response()->json($bairro, 200);
    }

    /**
     * @OA\Put(
     *      path="/bairro/{id}",
     *      description="Atualiza um bairro",
     *      tags={"Bairros"},
     *      summary="Retorna o bairro atualizado.",
     *      @OA\Parameter(
     *          name="request",
     *          in="path",
     *          description="Dados da requisição",
     *          required=true,
     *      ),
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="Id do bairro que será atualizado.",
     *          required=true,
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Bairro atualizado com sucesso.",
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Não foi possível encontrar o bairro.",
     *      ),
     * )
     */
    public function update(Request $request, $id)
    {
        
        Bairro::where('codigo_bairro', $id)->update($request->all());
        return response()->json(Bairro::all(), 200);
    }

    /**
     * @OA\Delete(
     *      path="/bairro/{id}",
     *      description="Apaga um bairro",
     *      tags={"Bairros"},
     *      summary="Retorna um array vazio.",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="Id do bairro que será apagado.",
     *          required=true,
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Bairro apagado com sucesso.",
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Não foi possível encontrar o bairro.",
     *      ),
     * )
     */
    public function destroy($id)
    {
        try {
            $bairro = Bairro::findOrFail($id);
            $bairro->delete();
        } catch(Exception $e) {
            return response()->json(['message' => 'Bairro inexistente.'], 404);
        }
    }
}
