<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produtomilhas extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome_programa',
        'operacao',
        'pontos_operacao',
        'saldo_anterior',
        'saldo_atual',
        'valor_operacao',
        'cpm_operacao',
        'cpm_total',
    ];

    public function getProdutosPesquisarIndex(string $search = NULL) 
    {
        $produtoMilhas = $this->where(function ($query) use ($search) {
            if (!empty($search)) {
                $query->where('nome_programa', $search);
                $query->orWhere('nome_programa', 'LIKE', "%{$search}%");
            };

        })->get();
        
        return $produtoMilhas;
    }
}
