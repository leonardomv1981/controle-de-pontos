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
        'usuario',
        'data_operacao',
        'pontos_operacao',
        'saldo_anterior',
        'saldo_atual',
        'valor_operacao',
        'valor_acumulado',
        'cpm_operacao',
        'cpm_acumulado',
        'situacao',
        'observacao',
    ];

    public function getProdutosPesquisarIndex(string $search = NULL) 
    {
        $produtoMilhas = $this->where(function ($query) use ($search) {
            if (!empty($search)) {
                echo "if";
                $query->whereRaw('nome_programa = ? AND situacao != "EXCLUIDO"', $search);
                // $query->orWhere('nome_programa', 'LIKE', "%{$search}%");
            } else {
                $query->whereRaw('situacao != "EXCLUIDO"');
            };            
        })->get();

        
        return $produtoMilhas;
    }

    public function getUltimoSaldo(string $nome_programa)
    {
        $ultimoSaldo = $this->where('nome_programa', $nome_programa)->orderBy('id', 'desc')->first();
        return $ultimoSaldo;
    }
}
