<!-- Form Step 2 -->
<fieldset id="fieldset_step_2"> 
  <h4>Solicitação<span>Fase 4 - 4</span></h4>
  
  <!-- DADOS BANCÁRIOS -->
  <div class="form-row">
    <div class="barra_2">Dados Bancários</div>
  </div>
  
  <!-- row -->
  <div class="form-row">
    <div class="form-group col-md-4">
      <label>Valor Solicitado: <span>*</span></label>
      <input class="form-control" type="text" name="ValorFinancido_s4" id="confirmaValorFinancido" placeholder="" value="" readonly="">
    </div>
    <div class="form-group col-md-4">
      <label>Parcelas: <span>*</span></label>
      <input class="form-control" type="text" name="Parcelas_s4" id="confirmaParcelas" placeholder="" readonly="">
    </div>
    <div class="form-group col-md-4" hidden="">
      <label>Total: <span>*</span></label>
      <input class="form-control" type="text" name="ValorTotalParcelas_s4" id="confirmaValorTotalParcelas" placeholder="" readonly="">
    </div>
  </div>

  <!-- row -->
  <div class="form-row">
    <div class="form-group col-md-8">
      <label for="">Banco</label>
      <select class="js-example-basic-multiple" name="bancoLiberacao"  id="bancoLiberacao_s4" style="width: 100%" readonly="">
        <option>bancos</option>
      </select>
    </div>
    <div class="form-group col-md-4">
      <label for="">Forma de Liberação</label>
      <select class="form-control"  name="formaLiberacao" id="formaLiberacao_s4">
        <option>ted</option>
      </select>
    </div>
  </div>

  <!-- row -->
  <div class="form-row">  
    <div class="form-group col-md-10">
      <label>Agência: <span>*</span></label>
      <input class="form-control somente_numeros" type="text" name="agenciaLiberacao" id="agenciaLiberacao_s4" placeholder="" maxlength="4" readonly="">
    </div>
    <div class="form-group col-md-2">
      <label>Dígito Agência: <span>*</span></label>
      <input class="form-control somente_numeros" type="text" name="digitoAgenciaLiberacao" id="digitoAgenciaLiberacao_s4" placeholder="" maxlength="2" readonly="">
    </div>
  </div>

  <!-- row -->
  <div class="form-row">
    <div class="form-group col-md-10">
      <label>Conta: <span>*</span></label>
      <input class="form-control somente_numeros" type="text" name="contaLiberacao" id="contaLiberacao_s4" placeholder="" maxlength="15" readonly="">
    </div>
    <div class="form-group col-md-2">
      <label>Dígito Conta: <span>*</span></label>
      <input class="form-control somente_numeros" type="text" name="digitoContaLiberacao" id="digitoContaLiberacao_s4" placeholder="" maxlength="2" readonly="">
    </div>
  </div>

  <!-- row -->
  <div class="form-row">
    <div class="form-group col-md-12">
      <label for="">Tipo de Conta</label>
      <select class="form-control" name="tipoContaLiberacao" id="tipoContaLiberacao_s4">
        <option value="1">Corrente</option>
        <option value="2">Poupança</option>
      </select>
    </div>
  </div>

  <div class="form-group col-md-12"></div>
  <div class="form-group col-md-12"></div>

  <div class="form-row">
    <div class="col-md-6 start">
      <button class="btn btn-danger" id="btn_finalizar" style="margin-top:10px;" type="button" data-toggle="modal" data-target="#modal_finalizar">Finalizar</button>&emsp;
    </div>
    <div class="col-md-3"></div>
    <div class="col-md-3 end" style="display: flex;align-items: center;justify-content: flex-end;">
      <div class="form-wizard-buttons">
        <button class="btn btn-previous" type="button">Voltar</button>
      </div>&emsp;
      <button class="btn btn-success" type="submit">Solicitar</button>
    </div>
  </div>
  
</fieldset>
<!-- Form Step 1