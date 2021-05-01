<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Municipio;
use Illuminate\Support\Facades\DB;

class MunicipioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pr_LD= 1;
        $pr_BG= 2;
        $pr_ML= 3;
        
        $municipios_LD = ['Luanda', 'Belas', 'Cacuaco', 'Icolo e bengo', 'Quiçama', 'Kilamba Kiaxi', 'Talatona', 'Viana'];
        $municipios_BG = ['Balombo','Baía Farta','Benguela','Bocoio','Caimbambo','Catumbela','Chongoroi','Cubal','Ganda','Lobito'];
        //$municipios_MX = ['Luanda', 'Belas', 'Cacuaco', 'Icolo e bengo', 'Quiçama', 'Kilamba Kiaxi', 'Talatona', 'Viana'];
        $municipios_ML = ['Cacuso','Calandula','Cambundi-Catembo','Cangandala','Caombo','Cunda-Diaza','Luquembo','Malange','Marimba','Massango','Caculama-Mucari','Quela','Quirima'];
        
        
        foreach($municipios_LD as $muni){
            DB::table('municipios')->insert([
                'provincia_id' => $pr_LD,               
                'nome_municipio' => $muni                
            ]);
        }

        foreach($municipios_BG as $muni){
            DB::table('municipios')->insert([
                'provincia_id' => $pr_BG,               
                'nome_municipio' => $muni                
            ]);
        }

        foreach($municipios_ML as $muni){
            DB::table('municipios')->insert([
                'provincia_id' => $pr_ML,               
                'nome_municipio' => $muni                
            ]);
        }
    }
}
