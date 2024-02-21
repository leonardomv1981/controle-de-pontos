<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saldos extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_programa',
        'id_usuario',
        'saldo_total',
        'valor_total',
        'cpm_total',
        'situacao'
    ];

    public function getSaldoPorPrograma($data)
    {
        $saldo = $this->where(function ($query) use ($data) {
            $query->where('id_programa', $data['id_programa'])->where('id_usuario', $data['id_usuario']);
        })->get();
        
        return $saldo;
    }

}
