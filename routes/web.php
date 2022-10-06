<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    UfsController,
    BairroController,
    MunicipioController,
    PessoaController
};

Route::resource('/ufs', UfsController::class);
Route::resource('/bairros', BairroController::class);
Route::resource('/municipios', MunicipioController::class);

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/pessoas', function () {
    return view('pessoas');
})->name('pessoas');



Route::post('/teste', function (Request $request) {
    dd($request->all());
})->name('teste');



// Route::resource('/uf', UfsController::class);
// Route::resource('/municipio', MunicipioController::class);
// Route::resource('/bairro', BairroController::class);
// Route::resource('/pessoa', PessoaController::class);