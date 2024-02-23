<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormRequestProdutoMilhas;
use App\Models\Componentes;
use App\Models\Produtomilhas;
use App\Models\Programas;
use App\Models\Saldos;
use Illuminate\Http\Request;

class ProdutosmilhasController extends Controller
{

    public function __construct(Produtomilhas $produtoMilhas)
    {
        $this->produtoMilhas = $produtoMilhas;
    }

    // public function index (Request $request) {
    //     $findProduto = $this->produtoMilhas->getProdutosPesquisarIndex(search: $request->pesquisar ?? '');
    //     return view('pages.produto-milhas.paginacao', compact('findProduto'));
    // }

    public function delete (Request $request)
    {
        $id = $request->id;
        $buscarRegistro = Produtomilhas::find($id)->update(['situacao' => "EXCLUIDO"]);
        return response()->utf8_decode(['success'=> true]);
    }

    public function cadastrarProdutoMilha (FormRequestProdutoMilhas $request) 
    {
        if ($request->method() == "POST") {
            $data = $request->data;
            $querySaldo = new Saldos();
            $idUsuario = 1;

            if ($data['produtomilhas']['operacao'] != 'transferencia') {
                $saldo = $querySaldo->getSaldoPorPrograma(['id_programa' => $data['produtomilhas']['id_programa'], 'id_usuario' => $idUsuario]);
                if(empty($data['produtomilhas']['valor_operacao'])) {
                    $data['produtomilhas']['valor_operacao'] = 0;
                }
            }

            switch ($data['produtomilhas']['operacao']) 
            {
                 case 'credito':
                    $compomentes = new Componentes();
                    $data['produtomilhas']['valor_operacao'] = $compomentes->formataMascaraMoeda($data['produtomilhas']['valor_operacao']);

                    $data['produtomilhas']['id_usuario'] = $idUsuario;
                    $data['produtomilhas']['cpm_operacao'] = $data['produtomilhas']['valor_operacao'] / (($data['produtomilhas']['pontos_operacao'] / 1000));
                    $data['produtomilhas']['situacao'] = 'ATIVO';

                    $data['saldo']['saldo_total'] = $saldo[0]->saldo_total + $data['produtomilhas']['pontos_operacao'];
                    $data['saldo']['valor_total'] = $saldo[0]->valor_total + $data['produtomilhas']['valor_operacao'];
                    $data['saldo']['cpm_total'] = $data['saldo']['valor_total'] / (($data['saldo']['saldo_total'] / 1000));
                    $data['saldo']['id'] = $saldo[0]->id;
                    break;
                case 'debito':
                    
                    if ($saldo[0]->saldo_total < $data['produtomilhas']['pontos_operacao']) {
                        return redirect()->route('produtoMilha.cadastrar')->with('error', 'Saldo insuficiente para realizar a transferência. Saldo atual disponível: ' . $saldoOrigem[0]->saldo_total);
                    }

                    $data['produtomilhas']['id_usuario'] = $idUsuario;
                    $data['produtomilhas']['valor_operacao'] = $saldo[0]->cpm_total * ($data['produtomilhas']['pontos_operacao']/1000);
                    $data['produtomilhas']['cpm_operacao'] = $data['produtomilhas']['valor_operacao'] / (($data['produtomilhas']['pontos_operacao'] / 1000));
                    $data['produtomilhas']['situacao'] = 'ATIVO';
                    
                    $data['saldo']['saldo_total'] = $saldo[0]->saldo_total - $data['produtomilhas']['pontos_operacao'];
                    $data['saldo']['valor_total'] = $saldo[0]->valor_total - $data['produtomilhas']['valor_operacao'];
                    $data['saldo']['cpm_total'] = $data['saldo']['valor_total'] / (($data['saldo']['saldo_total'] / 1000));
                    $data['saldo']['id'] = $saldo[0]->id;
                    break;
                case 'transferencia':
                    $saldoOrigem = $querySaldo->getSaldoPorPrograma(['id_programa' => $data['produtomilhas']['origem']['id_programa'], 'id_usuario' => $idUsuario]);
                    $saldoDestino = $querySaldo->getSaldoPorPrograma(['id_programa' => $data['produtomilhas']['destino']['id_programa'], 'id_usuario' => $idUsuario]);

                    if ($saldoOrigem[0]->saldo_total < $data['produtomilhas']['origem']['pontos_operacao']) {
                        // return Redirect::back()->withErros('Saldo insuficiente para realizar a transferência')->withInput();
                        return redirect()->route('produtoMilha.cadastrar')
                        ->with('error', 'Saldo insuficiente para realizar a transferência. Saldo atual disponível: ' . $saldoOrigem[0]->saldo_total);
                    }

                    //tratamento dos dados do programa de origem da transferência - preparação para debitar os pontos
                    $data['produtomilhas']['origem']['id_usuario'] = $idUsuario;
                    $data['produtomilhas']['origem']['operacao'] = 'debito';
                    $data['produtomilhas']['origem']['valor_operacao'] = $data['produtomilhas']['origem']['pontos_operacao'] / 1000 * $saldoOrigem[0]->cpm_total;
                    $data['produtomilhas']['origem']['cpm_operacao'] = $data['produtomilhas']['origem']['valor_operacao'] / (($data['produtomilhas']['origem']['pontos_operacao'] / 1000));
                    $data['produtomilhas']['origem']['situacao'] = 'ATIVO';
                    $data['produtomilhas']['origem']['observacao'] = 'Transferência para o programa xxx';
                    

                    //tratamento dos dados do programa de destino da transferência - preparação para creditar os pontos
                    $data['produtomilhas']['destino']['id_usuario'] = $idUsuario;
                    $data['produtomilhas']['destino']['operacao'] = 'credito';
                    $data['produtomilhas']['destino']['data_operacao'] = $data['produtomilhas']['origem']['data_operacao'];
                    $data['produtomilhas']['destino']['valor_operacao'] = $data['produtomilhas']['origem']['valor_operacao'];
                    $data['produtomilhas']['destino']['cpm_operacao'] = $data['produtomilhas']['origem']['cpm_operacao'];
                    $data['produtomilhas']['destino']['situacao'] = 'ATIVO';
                    $data['produtomilhas']['destino']['observacao'] = 'Transferência recebida do programa xxx';

                    $data['saldo']['origem']['saldo_total'] = $saldoOrigem[0]->saldo_total - $data['produtomilhas']['origem']['pontos_operacao'];
                    $data['saldo']['origem']['valor_total'] = $saldoOrigem[0]->valor_total - $data['produtomilhas']['origem']['valor_operacao'];
                    $data['saldo']['origem']['cpm_total'] = $data['saldo']['origem']['valor_total'] / (($data['saldo']['origem']['saldo_total'] / 1000));
                    $data['saldo']['origem']['id'] = $saldoOrigem[0]->id;

                    $data['saldo']['destino']['saldo_total'] = $saldoDestino[0]->saldo_total + $data['produtomilhas']['destino']['pontos_operacao'];
                    $data['saldo']['destino']['valor_total'] = $saldoDestino[0]->valor_total + $data['produtomilhas']['destino']['valor_operacao'];
                    $data['saldo']['destino']['cpm_total'] = $data['saldo']['destino']['valor_total'] / (($data['saldo']['destino']['saldo_total'] / 1000));
                    $data['saldo']['destino']['id'] = $saldoDestino[0]->id;

                    // Produtomilhas::create($data['origem']);
                    Produtomilhas::create($data['produtomilhas']['origem']);
                    Saldos::where('id', $data['saldo']['origem']['id'])->update($data['saldo']['origem']);

                    Produtomilhas::create($data['produtomilhas']['destino']);
                    Saldos::where('id', $data['saldo']['destino']['id'])->update($data['saldo']['destino']);

                    return redirect()->route('saldos.index');
                    
                    break;
                default:
                    echo "não foi possível realizar a ação";
                    break;
            }

            Produtomilhas::create($data['produtomilhas']);
            Saldos::where('id', $data['saldo']['id'])->update($data['saldo']);

            return redirect()->route('saldos.index');
        };

        $programas = ProgramasController::getProgramasDoUsuario(1);
        return view('pages.produto-milhas.cadastrar', compact('programas'));
    }

    public function action (Request $request)
    {
        $data = json_decode($_POST['data']);
        $acao = $data->acao;

        $programas = ProgramasController::getProgramasDoUsuario(1);

        switch ($acao){
            case 'creditoPontos':
                return view('pages.produto-milhas.credito-pontos', compact('programas'));
                break;
            case 'debitoPontos':
                return view('pages.produto-milhas.debito-pontos', compact('programas'));
                break;
            case 'transferenciaPontos':
                return view('pages.produto-milhas.transferencia-pontos', compact('programas'));
                break;
            default:
                echo "não foi possível realizar a ação";
                break;
        };

    }

    // public function listarPorPrograma ($data) {
    //     dd($data);
    //     $findProduto = Produtomilhas::where('nome_programa', '=', 'AA')->get();
    //     dd($findProduto);
    // }
}
