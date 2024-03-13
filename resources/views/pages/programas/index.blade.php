@extends('index')

@section('content')
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <div class="row border-bottom">
        <div class="col-7">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                <h1 class="h2">Adicionar programa</h1>
            </div>
        </div>
        <div class="col-5">
            <div class="d-flex justify-content-end grid gap-3">
                <div class="p-2 g-col-6">
                    <a type="button" href="{{ route('saldos.index') }}" class="btn btn-primary btn-sm">Saldo</a>
                </div>
                <div class="p-2 g-col-6">
                    <a type="button" href="{{ route('produtoMilha.cadastrar') }}" class="btn btn-primary btn-sm">Incluir movimento</a>
                </div>
            </div>
        </div>
    </div>
    

    <div class="row">
        <form class="row g-3" method="POST" action="{{ route('programas.cadastrar')}}">
            @csrf
            
            <fieldset class="row mb-3">
                <div class="col-sm-5">
                    <div class="form-check">
                        <label for="nomePrograma" class="form-label">Nome do programa*</label>
                        <input type="text" name="data[programas][nome]" class="form-control" placeholder="Nome do programa" required id="nomePrograma" required>
                    </div>
                </div>
                @if($errors->any())
                    <div class="alert alert-warning">
                        <span class="">
                            <strong> Houve um erro </strong>
                            {!! implode('', $errors->all('<div>:message</div>')) !!}
                        </span>
                    </div>
                @endif
            </fieldset>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </form>
    </div>
    
    
@endsection


