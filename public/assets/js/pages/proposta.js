var valor_validado = 0;
var prazo = 0;
var proposta_gerada = false;
var contrato_gerado = false;
var idSimulacao = null;

$(document).ready(function() {
	console.log(' -> init proposta.js');
	valor_validado = parseFloat($('#valorLiberado').val());
	$('#valorSolicitado_modal_finalizar').val(valor_validado);

});

$("#fieldset_step_1").bind('change', function() {
	$('#btn_proximo_step_1').prop('disabled', true);
});

$("#btn_finalizar").click(function(){
	$('#modal_finalizar').modal('show');
});

function subimit_form(id){
	console.log(id);
	$('#'+id).submit();
}

async function parcelas_valor_solicitado(){
	let parametros = await getDataSimulacao();
	parametros.prazo = 0;
	data = await simulacao(parametros);
	setParcelasSimulacao(data.resultado);
}

async function simulacao(parametros){
	let response = null;
	await $.ajax({
		type: "POST",
		url: base_url + "/proposta/simularProposta",
		data: parametros,
		async: false,
		success : function(data) {
			response = JSON.parse(data);
		},
      	error: function(){
			swal({
				title: 'Limite liberado mas houve algum problema na API de calcular o valor das parcelas',
				icon: 'error',
			});      		
      	}
	});

	return response;
}

async function simular_proposta(){
	

	let parms = getDataSimulacao();
	if(!valida_data() || !valida_parametros(parms))return;
	
	onload_page(true);
	await new Promise(resolve => setTimeout(resolve, 100));
	
	simulacao_proposta = await AJAX(parms, '/proposta/step_1', 'POST');
	

	if(simulacao_proposta.code == 200){
		idSimulacao = simulacao_proposta.resultado['idSimulacao'];
		setDataSimulacao(simulacao_proposta.resultado);
		$("#status_modal_finalizar").val('Apenas Simulou');	
		
		if(valida_renda_parcela(simulacao_proposta.resultado)){
			$('#modal_simular').modal('show');
			$("#idSimulacao_modal_finalizar").val(idSimulacao);
		}

	}else{
		await swal({title: 'error '+simulacao_proposta.code+' Erro ao consultar API Sicred!', icon: 'error'});
		show_request_error_alerts(simulacao_proposta);
	}

	onload_page(false);
}

async function efetivar_proposta(){
	

	if (proposta_gerada) {$("#btn_proximo_step_2").click(); return;}

	let parms = getDataEfetivarProposta();
	if(!valida_data() || !valida_parametros(parms))return;
	
	onload_page(true);
	await new Promise(resolve => setTimeout(resolve, 100));
	
	console.log(parms);

	geracao_proposta = await AJAX(parms, '/proposta/step_2', 'POST');

	if(geracao_proposta.code == 200){

		$("#btn_proximo_step_2").click();
		proposta_gerada = true;
		$("html, body").scrollTop(0);
		$("#status_modal_finalizar").val('Gerou Proposta');
		$("#Proposta_modal_finalizar").val(geracao_proposta.resultado['numeroProposta']);

		swal({
			title: 'Proposta Gerada com Sucesso! Nº da Proposta: '+geracao_proposta.resultado['numeroProposta']+'!',
			icon: 'success',
		});

	}else{

		await swal({title: 'error '+geracao_proposta.code+' Erro ao consultar API Sicred!', icon: 'error'});
		show_request_error_alerts(geracao_proposta);

	}

	onload_page(false);
}

