<?php

namespace App\Http\Controllers;

use App\Models\{
    Municipio,
    UF,
    Bairro
};
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $ufs = UF::all();
        $municipios = Municipio::all();
        $bairros = Bairro::all();

        return view('index', compact('ufs','bairros', 'municipios'));
    }

    public function store(Request $request)
    {
        // dd($_POST);
        dd($request);

        // $request->input('nome');
        // $request->input('sobrenome');
        // $request->input('idade');
        // $request->input('login');
        // $request->input('senha');
        
        // $request->input('rua');
        // $request->input('numero');
        // $request->input('bairro');
        // $request->input('cep');
        // $request->input('uf');
        // $request->input('municipio');
        // $request->input('complemento');
        
    }
}
