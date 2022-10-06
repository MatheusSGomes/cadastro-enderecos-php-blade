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

    public function index(Request $request)
    {
        $ufs = UF::all();

        // $busca = $this->model->filter([
        //     'codigoUF' => $request->query('codigoUF'),
        //     'sigla' => $request->query('sigla'),
        //     'nome' => $request->query('nome'),
        //     'status' => $request->query('status'),
        // ]);

        // if($request->query() !== [])
        //     return response()->json($busca, 200);

        return view('ufs', compact('ufs'));
    }

    public function create()
    {
        //
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

    public function edit($id)
    {
        //
    }

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
