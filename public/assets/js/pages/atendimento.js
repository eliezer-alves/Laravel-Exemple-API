var cep_valido = true;
var validacao_celular_envio_sms = false;

$(document).ready(async function() {
	console.log(' -> init atendimento.js');
	$('html,body').scrollTop(0);
	// $(".tipo_logradouro").trigger('change');

	onload_page(true);
	await new Promise(resolve => setTimeout(resolve, 100));
	onload_page(false);

});

$("#cpf_inicio_atendimento").ready(function() {
	let cpf = $("#cpf_inicio_atendimento");
	console.log(cpf.val());
	if(cpf.length > 0 && cpf.val() != ''){
		observacoes_cliente = observacoes_cliente(cpf.val());
		console.log(observacoes_cliente);

		if(observacoes_cliente.code == 200){
			exibe_observacoes_cliente(null, observacoes_cliente);
		}
	}
});

// ESCUTAS --------------------------------------------------------------------------------------------------->

$("#btn_proximo_step_1").click(function(){
	$("#btn_proximo_step_1_avancar").click();
});

$("#btn_iniciar_atendimento_pf").click(function(){
	$.redirect(base_url+'/atendimento/pessoaFisica');
});

$(".btn_observacoes").click(function(){
	exibe_observacoes_cliente($("#cpf").val());
});

$("#btn_enviar_link_contrato").click(async function(){

	validacao_celular_envio_sms = true;	

	await historico_propostas_telefone($("#celularEnviar").val());
	let valid_celular_envio_sms = await valida_dd_celular($("#celularEnviar").val());
	if(valid_celular_envio_sms){
		enviar_link_contrato();
	}else{
		$("#usuario_modal_permitir_celular").val('');
		$("#senha_modal_permitir_celular").val('');
		$("#modal_permitir_celular").modal('show');
		return false;
	}
});


$("#btn_salvar_observacao_modal_observacoes").click(function(){
	salvar_observacao_cliente();
});

$("#btn_valida_altera_valor").click(async function(){
	onload_page(true);
	await new Promise(resolve => setTimeout(resolve, 100));
	await solicita_alterar_valor();
	onload_page(false);
});

$("#btn_valida_permitir_parcelas").click(async function(){
	onload_page(true);
	await new Promise(resolve => setTimeout(resolve, 10));
	solicita_permitir_parcela();
	onload_page(false);
});

$("#btn_valida_permitir_celular").click(async function(){
	onload_page(true);
	await new Promise(resolve => setTimeout(resolve, 10));
	solicita_permitir_celular();
	onload_page(false);
});

$("#btn_cancelar_modal_permitir_celular").click(function(){
	$("#telefone_atendimento").val('');
});

$("#dataPrimeiroVencimento").on('change', function(){
	if(valida_data()){
		parcelas_valor_solicitado();
	}
});

$("#cepResidencial").on('change', function() {
	set_endereco_cep($(this).val());
});

$("#enderecoEmail").on('change', function() {
	if($(this).val().length > 0){
		valida_clientes_mesmo_email($(this).val());
	}
});

$("#nova_observacao_modal_observacoes").on('change', function() {
	let observacao = $(this).val();
	console.log(observacao.trim());
	$(this).val(observacao.trim());
});

$("#rendaMensalAtividade_simulacao").on('change', function() {
	$("#rendaMensalAtividade").val($(this).val());
});


$("#btn_liberar_valor").click(async function(){
	onload_page(true);
	await new Promise(resolve => setTimeout(resolve, 10));

	var parms = { cpf: $(this).val() };
	var liberar_limite = await AJAX(parms, '/cliente/liberar_limite', 'POST');

	if(liberar_limite.code != 200){
		swal({
      		title: 'Houve algum problema ao liberar um valor para esse cliente!',
      		icon: 'error',
      	});
      	return;
	}
	$("#score").val(liberar_limite.resultado[0].score);
	await setLimiteLiberado(liberar_limite.resultado[0].limite);
	await parcelas_valor_solicitado();

	onload_page(false);
});


