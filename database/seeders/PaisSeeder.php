<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\pais;
use Illuminate\Support\Facades\DB;

class PaisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pais = ['Angola', 'Brasil', 'Portugal', 'Moçambique'];
        foreach($pais as $p){
            DB::table('pais')->insert([
                'nome_pais' => $p
            ]);
        }
    }
}
