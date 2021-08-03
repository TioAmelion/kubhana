<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\doacao;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class DoacaoController extends Controller
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
        $formDoar = array(
            'descricaoDoar' => 'required|max:250',
            'quantidade' => 'required|integer',
            'instId' => 'required|integer',
            'estado' => 'required|string'
            );

        $erro = Validator::make($request->all(), $formDoar);

        if ($erro->fails()) {
            return response()->json(['erro' => $erro->errors()->all()]);
        }
    
        $dados = doacao::create([
            'doador_id' => Auth::user()->id, 
            'instituicao_id' => $request->instId,
            'descricao' => $request->descricaoDoar,
            'quantidade' => $request->quantidade,
            'estado' => $request->estado,
            'data' => date('Y-m-d')
        ]);

        return response()->json([ 'mensagem' => 'Doação realizada com sucesso', 'dados' => $dados ]);
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
