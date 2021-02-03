var numeroSocios = -1;
var numeroDocumentos = 0;
var numeroDocumentosAddAnalise = 0;

$(document).ready(function() {
	console.log(' -> init proposta_cnpj.js');
});

$("#uf_s3").ready(function(){
	setCidadesUf($("#uf_s3").val());
});

$("#uf_s3").on('change', function() {
	$("#cidade_s3").prop('disabled', true);
	setCidadesUf($("#uf_s3").val());
});

$("#btn_next_step_2").click(function(){
	if($('#form_proposta_cnpj').valid()){		
		$("#confirm_btn_next_step_2").click();
	}
});

$("#btn_next_step_3").click(function(){
	if($('#form_proposta_cnpj').valid()){		
		$("#confirm_btn_next_step_3").click();
	}
});

$("#fieldset_step_1").bind('change', function() {
	$('#btn_proximo_step_1').prop('disabled', true);
});

$("#statusPropostaLojista").bind('change', function(){
	console.log('here');
	if($(this).val() == 7){
		$("#motivoPendente").attr("required", "req");
		$("#motivoPendente").attr('readonly', false);
		console.log('here');
	}else{
		$("#motivoPendente").removeAttr('required');
		$("#motivoPendente").attr('readonly', true);
	}
});
$("#btn_add_doc").click(function(){
	adcionar_documento();
});


$("#btn_add_doc_analise").click(function(){
	adcionar_documento_analise();
});

$("#btn_add_socio").click(function(){
	adcionar_socio();
});

$(document.body).on('click', '.btn_remove_doc', function(){
	remover_documento($(this).val());
});

$(document.body).on('click', '.btn_remove_doc_analise', function(){
	// console.log($(this).val());return;
	remover_documento_analise($(this).val());
});

$(document.body).on('click', '.btn_remove_socio', function(){
	remover_socio($(this).val());
});

function confirma_simulacao(){
	$('#btn_proximo_step_1').prop('disabled', false);
}

function simular_proposta_cnpj(controle = 0){
	// console.log($("#cnpj").val());return;
	a = valida_data();
	if(a==0)return;

	data = getDataSimulacaoCnpj();
	if(data.error != ''){
		swal({
			title: "Validação do Formulário",
			text: data.error,
			icon: "error",
		});
		return;
	}
	// console.log(data);return;

	document.getElementById('div_loading').style.left = "0px";
	document.getElementById('body').className = 'container body opacity_6';
	$.post(
		base_url + "/propostaCnpj/simularProposta",
		data,
		function(data){
			console.log(data);
			if(data.code == 201){
				swal({
					title: data.message,
					icon: 'error',
				});
			}else if(data.code != 200 && data.code != 500){
				swal({
					title: data.resultado[0].message,
					icon: 'error',
				});
			}else if(data.code == 200){
				proposta_gerada = false;
				contrato_gerado = false;
				setDataSimulacaoPj(data.resultado);
				if(controle==0)    
					$('#modal_simular').modal('show');
			}else{
				swal({
					title: 'error '+data.code+' Erro ao consultar API Sicred!',
					icon: 'error',
				});

				$("#data_envio_contrato_analise").val();
			}
			document.getElementById('div_loading').style.left = "-100%";
			document.getElementById('body').className = 'container body';
		},'json');
}

function getDataSimulacaoCnpj(){
	error = '';
	if($("#cnpj").length && $("#cnpj").val() !='') cnpj = $("#cnpj").val(); else{ cnpj = null; error += 'Campo CNPJ necessário!'}
	// if($("#cpf_s3").length && $("#cpf_s3").val() !='') cpf_s3 = $("#cpf_s3").val(); else{ cpf_s3 = null; error += 'Campo CPF necessário!'}
	if($("#carteira").length && $("#carteira").val() !='') carteira = $("#carteira").val(); else{ carteira = null; error += 'Campo Carteira necessário!'}
	if($("#valorLiberacao").length && $("#valorLiberacao").val() !='') valorLiberacao = $("#valorLiberacao").val(); else{ valorLiberacao = null; error += 'Campo Valor Solicitado necessário!'}
	if($("#prazo").length && $("#prazo").val() !='') prazo = $("#prazo").val(); else{ prazo = null; error += 'Campo Parcelas necessário!'}
	if($("#dataInicio").length && $("#dataInicio").val() !='') dataInicio = $("#dataInicio").val();  else{ dataInicio = null; error += 'Campo Data Inicio necessário!'}
	if($("#dataPrimeiroVencimento").length && $("#dataPrimeiroVencimento").val() !='') dataPrimeiroVencimento = $("#dataPrimeiroVencimento").val();  else{ dataPrimeiroVencimento = null; error += 'Campo Primeiro Vencimento necessário!'}

	data = {
		cnpj: cnpj,
		// cpf: cpf_s3,
		carteira: carteira,
		valorSolicitado: parseFloat(valorLiberacao.replace('R$ ', '').replace('.', '').replace(',', ''))/100,
		prazo: prazo,
		dataInicio: dataInicio,
		dataPrimeiroVencimento: dataPrimeiroVencimento,
		error: error
	}
	return data;
}

