<input type="hidden" name="data[produtomilhas][operacao]" value="credito">
<div class="col-md-4">
    <label for="nome_programa" class="form-label">Programa</label>
    <select  name="data[produtomilhas][nome_programa]" class="form-control" id="nome_programa" value="">
                <option value="">SELECIONE</option>
                <option name="data[nome_programa]" class="form-control" id="nome_programa" value="AA">AA</option>
                <option name="data[nome_programa]" class="form-control" id="nome_programa"value="LATAM">LATAM</option>
                <option name="data[nome_programa]" class="form-control" id="nome_programa" value="LIVELO">LIVELO</option>
                <option name="data[nome_programa]" class="form-control" id="nome_programa" value="ESFERA">ESFERA</option>
                <option  name="data[nome_programa]" class="form-control" id="nome_programa" value="SMILES">SMILES</option>
            </select>
</div>
<div class="col-md-4">
    <label for="pontos_operacao" class="form-label">Pontuação a creditar</label>
    <input type="number" name="data[produtomilhas][pontos_operacao]" class="form-control" id="pontos_operacao">
</div>
<div class="col-md-4">
    <label for="valor_operacao" class="form-label" >Valor gasto</label>
    <input name="data[produtomilhas][valor_operacao]" class="form-control Inputmask"  id="valor_operacao">
</div>
<div class="col-md-4">
    <label for="data_operacao" class="form-label">Data da operação</label>
    <input type="date" name="data[produtomilhas][data_operacao]" class="form-control" id="data_operacao">
</div>
<div class="col-md-4">
    <label for="observacao" class="form-label">observação</label>
    <input type="text" name="data[produtomilhas][observacao]" class="form-control" id="observacao">
</div>

<script> 
    $('#valor_operacao').inputmask('R$ 99.999,99', { numericInput: true });
</script>