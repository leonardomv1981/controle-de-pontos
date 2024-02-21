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

            if ($data['produtomilhas']['operacao'] != 'transferencia') {
                $idUsuario = 1;
                $querySaldo = new Saldos();
                $saldo = $querySaldo->getSaldoPorPrograma(['id_programa' => $data['produtomilhas']['id_programa'], 'id_usuario' => $idUsuario]);
                $compomentes = new Componentes();
                $data['produtomilhas']['valor_operacao'] = $compomentes->formataMascaraMoeda($data['produtomilhas']['valor_operacao']);
            }

            switch ($data['produtomilhas']['operacao']) 
            {
                 case 'credito':
                    $data['produtomilhas']['id_usuario'] = $idUsuario;
                    $data['produtomilhas']['cpm_operacao'] = $data['produtomilhas']['valor_operacao'] / (($data['produtomilhas']['pontos_operacao'] / 1000));
                    $data['produtomilhas']['situacao'] = 'ATIVO';

                    $data['saldo']['saldo_total'] = $saldo[0]->saldo_total + $data['produtomilhas']['pontos_operacao'];
                    $data['saldo']['valor_total'] = $saldo[0]->valor_total + $data['produtomilhas']['valor_operacao'];
                    $data['saldo']['cpm_total'] = $data['saldo']['valor_total'] / (($data['saldo']['saldo_total'] / 1000));
                    $data['saldo']['id'] = $saldo[0]->id;
                    
                    // dd(Saldos::update($data['saldo'], $saldo[0]->id));


                    break;
                case 'debito':
                    $data['valor_operacao'] = ($data['pontos_operacao'] / 1000) * $ultimoRegistro->cpm_acumulado;
                    $data['saldo_atual'] = $ultimoRegistro->saldo_atual - $data['pontos_operacao'];
                    $data['valor_acumulado'] = $ultimoRegistro->valor_acumulado - $data['valor_operacao'];
                    $data['cpm_operacao'] = $data['valor_operacao'] / (($data['pontos_operacao'] / 1000));
                    $data['saldo_atual'] = $data['saldo_anterior'] - $data['pontos_operacao'];
                    $data['valor_acumulado'] = $ultimoRegistro->valor_acumulado - $data['valor_operacao'];
                    $data['cpm_acumulado'] = $ultimoRegistro->cpm_acumulado;
                    break;
                case 'transferencia':
                    $idUsuario = 1;
                    $saldoOrigem = SaldosController::getSaldoPorPrograma($data['origem']['id_programa'], $idUsuario);
                    $saldoDestino = SaldosController::getSaldoPorPrograma($data['destino']['id_programa'], $idUsuario);
                    // $ultimoRegistroDestino = $this->produtoMilhas->getUltimoSaldo($data['destino']['nome_programa']);

                    //tratamento dos dados do programa de origem da transferência - preparação para debitar os pontos
                    $data['origem']['operacao'] = 'debito';
                    $data['origem']['saldo_anterior'] = $ultimoRegistroOrigem->saldo_atual;
                    $data['origem']['valor_operacao'] = ($data['origem']['pontos_operacao'] / 1000) * $ultimoRegistroOrigem->cpm_acumulado;
                    $data['origem']['saldo_atual'] = $ultimoRegistroOrigem->saldo_atual - $data['origem']['pontos_operacao'];
                    $data['origem']['valor_acumulado'] = $ultimoRegistroOrigem->valor_acumulado - $data['origem']['valor_operacao'];
                    $data['origem']['cpm_operacao'] = $data['origem']['valor_operacao'] / (($data['origem']['pontos_operacao'] / 1000));
                    $data['origem']['saldo_atual'] = $data['origem']['saldo_anterior'] - $data['origem']['pontos_operacao'];
                    $data['origem']['valor_acumulado'] = $ultimoRegistroOrigem->valor_acumulado - $data['origem']['valor_operacao'];
                    $data['origem']['cpm_acumulado'] = $ultimoRegistroOrigem->cpm_acumulado;
                    $data['origem']['usuario'] = 12;

                    //tratamento dos dados do programa de destino da transferência - preparação para creditar os pontos
                    $data['destino']['operacao'] = 'credito';
                    $data['destino']['saldo_anterior'] = $ultimoRegistroDestino->saldo_atual;
                    $data['destino']['valor_operacao'] = $data['origem']['valor_operacao'];
                    $data['destino']['saldo_atual'] = $ultimoRegistroDestino->saldo_atual + $data['destino']['pontos_operacao'];
                    $data['destino']['valor_acumulado'] = $ultimoRegistroDestino->valor_acumulado + $data['origem']['cpm_operacao'];
                    $data['destino']['cpm_operacao'] = $data['origem']['cpm_operacao'];
                    $data['destino']['saldo_atual'] = $data['destino']['saldo_anterior'] + $data['destino']['pontos_operacao'];
                    $data['destino']['cpm_acumulado'] = $data['destino']['valor_acumulado'] / (($data['destino']['saldo_atual'] / 1000));
                    $data['destino']['data_operacao'] = $data['origem']['data_operacao'];
                    $data['destino']['usuario'] = 12;



                    // Produtomilhas::create($data['origem']);
                    $gravarOrigem = Produtomilhas::create($data['origem']);
                    $gravarDestino = Produtomilhas::create($data['destino']);

                    return redirect()->route('produto-milhas.index');
                    
                    break;
                default:
                    echo "não foi possível realizar a ação";
                    break;
            }

            Produtomilhas::create($data['produtomilhas']);
            Saldos::where('id', $data['saldo']['id'])->update($data['saldo']);
        };

        return redirect()->route('saldos.index');
        // $programas = ProgramasController::getProgramasDoUsuario(1);
        // return view('pages.produto-milhas.cadastrar', compact('programas'));
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
