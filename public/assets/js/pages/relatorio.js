var teste = 0; 

$(document).ready(function() {   
  createDataTables('#default_table_relatorio');

});

function select_all_columns(){
    if($('#check-all').is(':checked')){
      checkState = 'all';
      countChecked();
    }else{
      checkState = 'none';
      countChecked();
    }
}

function createDataTables(idTable){

	var buttonCommon = {
    exportOptions: {
      format: {
        body: function ( data, row, column, node ) {
          if(data.includes('R$')){
            data = data.replace( /[R$.]/g, '' );
            data = data.replace( /[,]/g, '.' );
            if(data.includes('-')){
              data = data.replace( /[ ]/g, '' );
            }
          }
          
          if(data.includes('<i hidden="">')){
            data = data.substring(13, data.length);
            
            vet  = data.split('<');
            data = vet[0];
          }else if(data.includes('<')){
            data = '';
          }

          return data;
        }
      }
    }
  };

  $(idTable).DataTable({
    "language": {
      "url": base_url + "/system/datatables/js/utils/DataTable-Portuguese-Brasil.json"
    },
    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Tudo"]],
    dom: 'Blfrtip',
    'scrollY': false,
    'scrollX': true,
    buttons: [
      $.extend( true, {}, buttonCommon, {
        extend: 'excel',
        className: 'btn btn-outline-primary',
        text: '<i class="c-black-500 ti-import"></i> &nbsp;EXCEL',
        filename: 'relatorio',
        title: 'Relatório',
        pageSize: 'LEGAL'
      } ),
      {
        extend: 'pdfHtml5',
        className: 'btn btn-outline-primary',
        text: '<i class="c-black-500 ti-import"></i> &nbsp;PDF',
        orientation: 'landscape',
        filename: 'relatorio',
        title: 'Relatório',
        orientation: 'landscape',
        pageSize: 'A4',
      },
      $.extend( true, {}, buttonCommon, {
        extend: 'csv',
        className: 'btn btn-outline-primary',
        text: '<i class="c-black-500 ti-import"></i> &nbsp;CSV',
        filename: 'relatorio',
        title: 'Relatório'
      } ),
    ]
  });
  
}

$("#status_modal_info_contrato").click(function(){
  console.log('here');
  $("#Motivo_Cancelado").attr('readonly', true);
  $("#Motivo_Pendente").attr('readonly', true);

  let valor = $(this).val();  
  
  if(valor==8){
    $("#Motivo_Cancelado").attr('readonly', false);
  }else if(valor==7){
    $("#Motivo_Pendente").attr('readonly', false);
  }
});


$("#status_modal_selecionados").click(function(){
  console.log('here');
  $("#Motivo_Cancelado_Selecionados").attr('readonly', true);
  $("#Motivo_Pendente_Selecionados").attr('readonly', true);

  let valor = $(this).val();  
  
  if(valor==8){
    $("#Motivo_Cancelado_Selecionados").attr('readonly', false);
  }else if(valor==7){
    $("#Motivo_Pendente_Selecionados").attr('readonly', false);
  }
});

function alterar_status_contrato(status = null, id_proposta = null){
  observacao = '';
  if(status == 8){
    observacao = $("#Motivo_Cancelado_Selecionados").val();
  }else if(status == 7){
    observacao = $("#Motivo_Pendente_Selecionados").val();
  }

  data_inicio = $("#data_inicio").val();
  texto_correcao = null;

  if(id_proposta == null){
    status = 11;//$("#status_modal_info_contrato").find(":selected").val();
    // motivo_pendente = $("#Motivo_Pendente").val();
    // motivo_cancelado = $("#Motivo_Cancelado").val();
    texto_correcao = $("#Texto_Correcao").val();
    id_proposta = $("#id_proposta_madal_info_proposta").val();
  }
  // console.log($("#id_proposta_madal_info_proposta").val());
  // console.log(id_proposta);
  // console.log(status);

  $.post(base_url + "/contrato/altera_status_contrato",{
    id_proposta : id_proposta,
    status: status,
    observacao: observacao,
    texto_correcao: texto_correcao,
    // dataInicio: data_inicio
  },function(data){
    console.log(data);
    if(data.code == 200){
      swal({
        title: 'Status Alterado com Sucesso!',
        icon: 'success'
      }).then((result) => {
        if (result.value) {
          location.reload();
        }
      });
      define_layot_td_status(id_proposta, status);
      $("#alteracao_status_"+id_proposta).html(data.data_alteracao_status);
      if(data.contrato != ''){
        $("#n_contrato_"+id_proposta).html(data.contrato);
        $("#emissao_"+id_proposta).html(data.data_remessa_contrato);
      }
    }else{
      swal({
        title: data.message,
        icon: 'error'
      })
    }
  },
  'json');
}

function alterar_status_contratos_selecionados(){
  console.log(teste);
  teste +=1;
  
  status = $("#status_modal_selecionados").find(":selected").val();

  $(".bulk_action input[name='table_records']:checked").each(function(){
    contrato = $(this).attr('id');
    console.log(contrato);
    alterar_status_contrato(status, contrato);
  });

  if($('#check-all').is(':checked'))
    $("#check-all").click();
}