$("#btn_telefones_infomais").click(async function(){
	$("#btn_tel_infomais").prop('disabled', true);

	var parms = { Ctrl_Cliente: $(this).val() };
	var telefones_infomais = await AJAX(parms, '/cliente/telefones_infomais', 'POST');
	
	if(telefones_infomais.code == 200 && telefones_infomais.result.length <= 0){
		swal({
      		title: 'Não foi encontrado nenhum outro telefone!',
      		icon: 'error',
      	});
      	return;
	}else if(telefones_infomais.code != 200){
		swal({
      		title: 'Houve algum problema ao buscar outros telefones: '+telefones_infomais.message,
      		icon: 'error',
      	});
      	return;
	}

	setTelefonesInfomais(telefones_infomais.result);
});


$("#telefone_atendimento").on('change', async function() {
	if($("#telefone_atendimento").val().length < 13){
	    swal({
	      title: "Validação do Formulário",
	      text: 'Telefone Atendimento com formato inválido!',
	      icon: "error",
	    });
      	return;
	}
	await historico_propostas_telefone($(this).val());

	let validacao_celular = await valida_dd_celular($(this).val());

	if(!validacao_celular){
		$("#usuario_modal_permitir_celular").val('');
		$("#senha_modal_permitir_celular").val('');
		$("#modal_permitir_celular").modal('show');
	}

	$("#fone_atendimento_modal_finalizar").val($(this).val());
});


// SERVIÇOS 1° ORDEM ----------------------------------------------------------------------------------------------->
async function valida_clientes_mesmo_email(email)
{
	parms = {
		email: email
	};

	var validacao_clientes_email = await AJAX(parms, '/cliente/validaExisteEmailCliente', 'POST');

	if(validacao_clientes_email.code != 200){
		swal({title: 'Já existem regiastros com mesmo e-mail na base!', icon: 'error'});
		$("#enderecoEmail").val('');
	}
}

async function set_endereco_cep(cep)
{
	cep = cep.replace(/[^0-9.]/g, '');

	dados_endereco = await $.ajax({
		type: 'GET',
		url: 'http://viacep.com.br/ws/'+cep+'/json/'
	}).done((response)=>{
		return response;
	});

	setEnderecoCep(dados_endereco);

}

function salvar_observacao_cliente(){
	parametros = getDataSalvarObservacaoCliente();
	if(!valida_parametros(parametros))return;
	retorno = set_observacoes_cliente(parametros);

	if(retorno.code!=200){
		swal({title: 'error '+retorno.code+' '+retorno.message, icon: 'error'});
		return;
	}

	swal({title: 'Observação inserida com sucesso!', icon: 'success'});
	$("#nova_observacao_modal_observacoes").val('');

	exibe_observacoes_cliente($("#cpf").val());
}


function solicita_alterar_valor(){
	let validacaoUsuario = false;
	let permissao = 222;
	//Validar através do valor qual permissão vou verificar:

	let limiteLiberado = parseFloat($("#valorLiberado").val());
	let valorSolicitado = parseFloat($("#valorSolicitadoModal").val());

	let parametros = getDataValidaUsuarioPermissaoAlterarValor(permissao);

	if(valorSolicitado <= (limiteLiberado + 500)){
		parametros.permissao = 241;
		if(valida_usuario(parametros).code == 200){
			validacaoUsuario = true
		}else{
			parametros.permissao = 242;
			if(valida_usuario(parametros).code == 200){
				validacaoUsuario = true
			}else{
				parametros.permissao = 243;
				if(valida_usuario(parametros).code == 200){
					validacaoUsuario = true
				}
			}
		}
	}

	else if(valorSolicitado <= (limiteLiberado + 1000)){
		parametros.permissao = 242;
		if(valida_usuario(parametros).code == 200){
			validacaoUsuario = true
		}else{
			parametros.permissao = 243;
			if(valida_usuario(parametros).code == 200){
				validacaoUsuario = true
			}
		}
	}

	else if(valorSolicitado > (limiteLiberado + 1000)){
		parametros.permissao = 243;
		if(valida_usuario(parametros).code == 200){
			validacaoUsuario = true
		}
	}


	if(!valida_parametros(parametros))return;

	if(valida_usuario(parametros).code == 200){
		parms = getDataSalvarLogAlteraValor();
		parms.tipo_log = 77;
		AJAX(parms, '/atendimento/registraLogAtendimento', 'POST');

		alterar_valor(true);

		parcelas_valor_solicitado();
	}else{
		alterar_valor(false);		
	}

	$("#usuario_modal_alterar_valor").val('');
	$("#senha_modal_alterar_valor").val('');
	$("#valorSolicitado").prop("readonly", false);
}

