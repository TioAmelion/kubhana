<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use Illuminate\Support\Facades\Auth;
use App\Models\publicacao;
use App\Models\pessoa;
use App\Models\instituicao;
use App\Models\doacao;
use App\Models\doador;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;

class PerfilDoadorController extends Controller
{
    public function index()
    {
        $categorias = Categoria::all();

        //total de publicações
        $totalPubli = publicacao::where('user_id', Auth::user()->id)->count();
        
        //total de doações
        $totalDoacoes = doacao::where('doador_id', Auth::user()->id)->count();

        //listar pessoas que receberam ajuda
        $publicacao = new publicacao;
        $pessoas = $publicacao->listarAjudas(Auth::user()->id);

        $publicacoes = new publicacao;
        // $pub = $publicacoes->showProfile();
        
        return view('admin.includes.perfilDoador', [
            'categorias' => $categorias,
            'totalPubli' => $totalPubli,
            'totalDoacoes' => $totalDoacoes,
            'pessoas' => $pessoas
        ]);
    }

    public function verificarPerfil($id)
    {
        // $dados = instituicao::where('user_id', $id)->first();
        // $dado = pessoa::where('user_id', $id)->first();

        // if ($dados != null) {
        //     return response()->json($dados);
        // } 
        
        // if($dado != null) {
        //     return response()->json($dado);
        // }

        //total de publicações
        $totalPubli = publicacao::where('user_id', $id)->count();
        
        //total de doações do doador
        $perfil = User::find($id);
        // dd($perfil['tipo_perfil']);
        if ($perfil['tipo_perfil'] == "doador") {
            $pessoa = pessoa::where('user_id', $perfil['id']);
            $totalDoacoes = doacao::where('doador_id', $id)->count();
            dd($pessoa);
        } else {
            $totalDoacoes = doacao::where('doador_id', $id)->count();
            dd($totalDoacoes);
        }
        

        // $totalDoacoes = doacao::where('doador_id', $id)->count();

        //listar pessoas que receberam ajuda do doador
        $publicacao = new publicacao;
        $pessoas = $publicacao->listarAjudas($id);

        //listar a quantidade de doação que a instituição recebeu
        $pessoas = $publicacao->listarAjudas($id);

        $publicacoes = new publicacao;
        $pub = $publicacoes->lstPubPerfil($id);
        
        return view('admin.includes.perfilDoador', [
            'categorias' => $categorias,
            'pub' => $pub,
            'totalPubli' => $totalPubli,
            'totalDoacoes' => $totalDoacoes,
            'pessoas' => $pessoas
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
