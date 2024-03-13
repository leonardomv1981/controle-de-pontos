@extends('index')

@section('content')
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <div class="row border-bottom">
        <div class="col-7">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                <h1 class="h2">Adicionar movimentação</h1>
            </div>
        </div>
        <div class="col-5">
            <div class="d-flex justify-content-end grid gap-3">
                <div class="p-2 g-col-6">
                    <a type="button" href="{{ route('saldos.index') }}" class="btn btn-primary btn-sm">Saldo</a>
                </div>
                <div class="p-2 g-col-6">
                    <a type="button" href="{{ route('programas.index') }}" class="btn btn-primary btn-sm">Incluir programa</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <form class="row g-3" method="POST" action="{{ route('cadastrar.produtoMilha')}}">
            @csrf
            
            <fieldset class="row mb-3">
                <legend class="col-form-label col-sm-2 pt-0">Tipo de movimentação</legend>
                <div class="col-sm-10">
                    <div class="form-check">
                    <input class="form-check-input" type="radio" data-param='{"acao": "creditoPontos"}' name="acaoMovimentacao">
                    <label class="form-check-label" for="gridRadios1">
                        Crédito de pontos
                    </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="acaoMovimentacao"  data-param='{"acao": "debitoPontos"}'>
                        <label class="form-check-label" for="gridRadios2">
                            Débito de pontos
                        </label>
                    </div>
                    <div class="form-check"> 
                        <input class="form-check-input" type="radio" name="acaoMovimentacao" data-param='{"acao": "transferenciaPontos"}'>
                        <label class="form-check-label" for="gridRadios3">
                            Transferência para outros programas
                        </label>
                    </div>
                </div>
                
                
                @if(session('error') || $errors->any())
                    <div class="alert alert-warning">
                        <span class="">
                            <strong> Houve um erro </strong>
                            @if(session('error'))
                                {{ session('error') }}
                            @endif
                            @if($errors->any())
                                {!! implode('', $errors->all('<div>:message</div>')) !!}
                            @endif
                        </span>
                    </div>
                @endif
            </fieldset>
            <div class="row" id="divMovimentacaoPontos">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </form>
    </div>
    
    
@endsection


