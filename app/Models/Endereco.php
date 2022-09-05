<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{
    Pessoa,
    Bairro
};

class Endereco extends Model
{
    use HasFactory;
    protected $table = 'tb_endereco';
    public $timestamps = false;
    protected $primaryKey = 'codigo_endereco';
    protected $fillable = [
        'codigo_endereco',
        'codigo_pessoa',
        'codigo_bairro',
        'nome_rua',
        'numero',
        'complemento',
        'cep'
    ];

    public function pessoa()
    {
        $this->belongsTo(Pessoa::class, 'codigo_pessoa', 'codigo_pessoa');
    }

    public function bairro()
    {
        return $this->hasOne(Bairro::class, 'codigo_bairro', 'codigo_bairro');
    }
}
