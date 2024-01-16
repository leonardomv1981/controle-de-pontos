@extends('index')

@section('content')
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Adicionar movimentação</h1>
    </div>
    <div>
        <form class="row g-3">
            <fieldset class="row mb-3">
                <legend class="col-form-label col-sm-2 pt-0">Tipo de movimentação</legend>
                <div class="col-sm-10">
                    <div class="form-check">
                    <input class="form-check-input" type="radio" data-param="{'acao': 'creditoPontos'}" name="acaoMovimentacao">
                    <label class="form-check-label" for="gridRadios1">
                        Crédito de pontos
                    </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="acaoMovimentacao"  data-param="{'acao': 'debitoPontos'}">
                        <label class="form-check-label" for="gridRadios2">
                            Débito de pontos
                        </label>
                    </div>
                    <div class="form-check disabled"> 
                        <input class="form-check-input" type="radio" name="acaoMovimentacao" data-param="{'acao': 'transferenciaPontos'}">
                        <label class="form-check-label" for="gridRadios3">
                            Transferência para outros programas
                        </label>
                    </div>
                </div>
              </fieldset>
            <div class="col-md-6">

                <label for="inputEmail4" class="form-label">Email</label>
                <input type="email" class="form-control" id="inputEmail4">
            </div>
            <div class="col-md-6">
                <label for="inputPassword4" class="form-label">Password</label>
                <input type="password" class="form-control" id="inputPassword4">
            </div>
            <div class="col-12">
                <label for="inputAddress" class="form-label">Address</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
            </div>
            <div class="col-12">
                <label for="inputAddress2" class="form-label">Address 2</label>
                <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
            </div>
            <div class="col-md-6">
                <label for="inputCity" class="form-label">City</label>
                <input type="text" class="form-control" id="inputCity">
            </div>
            <div class="col-md-4">
                <label for="inputState" class="form-label">State</label>
                <select id="inputState" class="form-select">
                    <option selected>Choose...</option>
                    <option>...</option>
                </select>
            </div>
            <div class="col-md-2">
                <label for="inputZip" class="form-label">Zip</label>
                <input type="text" class="form-control" id="inputZip">
            </div>
            <div class="col-12">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck">
                    <label class="form-check-label" for="gridCheck">
                    Check me out
                    </label>
                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Sign in</button>
            </div>
        </form>
    </div>
    
    
@endsection


