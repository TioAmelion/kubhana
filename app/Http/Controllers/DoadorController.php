<?php

namespace App\Http\Controllers;

use App\Models\pessoa;
use App\Models\User;
use App\Models\doador;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DoadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.cadastro_doador');
    }
    public function all_doadors()
    {
        $date = DB::table('pessoas')
            ->join('doadors', 'doadors.pessoa_id', '=', 'pessoas.id')
            ->join('users', 'users.id', '=', 'pessoas.user_id')
            ->join('provincias', 'provincias.id', '=', 'pessoas.provincia_id')
            ->join('municipios', 'municipios.id', '=', 'pessoas.municipio_id')
            ->select('provincias.*','pessoas.*','municipios.*','users.*')
            ->get();
        // $date = doador::with('pessoa.user')->get();
        
        return view('admin.includes.all_doadors',['dates' => $date]);
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

        if ($request->get('provincia') && $request->get('municipio') ) {

            $request->validate([ 
                'nome_doador' => 'required|string|min:5|max:40',
                'telefone' => 'required',
                'genero' => 'required|string',
                'pais' => 'required|string',
                'provincia' => 'required|string',
                'municipio' => 'required|string',
                'data_nasc' => 'required|date',
                'tipo_doador' => 'required|string',
                'numero_identificacao' => 'required',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|confirmed|min:8',
            ]);

            try {

                DB::beginTransaction();

                Auth::login($user = User::create([
                    'name' => $request->nome_doador,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'tipo_perfil' => "doador"
                ]));
        
                $pessoa = pessoa::create([ 
                    'user_id' => $user->id,
                    'nome_pessoa' => $request->get('nome_doador'),
                    'genero' => $request->get('genero'), 
                    'telefone' => $request->get('telefone'),
                    'numero_identificacao' => $request->get('numero_identificacao'),
                    'data_nascimento' => $request->get('data_nasc'),
                    'pais_id' => $request->get('pais'),
                    'provincia_id' => $request->get('provincia'),
                    'municipio_id' => $request->get('municipio'),
                ]);
        
                $doador = doador::create([
                    'pessoa_id' => $pessoa->id,
                    'tipo_doador' => $request->get('tipo_doador') 
                ]);

                if(!$user || !$pessoa || !$doador )
                {
                    DB::rollback();
                } else {

                    DB::commit();
                }
        
                event(new Registered($user));
        
                return redirect(RouteServiceProvider::HOME);

            } catch (\Throwable $th) {
                return redirect('/register')->with('status', 'Ocorreu um erro, por favor tente mais tarde!');
            }

        } else {

            $request->validate([ 
                'nome_doador' => 'required|string|min:5|max:40',
                'telefone' => 'required',
                'genero' => 'required|string',
                'pais' => 'required|string',
                'data_nasc' => 'required|date',
                'numero_identificacao' => 'required',
                'tipo_doador' => 'required|string',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|confirmed|min:8',
            ]);

            try {

                Auth::login($user = User::create([
                    'name' => $request->nome_doador,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'tipo_perfil' => "doador"
                ]));
        
                $pessoa = pessoa::create([ 
                    'user_id' => $user->id,
                    'nome_pessoa' => $request->get('nome_doador'),
                    'genero' => $request->get('genero'), 
                    'telefone' => $request->get('telefone'),
                    'data_nascimento' => $request->get('data_nasc'),
                    'numero_identificacao' => $request->get('numero_identificacao'),
                    'pais_id' => $request->get('pais')
                ]);
        
                $doador = doador::create([
                    'pessoa_id' => $pessoa->id,
                    'tipo_doador' => $request->get('tipo_doador') 
                ]);

                if(!$user || !$pessoa || !$doador )
                {
                    DB::rollback();
                } else {

                    DB::commit();
                }
        
                event(new Registered($user));
        
                return redirect(RouteServiceProvider::HOME);

            } catch (\Throwable $th) {
                return redirect('/register')->with('status', 'Ocorreu um erro, por favor tente mais tarde!');
            }

        }
        
        
        // return redirect("/doador");
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
