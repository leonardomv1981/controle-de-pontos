@extends('index')

@section('content')
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Adicionar programa</h1>
    </div>
    

    <div>
        <form class="row g-3" method="POST" action="{{ route('cadastrar.programas')}}">
            @csrf
            
            <fieldset class="row mb-3">
                <div class="col-sm-5">
                    <div class="form-check">
                        <label for="nomePrograma" class="form-label">Pontuação a creditar</label>
                        <input type="text" name="data[programas][nome]" class="form-control" placeholder="Nome do programa" required id="nomePrograma">
                    </div>
                    <div class="form-check">
                        <label for="descricao" class="form-label">Descrição</label>
                        <input type="text" name="data[programas][descricao]" class="form-control" placeholder="Descrição" id="descricao">
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


