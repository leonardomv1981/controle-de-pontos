@extends('index')

@section('content')
    
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <div class="row border-bottom">
        <div class="col-7">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                <h1 class="h2">Saldos</h1>
            </div>
        </div>
        <div class="col-5">
            <div class="d-flex justify-content-end grid gap-3">
                <div class="p-2 g-col-6">
                    <a type="button" href="{{ route('programas.index') }}" class="btn btn-primary btn-sm">Incluir programa</a>
                </div>
                <div class="p-2 g-col-6">
                    <a type="button" href="{{ route('produtoMilha.cadastrar') }}" class="btn btn-primary btn-sm">Incluir movimento</a>
                </div>
            </div>
        </div>
    </div>


    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>

                    <th>Programa</th>
                    <th>Saldo</th>
                    <th>Valor total</th>
                    <th>CPM total</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($findSaldos as $saldo)
                    <tr>
                        <td>{{ $saldo->programa->nome }}</td>
                        <td>{{ number_format($saldo->saldo_total, 0, '', '.') }}</td>
                        <td>R$: {{ number_format($saldo->valor_total, 2, ',', '.') }}
                        </td>
                        <td>R$: {{ str_replace('.', ',', $saldo->cpm_total) }}</td>
                        <td>
                            <a href="{{ route('produtoMilha.extrato') }}?programa={{ $saldo->programa->id }}" class="btn btn-outline-primary btn-sm">
                                Extrato
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection


