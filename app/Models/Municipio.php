<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UF;

/**
 * @OA\Schema(
 *     title="Municipio",
 *     description="Municipio model",
 * )
 */
class Municipio extends Model
{
    use HasFactory;
    protected $table = 'tb_municipio';
    public $timestamps = false;
    protected $primaryKey = 'codigo_municipio';
    protected $fillable = ['codigo_uf', 'nome', 'status'];

    public function uf()
    {
        return $this->hasOne(UF::class, 'codigo_uf', 'codigo_uf');
    }

    public function filter($filter)
    {
        $filter = $this->where(function ($query) use ($filter) {
            if($filter['codigoUF'] !== null) {
                $query->where('codigo_uf', $filter['codigoUF']);
            }

            if($filter['codigoMunicipio'] !== null) {
                $query->where('codigo_municipio', $filter['codigoMunicipio']);
             }

            if($filter['nome'] !== null) {
                $query->where('nome', $filter['nome']);
            }

            if($filter['status'] !== null) {
                $query->where('status', $filter['status']);
            }
        })->get();

        return $filter;
    }
}
