<?php

namespace Database\Seeders;

use App\Models\Produtomilhas as ModelsProdutomilhas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Produtomilhas extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ModelsProdutomilhas::create([
            'nome_programa' => 'AA',
            'operacao' => 'credito',
            'pontos_operacao' => '2240',
            'saldo_anterior' => '0',
            'saldo_atual' => '2240',
            'valor_operacao' => '0.00',
            'cpm_operacao' => '0.00',
            'cpm_total' => '0.00',
        ]);
    }
}