async function gerar_contrato(){
console.log('here');
	if (contrato_gerado) {$("#btn_proximo_step_3").click();return;}
	
	let parms = getDadosGeraContrato();
	if(!valida_data() || !valida_parametros(parms))return;

	onload_page(true);
	await new Promise(resolve => setTimeout(resolve, 100));

	finalizacao_proposta = await AJAX(parms, '/proposta/step_3', 'POST');
	// url = '/proposta/step_3';
	// type = 'POST';

	// finalizacao_proposta = await $.ajax({
	// 	type: type,
	// 	url: base_url + url,
	// 	data: parms,
	// 	async: false,
	// 	success : function(data) {
	// 		console.log(data);
	// 		response = JSON.parse(data);
	// 	}
	// });


	if(finalizacao_proposta.code == 200){
		setDataEnviar();
		$("#btn_proximo_step_3").click();
		$("html, body").scrollTop(0);
		contrato_gerado = true;				
		$("#status_modal_finalizar").val('Solicitou Contrato');
		$("#motivo").val('-');
		$("#motivo").attr("disabled", true); 

		readonly("#fieldset_step_2");
		readonly("#fieldset_step_3");
		console.log(finalizacao_proposta);
		$("#confirmaContrato").val(finalizacao_proposta.resultado['numeroProposta']);
		
		swal({
			title: 'Dados Bancários vinculados com sucesso! Proposta Finalizada!',
			icon: 'success',
		});
	}else{
		await swal({title: 'error '+finalizacao_proposta.code+' Erro ao consultar API Sicred!', icon: 'error'});
		show_request_error_alerts(finalizacao_proposta);
	}

	onload_page(false);
}

function readonly(id){
    $(id).children("input").each(function(){
        var re = $(this).prop('readonly'); 
        $(this).prop('readonly', true);
    });
}

function valida_renda_parcela(data){
	valor_emprestimo = parseFloat(data.totalParcelas).toFixed(2)
	valor_parcela = parseFloat(data.valorPmt).toFixed(2);
	renda = parseFloat($("#rendaMensalAtividade_simulacao").val()).toFixed(2);
	porcentagem = parseFloat((valor_parcela/renda)*100).toFixed(2);

	if(porcentagem>30){
		$("#valorEmprestimoModal").val(valor_emprestimo);
		$("#valorParcelasModal").val(valor_parcela);
		$("#rendaMensalModal").val(renda);
		$("#usuario_modal_permitir_parcelas").val('');
		$("#senha_modal_permitir_parcelas").val('');
		$('#modal_permitir_parcelas').modal('show');
		return false;
	}

	return true;

}

function valida_valor(){
	$("#valorSolicitado").prop("readonly",true);
	let v_lib = parseFloat($('#valorLiberado').val());
	let v_slc = parseFloat($('#valorSolicitado').val());
	valor_validado = v_lib;
	console.log(v_lib, v_slc);
	if(v_lib < v_slc){
		$('#valorSolicitadoModal').val(v_slc);
		$('#btn_concluir_modal').prop('disabled', true);
		$('#btn_cancelar_modal').prop('disabled', false);
		$("#usuario_modal_alterar_valor").val('');
		$("#senha_modal_alterar_valor").val('');
		$('#modal_alterar_valor').modal('show');
	}else{
		$("#valorSolicitado").prop("readonly",false);        
		$('#btn_simulacao').prop('disabled', false);
		valor_validado = v_slc;
		$('#valorSolicitado_modal_finalizar').val(valor_validado);
		parcelas_valor_solicitado();
	}
}

// ----------------------------------------------------------------------

async function liberar_limite(Ctrl_Cliente){

	onload_page(true);	
	await new Promise(resolve => setTimeout(resolve, 10));

	data = {
		Ctrl_Cliente: Ctrl_Cliente
	}
	$.post(
		base_url + "/cliente/liberar_limite",
		data,
		function(data){			
			onload_page(false);

			if(data.code!=200){			
				swal({
					title: 'error: '+data.message,
					icon: 'error',
				});
			}else{
				swal({
					title: 'Limite liberado com sucesso!',
					icon: 'success',
				});
				set_limite_liberado(data.resultado[0].Limite);
				parcelas_valor_solicitado();
			}
		},'json');
}


function cancela_alterar_valor(){
	v_lib = parseFloat($('#valorLiberado').val());
	$('#valorSolicitado').val(v_lib);
	$('#cod_adm').val(null);
	$('#btn_concluir_modal').prop('disabled', true);
	$('#btn_cancelar_modal').prop('disabled', false);
	$("#valorSolicitado").prop("readonly", false);
}

