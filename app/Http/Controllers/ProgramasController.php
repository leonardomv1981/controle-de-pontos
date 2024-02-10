<?php

namespace App\Http\Controllers;

use App\Models\Programas;
use App\Models\Saldos;
use Illuminate\Http\Request;

class ProgramasController extends Controller
{
    public function index()
    {
        $programas = Programas::all();
        return view('pages.programas.index', compact('programas'));
    }

    public function retornaDadosProgramas () 
    {
        $Programas = Programas::all();
        return $programas;
    }

    public function __construct(Programas $programas)
    {
        $this->programas = $programas;
    }

    public function cadastrarProgramas(Request $request)
    {
        $data = $request->data;
        // dd($data);
        $dataProgramas = $this->programas->create($data['programas']);
        $data['saldos']['id_programa'] = $dataProgramas->id;
        $data['saldos']['id_usuario'] = 12;
        $data['saldos']['saldo_total'] = 0;
        $data['saldos']['valor_total'] = 0;
        $data['saldos']['cpm_total'] = 0;
        // dd($data['saldos']);
        Saldos::create($data['saldos']);
        return redirect()->route('produto-milhas.index');
    }
}
