<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\MunicipioController;
use App\Http\Controllers\ProvinciaController;
use App\Http\Controllers\PublicacaoController;
use App\Http\Controllers\PessoaController;
// use App\Http\Controllers\HomeController;
use App\Http\Controllers\DoacaoController;
use App\Models\publicacao;

Route::resource('/feed', 'App\Http\Controllers\HomeController');

Route::get('autocomplete', [PessoaController::class, 'autocomplete'])->name('autocomplete');

Route::get('/perfil', function () {
    return view('auth/profile');
});

Route::resource('doacao', 'App\Http\Controllers\DoacaoController')->middleware(['auth']);

Route::get('/logout', 'App\Http\Controllers\Auth\AuthenticatedSessionController@destroy');

Route::resource('doador', 'App\Http\Controllers\DoadorController');

Route::resource('publicar', 'App\Http\Controllers\PublicacaoController')->middleware(['auth']);

Route::get('municipio/{id}', [MunicipioController::class, 'getMunicipio']);

Route::get('provincia/{id}', [ProvinciaController::class, 'getProvincia']);

Route::resource('instituicao', 'App\Http\Controllers\InstituicaoController');

Route::resource('fornecedor', 'App\Http\Controllers\FornecedorController'); 

Route::resource('/', 'App\Http\Controllers\HomeController');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
