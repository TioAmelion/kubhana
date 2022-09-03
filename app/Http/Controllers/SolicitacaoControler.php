<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\solicitacao;
use App\Models\notificacao;
use Validator;
use Illuminate\Support\Facades\DB;

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
        $dados = DB::select("SELECT * FROM solicitacaos s, users u, instituicaos i WHERE  s.publicacao_id = $id AND s.user_id = u.id AND i.user_id = u.id;");
        
        return response()->json(['data' => $dados, 'status' => 200]);
        
    }

    public function solicitacoesDoador($id) {
        $dados = DB::select("SELECT * FROM solicitacaos s, users u, instituicaos i WHERE  s.publicacao_id = $id AND s.user_id = u.id AND i.user_id = u.id;");
        
        return response()->json(['data' => $dados, 'status' => 200]);
        
    }

    public function store(Request $request)
    {
        try {

            DB::beginTransaction();

            $validacao = array(
                'publicacao_solicitar_id' => 'required',
                'texto_solicitacao' => 'nullable|max:255',
            );
            
            $erro = Validator::make($request->all(), $validacao);
    
            if ($erro->fails()) {
                return response()->json(['erroValidacao' => $erro->errors()->all()]);
            }

            $solicitar_id = $request->solicitar_id;

            $dados = [
                'user_id' => Auth::user()->id,
                'publicacao_id' => $request->publicacao_solicitar_id,
            ];

            if($request->texto_solicitacao) {
                $dados['texto'] = $request->texto_solicitacao;
            }else{
                $dados['texto'] = $request->texto_solicitacao_padrao;
            }

            $solicitacao = solicitacao::updateOrCreate(['id' => $solicitar_id], $dados);

            $notificacao_id = $request->notificacao_id;
            
            $notificacao = [
                'user_id' => Auth::user()->id, 
                'publicacao_id' => $request->publicacao_solicitar_id, 
                'destino' => $request->publicacao_user_id, 
                'texto' => "pretende receber o produto que pretende doar."
            ];

            $dadosNot = notificacao::updateOrCreate(['id' => $notificacao_id], $notificacao);

            if(!$solicitacao || !$dadosNot)
            {
                DB::rollback();
            } else {
                DB::commit();
            }

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
