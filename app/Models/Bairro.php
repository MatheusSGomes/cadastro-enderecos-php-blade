<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Municipio;

/**
 * @OA\Schema(
 *     title="Bairro",
 *     description="Bairro model",
 * )
 */
class Bairro extends Model
{
    use HasFactory;
    protected $table = 'tb_bairro';
    public $timestamps = false;
    protected $primaryKey = 'codigo_bairro';
    protected $fillable = [
        'codigo_bairro',
        'codigo_municipio',
        'nome',
        'status'
    ];
    
    public function municipio()
    {
        return $this->hasOne(Municipio::class, 'codigo_municipio', 'codigo_municipio');
    }

    public function filter($filter)
    {
        $filter = $this->where(function ($query) use ($filter) {
            if($filter['codigoBairro'] !== null)
                $query->where('codigo_bairro', $filter['codigoBairro']);

            if($filter['codigoMunicipio'] !== null)
                $query->where('codigo_municipio', $filter['codigoMunicipio']);

            if($filter['nome'] !== null)
                $query->where('nome', $filter['nome']);

            if($filter['status'] !== null)
                $query->where('status', $filter['status']);
                
        })->get();

        return $filter;
    }
}
