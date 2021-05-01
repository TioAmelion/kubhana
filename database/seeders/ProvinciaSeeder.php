<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\provincia;
use Illuminate\Support\Facades\DB;

class ProvinciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $provincias = ['Luanda','Benguela','Malanje','Cuanza Norte',
        'Cuannza Sul','Huila','Huige','Bie','Bengo','Huambo','Moxico',
        'Lunda Sul','Luanda Norte','Cunene','Cabinda','Cuando Cubango','Zaire','Namibe'];
        $id_pais = 1;
        foreach($provincias as $pro){
            DB::table('provincias')->insert([
                'pais_id' => $id_pais,
                'nome_provincia' => $pro                
            ]);
        }
    }
}
