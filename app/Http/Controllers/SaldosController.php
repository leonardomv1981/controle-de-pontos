<?php

namespace App\Http\Controllers;

use App\Models\Programas;
use App\Models\Saldos;
use App\Models\User;
use Illuminate\Http\Request;

class SaldosController extends Controller

{
    public function __construct(Saldos $saldos)
    {
        $this->saldos = $saldos;
    }

    public function index(Request $request)
    {
        $pequisar = $request->pesquisar;
        $findSaldos = $this->saldos->getSaldoIndex();
        return view('pages.saldos.index', compact('findSaldos'));
    }

    
    
}

