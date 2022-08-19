<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MunicipioController;
use App\Http\Controllers\ProvinciaController;
use App\Http\Controllers\PessoaController;
use App\Http\Controllers\ClassificarPublicacaoController;
use App\Http\Controllers\InstituicaoController;
use App\Http\Controllers\DoadorController;
use App\Http\Controllers\PerfilDoadorController;
use App\Http\Controllers\SolicitacaoControler;
use App\Http\Controllers\DoacaoController;

///////////////// GRUPO DE ROTAS /////////////////////////

Route::group(['middleware' => ['auth']], function(){

    Route::get('/dashboard', function () {
        return view('dashboard');
    });
    
    Route::resource('perfil', 'App\Http\Controllers\PerfilDoadorController');

    Route::get('verificarPerfil/{id}', [PerfilDoadorController::class, 'verificarPerfil']);

    Route::get('/doadores',[DoadorController::class, 'all_doadors']);

    Route::resource('doacao', 'App\Http\Controllers\DoacaoController');

    Route::get('doacoes/{id}', [DoacaoController::class, 'listarDoacoes']);

    Route::resource('publicar', 'App\Http\Controllers\PublicacaoController');

    Route::resource('votar', 'App\Http\Controllers\ClassificarPublicacaoController');

    Route::resource('solicitar', 'App\Http\Controllers\SolicitacaoControler');

    Route::get('solicitantes/{id}', [SolicitacaoControler::class, 'listarSolicitantes']);

    Route::get('verificarVoto', [ClassificarPublicacaoController::class, 'verificarVoto']);

    Route::post('update', [ClassificarPublicacaoController::class, 'update']);

    Route::resource('publicarUser', 'App\Http\Controllers\PublicacaoUserController');
});

Route::get('send-mail', function () {

    $details = [
        'title' => 'Mail from ItSolutionStuff.com',
        'body' => 'This is for testing email using smtp'
    ];
    
    \Mail::to('amelionjorge2012@gmail.com')->send(new \App\Mail\MyTestMail($details));
    
    dd("Email is Sent.");
});

Route::resource('/feed', 'App\Http\Controllers\HomeController');

Route::get('autocomplete', [PessoaController::class, 'autocomplete'])->name('autocomplete');

Route::get('/logout', 'App\Http\Controllers\Auth\AuthenticatedSessionController@destroy');
Route::get('/insitituicoes',[InstituicaoController::class, 'index']);

Route::resource('doador', 'App\Http\Controllers\DoadorController');

Route::get('municipio/{id}', [MunicipioController::class, 'getMunicipio']);

Route::get('provincia/{id}', [ProvinciaController::class, 'getProvincia']);

Route::resource('instituicao', 'App\Http\Controllers\InstituicaoController');

Route::resource('fornecedor', 'App\Http\Controllers\FornecedorController'); 

Route::resource('/', 'App\Http\Controllers\HomeController');

require __DIR__ . '/auth.php';