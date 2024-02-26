@extends('index')

@section('content')
    
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <div class="d-flex justify-content-end grid gap-3">
        <div class="p-2 g-col-6">
            <a type="button" href="{{ route('programas.index') }}" class="btn btn-primary btn-sm">Incluir programa</a>
        </div>
        <div class="p-2 g-col-6">
            <a type="button" href="{{ route('produtoMilha.cadastrar') }}" class="btn btn-primary btn-sm">Incluir movimento</a>
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
                        <td>R$: {{ str_replace('.', ',', $saldo->valor_total) }}</td>
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


