<?php

namespace App\Http\Controllers;

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
     *     tags={"\uf"},
     *     summary="Returns a list of UFs",
     *     description="Returns a object of UFs",
     *     path="/uf",
     *     @OA\Response(response="200", description="A list with UFs")
     * )
    */
    public function index(Request $request)
    {
        $busca = $this->model->filter([
            'codigoUF' => $request->query('codigoUF'),
            'sigla' => $request->query('sigla'),
            'nome' => $request->query('nome'),
            'status' => $request->query('status'),
        ]);

        if($request->query() !== [])
            return response()->json($busca, 200);

        return response()->json(UF::all(), 200);
    }

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

    public function show($id)
    {
        $uf = UF::where('codigo_uf', $id)->first();
        return response()->json($uf, 200);
    }

    public function update(Request $request, $id)
    {
        UF::where('codigo_uf', $id)->update($request->all());
        return response()->json(Uf::all(), 200);
    }

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
