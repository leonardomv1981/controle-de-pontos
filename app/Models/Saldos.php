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

    public function getSaldoIndex(string $search = NULL)
    {
        $saldos = $this->where(function ($query) use ($search) {
            if (!empty($search)) {
                $query->whereRaw('id_programa = ?', $search);
                // $query->orWhere('nome_programa', 'LIKE', "%{$search}%");
            };
        })->join('programas', 'saldos.id_programa', '=', 'programas.id')->orderBy('nome')->get();

        $saldos = $this->join('programas', 'saldos.id_programa', '=', 'programas.id')->orderBy('nome')->get();
        return $saldos;
    }
    public function getSaldoPorPrograma($data)
    {
        $saldo = $this->where(function ($query) use ($data) {
            $query->where('id_programa', $data['id_programa'])->where('id_usuario', $data['id_usuario']);
        })->get();
        
        return $saldo;
    }

    public function programa()
    {
        return $this->belongsTo(Programas::class, 'id_programa');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

}
