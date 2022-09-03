<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\mensagem;
use Illuminate\Support\Facades\Auth;
use DB;
use Validator;

class MensagemController extends Controller
{
    public function index()
    {
        $mensagem = mensagem::whereIn('origem', [Auth::user()->id, $_COOKIE['conversa-id']])->whereIn('destino', [$_COOKIE['conversa-id'], Auth::user()->id])->get();
        return view('admin.includes.mensagens')
        ->with(['mensagens'=> $mensagem, 'nome'=> $_COOKIE['nome']]);
    }

    public function listarMensagens($id)
    {
        $mensagens = mensagem::whereIn('origem', [Auth::user()->id, $_COOKIE['conversa-id']])->whereIn('destino', [$_COOKIE['conversa-id'], Auth::user()->id])->get();
         
        return view('admin.includes.mensagens')->with(['mensagem'=> $mensagens]);

        // return response()->json(['data' => $mensagens, 'status' => 200]);

        // $mensagens = Mensagem::get()->map(function($dados)use( $msg){
        //     if(($dados->origem == 5 || $dados->origem==1) && ($dados->destino == 1 || $dados->destino == 5 )){
        //         $msg->push(['titulo'=>$dados->texto,'origem'=>$dados->origem]);
        //     }
        // });
    }

    public function store(Request $request)
    {
        try {
            $validacao = array(
                'mensagem_texto' => 'nullable|max:500',
            );
            
            $erro = Validator::make($request->all(), $validacao);
    
            if ($erro->fails()) {
                return response()->json(['erroValidacao' => $erro->errors()->all()]);
            }

            $mensagem_id = $request->mensagem_id;

            if ($_COOKIE['conversa-id']) {
            
                $dados = [
                    'origem' => Auth::user()->id,
                    'destino' => $_COOKIE['conversa-id'],
                    'texto' => $request->mensagem_texto
                ];
            }

            $mensagem = mensagem::updateOrCreate(['id' => $mensagem_id], $dados);

            return response()->json(['mensagem' => 'Mensagem enviada com sucesso', 'data' => $mensagem, 'status' => 200]);
            
        }catch(\Exception $e){
            return response()->json(['mensagem' => 'Ocorreu um erro ao solicitar', 'erro' => $e->getMessage()]);
          }
    }
}
