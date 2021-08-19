<?php

namespace App\Http\Controllers;

use App\Models\publicacao;
use App\Models\pessoa;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Validator;
use DB;

class PublicacaoUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return response()->json(['mensagem' => 'Pubicação realizada com sucesso', 'data' => $request->all()]);

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
                return response()->json(['erro' => $erro->errors()->all()]);
            }
    
            if($request->imagem) {
                $imageName = time().'.'.$request->imagem->extension();
                $request->imagem->move(public_path('images'), $imageName);
            }

            $post = publicacao::create([
                'user_id' => Auth::user()->id,
                'titulo' => $request->titulo_doacao,
                'categoria_id' => $request->categoria_id_doador,
                'texto' => $request->descricao_doacao, 
                'estado_item' => $request->classificacao,
                'quantidade_item' => $request->quantidade_doacao,
                'localizacao' => $request->local_doacao,
                // 'data_validade' => $request->data_expiracao,
                'imagem' => $request->imagemName
            ]);

            return response()->json(['mensagem' => 'Pubicação realizada com sucesso', 'data' => $post]);
            
          }catch(\Exception $e){
            return response()->json(['mensagem' => 'Ocorreu um erro ao publicar', 'erro' => $e]);
          }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
