<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AfazeresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('afazers')->insert([
            'afazer' => 'Lavar Roupa',
            'prioridade' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('afazers')->insert([
            'afazer' => 'Comprar Game of Thrones',
            'prioridade' => 3,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('afazers')->insert([
            'afazer' => 'Fazer Projeto',
            'prioridade' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('afazers')->insert([
            'afazer' => 'Comprar Cordas de Violão',
            'prioridade' => 3,
            'finalizado' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
