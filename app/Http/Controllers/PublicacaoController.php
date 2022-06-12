<?php

namespace App\Http\Controllers;

use App\Models\publicacao;
use App\Models\pessoa;
use App\Models\Classificacao_publicacao;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\DB;
use File;

use Illuminate\Support\Facades\Date;
use Symfony\Component\VarDumper\Cloner\Data;

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
            ->join('users', 'publicacaos.user_id', '=', 'users.id')
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
        
    }

    public function store(Request $request)
    {

        try{
            
            $validacao = array(
                'titulo'       => 'required|max:53',
                'categoria_id' => 'required',
                'descricao' => 'required',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            );
            
            $erro = Validator::make($request->all(), $validacao);

            $publicacao_id = $request->publicacao_id;

            if ($erro->fails()) {
                return response()->json(['erroValidacao' => $erro->errors()->all()]);
            }

            $dadosPost = [
                'user_id' => Auth::user()->id,
                'titulo' => $request->titulo,
                'categoria_id' => $request->categoria_id,
                'texto' => $request->descricao,
                'data' => Date('Y-m-d')
            ];

            if($files = $request->file('image')) {

                //apagar ficheiro antigo
                \File::delete('public/images/'.$request->hidden_image);

                //inserir novo ficheiro
                $imageName = time().'.'.$files->getClientOriginalExtension();
                $files->move(public_path('images'), $imageName);
                $dadosPost['imagem'] = "$imageName";
            }

            $post = publicacao::updateOrCreate([ 'id' => $publicacao_id], $dadosPost );
            
            return response()->json(['mensagem' => 'Pubicação realizada com sucesso', 'data' => $post, 'status' => '200']);
            
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
        $editarId = array('id' => $id);
        $publicacao  = publicacao::where($editarId)->first();
      
        return response()->json($publicacao);
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
        $data = publicacao::where('id',$id)->first(['imagem']);
        \File::delete('public/images/'.$data->imagem);
        $publicacao = publicacao::where('id',$id)->delete();
      
        return response()->json($publicacao);
    }
}
