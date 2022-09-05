<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UfRequest $request)
    {

        try {
            $ufs = UF::create($request->all());
        } catch (Exception $e) {
            return response()->json([
                "mensagem" => "Não foi possível cadastrar a UF.",
                "status" => 503
            ], 503);
        }

        return response()->json(["mensagem" => "UF cadastrada com sucesso."], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $uf = UF::where('codigo_uf', $id)->first();
        return response()->json($uf, 200);
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
        UF::where('codigo_uf', $id)->update($request->all());
        return response()->json(Uf::all(), 200);
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
            $uf = UF::findOrFail($id);
            $uf->delete();
        } catch(Exception $e) {
            return response()->json(['message' => 'UF inexistente.'], 404);
        }
    }
}
