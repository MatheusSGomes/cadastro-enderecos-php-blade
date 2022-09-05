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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $busca = $this->model->filter([
            'codigoUF' => $request->query('codigoUF'),
            'codigoMunicipio' => $request->query('codigoMunicipio'),
            'nome' => $request->query('nome'),
            'status' => $request->query('status')
        ]);

        if($request->query() !== [])
            return response()->json($busca, 200);

        return response()->json(Municipio::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MunicipioRequest $request)
    {
        try {
            $municipio = Municipio::create($request->all());
        } catch (Exception $e) {
            return response()->json([
                "mensagem" => "Não foi possível cadastrar a UF.",
                "status" => 503
            ], 503);
        }
        return response()->json($municipio, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $municipio = Municipio::where('codigo_municipio', $id)->first();
        return response()->json($municipio, 200);
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
        Municipio::where('codigo_municipio', $id)->update($request->all());
        return response()->json(Municipio::all(), 200);
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
            $municipio = Municipio::findOrFail($id);
            $municipio->delete();
        } catch(Exception $e) {
            return response()->json(['message' => 'Município inexistente.'], 404);
        }
    }
}
