<input type="hidden" name="data[produtomilhas][operacao]" value="debito">
<div class="col-md-4">
    <label for="nome_programa" class="form-label">Programa</label>
    <select  name="data[produtomilhas][nome_programa]" class="form-control @error('nome_programa') é invalido @enderror" id="nome_programa" value="">
                <option value="">SELECIONE</option>
                <option name="data[nome_programa]" class="form-control" id="nome_programa" value="AA">AA</option>
                <option name="data[nome_programa]" class="form-control" id="nome_programa"value="LATAM">LATAM</option>
                <option name="data[nome_programa]" class="form-control" id="nome_programa" value="LIVELO">LIVELO</option>
                <option name="data[nome_programa]" class="form-control" id="nome_programa" value="ESFERA">ESFERA</option>
                <option  name="data[nome_programa]" class="form-control" id="nome_programa" value="SMILES">SMILES</option>
            </select>
</div>
<div class="col-md-4">
    <label for="pontos_operacao" class="form-label">Pontuação a debitar</label>
    <input type="number" name="data[produtomilhas][pontos_operacao]" class="form-control" id="pontos_operacao">
</div>
<div class="col-md-4">
    <label for="data_operacao" class="form-label">Data da operação</label>
    <input type="date" name="data[produtomilhas][data_operacao]" class="form-control" id="data_operacao">
</div>
<div class="col-md-4">
    <label for="observacao" class="form-label">observação</label>
    <input type="text" name="data[produtomilhas][observacao]" class="form-control" id="observacao">
</div>