async function solicita_permitir_parcela(){
	var parms = getDataValidaUsuarioPermissaoParcelas(223);
	if(!valida_parametros(parms))return;
	
	var valida_usuario = await AJAX(parms, '/atendimento/validaUsuarioPermissao', 'POST');
	console.log(valida_usuario);
	if(valida_usuario.code == 200){

		parms = getDataSalvarLogAlteraParcelas();
		parms.tipo_log = 78;
		await AJAX(parms, '/atendimento/registraLogAtendimento', 'POST');

		$('#modal_permitir_parcelas').modal('hide');
		$('#modal_simular').modal('show');

	}else{	

		swal({ title: 'Falha na Validação', icon: 'error', });
	}

	$("#usuario_modal_permitir_parcelas").val('');
	$("#senha_modal_permitir_parcelas").val('');
}

async function solicita_permitir_celular(){
	parms = getDataValidaUsuarioPermissaoPermitirCelular(224);
	if(!valida_parametros(parms))return;
	var valida_usuario = await AJAX(parms, '/atendimento/validaUsuarioPermissao', 'POST');
	console.log(valida_usuario);

	if(valida_usuario.code == 200){
		parms = getDataSalvarLogPermiteCelular();
		parms.tipo_log = 79;
		await AJAX(parms, '/atendimento/registraLogAtendimento', 'POST');

		permite_celular(true);
	}else{
		permite_celular(false);
	}

	$("#usuario_modal_permitir_celular").val('');
	$("#senha_modal_permitir_celular").val('');
}


function alterar_valor(autorizado){
	var message = '';
	var type = ''

	if(autorizado){
		v_slc = $('#valorSolicitadoModal').val();
		$('#cod_adm').val(null);
		$('#valorSolicitado').val(v_slc);
		valor_validado = v_slc;
		$('#btn_concluir_modal').prop('disabled', false);
		$('#btn_cancelar_modal').prop('disabled', true);
		message = 'Valor Atualizado!';
		v_slc = $('#valorSolicitadoModal').val();
		type = 'success';
		controle = 1;
	}else{
		v_lib = $('#valorLiberado').val();                
		$('#valorSolicitado').val(v_lib);
		valor_validado = v_lib;
		$('#cod_adm').val(null);
		$('#btn_concluir_modal').prop('disabled', true);
		$('#btn_cancelar_modal').prop('disabled', false);
		message = 'Falha na Validação';
		type = 'error';
	}

	if (message != ''){
		swal({ title: message, icon: type, });
	}
}

function permite_celular(autorizado){
	var message = '';
	var type = ''

	if(autorizado){
		$('#modal_permitir_celular').modal('hide');
		message = 'Celular Liberado';
		type = 'success';

		if(validacao_celular_envio_sms){
			enviar_link_contrato();
		}

	}else{
		message = 'Falha na Validação';
		type = 'error';
		// $("#celular").val($("#celular_simulacao").val());
	}

	if (message != ''){
		swal({ title: message, icon: type, });
	}
}

function enviar_link_contrato(){
	data = getDataEnviarLinkContrato();
	if(!valida_parametros(data))return;

	$("#celular_envio_sms_modal_finalizar").val(data.celularEnviar);
	$("#email_envio_sms_modal_finalizar").val(data.emailEnviar);

	$.post(
		base_url + "/contrato/enviarContrato",
		data,
		function(data){
			console.log(data);
			if(data.code != 200){
				swal({ title: data.message,	icon: 'error'});
				return;
			}
			
			swal({ title: 'Link enviado com Sucesso!',	icon: 'success'});
    	},
    	'json');
	
}



