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
use App\Http\Controllers\MensagemController;
use App\Http\Controllers\notificacaController;
use App\Models\mensagem;
use Illuminate\Support\Facades\Auth;

///////////////// GRUPO DE ROTAS /////////////////////////

Route::group(['middleware' => ['auth']], function(){

    Route::get('/dashboard', function () {
        return view('dashboard');
    });
    
    Route::resource('notificacoes', 'App\Http\Controllers\notificacaController');

    Route::resource('perfil', 'App\Http\Controllers\PerfilDoadorController');

    Route::get('verificarPerfil/{id}', [PerfilDoadorController::class, 'verificarPerfil']);

    Route::get('mensagens', [MensagemController::class, 'index']);

    Route::get('mensagens/{id}', [MensagemController::class, 'listarMensagens']);

    Route::post('enviar-mensagem', [MensagemController::class, 'store']);

    Route::get('/doadores', [DoadorController::class, 'all_doadors']);

    Route::resource('doacao', 'App\Http\Controllers\DoacaoController');

    Route::put('doacao/{id}', [DoadorController::class, 'update'])->name('doacao-doador');

    Route::get('mapa', [DoacaoController::class, 'mapa']);

    Route::get('doacoes/{id}', [DoacaoController::class, 'listarDoacoes']);

    Route::get('doacoes-instituicao/{id}', [DoacaoController::class, 'lstDoacoes'])->name('doacoes-instituicao');

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