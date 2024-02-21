<input type="hidden" name="data[produtomilhas][operacao]" value="transferencia">
<div class="card col-md-4" style="margin-right: 15px;">
    <ul class="list-group list-group-flush">
        <li class="list-group-item">Origem</li>
    </ul>
    <div class="card-body">
        <div class="">
            <label for="id_programa_origem" class="form-label">Programa</label>
            <select  name="data[produtomilhas][origem][id_programa]" class="form-control" id="id_programa_origem">
                <option value="">SELECIONE</option>
                @foreach ($programas as $programa)
                <option name="data[produtomilhas][origem][id_programa]" class="form-control" id="id_programa" value="{{ $programa->id }}"> {{ $programa->nome }}</option>    
                @endforeach
            </select>
        </div>
        <div class="">
            <label for="pontos_operacao" class="form-label">Pontuação a transferir</label>
            <input type="number" name="data[produtomilhas][origem][pontos_operacao]" class="form-control" id="pontos_operacao">
        </div>
        <div>
            <label for="data_operacao" class="form-label">Data da operação</label>
            <input type="date" name="data[produtomilhas][origem][data_operacao]" class="form-control" id="data_operacao">
        </div>
    </div>
</div>

<div class="card col-md-4">
    <ul class="list-group list-group-flush">
        <li class="list-group-item">Destino</li>
    </ul>
    <div class="card-body">
        <div class="">
            <label for="id_programa_destino" class="form-label">Programa</label>
            <select  name="data[produtomilhas][destino][id_programa]" class="form-control" id="id_programa_destino">
                <option value="">SELECIONE</option>
                @foreach ($programas as $programa)
                <option name="data[produtomilhas][destino][id_programa]" class="form-control" id="id_programa" value="{{ $programa->id }}"> {{ $programa->nome }}</option>    
                @endforeach
            </select>
        </div>
        <div class="">
            <label for="pontos_operacao" class="form-label">Pontuação a creditar</label>
            <input type="number" name="data[produtomilhas][destino][pontos_operacao]" class="form-control" id="pontos_operacao">
        </div>
    </div>
</div>