function setDataSimulacaoPj(data){
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
	prazo = parseInt(data.prazo);
}

function adcionar_documento_analise(){
	numeroDocumentosAddAnalise += 1;
	// html = $("#documentos").html();
	let html = '';
	html += ''+
	'<div class="form-group col-md-4" id="documento_analise_'+numeroDocumentosAddAnalise+'">'+
	'<div class="form-group _input-file-sturcture" style="margin-top: 40px; margin: 5px 5px;">'+
	'<label style="width:100%;">'+
	'Documento Adcional:'+
	'<span>'+
	'<button class="btn btn-danger btn_remove_doc_analise _end" type="button" value="'+numeroDocumentosAddAnalise+'">X</button>'+
	'</span>'+
	'</label><br>'+
	'<input class="form-control-file" type="file" name="add_file_'+numeroDocumentosAddAnalise+'" id="add_file_'+numeroDocumentosAddAnalise+'" style="min-height: 30px;" required><br>'+
	'<label>O arquivo está aprovado?</label><br>'+
	'<div class="radio d-inline">'+
	'<label><input type="radio" name="add_Status_Documento_'+numeroDocumentosAddAnalise+'" value="1">&emsp;Sim</label>'+
	'</div>&emsp;&emsp;'+
	'<div class="radio d-inline">'+
	'<label><input type="radio" name="add_Status_Documento_'+numeroDocumentosAddAnalise+'" value="0" checked>&emsp;Não</label>'+
	'</div><br>'+
	'<textarea class="w_100 form-control" name="add_Observacao_'+numeroDocumentosAddAnalise+'" rows="3"></textarea>'+
	'</div>'+
	'</div>';

	$("#documentosAddAnalise").append(html);
}


function adcionar_documento(){

	x = 0;
	for (var i = numeroDocumentos; i >= 0; i--) {
		console.log("#file_"+i);
		console.log($("#file_"+i).val());
		if($("#file_"+i).val() != undefined){
			if($("#file_"+i).val().length==0){
				x=1;
				break;
			}
		}
	}

	if(x==1){
		swal({
			title: 'Para adcionar um novo arquivo é necessário o preenchimento do já existente!',
			icon: 'error',
		});
		return;
	}

	numeroDocumentos += 1;
	// html = $("#documentos").html();
	let html = '';
	html += ''+
	'<div id="documento_'+numeroDocumentos+'">'+
	'<div class="form-group col-md-10" style="margin-top: 20px;">'+
	'<label class="_font-bold">Documento Adcional: <span>*</span></label>'+
	'<input type="file" class="form-control-file" name="file_'+numeroDocumentos+'" id="file_'+numeroDocumentos+'" required="">'+
	'</div>'+
	'<div class="form-group col-md-2" style="margin-top: 40px;">'+
	'<label>&emsp;</label><br>'+
	'<button class="btn btn-danger btn_remove_doc _end" type="button" value="'+numeroDocumentos+'">Remover</button>'+
	'</div>'+
	'</div>';

	$("#documentos").append(html);
}

