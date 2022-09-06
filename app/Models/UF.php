<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     title="UF",
 *     description="UF model",
 * )
 */
class UF extends Model
{
    use HasFactory;
    protected $table = 'tb_uf';
    protected $primaryKey = 'codigo_uf';
    public $timestamps = false;
    protected $fillable = [
        'sigla',
        'nome',
        'status'
    ];
    public function filter($filter)
    {
        $filter = $this->where(function($query) use ($filter) {
            if($filter['codigoUF'] !== null) 
                $query->where('codigo_uf', $filter['codigoUF']);

            if($filter['sigla'] !== null) 
                $query->orWhere('sigla', $filter['sigla']);

            if($filter['nome'] !== null)
                $query->orWhere('nome', $filter['nome']);

            if($filter['status'] !== null) 
                $query->orWhere('status', $filter['status']);
        })->get();

        return $filter;
    }
}
