<!-- Form Step 1 -->
<fieldset id="fieldset_step_1">
  <h4>Solicitação<span>Fase 1 - 4</span></h4>

  <!-- DADOS DO CLIENTE -->
  <div class="form-row">
    <div class="barra_2">Dados do Cliente</div>
  </div>

  <!-- row -->
  <div class="form-row">
    <div class="form-group col-md-8">
      <label>Empresa: <span>*</span></label>
      <input class="form-control" type="text" name="razao_social_s1" id="razao_social_s1" placeholder="">
    </div>

    <div class="form-group col-md-4">
      <label>CNPJ: <span>*</span></label>
      <input class="form-control" type="text" name="cnpj_s1" id="cnpj_s1" placeholder="">
    </div>
  </div>

  <div class="form-group col-md-12"></div>
  <div class="form-group col-md-12"></div>

  <!-- DADOS DA SIMULAÇÃO -->
  <div class="form-row">
    <div class="barra_2">Dados da Simulação</div>
  </div>

  <!-- row -->
  <div class="form-row">
    <div class="form-group col-md-2">
      <label>Valor Solicitado R$ <span>*</span></label>
      <input class="form-control money" type="text" name="valor_liberacao" id="valor_liberacao" placeholder="" value="R$ 10.000,00">
    </div>

    <div class="form-group col-md-2">
      <label>Parcelas: <span>*</span></label>
      <input class="form-control" type="number" name="quantidade_parcelas" id="quantidade_parcelas" step="1" value="10">
    </div>

    <div class="form-group col-md-4">
      <label>Data Geração da Proposta <span>*</span></label>
      <input class="form-control data" type="text" name="dataInicio" id="dataInicio" placeholder="" autocomplete="off" readonly>
    </div>

    <div class="form-group col-md-4">
      <label>1º Vencimento: <span>*</span></label>&emsp;
      <span id="intervalo_datas_venc"></span>
      <input class="form-control data" type="text" name="primeiro_vencimento" id="primeiro_vencimento"  placeholder="" value="">
    </div>
  </div>

   <br><br><br><br>
  <div class="form-row">
    <div class="col-md-6 start">
      <button class="btn btn-danger" style="margin-top:10px;" type="button" data-toggle="modal" data-target="#modal_finalizar">Finalizar</button>&emsp;
      <button class="btn btn-success" id="btn_simular" style="margin-top:10px;" type="button">Simular</button>
    </div>
    <div class="col-md-3"></div>
    <div class="col-md-3 end">
      <div class="form-wizard-buttons">
        <button class="btn btn-next" type="button" id="btn_proximo_step_1" _disabled="">Próximo</button>
      </div>
    </div>
  </div>
  
</fieldset>
<!-- Form Step 1 -->