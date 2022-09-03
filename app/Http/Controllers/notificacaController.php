<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\notificacao;
use Illuminate\Support\Facades\Auth;
use DB;

class notificacaController extends Controller
{

    public function index()
    {
        // $notificacao = notificacao::where('user_id', )->where('destino', Auth::user()->id)->where('lida', 0)->orderByDesc('id')->limit(5)->get();
        $user_id = Auth::user()->id;
        $notificacao = DB::select("SELECT * FROM notificacaos n, users u WHERE n.user_id = u.id AND n.destino = $user_id AND n.lida = 'nao' ");
        $qtdNotificacao = notificacao::where('destino', Auth::user()->id)->where('lida', 'nao')->count();
        return response()->json(['data' => $notificacao, 'qtdNotificacao' => $qtdNotificacao, 'status' => 200]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        
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
