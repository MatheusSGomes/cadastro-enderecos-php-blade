<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    UfsController,
    MunicipioController,
    BairroController,
    PessoaController
};

Route::apiResource('/uf', UfsController::class);
Route::apiResource('/municipio', MunicipioController::class);
Route::apiResource('/bairro', BairroController::class);
Route::apiResource('/pessoa', PessoaController::class);