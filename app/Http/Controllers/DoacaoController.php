<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\doacao;
use App\Models\pessoa;
use App\Models\doador;
use App\Models\User;
use App\Models\publicacao;
use App\Models\notificacao;
use App\Models\instituicao;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use App\Models\Categoria;
use Exception;
use Nexmo\Laravel\Facade\Nexmo;
use File;
use Illuminate\Support\Facades\DB;
class DoacaoController extends Controller
{

    public function index()
    {
        $idPessoas = pessoa::all();

        if(Auth::check()){
            $idPessoas = pessoa::where('user_id', Auth::user()->id)->first();
        }

        $categorias = Categoria::all();
        $dados = new doacao();

        $doacoes = $dados->doacoes();

        //listar todoas as doacoes que a instituicao recebeu
        $todasDoacoes = $dados->doacoesInstituicoes();

        $publicacoes = new publicacao;
        $pub = $publicacoes->lstPubPerfil();

        return view('admin.includes.doacao', [
            'categorias'   => $categorias, 
            'doacoes'      => $doacoes,
            'idPessoas'    => $idPessoas,
            'publicacoes'  => $pub,
            'todasDoacoes' => $todasDoacoes
        ]);
    }

    //listar doações na modal da página home
    public function listarDoacoes($id) {
        $dados = DB::select("
            SELECT * FROM doacaos doa, doadors d, pessoas p, users u
            WHERE doa.publicacao_id = $id
            AND d.id = doa.doador_id
            AND d.pessoa_id = p.id
            AND u.id = p.user_id
        ");
        
        return response()->json(['data' => $dados, 'status' => 200]);
    }

    //listar doações na página listar doações de uma determinada publicação
    public function lstDoacoes($id) {

        $dados = DB::select("
            SELECT * FROM doacaos doa, doadors d, pessoas p, users u
            WHERE doa.publicacao_id = $id
            AND d.id = doa.doador_id
            AND d.pessoa_id = p.id
            AND u.id = p.user_id
            order by doa.id desc
        ");
        
        return view('admin.includes.listar_doacao', ['doacoesInst' => $dados]);
    }

    public function confirmarDoacao($id)
    {
        $dados = doacao::where('publicacao_id', $id)->update(['confirmado' => 'sim']);
        return response()->json(['data' => $dados, 'status' => 200, 'mensagem' => 'Doação Confirmada.']);
    }

    public function mapa(Request $request)
    {
        return view('admin.includes.mapa');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        try {

            DB::beginTransaction();
            
            $formDoar = array(
                'descricaoDoar' => 'required',
                'quantidade' => 'required|integer',
                'instituicao_id' => 'required|integer',
                'publicacao_doacao_id' => 'required|integer',
                'estado' => 'required|string',
                'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            );

            $erro = Validator::make($request->all(), $formDoar);

            if ($erro->fails()) {
                return response()->json(['erroValidacao' => $erro->errors()->all()]);
            }

            $idPessoa = pessoa::where('user_id', Auth::user()->id)->get();
            $idDoador = doador::where('pessoa_id', $idPessoa[0]['id'])->get();

            $idInstituicao = instituicao::where('user_id', $request->instituicao_id)->get();

            $doacao_id = $request->publicacao_id_doar;

            $dados = [
                'doador_id' => $idDoador[0]['id'], 
                'instituicao_id' => $idInstituicao[0]['id'],
                'publicacao_id' => $request->publicacao_doacao_id,
                'descricao' => $request->descricaoDoar,
                'quantidade' => $request->quantidade,
                'estado' => $request->estado,
                'data' => date('Y-m-d')
            ];

            if($files = $request->file('image'))
            {
                //apagar ficheiro antigo
                \File::delete('public/images/'.$request->hidden_image);

                //inserir novo ficheiro
                $imageName = time().'.'.$files->getClientOriginalExtension();
                $files->move(public_path('images'), $imageName);
                $dados['imagem'] = "$imageName";
            }
        
            $doacao = doacao::updateOrCreate(['id' => $doacao_id], $dados);

            $notificacao_id = $request->notificacao_id;

            $notificacao = [
                'user_id' => Auth::user()->id ,
                'publicacao_id' => $request->publicacao_doacao_id, 
                'destino' => $request->instituicao_id, 
                'texto' => "pretende fazer uma doação."
            ];

            $dadosNot = notificacao::updateOrCreate(['id' => $notificacao_id], $notificacao);

            if(!$doacao || !$dadosNot)
            {
                DB::rollback();
            } else {
                DB::commit();
            }

            return response()->json([ 'mensagem' => 'Doação realizada com sucesso', 'data' => $doacao, 'status' => 200 ]);

        } catch(\Exception $e) {
            return response()->json(['mensagem' => 'Ocorreu um erro ao Solicitar', 'erro' => $e->getMessage()]);
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

    public function show($id)
    {
        $dados = doacao::find($id);
        return response()->json(['data' => $dados]);
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
