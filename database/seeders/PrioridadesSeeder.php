<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrioridadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('prioridades')->insert([
            'nome' => 'Maxima'
        ]);
        DB::table('prioridades')->insert([
            'nome' => 'Media'
        ]);
        DB::table('prioridades')->insert([
            'nome' => 'Minima'
        ]);
    }
}
