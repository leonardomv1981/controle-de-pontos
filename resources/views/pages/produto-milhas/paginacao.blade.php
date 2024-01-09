@extends('index')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Programas de pontos</h1>
    </div>
    <div>
        <form action="{{ route('produto-milhas.index') }}" method="GET">
            <input type="text" name="pesquisar" placeholder="digite o nome">
            <button> Pesquisar </button>
            <a type="button" href="" class="btn btn-success float-end btn-sm">Incluir movimento</a>
        </form>
    </div>
    
    <h2>Section title</h2>
    <div class="table-responsive small">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th></th>
                    <th>Programa</th>
                    <th>Operação</th>
                    <th>Pontos da op</th>
                    <th>Valor da op</th>
                    <th>cpm da operação</th>
                    <th>Saldo anterior</th>
                    <th>Saldo atual</th>
                    <th>CPM atual</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($findProduto as $produto)
                    <tr>
                        <td>{{ $produto->id }}</td>
                        <td>{{ $produto->nome_programa }}</td>
                        <td>{{ $produto->operacao }}</td>
                        <td>{{ $produto->pontos_operacao }}</td>
                        <td>{{  'R$' . ' ' . number_format($produto->valor_operacao, 2, ',', '.') }}</td>
                        <td>{{ 'R$' . ' ' . number_format($produto->cpm_operacao, 2,',', '.') }}</td>
                        <td>{{ $produto->saldo_anterior }}</td>
                        <td>{{ $produto->saldo_atual }}</td>
                        <td>{{ $produto->cpm_total }}</td>
                        <td>
                            <a href="" class="btn btn-light btn-sm">
                                editar
                            </a>
                            <a href="" class="btn btn-danger btn-sm">
                                excluir
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection