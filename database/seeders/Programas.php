<?php

namespace Database\Seeders;

use App\Models\Programas as ModelsProgramas;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Programas extends Seeder
{
    public function run(): void
    {
        ModelsProgramas::create([
            'nome' => 'AAdvantage',
            'descricao' => 'American Airlines',
            'situacao' => 'ATIVO',
        ]);
    }
}
