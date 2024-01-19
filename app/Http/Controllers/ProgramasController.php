<?php

namespace App\Http\Controllers;

use App\Models\Programas;
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

    public function cadastrarPrograma()
    {
        return view('programas.cadastrarPrograma');
    }

    public function action(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $query = $request->get('query');
            if ($query != '') {
                $data = DB::table('programas')
                    ->where('nome', 'like', '%' . $query . '%')
                    ->orWhere('descricao', 'like', '%' . $query . '%')
                    ->orWhere('milhas', 'like', '%' . $query . '%')
                    ->orWhere('validade', 'like', '%' . $query . '%')
                    ->orWhere('status', 'like', '%' . $query . '%')
                    ->orderBy('id', 'desc')
                    ->get();
            } else {
                $data = DB::table('programas')
                    ->orderBy('id', 'desc')
                    ->get();
            }
            $total_row = $data->count();
            if ($total_row > 0) {
                foreach ($data as $row) {
                    $output .= '
                    <tr>
                        <td>' . $row->nome . '</td>
                        <td>' . $row->descricao . '</td>
                        <td>' . $row->milhas . '</td>
                        <td>' . $row->validade . '</td>
                        <td>' . $row->status . '</td>
                        <td>
                            <a href="' . route('programas.edit', $row->id) . '" class="btn btn-warning">Editar</a>
                            <form action="' . route('programas.delete') . '" method="POST" class="d-inline">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="id" value="' . $row->id . '">
                                <button type="submit" class="btn btn-danger">Excluir</button>
                            </form>
                        </td>
                    </tr>
                    ';
                }
            } else {
                $output = '
                <tr>
                    <td align="center" colspan="5">Nenhum dado encontrado</td>
                </tr>
                ';
            }
            $data = array(
                'table_data' => $output,
                'total_data' => $total_row
            );
            echo json_encode($data);
        }
    }
}
