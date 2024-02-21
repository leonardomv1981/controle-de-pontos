@extends('index')

@section('content')
    
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <div class="d-flex justify-content-end grid gap-3">
        <div class="p-2 g-col-6">
            <a type="button" href="{{ route('programas.index') }}" class="btn btn-success float-end btn-sm">Incluir programa</a>
        </div>
        <div class="p-2 g-col-6">
            <a type="button" href="{{ route('produtoMilha.cadastrar') }}" class="btn btn-success float-end btn-sm">Incluir movimento</a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th></th>
                    <th>Programa</th>
                    <th>Saldo</th>
                    <th>Valor total</th>
                    <th>CPM total</th>
                    <th>Extrato</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($saldos as $saldo)
                    <tr>
                        <td>{{ $saldo->id }}</td>
                        <td>{{ $programas[$saldo->id_programa -1 ]->nome }}</td>
                        <td>{{ $saldo->saldo_total }}</td>
                        <td>R$: {{ str_replace('.', ',', $saldo->valor_total) }}</td>
                        <td>R$: {{ str_replace('.', ',', $saldo->cpm_total) }}</td>
                        <td>Extrato</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection


