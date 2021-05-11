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
        $validacao = array(
            'titulo'       => 'required|max:50',
            'categoria_id' => 'required',
            'descricao' => 'required'
            // 'imagem' => 'image|max:2048'
        );
        
        $erro = Validator::make($request->all(), $validacao);

        if ($erro->fails()) {
            return response()->json(['erro' => $erro->errors()->all()]);
        }
        
            
        $post = publicacao::create([
            'usuario_id' => Auth::user()->id,
            'titulo' => $request->titulo,
            'categoria_id' => $request->categoria_id,
            'texto' => $request->descricao, 
            'estado_item' => $request->estado_item,
            'quantidade_item' => $request->quantidade_doacao,
            'localizacao' => $request->local_doacao,
            'data_validade' => $request->data_expiracao
        ]);

        return response()->json(['mensagem' => 'Pubicação realizada com sucesso', 'data' => $post]);
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