function info_contrato(id_proposta){
  // $('#btn_alterar_status').prop('disabled', true);

  $("#Motivo_Cancelado_Selecionados").attr('readonly', true);
  $("#Motivo_Cancelado").attr('readonly', true);
  $("#Motivo_Pendente_Selecionados").attr('readonly', true);
  $("#Motivo_Pendente").attr('readonly', true);

  $('#info_proposta_modal').modal('show');
  $('#id_proposta_madal_info_proposta').val(id_proposta);
  $.post(base_url + "/contrato/info_log_contrato",{
    id_proposta : id_proposta
  }, function(data){
    console.log(contrato);
    if(data.dados!=null){
      set_dados_modal_contrato(data.dados);
    }
  },
  'json');
}

function set_dados_modal_contrato(dados){
  console.log(dados);
  // console.log(permissoes);
  // console.log(!permissoes.includes(211));
  if(dados.status!=7&&dados.status!=11||!(permissoes.includes(211))){
    $("#footer_dados_contrato_modal").attr('hidden', true);
    $("#Texto_Correcao").attr('readonly', true);
  }else{
    $("#footer_dados_contrato_modal").attr('hidden', false);
    $("#Texto_Correcao").attr('readonly', false);
  }
  $("#status_modal_info_contrato").val(dados.Status);

  $("#Banco").val(dados.banco_liberacao);
  $("#Tipo_Conta").val(dados.tipo_conta);
  $("#Conta").val(dados.conta_liberacao);
  $("#Digito_Conta").val(dados.digito_conta_liberacao);
  $("#Agencia").val(dados.agencia_liberacao);
  $("#Digito_Agencia").val(dados.digito_agencia_liberacao);

  $('#Cancelado').val(dados.cancelado);
  $('#Motivo_Cancelado').val(dados.motivo_cancelado);
  $('#Pendente').val(dados.pendente);
  $('#Motivo_Pendente').val(dados.motivo_pendente);
  $('#Reenviado').val(dados.reenviado);
  $('#Corrigido').val(dados.corrigido); 
  $('#Reliberado').val(dados.reliberado);
  $('#Pago').val(dados.pago);
  $('#Enviado_Banco').val(dados.enviado_banco);
  $('#Liberado').val(dados.liberado);
  $('#Conferido').val(dados.conferido);
  $('#Conferencia').val(dados.conferencia);
  $('#Assinado').val(dados.data_aceite_2);
  $('#Envio_SMS').val(dados.data_envio_sms);
  $('#Data_Geracao').val(dados.data_geracao_proposta);
  
  $('#CPF').val(dados.cpf_beneficiario);
  $('#NomeCliente').val(dados.nome_beneficiario);  
  $('#Analista').val(dados.atendente);  
  $('#Celular').val(dados.celular);
  $('#Protocolo').val(dados.protocolo);
  $("#Texto_Correcao").val(dados.texto_correcao);
  
  $('#Contrato_modal').val(dados.proposta);
}

function define_layot_td_status(id, _status){
  console.log(id);
  let status = '';
  let color = '#424242';
  let text_color = 'white';
  // console.log(_status);
  switch (parseInt(_status)) {
    case 0:
      status = 'Não Assinado';
      color = '#800000';
      break;
    case 1:
      status = 'Assinou o 1°';
      color = '#800000';
      break;
    case 2:
      status = 'Assinado';
      color = '#C9C9C9';
      text_color = 'black';
      break;
    case 3:
      status = 'Conferido';
      color = '#FFFF00';
      text_color = 'black';
      break;
    case 4:
      status = 'Liberado';
      color = '#FDFFA7';
      text_color = 'black';
      break;
    case 5:
      status = 'Enviado banco';
      color = '#A9D08E';
      text_color = 'black';
      break;
    case 6:
      status = 'Pago';
      color = '#375623';
      break;
    case 7:
      status = 'Pendente';
      color = '#FF6969';
      break;
    case 8:
      status = 'Cancelado';
      color = '#FF0000';
      break;
    case 9:
      status = 'Reenviado';
      color = '#203764';
      break;
    case 10:
      status = 'Reliberado';
      color = '#305096';
      break;
    case 11:
      status = 'Corrigido';
      color = '#B4C6E7';
      text_color = 'black';
      break;
    case 12:
      status = 'Em Conferência';
      color = '#F7BE81';
      text_color = 'black';
      break; 
    case 13:
      status = 'Conferência de Fraude';
      color = '#FFBF00';
      text_color = 'black';
      break;
    case 14:
      status = 'Pré-Cancelamento';
      color = '#F78181';
      text_color = 'black';
      break;
    default:
      status = ' - ';
      break;

  }
  span = $("#_span"+id);
  span.html(status);
  // console.log(span);
  document.getElementById("_td"+id).style.backgroundColor = color;
  // console.log(color);
  span.css("color", text_color);
  // console.log(span);
  // $("#_td"+id)

}
