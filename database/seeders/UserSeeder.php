<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Dados DO USER
        $users = array(
            ["name" => "Lar Kusola", "email" => "larkusola@gmail.com", "password" => "lllllllll"],
            ["name" => "Lar do Beiral", "email" => "beiral@gmail.com", "password" => "lllllllll"],
            ["name" => "Centro de Acolhimento Arnould Jensen", "email" => "arnould@gmail.com", "password" => "lllllllll"],
            ["name" => "Centro Infantil Madre Trindade", "email" => "centroinfantil@gmail.com", "password" => "lllllllll"],
            ["name" => "Augusto Jõao", "email" => "augusto@gmail.com", "password" => "bbbbbbbbb"],
            ["name" => "Sandra Mateus", "email" => "sandra@gmail.com", "password" => "bbbbbbbbb"],
            ["name" => "Elizabeth Adão", "email" => "elisabeth@gmail.com", "password" => "bbbbbbbbb"],
            ["name" => "Aurea Cardoso", "email" => "aurea@gmail.com", "password" => "bbbbbbbbb"]
        );

        //INSERIR USERS
        foreach($users as $user) {

            DB::table('users')->insert([
                'name' => $user["name"],
                'email' => $user["email"],
                'password' => Hash::make($user["password"]),
            ]);
        }

        //DADOS DA PESSOA
        $pessoas = array(
            [
                "user_id" => 5,
                "pais_id" => 1, 
                "provincia_id" => 1, 
                "municipio_id" => 1, 
                "nome_pessoa" => "Augusto Jõao",
                "telefone" => 926997047,
                "data_nascimento" => "1997-09-30",
                "genero" => "masculino",
                "numero_identificacao" => "000049264LA018"
            ],
            [
                "user_id" => 6,
                "pais_id" => 1, 
                "provincia_id" => 1, 
                "municipio_id" => 1, 
                "nome_pessoa" => "Sandra Mateus",
                "telefone" => 924117047,
                "data_nascimento" => "1997-09-30",
                "genero" => "feminino",
                "numero_identificacao" => "000049264LA018"
            ],
            [
                "user_id" => 7,
                "pais_id" => 1, 
                "provincia_id" => 1, 
                "municipio_id" => 1, 
                "nome_pessoa" => "Elizabeth Adão",
                "telefone" => 921170423,
                "data_nascimento" => "1997-09-30",
                "genero" => "masculino",
                "numero_identificacao" => "000049264LA018"
            ],
            [
                "user_id" => 8,
                "pais_id" => 1, 
                "provincia_id" => 1, 
                "municipio_id" => 1, 
                "nome_pessoa" => "Aurea Cardoso",
                "telefone" => 923117047,
                "data_nascimento" => "1997-09-30",
                "genero" => "feminino",
                "numero_identificacao" => "000049264LA018"
            ]
        );
        
        //INSERIR PESSOA
        foreach($pessoas as $pessoa){

            DB::table('pessoas')->insert([
                "user_id" => $pessoa["user_id"],
                "pais_id" => $pessoa["pais_id"], 
                "provincia_id" => $pessoa["provincia_id"], 
                "municipio_id" => $pessoa["municipio_id"], 
                "nome_pessoa" => $pessoa["nome_pessoa"],
                "telefone" => $pessoa["telefone"],
                "data_nascimento" => $pessoa["data_nascimento"],
                "genero" => $pessoa["genero"],
                "numero_identificacao" => $pessoa["numero_identificacao"]
            ]);
        }
        
        //DADOS DOADOR
        $doadores = array(
            [
                "pessoa_id" => 1,
                "tipo_doador" => "pessoa_fisica"
            ],
            [
                "pessoa_id" => 2,
                "tipo_doador" => "pessoa_juridica"
            ],
            [
                "pessoa_id" => 3,
                "tipo_doador" => "pessoa_fisica"
            ],
            [
                "pessoa_id" => 4,
                "tipo_doador" => "pessoa_juridica"
            ]
        );

        //INSERIR DOADOR
        foreach($doadores as $doador){
            DB::table('doadors')->insert([
                'pessoa_id' => $doador["pessoa_id"],
                'tipo_doador' => $doador["tipo_doador"]
            ]);
        }

        //DADOS INSTITUICAO
        $instituicoes = array(
            [
                "user_id" => 1, 
                "pais_id" => 1, 
                "provincia_id" => 1, 
                "municipio_id" => 1, 
                "nome_instituicao" => "Lar Kusola", 
                "sigla" => "LKS", 
                "telefone" => "923265790", 
                "objectivo" => "Ajudar todas as crianças a nível nacional", 
                "nif" => "05825"
            ],
            [
                "user_id" => 2, 
                "pais_id" => 1, 
                "provincia_id" => 2, 
                "municipio_id" => 2, 
                "nome_instituicao" => "Lar do Beira", 
                "sigla" => "LKS", 
                "telefone" => "923265790", 
                "objectivo" => "Ajudar todas as crianças a nível nacional", 
                "nif" => "05825"
            ],
            [
                "user_id" => 3, 
                "pais_id" => 1, 
                "provincia_id" => 1, 
                "municipio_id" => 1, 
                "nome_instituicao" => "Centro de Acolhimento Arnould Jensen", 
                "sigla" => "CAAJ", 
                "telefone" => "923265790", 
                "objectivo" => "Ajudar todas as crianças a nível nacional", 
                "nif" => "05825"
            ],
            [
                "user_id" => 4, 
                "pais_id" => 1, 
                "provincia_id" => 2, 
                "municipio_id" => 2, 
                "nome_instituicao" => "Centro Infantil Madre Trindade", 
                "sigla" => "CIMT", 
                "telefone" => "994265790", 
                "objectivo" => "Ajudar todas as crianças a nível nacional", 
                "nif" => "05825"
            ]
        );

        //INSERIR INSTITUICAO
        foreach($instituicoes as $instituico){

            DB::table('instituicaos')->insert([
                "user_id" => $instituico["user_id"], 
                "pais_id" => $instituico["pais_id"], 
                "provincia_id" => $instituico["provincia_id"], 
                "municipio_id" => $instituico["municipio_id"], 
                "nome_instituicao" => $instituico["nome_instituicao"], 
                "sigla" => $instituico["sigla"], 
                "telefone" => $instituico["telefone"], 
                "objectivo" => $instituico["objectivo"], 
                "nif" => $instituico["nif"]
            ]);
        }
    }
}
