<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/pessoas', function () {
    return view('pessoas');
})->name('pessoas');

Route::get('/ufs', function () {
    return view('ufs');
})->name('ufs');

Route::get('/municipios', function () {
    return view('municipios');
})->name('municipios');

Route::get('/bairros', function () {
    return view('bairros');
})->name('bairros');

Route::post('/teste', function (Request $request) {
    dd($request->all());
})->name('teste');

use App\Http\Controllers\{
    UfsController,
    MunicipioController,
    BairroController,
    PessoaController
};

// Route::resource('/uf', UfsController::class);
// Route::resource('/municipio', MunicipioController::class);
// Route::resource('/bairro', BairroController::class);
// Route::resource('/pessoa', PessoaController::class);