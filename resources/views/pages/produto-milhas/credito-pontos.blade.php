<input type="hidden" name="data[produtomilhas][operacao]" value="credito">
<div class="col-md-4">

    <label for="nome_programa" class="form-label">Programa</label>
    <select  name="data[produtomilhas][id_programa]" class="form-control" id="id_programa">
        <option value="">SELECIONE</option>
        @foreach ($programas as $programa)
        <option name="data[id_programa]" class="form-control" id="id_programa" value="{{ $programa->id }}"> {{ $programa->nome }}</option>    
        @endforeach
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
    $('#valor_operacao').maskMoney({
         prefix: "R$: ",
         decimal: ",",
         thousands: "."
     });
</script>