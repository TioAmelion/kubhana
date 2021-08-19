<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classificacao_publicacao;
use Illuminate\Support\Facades\Auth;

class ClassificarPublicacaoController extends Controller
{

    public function index()
    {
        $dados = Classificacao_publicacao::all();

        return response()->json(['dados' => $dados]);
    }

    public function verificarVoto(Request $request)
    {
        $dados = Classificacao_publicacao::where('publicacao_id', '=', $request->publicacao_id)->where('user_id', '=' ,Auth::user()->id)->get();

        return response()->json(['dados' => $dados]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        try {

            $votar = Classificacao_publicacao::create([
                'user_id'       =>  Auth::user()->id,
                'publicacao_id' =>  $request->publicacao_id,
                'classificacao' =>  $request->classificacao
            ]);

            return response()->json(['mensagem' => 'Votação realizada com sucesso', 'dados' => $votar]);

        } catch (\Throwable $th) {
            return response()->json(['mensagem' => 'Ocorreu um erro ao votar na publicação', 'erro' => $th]);
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request)
    {
        try {

            $dados = Classificacao_publicacao::find($request->id);
            $dados->classificacao  =  $request->classificacao;
            $dados->update();

            return response()->json(['mensagem' => 'Votação editada com sucesso', 'dados' => $dados]);

        } catch (\Throwable $th) {
            return response()->json(['mensagem' => 'Ocorreu um erro ao editar voto na publicação', 'erro' => $dados]);
        }
    }

    public function destroy($id)
    {
        //
    }
}
