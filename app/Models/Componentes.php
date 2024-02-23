<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Componentes extends Model
{
    use HasFactory;

    public function formataMascaraMoeda($valor)
    {
        $valorRetorno = str_replace(['R$', ':', ' ', '.'], '', $valor);
        $valorRetorno = str_replace(',', '.', $valorRetorno);

        return $valorRetorno;
    }

    public function formataBancoMoeda($valor)
    {
        $valorRetorno = str_replace('.', ',', $valor);

        return 'R$: ' . $valorRetorno;
    }
}
