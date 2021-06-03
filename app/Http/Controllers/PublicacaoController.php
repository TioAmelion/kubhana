<?php

namespace App\Http\Controllers;

use App\Models\publicacao;
use App\Models\pessoa;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Validator;
use DB;


class PublicacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $idPessoas = pessoa::all();
        $pub = DB::table('publicacaos')
            ->join('users', 'publicacaos.usuario_id', '=', 'users.id')
            ->select('users.name', 'publicacaos.*')->get();
            return view('welcome')->with(['pub'=> $pub, 'idPessoas' => $idPessoas]);
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
            'descricao' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        );

        $erro = Validator::make($request->all(), $validacao);

        if ($erro->fails()) {
            return response()->json(['erro' => $erro->errors()->all()]);
        }

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        $post = publicacao::create([
            'usuario_id' => Auth::user()->id,
            'titulo' => $request->titulo,
            'categoria_id' => $request->categoria_id,
            'texto' => $request->descricao,
            'image' => $imageName
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
        $pub = publicacao::all();
        return view('welcome')->with('pub', $pub);
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
