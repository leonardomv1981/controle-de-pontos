<?php

namespace App\Http\Controllers;

use App\Models\Programas;
use App\Models\Saldos;
use Illuminate\Http\Request;

class SaldosController extends Controller

{
    public function index()
    {
    $saldos = Saldos::all();
    $programas = Programas::all();
    return view('pages.saldos.index', compact('saldos', 'programas'));
    }

    
}