function getDataSimulacao(){
	error = '';
	if($("#tipoCliente").length && $("#tipoCliente").val() !='') tipoCliente = $("#tipoCliente").val(); else{ tipoCliente = null; error += ''}
	if($("#cpf").length && $("#cpf").val() !='') cpf = $("#cpf").val(); else{ cpf = null; error += 'Campo CPF necessário!'}
	if($("#carteira").length && $("#carteira").val() !='') carteira = $("#carteira").val(); else{ carteira = null; error += 'Campo Carteira necessário!'}
	if($("#valorSolicitado").length && $("#valorSolicitado").val() !='') valorSolicitado = $("#valorSolicitado").val(); else{ valorSolicitado = null; error += 'Campo Valor Solicitado necessário!'}
	if($("#prazo").length && $("#prazo").val() !='') prazo = $("#prazo").val(); else{ prazo = null; error += 'Campo Parcelas necessário!'}
	if($("#dataInicio").length && $("#dataInicio").val() !='') dataInicio = $("#dataInicio").val();  else{ dataInicio = null; error += 'Campo Data Inicio necessário!'}
	if($("#dataPrimeiroVencimento").length && $("#dataPrimeiroVencimento").val() !='') dataPrimeiroVencimento = $("#dataPrimeiroVencimento").val();  else{ dataPrimeiroVencimento = null; error += 'Campo Primeiro Vencimento necessário!'}
	if($("#telefone_atendimento").length && $("#telefone_atendimento").val() !='') telefone_atendimento = $("#telefone_atendimento").val();  else{ telefone_atendimento = null; error += 'Campo Telefone Atendimento necessário!'}

	data = {
		tipoCliente: tipoCliente,
		cpf: cpf,
		carteira: carteira,
		valorSolicitado: valor_validado,//valorSolicitado,
		prazo: prazo,
		dataInicio: dataInicio,
		dataPrimeiroVencimento: dataPrimeiroVencimento,
		telefone_atendimento: telefone_atendimento,
		error: error
	}
	return data
}

