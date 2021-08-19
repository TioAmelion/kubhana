<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PublicacaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $publicacoes = array(
            [
                'user_id' => 1,
                'titulo' => "Produtos Alimenticios",
                'categoria_id' => 1,
                'texto' => "Precisamos de alimentos, tudo que tinhamos em nosso estoque já terminou.",
                'estado_item' => "",
                'quantidade_item' => "",
                'localizacao' => "",
                'data_validade' => "",
                'imagem' => "",
                'data' => "2021-08-18"
            ],
            [
                'user_id' => 2,
                'titulo' => "Pessoa em Estado Critico",
                'categoria_id' => 3,
                'texto' => "Precisamos de ajuda para marcar uma cirurgia urgente.",
                'estado_item' => "",
                'quantidade_item' => "",
                'localizacao' => "",
                'data_validade' => "",
                'imagem' => "",
                'data' => "2021-08-18"
            ],
            [
                'user_id' => 1,
                'titulo' => "Medicamentos",
                'categoria_id' => 3,
                'texto' => "Temos dois jovens aqui no centro doentes, até o momento os mesmo não fizeram ainda a medicação porque o centro não tem medicamentos e nem valores para comprar, por favor precisamos de ajuda o mais breve possivel.",
                'estado_item' => "",
                'quantidade_item' => "",
                'localizacao' => "",
                'data_validade' => "",
                'imagem' => "",
                'data' => "2021-08-18"
            ],
            [
                'user_id' => 1,
                'titulo' => "Medicamentos",
                'categoria_id' => 1,
                'texto' => "Temos dois jovens aqui no centro doentes, até o momento os mesmo não fizeram ainda a medicação porque o centro não tem medicamentos e nem valores para comprar, por favor precisamos de ajuda o mais breve possivel.",
                'estado_item' => "",
                'quantidade_item' => "",
                'localizacao' => "",
                'data_validade' => "",
                'imagem' => "",
                'data' => "2021-08-18"
            ]
        );

        foreach($publicacoes as $publicacao){
            DB::table('publicacaos')->insert([
                'user_id' => $publicacao["user_id"],
                'titulo' => $publicacao["titulo"],
                'categoria_id' => $publicacao["categoria_id"],
                'texto' => $publicacao["texto"],
                'data_validade' => $publicacao["data"]             
            ]);
        }

    }
}
