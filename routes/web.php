<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    UfsController,
    BairroController,
    IndexController,
    MunicipioController,
    PessoaController
};

Route::resource('/ufs', UfsController::class);
Route::resource('/municipios', MunicipioController::class);
Route::resource('/bairros', BairroController::class);
Route::resource('/pessoas', PessoaController::class);
Route::get('/', [IndexController::class, 'index'])->name('index');
Route::post('/', [IndexController::class, 'store'])->name('index.store');


Route::post('/teste', function (Request $request) {
    dd($request->all());
})->name('teste');


// Route::resource('/uf', UfsController::class);
// Route::resource('/municipio', MunicipioController::class);
// Route::resource('/bairro', BairroController::class);
// Route::resource('/pessoa', PessoaController::class);