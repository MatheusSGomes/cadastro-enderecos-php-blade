<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Endereco;

/**
 * @OA\Schema(
 *     title="Pessoa",
 *     description="Pessoa model",
 * )
 */
class Pessoa extends Model
{
    use HasFactory;
    protected $table = 'tb_pessoa';
    public $timestamps = false;
    protected $primaryKey = 'codigo_pessoa';
    protected $fillable = [
        'codigo_pessoa',
        'nome',
        'sobrenome',
        'idade',
        'login',
        'senha',
        'status'
    ];

    public function enderecos()
    {
        return $this->hasMany(Endereco::class, 'codigo_pessoa');
    }

    public function filter($filter)
    {        
        $filter = $this->where(function ($query) use ($filter) {
            if($filter['codigoPessoa'] !== null) 
                $query->where('codigo_pessoa', $filter['codigoPessoa']);

            if($filter['login'] !== null) 
                $query->where('login', $filter['login']);

            if($filter['status'] !== null) 
                $query->where('status', $filter['status']);
        })->with('enderecos.bairro.municipio.uf')->get();

        return $filter;
    }
}
