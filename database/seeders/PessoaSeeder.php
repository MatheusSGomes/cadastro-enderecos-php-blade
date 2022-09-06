<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PessoaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* PESSOA 1 */
        DB::table('tb_pessoa')->insert([
            "nome" => "Fernanda",
            "sobrenome" => "Maria",
            "idade" => 25,
            "login" => "fernanda.maria",
            "senha" => "senha",
            "status" => 1
        ]);

        DB::table('tb_endereco')->insert([
            "codigo_pessoa" => DB::getPdo()->lastInsertId(),
            "codigo_bairro" => 1,
            "nome_rua" => "RUA A",
            "numero" => "123",
            "complemento" => "MINHA CASA UM",
            "cep" => "11111-222"
        ]);

        /* PESSOA 2 */
        DB::table('tb_pessoa')->insert([
            "nome" => "Lucas",
            "sobrenome" => "Santos",
            "idade" => 31,
            "login" => "lucas.santos",
            "senha" => "senha",
            "status" => 1
        ]);

        DB::table('tb_endereco')->insert([
            "codigo_pessoa" => DB::getPdo()->lastInsertId(),
            "codigo_bairro" => 1,
            "nome_rua" => "RUA B",
            "numero" => "321",
            "complemento" => "MINHA CASA DOIS",
            "cep" => "22222-333"
        ]);

        /* PESSOA 3 */
        DB::table('tb_pessoa')->insert([
            "nome" => "Joana",
            "sobrenome" => "Gomes",
            "idade" => 35,
            "login" => "joana.gomes",
            "senha" => "senha",
            "status" => 1
        ]);

        DB::table('tb_endereco')->insert([
            "codigo_pessoa" => DB::getPdo()->lastInsertId(),
            "codigo_bairro" => 1,
            "nome_rua" => "RUA C",
            "numero" => "564",
            "complemento" => "MINHA CASA TRÊS",
            "cep" => "55555-777"
        ]);
    }
}
