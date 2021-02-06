<!-- Form Step 1 -->
<fieldset id="fieldset_step_1">
  <h4>Atendimento<span>Fase 1 - 4</span></h4>

  <!-- DADOS DO CLIENTE -->
  <div class="form-row">
    <div class="barra_2">Dados do Cliente</div>
  </div>

  <!-- row -->
  <div class="form-row">
    <div class="form-group col-md-8">
      <label>Empresa: <span>*</span></label>
      <input class="form-control" type="text" name="razaoSocial" id="razaoSocial" placeholder="" readonly="">
    </div> 
    <div class="form-group col-md-4">
      <label>CNPJ: <span>*</span></label>
      <input class="form-control" type="text" name="cnpj" id="cnpj" placeholder="" readonly="">
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
    <div class="form-group col-md-4">
      <label>Valor Solicitado R$ <span>*</span></label>
      <input class="form-control money" type="text" name="valorLiberacao" id="valorLiberacao" placeholder="" value="R$ 10.000,00">
    </div>
    <div class="form-group col-md-2">
      <label>Parcelas: <span>*</span></label>
      <input class="form-control" type="number" name="prazo" id="prazo" step="1" value="10">
    </div>
    <div class="form-group col-md-6">
      <label for="">Carteira</label>
      <select class="form-control"  id="carteira" name="carteira">
        <option value="104">Boleto</option>
        <option value="109">e-mail</option>
      </select>
    </div>
  </div>

  <!-- row -->
  <div class="form-row">
    <div class="form-group col-md-6">
      <label>Data Geração da Proposta <span>*</span></label>
      <input class="form-control data" type="text" name="dataInicio" id="dataInicio" placeholder="" autocomplete="off" readonly>
    </div>
    <div class="form-group col-md-6">
      <label>1º Vencimento: <span>*</span></label>&emsp;
      <span id="intervalo_datas_venc"></span>
      <input class="form-control data" type="text" name="dataPrimeiroVencimento" id="dataPrimeiroVencimento"  placeholder="" value="">
    </div>
  </div>

  <!-- row -->
  <div class="form-group col-md-12"></div>
  <div class="form-group col-md-12"></div>

  <div class="form-group col-md-12 adcional-info">
    <div class="col-md-3">
      <label>Lista de Telefones:</label>
      <ul id="lista_outros_tel" class="lista_outros_tel" style="padding-left: 10px;">
        <?php
        foreach (['00000000000', '0000000000'] as $telefone) {
          $li = '<li>'.$telefone.'</li>';
          echo $li;
        }
        ?>
      </ul>
    </div>
  </div>

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