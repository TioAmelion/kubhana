<?php

namespace App\Http\Controllers;

use App\Models\publicacao;
use App\Models\pessoa;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Validator;
use DB;
use File;

class PublicacaoUserController extends Controller
{
    public function index()
    {
        //
    }
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        try{

            $validacao = array(
                'titulo_doacao' => 'required|max:50',
                'categoria_id_doador' => 'required',
                'local_doacao' => 'required',
                'quantidade_doacao' => 'required',
                // 'data_expiracao' => 'required',
                'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'descricao_doacao' => 'required',
                'local_doacao' => 'required',
                'classificacao' => 'required'
            );
            
            $erro = Validator::make($request->all(), $validacao);
    
            if ($erro->fails()) {
                return response()->json(['erroValidacao' => $erro->errors()->all()]);
            }

            $publicacao_id = $request->publicacao_id_doador;

            $dados = [
                'user_id' => Auth::user()->id,
                'titulo' => $request->titulo_doacao,
                'categoria_id' => $request->categoria_id_doador,
                'texto' => $request->descricao_doacao, 
                'estado_item' => $request->classificacao,
                'quantidade_item' => $request->quantidade_doacao,
                'localizacao' => $request->local_doacao,
                // 'data_validade' => $request->data_expiracao,
            ];

            if($files = $request->file('image')) {

                //apagar ficheiro antigo
                \File::delete('public/images/'.$request->hidden_image);

                //inserir novo ficheiro
                $imageName = time().'.'.$files->getClientOriginalExtension();
                $files->move(public_path('images'), $imageName);
                $dados['imagem'] = "$imageName";
            }

            $publicacao = publicacao::updateOrCreate(['id' => $publicacao_id], $dados);

            return response()->json(['mensagem' => 'Pubicação realizada com sucesso', 'data' => $publicacao, 'status' => 200]);
            
          }catch(\Exception $e){
            return response()->json(['mensagem' => 'Ocorreu um erro ao publicar', 'erro' => $e]);
          }
    }
    
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $editarId = array('id' => $id);
        $publicacao  = publicacao::where($editarId)->first();
      
        return response()->json($publicacao);
    }
    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $data = publicacao::where('id',$id)->first(['imagem']);
        \File::delete('public/images/'.$data->imagem);
        $publicacao = publicacao::where('id',$id)->delete();
      
        return response()->json($publicacao);
    }
}
