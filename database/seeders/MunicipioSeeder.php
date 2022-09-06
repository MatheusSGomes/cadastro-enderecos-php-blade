<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
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
        DB::table('tb_municipio')->insert([
            "codigo_uf" => 1,
            "nome" => "BELO HORIZONTE",
            "status" => 1
        ]);

        DB::table('tb_municipio')->insert([
            "codigo_uf" => 2,
            "nome" => "GOIÂNIA",
            "status" => 1
        ]);

        DB::table('tb_municipio')->insert([
            "codigo_uf" => 3,
            "nome" => "ASA SUL",
            "status" => 1
        ]);
    }
}
