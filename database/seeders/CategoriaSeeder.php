<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categorias = ['Produtos Alimenticios', 'Produtos de Higiene', 'Pessoa em Estado Critico', 'Medicamentos', 'Materiais Escolar', 'Electrodomesticos', 'Roupas'];
        
        foreach($categorias as $cat){
            DB::table('categorias')->insert([
                'nome_categoria' => $cat                
            ]);
        }
    }
}