function getDataEfetivarProposta(){
	error = '';
	if($("#nomeCliente").length && $("#nomeCliente").val() !='') nomeCliente = $("#nomeCliente").val().toUpperCase(); else{ nomeCliente = null; error += 'Campo Nome necessário!'}
	if($("#cpf").length && $("#cpf").val() !='') cpf = $("#cpf").val(); else{ cpf = null; error += 'Campo CPF necessário!'}
	if($("#sexo").length && $("#sexo").val() !='') sexo = $("#sexo").val().toUpperCase(); else{ sexo = null; error += 'Campo Sexo necessário!'}
	if($("#dataNascimento").length && $("#dataNascimento").val() !='') dataNascimento = $("#dataNascimento").val(); else{ dataNascimento = null; error += 'Campo Nascimento necessário!'}
	if($("#idade").length && $("#idade").val() !='') idade = $("#idade").val(); else{ idade = null; error += 'Campo Idade necessário!'}
	if($("#estadoCivil").length && $("#estadoCivil").val() !='') estadoCivil = $("#estadoCivil").val().toUpperCase(); else{ estadoCivil = null; error += 'Campo Estado Civil necessário!'}
	if($("#nomeMae").length && $("#nomeMae").val() !='') nomeMae = $("#nomeMae").val().toUpperCase(); else{ nomeMae = null; error += 'Campo Mae necessário!'}
	if($("#numeroDocIdentidade").length && $("#numeroDocIdentidade").val() !='') numeroDocIdentidade = $("#numeroDocIdentidade").val(); else{ numeroDocIdentidade = null; error += 'Campo Documento necessário!'}
	if($("#tipoDocIdentidade").length && $("#tipoDocIdentidade").val() !='') tipoDocIdentidade = $("#tipoDocIdentidade").val(); else{ tipoDocIdentidade = null; error += 'Campo Tipo Documento necessário!'}
	if($("#ufDocIdentidade").length && $("#ufDocIdentidade").val() !='') ufDocIdentidade = $("#ufDocIdentidade").val().toUpperCase(); else{ ufDocIdentidade = null; error += 'Campo UF Documento necessário!'}
	if($("#logradouro").length && $("#logradouro").val() !='') logradouro = $("#logradouro").val(); else{ logradouro = null; error += 'Campo Endereco necessário!'}
	if($("#numeroResidencial").length && $("#numeroResidencial").val() !='') numeroResidencial = $("#numeroResidencial").val(); else{ numeroResidencial = null; error += 'Campo Número necessário!'}
	if($("#complementoResidencial").length && $("#complementoResidencial").val() !='') complementoResidencial = $("#complementoResidencial").val(); else{ complementoResidencial = null; error += ''}
	if($("#ufResidencial").length && $("#ufResidencial").val() !='') ufResidencial = $("#ufResidencial").val().toUpperCase(); else{ ufResidencial = null; error += 'Campo UF necessário!'}
	if($("#cidadeResidencial").length && $("#cidadeResidencial").val() !='') cidadeResidencial = $("#cidadeResidencial").val().toUpperCase(); else{ cidadeResidencial = null; error += 'Campo Cidade necessário!'}
	if($("#cepResidencial").length && $("#cepResidencial").val() !='') cepResidencial = $("#cepResidencial").val(); else{ cepResidencial = null; error += 'Campo CEP necessário!'}
	if($("#bairroResidencial").length && $("#bairroResidencial").val() !='') bairroResidencial = $("#bairroResidencial").val().toUpperCase(); else{ bairroResidencial = null; error += 'Campo Bairro necessário!'}
	if($("#profissaoAtividade").length && $("#profissaoAtividade").val() !='') profissaoAtividade = $("#profissaoAtividade").val().toUpperCase(); else{ profissaoAtividade = null; error += 'Campo Profissao necessário!'}
	if($("#nomeEmpresaAtividade").length && $("#nomeEmpresaAtividade").val() !='') nomeEmpresaAtividade = $("#nomeEmpresaAtividade").val().toUpperCase(); else{ nomeEmpresaAtividade = null; error += ''}
	if($("#rendaMensalAtividade").length && $("#rendaMensalAtividade").val() !='') rendaMensalAtividade = $("#rendaMensalAtividade").val(); else{ rendaMensalAtividade = null; error += 'Campo Renda Mensal necessário!'}
	if($("#celular").length && $("#celular").val() !='') celular = $("#celular").val(); else{ celular = null; error += 'Campo Celular necessário!'}
	if($("#telefone").length && $("#telefone").val() !='') telefone = $("#telefone").val(); else{ telefone = null; error += ''}
	if($("#telefone_atendimento").length && $("#telefone_atendimento").val() !='') telefoneAtendimento = $("#telefone_atendimento").val(); else{ telefoneAtendimento = null; error += ''}
	if($("#enderecoEmail").length && $("#enderecoEmail").val() !='') enderecoEmail = $("#enderecoEmail").val(); else{ enderecoEmail = 'default@default.com'; error += ''}
	
	if($("#tipoLogradouro").length && $("#tipoLogradouro").val() !='') tipoLogradouro = $("#tipoLogradouro").val(); else{ tipoLogradouro = null; error += 'Campo Tipo Logradouro necessário!'}
	if($("#tipoLogradouro").length && $("#tipoLogradouro").val() !='') descricaoTipoLogradouro = $("#tipoLogradouro option:selected").text(); else{ descricaoTipoLogradouro = null; error += 'Campo Tipo Logradouro necessário!'}

	data = {
		idSimulacao: idSimulacao,
		nomeCliente: nomeCliente,
		cpf: cpf,
		sexo: sexo,
		dataNascimento: dataNascimento,
		idade: idade,
		estadoCivil: estadoCivil,
		nomeMae: nomeMae,
		numeroDocIdentidade: numeroDocIdentidade,
		tipoDocIdentidade: tipoDocIdentidade,
		ufDocIdentidade: ufDocIdentidade,
		enderecoResidencial: logradouro,
		numeroResidencial: numeroResidencial,
		complementoResidencial: complementoResidencial,
		ufResidencial: ufResidencial,
		cidadeResidencial: cidadeResidencial,
		cepResidencial: cepResidencial,
		bairroResidencial: bairroResidencial,
		profissaoAtividade: profissaoAtividade,
		nomeEmpresaAtividade: nomeEmpresaAtividade,
		rendaMensalAtividade: rendaMensalAtividade,
		celular: celular,
		telefone: telefone,
		telefoneAtendimento: telefoneAtendimento,
		enderecoEmail: enderecoEmail,
		tipoLogradouro: tipoLogradouro,
		descricaoTipoLogradouro: descricaoTipoLogradouro,
		valorLimiteLiberadoBcard: parseFloat($('#valorLiberado').val()),
		score: $('#score').val(),
		error: error
	}
	return data
}

