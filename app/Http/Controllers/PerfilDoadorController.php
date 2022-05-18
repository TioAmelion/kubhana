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
        $nome = Auth::user()->name;
        $categorias = Categoria::all();

        //total de publicações
        $totalPubli = publicacao::where('user_id', Auth::user()->id)->count();
        
        //total de doações
        $totalDoacoes = doacao::where('doador_id', Auth::user()->id)->count();

        //listar pessoas que receberam ajuda
        $publicacao = new publicacao;
        $pessoas = $publicacao->listarAjudas(Auth::user()->id);
        // dd($pessoas);

        $publicacoes = new publicacao;
        $pub = $publicacoes->showProfile();
        
        return view('admin.includes.perfilDoador', [
            'categorias' => $categorias,
            'nome' => $nome,
            'pub' => $pub,
            'totalPubli' => $totalPubli,
            'totalDoacoes' => $totalDoacoes,
            'pessoas' => $pessoas
        ]);
    }

    public function verificarPerfil($id)
    {
        $dados = instituicao::where('user_id', $id)->first();
        $dado = pessoa::where('user_id', $id)->first();

        if ($dados != null) {
            return response()->json($dados);
        } 
        
        if($dado != null) {
            return response()->json($dado);

        }
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
