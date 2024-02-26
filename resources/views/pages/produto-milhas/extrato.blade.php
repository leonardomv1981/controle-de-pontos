@extends('index')

@section('content')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Extrato de pontos {{ $extrato[0]->programa->nome }}</h1>
    </div>
    <div class="d-flex justify-content-end grid gap-3">
        <div class="p-2 g-col-6">
            <a type="button" href="{{ route('saldos.index') }}" class="btn btn-primary btn-sm">Saldo</a>
        </div>
        <div class="p-2 g-col-6">
            <a type="button" href="{{ route('produtoMilha.cadastrar') }}" class="btn btn-primary btn-sm">Incluir movimento</a>
        </div>
    </div>
    
    <div class="table-responsive small">

        @if ($extrato->isEmpty())
            <p> Não foi encontrado movimentações no programa selecionado </p>
        @else
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>Data da operação</th>
                        <th>Operação</th>
                        <th>Pontos da operação</th>
                        <th>Valor da operação</th>
                        <th>CPM da operação</th>
                        <th>Descrição</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($extrato as $movimentacao)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($movimentacao->data_operacao)->format('d/m/Y') }}</td>
                            <td>{{ $movimentacao->operacao }}</td>
                            <td>
                                @if ($movimentacao->operacao == 'debito')
                                    <font color="red">-{{ number_format($movimentacao->pontos_operacao, 0, '', '.') }}</font>
                                @else 
                                    {{ number_format($movimentacao->pontos_operacao, 0, '', '.') }}
                                @endif
                            </td>
                            <td>
                                {{ 'R$' . ' ' . number_format($movimentacao->valor_operacao, 2, ',', '.') }}
                            </td>
                            <td>{{ 'R$' . ' ' . number_format($movimentacao->cpm_operacao, 2, ',', '.') }}</td>
                            <td>{{ $movimentacao->observacao }}</td>
                            <td>
                                <meta name="csrf_token" content="{{ csrf_token() }}">
                                <a onclick="deleteRegistroPontos('{{ route('produto-milhas.delete') }}', '{{ $movimentacao->id }}' )" class="btn btn-outline-danger btn-sm">
                                    excluir
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection


