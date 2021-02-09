<!-- Form Step 1 -->
<fieldset id="fieldset_step_1">
  <h4>Solicitação<span>Fase 2 - 4</span></h4>

  <!-- DADOS DA EMPRESA -->
  <div class="form-row">
    <div class="barra_2">Dados da Empresa</div>
  </div>
  
  <!-- row -->
  <div class="form-row">
    <div class="form-group col-md-8">
      <label>Razão Social: <span>*</span></label>
      <input class="form-control" type="text" name="razao_social" id="razao_social_s2" placeholder="">
    </div>

    <div class="form-group col-md-4">
      <label>CNPJ: <span>*</span></label>
      <input class="form-control" type="text" name="cnpj" id="cnpj_s2" placeholder="" readonly="">
    </div>
  </div>

  <!-- row -->
  <div class="form-row">
    <div class="form-group col-md-8">
      <label>Nome Fantasia: <span>*</span></label>
      <input class="form-control" type="text" name="nome_fantasia" id="nome_fantasia_s2" placeholder="">
    </div>

    <div class="form-group col-md-4">
      <label>Inscrição Estadual: <span>*</span></label>
      <input class="form-control" type="text" name="inscricao_estadual" id="inscricao_estadual_s2" placeholder="">
    </div>
  </div>

  <!-- row -->
  <div class="form-row">
    <div class="form-group col-md-4">
      <label>Tipo de Empresa: <span>*</span></label>
      <input class="form-control" type="text" name="tipo_empresa" id="tipo_empresa_s2" placeholder="">
    </div> 

    <div class="form-group col-md-4">
      <label>Ramo de Atividade: <span>*</span></label>
      <input class="form-control" type="text" name="ramo_atividade" id="ramo_atividade_s2" placeholder="">
    </div>

    <div class="form-group col-md-4">
      <label>Rendimento Mensal: <span>*</span></label>
      <input class="form-control money_meia_boca" type="text" name="rendimento_mensal" id="rendimento_mensal_s2" placeholder="" value="1000">
    </div>
  </div>
  
  <!-- DADOS DE ENDEREÇO DA EMPRESA -->
  <div class="form-row">
    <div class="barra_2">Endereço / Contato</div>
  </div>

  <!-- row -->
  <div class="form-row">
    <div class="form-group col-md-2">
      <label>CEP: <span>*</span></label>
      <input class="form-control cep" type="text" name="cep" id="cep_s2" minlength="9" placeholder="" value="">
    </div> 

    <div class="form-group col-md-2">
      <label>UF: <span>*</span></label>
      <select class="form-control" name="uf" id="uf_s2" readonly="">
        <?php
        foreach ([] as $v) {
          $selected = '';
          // if($v->codigo == $cliente->UFRG){
          //   $selected = 'selected=""';
          // }
          echo '<option value="'.$v->codigo.'" '.$selected.'>'.$v->descricao.'</option>';
        }
        ?>
      </select>
    </div>

    <div class="form-group col-md-4">
      <label>Cidade: <span>*</span></label>
      <input class="form-control" type="text" name="cidade" id="cidade_s2" placeholder="" value="" readonly="">
    </div>

    <div class="form-group col-md-4">
      <label>Bairro: <span>*</span></label>
      <input class="form-control" type="text" name="bairro" id="bairro_s2" placeholder="" value="">
    </div>
  </div>

  <!-- row -->
  <div class="form-row">
    <div class="form-group col-md-6">
      <label>Endereço: <span>*</span></label>
      <input class="form-control" type="text" name="logradouro" id="logradouro_s2" placeholder="" value="">
    </div>

    <div class="form-group col-md-2">
      <label>Número: <span>*</span></label>
      <input class="form-control somente_numeros" type="text" name="numero" id="numero_s2" placeholder="" value="">
    </div>

    <div class="form-group col-md-4">
      <label>Complemento: <span>*</span></label>
      <input class="form-control" type="text" name="complemento" id="complemento_s2" placeholder="" value="">
    </div>
  </div>

  <!-- row -->
  <div class="form-row">
    <div class="form-group col-md-4">
      <label>Telefone Empresa: <span>*</span></label>
      <input class="form-control celular" type="text" name="telefone" id="telefone_s2" placeholder="" value="">
    </div>
    <div class="form-group col-md-8">
      <label>e-mail: <span>*</span></label>
      <input class="form-control" type="email" name="email" id="email_s2" placeholder="" value="">
    </div>
  </div>
  
  <!-- ARQUIVOS CONTRTAO SOCIAL -->
  <div class="form-row">
    <div class="barra_2">Arquivos Contrato Social</div>
  </div>
  
  <!-- row -->
  <div class="form-row">
    <div class="form-group col-md-10" style="margin-top: 20px;">
      <label class="_detac">Contrato Social: <span></span></label>
      <input type="file" class="form-control-file" name="file_0" id="file_0">
    </div>

    <div class="form-group col-md-2" style="margin-top: 40px;">
      <label>&emsp;</label><br>
      <button class="btn btn-danger btn_remove_doc _end" type="button" value="0" disabled="">Remover</button>
    </div>
  </div>

  <div id="documentos"></div>

  <div class="form-row">
    <div class="form-group col-md-12" style="margin-top: 60px;">
      <button class="btn btn-primary _end" type="button" id="btn_add_doc">Novo</button>
    </div>
  </div>

  <!-- DADOS DOS SÓCIOS -->
  <div class="form-row">
    <div class="barra">Sócios&emsp;<span style="font-size: 15px;">(inclusive o próprio represenatante legal)</span></div>
  </div>
  
  <!-- row -->
  <div class="form-row">
    <div class="form-group col-md-4">
      <label>Nome: <span>(representante)*</span></label>
      <input type="text" class="form-control" name="nomeSocio_0" id="nomeSocio_0" value="">
    </div>

    <div class="form-group col-md-2">
      <label>CPF: <span>*</span></label>
      <input type="text" class="form-control cpf" name="cpf_0" id="cpf_0" value="">
    </div>

    <div class="form-group col-md-2">
      <label>N° RG: <span>*</span></label>
      <input type="text" class="form-control" name="rg_0" id="rg_0" value="">
    </div>

    <div class="form-group col-md-2">
      <label>Sexo: <span>*</span></label>
      <select class="form-control"  name="sexo_0" id="sexo_0">
        <option value="M">Masculino</option>
        <option value="F">Feminino</option>
      </select>
    </div>
    <div class="form-group col-md-2">
      <label>&emsp;</label><br>
      <button class="btn btn-danger btn_remove_socio _end" type="button" value="0" disabled="">Remover</button>
    </div>
  </div>

  <div class="form-row">    
    <div class="form-group col-md-6">
      <label>e-mail: <span>*</span></label>
      <input type="email" class="form-control" name="email_0" id="email_0" value="">
    </div>

    <div class="form-group col-md-4">
      <label>Celular: <span>*</span></label>
      <input type="text" class="form-control celular" name="celular_0" id="celular_0" value="">
    </div>

    <div class="form-group col-md-2">
      <label for="">Estado Civil</label>
      <select class="form-control"  id="estadoCivil_0" name="estadoCivil_0">
        <option>estadocivil</option>
      </select>
    </div>
  </div>

  <!-- row -->
  <div class="form-row">
    <div class="form-group col-md-2">
      <label>CEP: <span>*</span></label>
      <input class="form-control cep cep_endereco" type="text" name="cep_0" id="cep_0" minlength="9" placeholder="" value="">
    </div> 

    <div class="form-group col-md-2">
      <label>UF: <span>*</span></label>
      <select class="form-control" name="uf_0" id="uf_0" readonly="">
        <option>uf</option>
      </select>
    </div>

    <div class="form-group col-md-4">
      <label>Cidade: <span>*</span></label>
      <input class="form-control" type="text" name="cidade_0" id="cidade_0" placeholder="" value="" readonly="">
    </div>

    <div class="form-group col-md-4">
      <label>Bairro: <span>*</span></label>
      <input class="form-control" type="text" name="bairro_0" id="bairro_0" placeholder="" value="">
    </div>
  </div>

  <!-- row -->
  <div class="form-row">
    <div class="form-group col-md-6">
      <label>Endereço: <span>*</span></label>
      <input class="form-control" type="text" name="endereco_0" id="endereco_0" placeholder="" value="">
    </div>

    <div class="form-group col-md-2">
      <label>Número: <span>*</span></label>
      <input class="form-control somente_numeros" type="text" name="numero_0" id="numero_0" placeholder="" value="">
    </div>

    <div class="form-group col-md-4">
      <label>Complemento: <span>*</span></label>
      <input class="form-control" type="text" name="complemento_0" id="complemento_0" placeholder="" value="">
    </div>
  </div>

  <div id="socios"></div>
  
  <div class="form-group col-md-12"></div>


  <div class="form-row">
    <div class="form-group col-md-12">
      <button class="btn btn-primary _end" type="button" id="btn_add_socio">Novo</button>
    </div>
  </div>

  <br><br>  
  <div class="form-row">
    <div class="col-md-6 start">
        <button class="btn btn-danger" style="margin-top:10px;" type="button" data-toggle="modal" data-target="#modal_finalizar">Finalizar</button>&emsp;
    </div>
    <div class="col-md-3"></div>
    <div class="col-md-3 end" style="display: flex;align-items: center;justify-content: flex-end;">
        <div class="form-wizard-buttons">
          <button class="btn btn-previous" type="button">Voltar</button>
        </div>&emsp;
        <button class="btn btn-next" type="button" id="">Próximo</button>
    </div>
  </div>
  
</fieldset>
<!-- Form Step 2 -->