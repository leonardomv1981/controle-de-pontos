<input type="hidden" name="data[produtomilhas][operacao]" value="transferencia">
<div class="card col-md-4" style="margin-right: 15px;">
    <ul class="list-group list-group-flush">
        <li class="list-group-item">Origem</li>
    </ul>
    <div class="card-body">
        <div class="">
            <label for="nome_programa_origem" class="form-label">Programa</label>
            <select  name="data[produtomilhas][origem][nome_programa]" class="form-control" id="nome_programa" value="">
                <option value="">SELECIONE</option>
                <option name="data[produtomilhas][origem][nome_programa]" class="form-control" id="nome_programa_origem" value="AA">AA</option>
                <option name="[origem][nome_programa]" class="form-control" id="nome_programa_origem"value="LATAM">LATAM</option>
                <option name="[origem][nome_programa]" class="form-control" id="nome_programa_origem" value="LIVELO">LIVELO</option>
                <option name="[origem][nome_programa]" class="form-control" id="nome_programa_origem" value="ESFERA">ESFERA</option>
                <option  name="[origem][nome_programa]" class="form-control" id="nome_programa_origem" value="SMILES">SMILES</option>
            </select>
        </div>
        <div class="">
            <label for="pontos_operacao" class="form-label">Pontuação a transferir</label>
            <input type="number" name="data[produtomilhas][origem][pontos_operacao]" class="form-control" id="pontos_operacao">
        </div>
    </div>
</div>

<div class="card col-md-4">
    <ul class="list-group list-group-flush">
        <li class="list-group-item">Destino</li>
    </ul>
    <div class="card-body">
        <div class="">
            <label for="nome_programa_origem" class="form-label">Programa</label>
            <select  name="data[produtomilhas][destino][nome_programa]" class="form-control" id="nome_programa" value="">
                <option value="">SELECIONE</option>
                <option name="data[produtomilhas][destino][nome_programa]" class="form-control" id="nome_programa_origem" value="AA">AA</option>
                <option name="data[produtomilhas][destino][nome_programa]" class="form-control" id="nome_programa_origem"value="LATAM">LATAM</option>
                <option name="data[produtomilhas][destino][nome_programa]" class="form-control" id="nome_programa_origem" value="LIVELO">LIVELO</option>
                <option name="data[produtomilhas][destino][nome_programa]" class="form-control" id="nome_programa_origem" value="ESFERA">ESFERA</option>
                <option  name="data[produtomilhas][destino][nome_programa]" class="form-control" id="nome_programa_origem" value="SMILES">SMILES</option>
            </select>
        </div>
        <div class="">
            <label for="pontos_operacao" class="form-label">Pontuação a creditar</label>
            <input type="number" name="data[produtomilhas][destino][pontos_operacao]" class="form-control" id="pontos_operacao">
        </div>
    </div>
</div>
