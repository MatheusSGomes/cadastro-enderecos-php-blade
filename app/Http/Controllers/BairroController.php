<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bairro;
use Exception;
use App\Http\Requests\BairroRequest;
use App\Models\UF;

class BairroController extends Controller
{
    public function __construct(Bairro $bairro)
    {
        $this->model = $bairro;
    }

    public function index(Request $request)
    {
        $bairros = $this->model->all();
        $ufs = UF::all();
        return view('bairros.index', compact('bairros', 'ufs'));
    }

    
    public function store(BairroRequest $request)
    {
        dd($request->all());
        $bairro = Bairro::create([
            'codigo_municipio' => $request->input('municipio'),
            'nome' => $request->input('nome'),
        ]);

        return redirect('bairros');
    }

    public function show($id)
    {
        // $bairro = Bairro::where('codigo_bairro', $id)->first();
        // return response()->json($bairro, 200);
    }

    public function update(Request $request, $id)
    {
        // try {
        //     $bairro = Bairro::where('codigo_bairro', $id)->update($request->all());
        //     if($bairro === 0)
        //         return response()->json([
        //             "mensagem" => "Não foi possível alterar, pois não existe um registro de Bairro com o mesmo nome para o Município informado.",
        //             "status" => 400
        //         ], 400);
        //     return response()->json(Bairro::all(), 200);
        // } catch (\Exception $e) {
        //     return response()->json([
        //         "mensagem" => "Não foi possível alterar o Bairro.",
        //         "status" => 503
        //     ], 503);
        // }
    }

    public function destroy($id)
    {
        // try {
        //     $bairro = Bairro::findOrFail($id);
        //     $bairro->delete();
        // } catch(Exception $e) {
        //     return response()->json(['message' => 'Bairro inexistente.'], 404);
        // }
    }
}