function valida_dd_celular(fone_atendimento){
	console.log(celular);
	let regexp = /[^0-9]/g;
	let dd_fone_atendimento = fone_atendimento.replace(regexp, '').substring(0,2);
	let dd_celular = $("#celular_simulacao").val().replace(regexp, '').substring(0,2);
	let dd_telefone = $("#telefone_simulacao").val().replace(regexp, '').substring(0,2);

	console.log(dd_fone_atendimento);
	console.log(dd_celular);
	console.log(dd_telefone);

	if((dd_fone_atendimento == dd_celular) || dd_fone_atendimento == dd_telefone)
		return true;

	return false;

	if(!dd_valido){
		$("#usuario_modal_permitir_celular").val('');
		$("#senha_modal_permitir_celular").val('');
		$("#modal_permitir_celular").modal('show');
		console.log('here');

	}else{
		swal({ title: response.message, icon: 'success', });
	}
}

function historico_propostas_telefone(telefone){
	console.log(telefone);
	let response = null;
	
	$.ajax({
		type: "POST",
		url: base_url + "/atendimento/historico_propostas_telefone",
		data: {
			telefone: telefone
		},
		async: false,
		success : function(data) {
			response = JSON.parse(data);
		},error : function(data) {
			response = {
				code: 417,
				message: 'Houve algum problema no processo de validação do telefone de atendimento!'
			}
		}
	});

	if(response.code == 202){
		propostas = response.result;
		console.log(propostas);
		html = '';
		for (var i = 0; i < propostas.length; i++) {
			html += ''+
			'<div class="col-12">'+
			  '<div class="x_panel">'+
			    '<div class="x_title">'+
			      '<h2>Proposta: '+propostas[i].proposta+'</h2>'+
			      '<ul class="nav navbar-right panel_toolbox">'+
			        '<li>&emsp;</li>'+
			        '<li>&emsp;</li>'+
			        '<li>&emsp;</li>'+
			        '<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>'+
			      '</ul>'+
			      '<div class="clearfix"></div>'+
			    '</div>'+
			    '<div class="x_content">'+

					'<div class="form-group">'+
						'<div class="card w_100" style="width: 18rem;">'+
						  '<div class="card-body">'+
						    '<h6 class="card-subtitle mb-2 text-muted">Atendente: '+propostas[i].atendente+'</h6></br>'+
						    '<h6 class="card-subtitle mb-2 text-muted">Data Geração: '+propostas[i].data_geracao_proposta+'</h6></br>'+
						    '<h6 class="card-subtitle mb-2 text-muted">Status:&emsp;'+propostas[i].status+'</h6></br>'+
						    '<h6 class="card-subtitle mb-2 text-muted">Cliente: '+propostas[i].nome_beneficiario+'</h6></br>'+
						    '<h6 class="card-subtitle mb-2 text-muted">CPF: '+propostas[i].cpf_beneficiario+'</h6></br>'+
						  '</div>'+
						'</div>'+
					'</div>'+

			    '</div>'+
			  '</div>'+
			'</div>';
		}
		
		$("#propostas_mesmo_telefone").html(html);
		$('#modal_historico_propostas_telefone').modal('show');
	}
}

// SERVIÇOS 2° ORDEM ------------------------------------------------------------------------------------------>

function observacoes_cliente(cpf){
	
	let response = null;
	$.ajax({
		type: "POST",
		url: base_url + "/cliente/getObservacoesCliente",
		data: {
			cpf: cpf
		},
		async: false,
		success : function(data) {
			response = JSON.parse(data);
		}
	});

	return response;
}

function valida_usuario(parametros){
	let response = null;
	$.ajax({
		type: "POST",
		url: base_url + "/atendimento/validaUsuarioPermissao",
		data: parametros,
		async: false,
		success : function(data) {
			response = JSON.parse(data);
		}
	});

	return response;
}


// GETDATA --------------------------------------------------------------------------------------------------->

function getDataSalvarObservacaoCliente(){
	error = '';
	if($("#cpf").length && $("#cpf").val() !='') cpf = $("#cpf").val(); else{ cpf = null; error += ''}
	if($("#nova_observacao_modal_observacoes").length && $("#nova_observacao_modal_observacoes").val() !='') observacao = $("#nova_observacao_modal_observacoes").val(); else{ observacao = null; error += 'Campo Observação necessário!'}

	data = {
		cpf: cpf,
		observacao: observacao,
		error: error
	}
	return data
}

