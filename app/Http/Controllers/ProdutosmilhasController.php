<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormRequestProdutoMilhas;
use App\Models\Componentes;
use App\Models\Produtomilhas;
use App\Models\Programas;
use App\Models\Saldos;
use Brian2694\Toastr\Facades\Toastr;
use Brian2694\Toastr\Toastr as ToastrToastr;
use Illuminate\Http\Request;

class ProdutosmilhasController extends Controller
{

    public function __construct(Produtomilhas $produtoMilhas)
    {
        $this->produtoMilhas = $produtoMilhas;
    }

    public function delete (Request $request)
    {

        $id = $request->id;
        $buscarRegistro = $this->produtoMilhas->where('id', $id)->where('situacao', 'ATIVO')->get()[0];

        if ($buscarRegistro->operacao == 'credito') {
            $saldo = Saldos::where('id_programa', $buscarRegistro->id_programa)->get();
            $saldo[0]->saldo_total = $saldo[0]->saldo_total - $buscarRegistro->pontos_operacao;
            $saldo[0]->valor_total = $saldo[0]->valor_total - $buscarRegistro->valor_operacao;
            $saldo[0]->cpm_total = $saldo[0]->valor_total / (($saldo[0]->saldo_total / 1000));
            $saldo[0]->save();
        } elseif ($buscarRegistro->operacao == 'debito') {
            $saldo = Saldos::where('id_programa', $buscarRegistro->id_programa)->get();
            $saldo[0]->saldo_total = $saldo[0]->saldo_total + $buscarRegistro->pontos_operacao;
            $saldo[0]->valor_total = $saldo[0]->valor_total + $buscarRegistro->valor_operacao;
            $saldo[0]->cpm_total = $saldo[0]->valor_total / (($saldo[0]->saldo_total / 1000));
            dd($saldo[0]);
            $saldo[0]->save();
        }
        
        $buscarRegistro = Produtomilhas::find($id)->update(['situacao' => "EXCLUIDO"]);

        return (['success'=> true]);
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
                    $data['produtomilhas']['origem']['observacao'] = 'Transferência para o programa ' . $saldoDestino[0]->programa->nome;

                    //tratamento dos dados do programa de destino da transferência - preparação para creditar os pontos
                    $data['produtomilhas']['destino']['id_usuario'] = $idUsuario;
                    $data['produtomilhas']['destino']['operacao'] = 'credito';
                    $data['produtomilhas']['destino']['data_operacao'] = $data['produtomilhas']['origem']['data_operacao'];
                    $data['produtomilhas']['destino']['valor_operacao'] = $data['produtomilhas']['origem']['valor_operacao'];
                    $data['produtomilhas']['destino']['cpm_operacao'] = $data['produtomilhas']['origem']['cpm_operacao'];
                    $data['produtomilhas']['destino']['situacao'] = 'ATIVO';
                    $data['produtomilhas']['destino']['observacao'] = 'Transferência recebida do programa ' . $saldoOrigem[0]->programa->nome;

                

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

                    Toastr::success('Operação realizada com sucesso');

                    return redirect()->route('saldos.index');
                    
                    break;
                default:
                    echo "não foi possível realizar a ação";
                    break;
            }

            Produtomilhas::create($data['produtomilhas']);
            Saldos::where('id', $data['saldo']['id'])->update($data['saldo']);

            Toastr::success('Operação realizada com sucesso');

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

    public function listarPorPrograma (Request $request) 
    {
        $programa = $request->programa;

        if ($programa == '') {
            Toastr::warning('Houve um erro ao obter o extrato. Tente novamente.');
            return redirect()->route('saldos.index');
        }

        $extrato = $this->produtoMilhas->getExtratoPorPrograma($programa);

        return view('pages.produto-milhas.extrato', compact('extrato'));
    }
}
