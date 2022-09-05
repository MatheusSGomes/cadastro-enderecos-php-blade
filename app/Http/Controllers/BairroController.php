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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bairro = Bairro::where('codigo_bairro', $id)->first();
        return response()->json($bairro, 200);
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
        
        Bairro::where('codigo_bairro', $id)->update($request->all());
        return response()->json(Bairro::all(), 200);
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
            $bairro = Bairro::findOrFail($id);
            $bairro->delete();
        } catch(Exception $e) {
            return response()->json(['message' => 'Bairro inexistente.'], 404);
        }
    }
}
