<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\doacao;
use App\Models\pessoa;
use App\Models\doador;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use App\Models\Categoria;
use Exception;
use Nexmo\Laravel\Facade\Nexmo;
use File;

class DoacaoController extends Controller
{

    public function index()
    {
        $categorias = Categoria::all();

        return view('admin.includes.doacao', ['categorias' => $categorias]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        try {

            $formDoar = array(
                'descricaoDoar' => 'required',
                'quantidade' => 'required|integer',
                'instituicao_id' => 'required|integer',
                'estado' => 'required|string',
                'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            );

            $erro = Validator::make($request->all(), $formDoar);

            if ($erro->fails()) {
                return response()->json(['erroValidacao' => $erro->errors()->all()]);
            }

            $idPessoa = pessoa::where('user_id', Auth::user()->id)->get();
            $idDoador = doador::where('pessoa_id', $idPessoa[0]['id'])->get();

            $doacao_id = $request->publicacao_id_doar;

            $dados = [
                'doador_id' => $idDoador[0]['id'], 
                'instituicao_id' => $request->instituicao_id,
                'descricao' => $request->descricaoDoar,
                'quantidade' => $request->quantidade,
                'estado' => $request->estado,
                'data' => date('Y-m-d')
            ];

            if($files = $request->file('image')) {

                //apagar ficheiro antigo
                \File::delete('public/images/'.$request->hidden_image);

                //inserir novo ficheiro
                $imageName = time().'.'.$files->getClientOriginalExtension();
                $files->move(public_path('images'), $imageName);
                $dados['imagem'] = "$imageName";
            }
        
            $doacao = doacao::updateOrCreate(['id' => $doacao_id], $dados);

            return response()->json([ 'mensagem' => 'Doação realizada com sucesso', 'data' => $doacao, 'status' => 200 ]);

        }catch(\Exception $e){
            return response()->json(['mensagem' => 'Ocorreu um erro ao publicar', 'erro' => $e->getMessage()]);
        }
        // $basic  = new \Nexmo\Client\Credentials\Basic('569ecd86', 'EAe66YBv7ZwDo0dy');
        // $client = new \Nexmo\Client($basic);
 
        // $message = $client->message()->send([
        //     'to' => '921940679',
        //     'from' => '921940679',
        //     'text' => 'O utilizador predente fazer uma doação pra voce.'
        // ]);

        // $basic  = new \Vonage\Client\Credentials\Basic("569ecd86", "EAe66YBv7ZwDo0dy");
        // $client = new \Vonage\Client($basic);

        // $response = $client->sms()->send(
        //     new \Vonage\SMS\Message\SMS("244925773431", KUBHANA, 'O utilizador predente fazer uma doação pra voce.')
        // );
        
        // $message = $response->current();
        
        // if ($message->getStatus() == 0) {
        //     // echo "The message was sent successfully\n";
        //     return response()->json([ 'mensagem' => 'Doação realizada com sucesso', 'dados' => $dados ]);

        // } else {
        //     return response()->json([ 'mensagem' => 'The message failed with status:']);

        //     // echo "The message failed with status: " . $message->getStatus() . "\n";
        // }

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