function getDadosGeraContrato(){
    error = '';
    if($("#nomeCliente").length && $("#nomeCliente").val() !='') nomeCliente = $("#nomeCliente").val().toUpperCase(); else{ nomeCliente = null; error += ''}
    if($("#cpf").length && $("#cpf").val() !='') cpf = $("#cpf").val(); else{ cpf = null; error += ''}
    if($("#bancoLiberacao").length && $("#bancoLiberacao").val() !='') bancoLiberacao = $("#bancoLiberacao").val(); else{ bancoLiberacao = null; error += 'Campo Banco necessário!'}
    if($("#formaLiberacao").length && $("#formaLiberacao").val() !='') formaLiberacao = $("#formaLiberacao").val(); else{ formaLiberacao = null; error += 'Campo Forma Liberação necessário!'}
    if($("#tipoOperacao").length && $("#tipoOperacao").val() !='') tipoOperacao = $("#tipoOperacao").val(); else{ tipoOperacao = null; error += ''}
    if($("#agenciaLiberacao").length && $("#agenciaLiberacao").val() !='') agenciaLiberacao = $("#agenciaLiberacao").val(); else{ agenciaLiberacao = null; error += 'Campo Agência necessário!'}
    if($("#contaLiberacao").length && $("#contaLiberacao").val() !='') contaLiberacao = $("#contaLiberacao").val(); else{ contaLiberacao = null; error += 'Campo Conta necessário!'}    
    if($("#digitoAgenciaLiberacao").length && $("#digitoAgenciaLiberacao").val() !='') digitoAgenciaLiberacao = $("#digitoAgenciaLiberacao").val(); else{ digitoAgenciaLiberacao = null; error += 'Campo Dígito Agência necessário!'}
    if($("#tipoContaLiberacao").length && $("#tipoContaLiberacao").val() !='') tipoContaLiberacao = $("#tipoContaLiberacao").val(); else{ tipoContaLiberacao = null; error += 'Campo Tipo de Conta necessário!'}
    if($("#carteira").length && $("#carteira").val() !='') carteira = $("#carteira").val(); else{ carteira = null; error += 'Campo Cartria necessário!'}
    if($("#digitoContaLiberacao").length && $("#digitoContaLiberacao").val() !='') digitoContaLiberacao = $("#digitoContaLiberacao").val(); else{ digitoContaLiberacao = null; error += 'Campo Dígito Conta necessário!'}
    //if($("#pessoa_politicamente_exp").length && $("#pessoa_politicamente_exp").val() !='') pessoa_politicamente_exp = $("#pessoa_politicamente_exp").val(); else{ pessoa_politicamente_exp = null; error += ''}
    if($("#cargo_pess_politicamente_exp").length && $("#cargo_pess_politicamente_exp").val() !='') cargo_pess_politicamente_exp = $("#cargo_pess_politicamente_exp").val().toUpperCase(); else{ cargo_pess_politicamente_exp = null; error += ''}
    //if($("#parente_politicamente_exp").length && $("#parente_politicamente_exp").val() !='') parente_politicamente_exp = $("#parente_politicamente_exp").val(); else{ parente_politicamente_exp = null; error += ''}
    if($("#cargo_par_politicamente_exp").length && $("#cargo_par_politicamente_exp").val() !='') cargo_par_politicamente_exp = $("#cargo_par_politicamente_exp").val().toUpperCase(); else{ cargo_par_politicamente_exp = null; error += ''}

    pessoa_politicamente_exp = 0;
    parente_politicamente_exp = 0;
    if($('#pessoa_politicamente_exp').is(':checked')){
        pessoa_politicamente_exp = 1;
    }
    if($('#parente_politicamente_exp').is(':checked')){
        parente_politicamente_exp = 1;
    }
    data = {
        nomeBeneficiario: nomeCliente,
        cpf: cpf,
        valorLiberacao: valor_validado,
        bancoLiberacao: bancoLiberacao,
        formaLiberacao: formaLiberacao,
        tipoOperacao: tipoOperacao,
        agenciaLiberacao: agenciaLiberacao,
        contaLiberacao: contaLiberacao,
        digitoAgenciaLiberacao: digitoAgenciaLiberacao,
        digitoContaLiberacao: digitoContaLiberacao,
        tipoContaLiberacao: tipoContaLiberacao,
        carteira: carteira,
        pessoa_politicamente_exp: pessoa_politicamente_exp,
        cargo_pess_politicamente_exp: cargo_pess_politicamente_exp,
        parente_politicamente_exp: parente_politicamente_exp,
        cargo_par_politicamente_exp: cargo_par_politicamente_exp,
        prazo: prazo,
        error: error        
    }
    return data
}