function getDataEnviarLinkContrato(){
	error = '';
	if($("#confirmaContrato").length && $("#confirmaContrato").val() !='') confirmaContrato = $("#confirmaContrato").val(); else{ confirmaContrato = null; error += 'Campo Contrato necessário!'}
	if($("#emailEnviar").length && $("#emailEnviar").val() !='') emailEnviar = $("#emailEnviar").val(); else{ emailEnviar = null; error += ''}
	if($("#celularEnviar").length && $("#celularEnviar").val() !='') celularEnviar = $("#celularEnviar").val(); else{ celularEnviar = null; error += 'Campo Celular necessário!'}
	if($("#Protocolo").length && $("#Protocolo").val() !='') Protocolo = $("#Protocolo").val(); else{ Protocolo = null; error += ''}

	data = {
		confirmaContrato: confirmaContrato,
		emailEnviar: emailEnviar,
		celularEnviar: celularEnviar,
		Protocolo: Protocolo,
		chamadaAjax: true,
		error: error
	}
	return data
}

function getDataValidaUsuarioPermissaoAlterarValor(permissao){
	error = '';
	if($("#usuario_modal_alterar_valor").length && $("#usuario_modal_alterar_valor").val() !='') usuario = $("#usuario_modal_alterar_valor").val(); else{ usuario = null; error += 'Campo Usuário necessário!'}
	if($("#senha_modal_alterar_valor").length && $("#senha_modal_alterar_valor").val() !='') senha = $("#senha_modal_alterar_valor").val(); else{ senha = null; error += 'Campo Senha necessário!'}

	data = {
		identificacao: usuario,
		senha: senha,
		permissao: permissao,
		error: error
	}
	return data
}

function getDataValidaUsuarioPermissaoParcelas(permissao){
	error = '';
	if($("#usuario_modal_permitir_parcelas").length && $("#usuario_modal_permitir_parcelas").val() !='') usuario = $("#usuario_modal_permitir_parcelas").val(); else{ usuario = null; error += 'Campo Usuário necessário!'}
	if($("#senha_modal_permitir_parcelas").length && $("#senha_modal_permitir_parcelas").val() !='') senha = $("#senha_modal_permitir_parcelas").val(); else{ senha = null; error += 'Campo Senha necessário!'}

	data = {
		identificacao: usuario,
		senha: senha,
		permissao: permissao,
		error: error
	}
	return data
}

function getDataValidaUsuarioPermissaoPermitirCelular(permissao){
	error = '';
	if($("#usuario_modal_permitir_celular").length && $("#usuario_modal_permitir_celular").val() !='') identificacao = $("#usuario_modal_permitir_celular").val(); else{ identificacao = null; error += 'Campo Usuário necessário!'}
	if($("#senha_modal_permitir_celular").length && $("#senha_modal_permitir_celular").val() !='') senha = $("#senha_modal_permitir_celular").val(); else{ senha = null; error += 'Campo Senha necessário!'}

	data = {
		identificacao: identificacao,
		senha: senha,
		permissao: permissao,
		error: error
	}
	return data
}

function getDataSalvarLogAlteraValor(){
	error = '';
	if($("#usuario_modal_alterar_valor").length && $("#usuario_modal_alterar_valor").val() !='') usuario = $("#usuario_modal_alterar_valor").val(); else{ usuario = null; error += ''}
	if($("#senha_modal_alterar_valor").length && $("#senha_modal_alterar_valor").val() !='') senha = $("#senha_modal_alterar_valor").val(); else{ senha = null; error += ''}
	if($("#valorLiberado").length && $("#valorLiberado").val() !='') situacao_anterior = $("#valorLiberado").val(); else{ situacao_anterior = null; error += ''}
	if($("#valorSolicitadoModal").length && $("#valorSolicitadoModal").val() !='') situacao_atual = $("#valorSolicitadoModal").val(); else{ situacao_atual = null; error += ''}
	if($("#cpf").length && $("#cpf").val() !='') afetado = $("#cpf").val(); else{ afetado = null; error += ''}

	data = {
		usuario: usuario,
		senha: senha,
		operacao: 'Alteração de Limite',
		situacao_anterior: situacao_anterior,
		situacao_atual: situacao_atual,
		afetado: afetado,
		error: error
	}
	return data
}

