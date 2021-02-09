<!-- Form Step 2 -->
<fieldset id="fieldset_step_2"> 
  <h4>Solicitação<span>Fase 3 - 4</span></h4>  

  <!-- DADOS RPRESENTANTE LEGAL -->
  <div class="form-row">
    <div class="barra_2">Dados Representante Legal</div>
  </div>
  
  
  <!-- row -->
  <div class="form-row">
    <div class="form-group col-md-8">
      <label>Nome: <span>*</span></label>
      <input class="form-control" type="text" name="nome_representante" id="nome_s3" placeholder="" value="" readonly="">
    </div> 
    <div class="form-group col-md-4">
      <label>CPF: <span>*</span></label>
      <input class="form-control cpf" type="text" name="cpf_representante" id="cpf_s3" placeholder="" value="" readonly="">
    </div>
  </div>

  <!-- row -->
  <div class="form-row">
    <div class="form-group col-md-2">
      <label>Sexo: <span>*</span></label>
      <select class="form-control"  name="sexo_representante" id="sexo_s3" readonly="">
        <option value="M">Masculino</option>
        <option value="F">Feminino</option>
      </select>
    </div>
    <div class="form-group col-md-6">
      <label>Profissão: <span>*</span></label>
      <input class="form-control" type="text" name="profissao_representante" id="profissao_s3" placeholder="" value="">
    </div> 
    <div class="form-group col-md-4">
      <label>RG: <span>*</span></label>
      <input class="form-control" type="text" name="numeroDocIdentidade" id="rg_s3" placeholder="" value="" readonly="">
    </div>
  </div>

  <!-- row -->

  <div class="form-row">
    <div class="form-group col-md-2">
      <label for="">Estado Civil</label>
      <select class="form-control" name="estadoCivil" id="estadoCivil_s3" readonly="">
        <?php
        foreach ([] as $v) {
          echo '<option value="'.$v->descricao.'">'.$v->descricao.'</option>';
        }
        ?>
      </select>
    </div>
    <div class="form-group col-md-10">
      <label>Mãe: <span>*</span></label>
      <input class="form-control" type="text" name="nomeMae" id="mae_s3" placeholder="" value="">
    </div> 
  </div>

  <!-- row -->
  <div class="form-row">
    <div class="form-group col-md-6">
      <label>Endereço: <span>*</span></label>
      <input class="form-control" type="text" name="enderecoResidencial" id="endereco_s3" placeholder="" value="" readonly="">
    </div> 
    <div class="form-group col-md-2">
      <label>Número: <span>*</span></label>
      <input class="form-control somente_numeros" type="text" name="numeroResidencial" id="numero_s3" placeholder="" value="" readonly="">
    </div>
    <div class="form-group col-md-4">
      <label>Complemento: <span>*</span></label>
      <input class="form-control" type="text" name="complementoResidencial" id="complemento_s3" placeholder="" value="" readonly="">
    </div>
  </div>

  <!-- row -->
  <div class="form-row">
    <div class="form-group col-md-4">
      <label>CEP: <span>*</span></label>
      <input class="form-control cep" type="text" name="cepResidencial" id="cep_s3" minlength="9" placeholder="" value="" readonly="">
    </div> 
    <div class="form-group col-md-8">
      <label>Bairro: <span>*</span></label>
      <input class="form-control" type="text" name="bairroResidencial" id="bairro_s3" placeholder="" value="" readonly="">
    </div>
  </div>
  
  <!-- row -->
  <div class="form-row">
    <div class="form-group col-md-5">
      <label>UF: <span>*</span></label>
      <input class="form-control" type="text" name="ufResidencial" id="uf_s3" placeholder="" value="" readonly="">
    </div>


    <div class="form-group col-md-7">
      <label>Cidade: <span>*</span></label>
      <input class="form-control" type="text" name="cidadeResidencial" id="cidadeResidencial" placeholder="" value="" readonly="">
    </div>
  </div>

  <!-- row -->
  <div class="form-row">
    <div class="form-group col-md-4">
      <label>Telefone Pessoal: <span>*</span></label>
      <input class="form-control celular" type="text" name="celular" id="telefonePessoal_s3" placeholder="" value="" readonly="">
    </div>
    <div class="form-group col-md-8">
      <label>e-mail: <span>*</span></label>
      <input class="form-control" type="email" name="enderecoEmail" id="email_s3" placeholder="" value="" readonly="">
    </div>
  </div>

  <!-- row -->
  <div class="form-row">
    <div class="form-group col-md-12">
      <label for="Pessoa_Politicamente_Exp">
        <input value="1" type="checkbox" name="Pessoa_Politicamente_Exp"  id="Pessoa_Politicamente_Exp">
        Pessoa Políticamente Exposta
      </label>
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-12">
      <input placeholder="Cargo" type="text" class="form-control" name="Cargo_Pess_Politicamente_Exp" id="Cargo_Pess_Politicamente_Exp">
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-12">
      <label for="Parente_Politicamente_Exp">
        <input value="1" type="checkbox" name="Parente_Politicamente_Exp"  id="Parente_Politicamente_Exp">
        Parente Politicamente exposto
      </label>
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-12">
      <input placeholder="Cargo" type="text" class="form-control" name="Cargo_Par_Politicamente_Exp" id="Cargo_Par_Politicamente_Exp">
    </div>
  </div>

  
  <div class="form-group col-md-12"></div>
  <div class="form-group col-md-12"></div>

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
<!-- Form Step 3 -->