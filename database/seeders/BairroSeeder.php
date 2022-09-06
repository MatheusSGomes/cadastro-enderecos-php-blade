<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BairroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_bairro')->insert([
            "codigo_municipio" => 1,
            "nome" => "CENTRO",
            "status" => 1
        ]);

        DB::table('tb_bairro')->insert([
            "codigo_municipio" => 2,
            "nome" => "JARDINS",
            "status" => 1
        ]);

        DB::table('tb_bairro')->insert([
            "codigo_municipio" => 3,
            "nome" => "QNL",
            "status" => 1
        ]);
    }
}