function getDataSalvarLogAlteraParcelas(){
	error = '';
	if($("#usuario_modal_permitir_parcelas").length && $("#usuario_modal_permitir_parcelas").val() !='') usuario = $("#usuario_modal_permitir_parcelas").val(); else{ usuario = null; error += ''}
	if($("#senha_modal_permitir_parcelas").length && $("#senha_modal_permitir_parcelas").val() !='') senha = $("#senha_modal_permitir_parcelas").val(); else{ senha = null; error += ''}
	if($("#prazo").length && $("#prazo").val() !='') situacao_atual = $("#prazo").val(); else{ situacao_atual = null; error += ''}
	if($("#cpf").length && $("#cpf").val() !='') afetado = $("#cpf").val(); else{ afetado = null; error += ''}

	data = {
		usuario: usuario,
		senha: senha,
		operacao: 'Permissão de parcelas que excedem 30% do salário',
		situacao_anterior: 10,
		situacao_atual: situacao_atual,
		afetado: afetado,
		error: error
	}
	console.log(data);
	return data
}

function getDataSalvarLogPermiteCelular(){
	error = '';
	if($("#usuario_modal_permitircelular").length && $("#usuario_modal_permitircelular").val() !='') usuario = $("#usuario_modal_permitircelular").val(); else{ usuario = null; error += ''}
	if($("#senha_modal_permitircelular").length && $("#senha_modal_permitircelular").val() !='') senha = $("#senha_modal_permitircelular").val(); else{ senha = null; error += ''}
	// if($("#prazo").length && $("#prazo").val() !='') situacaoAnterior = $("#prazo").val(); else{ situacaoAnterior = null; error += ''}
	if($("#celular_simulacao").length && $("#celular_simulacao").val() !='') situacaoAnterior = $("#celular_simulacao").val(); else{ situacaoAnterior = null; error += ''}
	if($("#celular").length && $("#celular").val() !='') situacaoAtual = $("#celular").val(); else{ situacaoAtual = null; error += ''}
	if($("#cpf").length && $("#cpf").val() !='') afetado = $("#cpf").val(); else{ afetado = null; error += ''}

	data = {
		usuario: usuario,
		senha: senha,
		operacao: 'Permissão de celular com DDD diferente do quer está no cadastro da BrasilCard',
		situacaoAnterior: situacaoAnterior,
		situacaoAtual: situacaoAtual,
		afetado: afetado,
		error: error
	}
	return data
}



// SETDATA --------------------------------------------------------------------------------------------------->

function setLimiteLiberado(limite){
	valor_validado = limite;
	$("#valorLiberado").val(limite);
	$("#valorSolicitado").val(limite);
	$("#valorLiberado_modal_finalizar").val(limite);
	$('#valorSolicitado_modal_finalizar').val(limite);
	$("#btn_proximo_step_1").prop('disabled', true);
}

function setTelefonesInfomais(telefones){
	console.log(telefones);
	lista = '';
	for (var i = 0; i< telefones.length; i++) {
		lista += '<li>('+parseInt(telefones[i].ddd)+') '+telefones[i].numero+'</li>';
    }
    $("#lista_outros_tel").html('');
    $("#lista_outros_tel").html(lista);
}



function set_observacoes_cliente(parametros){
	let response = null;
	$.ajax({
		type: "POST",
		url: base_url + "/cliente/setObservacoesCliente",
		data: parametros,
		async: false,
		success : function(data) {
			response = JSON.parse(data);
		}
	});

	return response;
}