function setDataSimulacao(data){
	cliente = $("#nome").val();
	$("#cliente").val(cliente);
	$("#parcelas").val(parseInt(data.prazo));
	$("#valorPmt").val('R$ '+parseFloat(data.valorPmt).toFixed(2));
	$("#valorFinanciado").val('R$ '+parseFloat(data.valorSolicitado).toFixed(2));
	$("#confirmaValorFinancido").val('R$ '+parseFloat(data.valorSolicitado).toFixed(2));
	$("#totalParcelas").val('R$ '+parseFloat(data.totalParcelas).toFixed(2));
	$("#confirmaValorTotalParcelas").val('R$ '+parseFloat(data.totalParcelas).toFixed(2));
	$("#confirmaParcelas").val(parseInt(data.prazo)+'X de R$ '+parseFloat(data.valorPmt).toFixed(2));
	$("#idSimulacao_modal_finalizar").val(data.idSimulacao);
	prazo = parseInt(data.prazo);
	
}

function setParcelasSimulacao(data){
	let html = '';
	let espaco = '';
	let checked = '';
	$("#valorFinanciado").val(data[0].valorSolicitado);
	for (var i = 0; i <= data.length - 1; i++) {
		if(i==0){
			checked = 'checked';
		}else{
			checked = '';
		}
		if(i<9){
			espaco = ' &nbsp;&nbsp;';
		}else{
			espaco = ' ';
		}

		html +=
		'<div class="col-md-3 form-check _resultado_simulacao">'+
          '<label class="form-check-label">'+
            data[i].prazo+'X'+espaco+'de R$ '+parseFloat(data[i].valorParcela).toFixed(2)+
          '</label>'+
        '</div>';
	}
	html += '<div class="form-group col-md-12"></div><div class="row _separator_line"></div>';
	$("#resultado_simulacao").html(html);
}

function _setDataSimulacao(data){
	console.log(data);
	cliente = $("#nome").val();
	$("#cliente").val(cliente);
	$("#parcelas").val(parseInt(data.prazo));
	$("#valorPmt").val('R$ '+parseFloat(data.valorPmt).toFixed(2));
	$("#valorFinanciado").val('R$ '+parseFloat(data.valorSolicitado).toFixed(2));
	$("#confirmaValorFinancido").val('R$ '+parseFloat(data.valorSolicitado).toFixed(2));
	$("#totalParcelas").val('R$ '+parseFloat(data.totalParcelas).toFixed(2));
	$("#confirmaValorTotalParcelas").val('R$ '+parseFloat(data.totalParcelas).toFixed(2));
	$("#confirmaParcelas").val(parseInt(data.prazo)+'X de R$ '+parseFloat(data.valorPmt).toFixed(2));

	$("#valorSolicitado_modal_finalizar").val(parseFloat(data.valorSolicitado).toFixed(2));
	$("#idSimulacao_modal_finalizar").val(data.idSimulacao);
	$("#status_modal_finalizar").val('Apenas Simulou');
	prazo = parseInt(data.prazo);
}

function setDataEnviar(){
	console.log(data);
	email = $("#enderecoEmail").val();
	cpf = $("#cpf").val();
	celular = $("#celular").val();
	$("#confirmaCpf").val(cpf);
	$("#emailEnviar").val(email);
	$("#celularEnviar").val(celular);
}

function confirma_simulacao(){
	$('#btn_proximo_step_1').prop('disabled', false);
}

async function show_request_error_alerts(data){
	for(i = 0; i < data.resultado.length; i++){		
		await swal({
			title: data.resultado[i].message,
			icon: 'error',
		});			
	}
}