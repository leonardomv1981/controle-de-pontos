<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produtomilhas extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_programa',
        'id_usuario',
        'operacao',
        'data_operacao',
        'pontos_operacao',
        'valor_operacao',
        'valor_acumulado',
        'cpm_operacao',
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

    public function getExtratoPorPrograma(string $idPrograma)
    {
        $idUsuario = 1;
        $extrato = $this->where('id_programa', $idPrograma)->where('situacao', 'ATIVO')->where('id_usuario', $idUsuario)->orderBy('data_operacao', 'asc')->get();
        return $extrato;
    }
    
    public function programa()
    {
        return $this->belongsTo(Programas::class, 'id_programa');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    // public function getUltimoSaldo(string $nome_programa)
    // {
    //     $ultimoSaldo = $this->where('nome_programa', $nome_programa)->orderBy('id', 'desc')->first();
    //     return $ultimoSaldo;
    // }
}