function setEnderecoCep(endereco){
	console.log(endereco);
	if(endereco.length == 0){		
		cep_valido = false;
		$('#ufResidencial').attr('readonly', false);

		$("#cidadeResidencial").val('');
		$('#cidadeResidencial').attr('readonly', false);
		
		$("#bairroResidencial").val('');
		$("#bairroResidencial").prop('readonly', false);	
		
		$("#logradouro").val('');
		$("#logradouro").prop('readonly', false);
		
		$("#complementoResidencial").val('');		
		$("#complementoResidencial").attr('readonly', false);
	}else{
		cep_valido = true
		
		if(endereco.uf != null && endereco.uf != ''){
			$('#ufResidencial').val(endereco.uf);
			$('#ufResidencial').attr('readonly', true).attr('data-original-value', $('#ufResidencial').val()).on('change', function(i) {
			    $(i.target).val($(this).attr('data-original-value'));
			});
		}else{
			$('#ufResidencial').attr('readonly', false);
		}

		if(endereco.localidade != null && endereco.localidade != ''){
			$("#cidadeResidencial").val(endereco.localidade);
			$("#cidadeResidencial").prop('readonly', true);
		}else{
			$("#cidadeResidencial").val('');
			$('#cidadeResidencial').attr('readonly', false);
		}

		if(endereco.bairro != null && endereco.bairro != ''){
			$("#bairroResidencial").val(endereco.bairro);
			$("#bairroResidencial").prop('readonly', true);
		}else{
			$("#bairroResidencial").val('');
			$("#bairroResidencial").prop('readonly', false);
		}

		if(endereco.logradouro != null && endereco.logradouro != ''){
			$("#logradouro").val(endereco.logradouro);
			$("#logradouro").prop('readonly', true);
		}else{
			$("#logradouro").val('');
			$("#logradouro").prop('readonly', false);
		}

		if(endereco.complemento != null && endereco.complemento != ''){
			$("#complementoResidencial").val(endereco.complemento);
			$("#complementoResidencial").attr('readonly', true);
		}else{
			$("#complementoResidencial").val('');
			$("#complementoResidencial").attr('readonly', false);
		}
	}
	$(".rgx_endereco").trigger('change');
	flag = false;
	$(".tipo_logradouro").trigger('change');
	$("#form_proposta").validate().element("#cepResidencial");
}

function exibe_observacoes_cliente(cpf, observacoes = null){
	if(observacoes == null){
		observacoes = observacoes_cliente(cpf);
	}
	observacoes = observacoes.result;
	console.log(observacoes);

	let html = 	'';
	for (var i = 0; i < observacoes.length; i++) {
		if(observacoes[i].propostas_canceladas > 0){
			html += ''+
			'<div class="form-group col-12">'+
				'<div class="card w_100" style="width: 18rem;">'+
				  '<div class="card-body">'+
				    '<h5 class="card-title">Cliente possui '+observacoes[i].propostas_canceladas+' propostas <strong style="color: red;">canceladas</strong>!</h5>'+
				  '</div>'+
				'</div>'+
			'</div>';
		}else if(observacoes[i].propostas_canceladas == -1){
			html += ''+
			'<div class="col-12">'+
			  '<div class="x_panel">'+
			    '<div class="x_title">'+
			      '<h2>'+observacoes[i].data_observacao+'</h2>'+
			      '<ul class="nav navbar-right panel_toolbox">'+
			        '<li>&emsp;</li>'+
			        '<li>&emsp;</li>'+
			        '<li>&emsp;</li>'+
			        '<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>'+
			      '</ul>'+
			      '<div class="clearfix"></div>'+
			    '</div>'+
			    '<div class="x_content">'+
			      


			'<div class="form-group">'+
				'<div class="card w_100" style="width: 18rem;">'+
				  '<div class="card-body">'+
				    '<h6 class="card-subtitle mb-2 text-muted">Autor: '+observacoes[i].atendente+'</h6>'+
				    '<br/>'+
				    '<p class="card-text" style="font-size: 18px;">'+observacoes[i].observacao+'</p>'+
				  '</div>'+
				'</div>'+
			'</div>'+

			    '</div>'+
			  '</div>'+
			'</div>';
		}
	}
	
	$("#observacoes_cliente").html(html);
	$('#modal_observacoes').modal('show')
}


$("#form_proposta").validate( {
	onkeyup: true,
	errorClass: 'text-danger',
	validClass: 'text-success',
	highlight: function (element) {
		$(element).closest('.form-group').removeClass("has-success");
		$(element).closest('.form-group').addClass("has-error");
	},
	unhighlight: function (element) {
		$(element).closest('.form-group').removeClass("has-error");
		$(element).closest('.form-group').addClass("has-success");
	},
	errorPlacement: function (error, element) {
		$(element).closest('.form-group').append(error);
	},
	rules: {
		prazo:{
			_required: true,
			_prazo: true
		},
		cepResidencial:{
			_required: true,
			_valida_cep: true	
		},
	}
});

$("#emailEnviar").on("change", async function () {
	$('#modal_avisoAlteracaoEnvioSMS').modal('show');
  });

$("#celularEnviar").on("change", async function () {
	$('#modal_avisoAlteracaoEnvioSMS').modal('show');
  });