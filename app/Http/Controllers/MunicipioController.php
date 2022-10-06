<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Municipio;
use App\Http\Requests\MunicipioRequest;
use App\Models\UF;
use Exception;

class MunicipioController extends Controller
{
    private $model;

    public function __construct(Municipio $municipio)
    {
        $this->model = $municipio;
    }

    public function index(Request $request)
    {
        $municipios = $this->model->all();
        $ufs = UF::all();

        return view('municipios.index', compact('municipios', 'ufs'));

        // try {
        //     $busca = $this->model->filter([
        //         'codigoUF' => $request->query('codigoUF'),
        //         'codigoMunicipio' => $request->query('codigoMunicipio'),
        //         'nome' => $request->query('nome'),
        //         'status' => $request->query('status')
        //     ]);
    
        //     if($request->query() !== [])
        //         return response()->json($busca, 200);
    
        //     return response()->json(Municipio::all(), 200);
        // } catch (\Exception $e) {
        //     return response()->json([
        //         "mensagem" => "Não foi possível pesquisar o Município.",
        //         "status" => 503
        //     ], 503);
        // } 
    }

    public function store(Request $request)
    {

        $municipio = Municipio::create([
            'nome' => $request->input('nome'),
            'codigo_uf' => $request->input('uf'),
            'status' => 1
        ]);

        return redirect('municipios')
            ->with('message', 'Município adicionado com sucesso');
    }

    public function show($id)
    {
        $municipio = Municipio::where('codigo_municipio', $id)->first();
        return response()->json($municipio, 200);
    }

    public function update(Request $request, $id)
    {
        // try {
        //     $municipio = Municipio::where('codigo_municipio', $id)->update($request->all());

        //     if($municipio === 0)
        //         return response()->json([
        //             "mensagem" => "Não foi possível alterar, pois não existe um registro de Município com o mesmo nome para a UF informada.",
        //             "status" => 400
        //         ], 400);

        //     return response()->json(Municipio::all(), 200);
        // } catch (\Exception $e) {
        //     return response()->json([
        //         "mensagem" => "Não foi possível alterar o Muncípio.",
        //         "status" => 503
        //     ], 503);
        // }
    }

    public function destroy($id)
    {
        // try {
        //     $municipio = Municipio::findOrFail($id);
        //     $municipio->delete();
        // } catch(Exception $e) {
        //     return response()->json(['message' => 'Município inexistente.'], 404);
        // }
    }
}
