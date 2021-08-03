<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\publicacao;
use App\Models\instituicao;
use App\Models\pessoa;
use App\Models\Categoria;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $result = new publicacao;
        $pub = $result->show();
        // dd($pub);

        $estadoPessoa = $result->estadoPessoa(); 
        $doacoes = $result->doacoesSemana();
        $instSemAjudas = $result->instSemAjudas();

        $teste = Categoria::all();
        $instituicao = instituicao::all();
        $idPessoas = pessoa::all();

        // $d = publicacao::withCount('classiPublicacao')->get();
        $d = publicacao::with('classiPublicacao')->count();

        if(Auth::check()){
            $idPessoas = pessoa::where('usuario_id', Auth::user()->id)->first();
        }
        
        return view('admin.includes.feedSite')->with(['pub'=> $pub, 'idPessoas' => $idPessoas, 'cat' => $teste, 'estadoPessoa' => $estadoPessoa, 'instituicao' => $instituicao, 'doacoes' => $doacoes, 'instSemAjudas' => $instSemAjudas]);
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
        //
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
