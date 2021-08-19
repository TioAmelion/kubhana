<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\instituicao;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class InstituicaoController extends Controller
{
     public function store(Request $request)
     {

        $request->validate([
            'nome_instituicao' => 'required|string|min:5|max:40',
            'sigla' => 'required|string|min:2|max:10',
            'telefoneI' => 'required|min:9',
            'paisI' => 'required|string|max:20',
            'municipioI' => 'required|string|max:20',
            'provinciaI' => 'required|string|max:20',
            'objectivo' => 'required|string|min:10|max:100',
            'nif' => 'required||string',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        try {

            DB::beginTransaction();

            Auth::login($user = User::create([
                'name' => $request->nome_instituicao,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]));
    
            $instituicao = instituicao::create([ 
                'usuario_id' => $user->id,
                'nome_instituicao' => $request->get('nome_instituicao'),
                'sigla' => $request->get('sigla'),
                'telefone' => $request->get('telefoneI'),
                'pais_id' => $request->get('paisI'),
                'objectivo' => $request->get('objectivo'),
                'municipio_id' => $request->get('municipioI'), 
                'provincia_id' => $request->get('provinciaI'),
                'nif' => $request->get('nif')
            ]);

            if (!$user || !$instituicao)
            {
                DB::rollBack();
            } else {
                DB::commit();
            }
    
            event(new Registered($user));
    
            return redirect(RouteServiceProvider::HOME);
        } catch (\Throwable $th) {
            return redirect('/register')->with('status', 'Ocorreu um erro, por favor tente mais tarde!');
        }
    }
}
