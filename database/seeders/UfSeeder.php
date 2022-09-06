<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UfSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_uf')->insert([
            "sigla" => "MG",
            "nome" => "MINAS GERAIS",
            "status" => 1
        ]);

        DB::table('tb_uf')->insert([
            "sigla" => "GO",
            "nome" => "GOIÁS",
            "status" => 1
        ]);

        DB::table('tb_uf')->insert([
            "sigla" => "DF",
            "nome" => "DISTRITO FEDERAL",
            "status" => 1
        ]);
    }
}
