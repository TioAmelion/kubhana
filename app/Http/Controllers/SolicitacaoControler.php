<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\solicitacao;
use Validator;
use DB;

class SolicitacaoControler extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function listarSolicitantes($id) {
        $dados = DB::select("SELECT * FROM solicitacaos s, publicacaos p, users u, pessoas pe WHERE s.publicacao_id = p.id AND s.user_id = u.id AND pe.user_id = u.id AND s.publicacao_id = $id");
        
        return response()->json(['data' => $dados, 'status' => 200]);
        
    }

    public function store(Request $request)
    {
        try {
            $validacao = array(
                'publicacao_solicitar_id' => 'required',
                'texto_solicitacao' => 'nullable|max:255',
            );
            
            $erro = Validator::make($request->all(), $validacao);
    
            if ($erro->fails()) {
                return response()->json(['erroValidacao' => $erro->errors()->all()]);
            }

            $publicacao_solicitar_id = $request->publicacao_solicitar_id;

            $dados = [
                'user_id' => Auth::user()->id,
                'publicacao_id' => $request->publicacao_solicitar_id,
            ];

            if($request->texto_solicitacao) {
                $dados['texto'] = $request->texto_solicitacao;
            }else{
                $dados['texto'] = $request->texto_solicitacao_padrao;
            }

            $solicitacao = solicitacao::updateOrCreate(['id' => $publicacao_solicitar_id], $dados);

            return response()->json(['mensagem' => 'Solicitação realizada com sucesso', 'data' => $solicitacao, 'status' => 200]);
            
        }catch(\Exception $e){
            return response()->json(['mensagem' => 'Ocorreu um erro ao solicitar', 'erro' => $e->getMessage()]);
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

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
