<?php

namespace App\Http\Controllers;

use App\Models\{
    Municipio,
    UF,
    Bairro
};

class IndexController extends Controller
{
    public function index()
    {
        $ufs = UF::all();
        $municipios = Municipio::all();
        $bairros = Bairro::all();

        return view('index', compact('ufs','bairros', 'municipios'));
    }
}
