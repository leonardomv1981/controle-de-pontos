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
    ];
}
