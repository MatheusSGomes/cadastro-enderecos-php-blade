<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/pessoas', function () {
    return view('pessoas');
})->name('pessoas');

Route::post('/teste', function (Request $request) {
    dd($request->all());
})->name('teste');

use App\Http\Controllers\{
    UfsController,
    MunicipioController,
    BairroController,
    PessoaController
};

Route::resource('/uf', UfsController::class);
Route::resource('/municipio', MunicipioController::class);
Route::resource('/bairro', BairroController::class);
Route::resource('/pessoa', PessoaController::class);