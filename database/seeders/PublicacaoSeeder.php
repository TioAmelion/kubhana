<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\publicacao;

class PublicacaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipo_publicacao = ['doacao', 'ajuda'];
        
        $publicacoes = array(
            [
                'user_id' => 1,
                'titulo' => "Produtos Alimenticios",
                'categoria_id' => 1,
                'texto' => "Precisamos de alimentos, tudo que tinhamos em nosso estoque já terminou.",
                'estado_item' => "",
                'quantidade_item' => "",
                'localizacao' => "Malanje",
                'data_validade' => "",
                'imagem' => "",
                'data' => "2021-08-18",
                'tipo_publicacao' => "ajuda",
                'estado_doacao' => "disponivel"
            ],
            [
                'user_id' => 3,
                'titulo' => "Bens alimentares diversos",
                'categoria_id' => 1,
                'texto' => "Bens alimentares diversos, batata doce, mandioca e tomate maduro",
                'estado_item' => "",
                'quantidade_item' => "",
                'localizacao' => "Viana, Zango II",
                'data_validade' => "",
                'imagem' => "",
                'data' => "2021-08-18",
                'tipo_publicacao' => "doacao",
                'estado_doacao' => "disponivel"
            ],
            [
                'user_id' => 2,
                'titulo' => "Medicamentos",
                'categoria_id' => 3,
                'texto' => "Temos dois jovens aqui no centro doentes, até o momento os mesmo não fizeram ainda a medicação porque o centro não tem medicamentos e nem valores para comprar, por favor precisamos de ajuda o mais breve possivel.",
                'estado_item' => "",
                'quantidade_item' => "",
                'localizacao' => "Benguela, Baía Farta",
                'data_validade' => "",
                'imagem' => "",
                'data' => "2021-08-18",
                'tipo_publicacao' => "ajuda",
                'estado_doacao' => "disponivel"
            ],
            [
                'user_id' => 4,
                'titulo' => "Produtos de higiene",
                'categoria_id' => 2,
                'texto' => "Papel higiénicos, Sabão, sabonete, lixívia, omo, baldes e banheiras.",
                'estado_item' => "",
                'quantidade_item' => "",
                'localizacao' => "Luanda, Kilamba Edifício X14",
                'data_validade' => "",
                'imagem' => "",
                'data' => "2021-08-18",
                'tipo_publicacao' => "doacao",
                'estado_doacao' => "disponivel"
            ]
        );

        foreach($publicacoes as $publicacao){
            publicacao::create([
                'user_id' => $publicacao["user_id"],
                'titulo' => $publicacao["titulo"],
                'categoria_id' => $publicacao["categoria_id"],
                'texto' => $publicacao["texto"],
                'data' => $publicacao["data"],
                'localizacao' => $publicacao["localizacao"],
                'tipo_publicacao' => $publicacao["tipo_publicacao"],
                'estado_doacao' => $publicacao["estado_doacao"],
            ]);
        }

    }
}