function adcionar_socio(){

	numeroSocios += 1;
	x = 0;
	
	for (var i = numeroSocios; i >= 0; i--) {
		console.log("#nomeSocio_"+i);
		console.log($("#nomeSocio_"+i).val());
		if($("#nomeSocio_"+i).val() != undefined && numeroSocios>0){
			if($("#nomeSocio_"+i).val().length==0 || $("#cpf_"+i).val().length==0 || $("#email_"+i).val().length==0 || $("#celular_"+i).val().length==0){
				x=1;
				break;
			}
		}
	}

	if(x==1){
		swal({
			title: 'Para adcionar um novo sócio é necessário o preenchimento de todas as informações do já existente!',
			icon: 'error',
		});
		return;
	}


	// html = $("#socios").html();
	let html = '';
	html += ''+
	'<div class="form-row" id="socio_'+numeroSocios+'">'+
	'<div class="form-group col-md-3">'+
	'<label>Nome: <span>*</span></label>'+
	'<input type="text" class="form-control" name="nomeSocio_'+numeroSocios+'" id="nomeSocio_'+numeroSocios+'">'+
	'</div>'+
	'<div class="form-group col-md-2">'+
	'<label>CPF: <span>*</span></label>'+
	'<input type="text" class="form-control cpf" name="cpf_'+numeroSocios+'" id="cpf_'+numeroSocios+'">'+
	'</div>'+
	'<div class="form-group col-md-3">'+
	'<label>e-mail: <span>*</span></label>'+
	'<input type="email" class="form-control" name="email_'+numeroSocios+'" id="email_'+numeroSocios+'">'+
	'</div>'+
	'<div class="form-group col-md-2">'+
	'<label>Celular: <span>*</span></label>'+
	'<input type="text" class="form-control celular" name="celular_'+numeroSocios+'" id="celular_'+numeroSocios+'">'+
	'</div>'+
	'<div class="form-group col-md-2">'+
	'<label>&emsp;</label><br/>'+
	'<button class="btn btn-danger btn_remove_socio _end" type="button" value="'+numeroSocios+'">Remover</button>'+
	'</div>'+
	'</div>';

	$("#socios").append(html);
	adciona_validacao(numeroSocios);
}

function remover_documento(id){
	console.log(id);
	var node = document.getElementById("documento_"+id);
	if (node.parentNode) {
		node.parentNode.removeChild(node);
	}
}

function remover_documento_analise(id){
	// console.log(id);return;
	var node = document.getElementById("documento_analise_"+id);
	if (node.parentNode) {
		node.parentNode.removeChild(node);
	}
}

function remover_socio(id){
	var node = document.getElementById("socio_"+id);
	if (node.parentNode) {
		node.parentNode.removeChild(node);
	}
}

function adciona_validacao(id){
	// console.log(id);

	$("#cpf_"+id).rules("add", {
		_required: true,
		verifica_cpf: true,
		verifica_cpf_socio_repetido: true,
	});
	$("#nomeSocio_"+id).rules("add", {
		_required: true
	});
	$("#email_"+id).rules("add", {
		_required: true,
		verifica_email_socio_repetido: true
	});
	$("#celular_"+id).rules("add", {
		_required: true,
		_phone: true,
		verifica_celular_socio_repetido: true
	});
}

$("#form_proposta_cnpj").validate( {
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
			prazo: true
		},
		inscricaoEstadual:{
			_required: true
		},
		rendaMensalAtividade:{
			_required: true
		},
		cpf_1:{
			verifica_cpf: true,
			_required: true
		},
		cpf:{
			verifica_cpf: true,
			_required: true
		},
		nomeRepresentante:{
			_required: true	
		},
		sexo:{
			_required: true	
		},
		profissaoAtividade:{
			_required: true	
		},
		numeroDocIdentidade:{
			_required: true	
		},
		nomeMae:{
			_required: true	
		},
		enderecoResidencial:{
			_required: true	
		},
		numeroResidencial:{
			_required: true	
		},
		complementoResidencial:{
			_required: false	
		},
		cepResidencial:{
			_required: true	
		},
		bairroResidencial:{
			_required: true	
		},
		ufResidencial:{
			_required: true	
		},
		cidadeResidencial:{
			_required: true	
		},
		telefoneEmpresa:{
			_required: true,
			_phone: true
		},
		celular:{
			_required: true,
			_phone: true
		},
		enderecoEmail:{
			_required: true	
		}
	}
});

$("#form :input").each(function() {
	if($(this).attr("name").length > 0) {
		fieldPair[$(this).attr("name")] = $(this).val();
	}

	console.log(fieldPair);
});
