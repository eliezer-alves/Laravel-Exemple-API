$(document).ready(function() {
	console.log(' -> init agil.js')
	
	inicializa_mascaras();
	alertas();

	$('.js-example-basic-single').select2();
	$('.js-example-basic-multiple').select2();

	
});

function inicializa_mascaras() {
	$('.cpf').mask('000.000.000-00');

	$('.cnpj').mask('00.000.000/0000-00');

	$('.cep').mask('00000-000');

	$('.telefone_fixo').mask('(00) 0000-0000');

	$('.data').mask('00/00/0000');

	$(".maiusculo").on("input", function(){
		$(this).val($(this).val().toUpperCase());
	});

	$(".numeric").mask('0.#');

	$('.celular').mask('(00)00000-0000', {
		onKeyPress: function (celular, e, field, options) {
			var masks = ['(00)0000-00000', '(00)00000-0000'];
			mask = (celular.length > 13) ? masks[1] : masks[0];
			$('.celular').mask(mask, options);
		}
	});

	$(".money").maskMoney({
         prefix: "R$ ",
         decimal: ",",
         thousands: "."
     });
}

$(".somente_letras").on("input", function(){
	var regexp = /[^a-zA-Z- ]/g;
	if(this.value.match(regexp)){
		$(this).val(this.value.replace(regexp,''));
	}
});

$(".somente_numeros").on("input", function(){
	var regexp = /[^0-9]/g;
	if(this.value.match(regexp)){
		$(this).val(this.value.replace(regexp,''));
	}
});

$(".money_meia_boca").on("input", function(){
	var regexp = /[^0-9.]/g;
	if(this.value.match(regexp)){
		$(this).val(this.value.replace(regexp,''));
	}
});


function alertas(){
	if($("#alert_success").length && $("#alert_success").val() !='') message = $("#alert_success").val(); else message = null;
	
	if(message!=null){
		swal({
			title: message,
			icon: 'success',
		});
	}

	if($("#alert_danger").length && $("#alert_danger").val() !='') message = $("#alert_danger").val(); else message = null;
	
	if(message!=null){
		swal({
			title: message,
			icon: 'error',
		});
	}


	$banco = $("#bancoLiberacao");
	texto_banco = $('#bancoLiberacao').find(":selected").text();
	$("#nomeBancoLiberacao").val(texto_banco);
	
}

function get_dados_contrato() {
	$('#btn_enviar_contrato').prop('disabled', true);
	if ($('#confirmaCpf').val() != '' && $('#confirmaContrato').val() != ''){		
		$.post(base_url + "/contrato/valida_contrato",{
			cpf : $('#confirmaCpf').val(),
			contrato : $('#confirmaContrato').val()
		}, function(data){
			
			var message = '';
			var type = 'success';
			if (data.code==200){
				message = 'Contrato encontrado com sucesso! Cliente: '+data.resultado.nome;
				$('#btn_enviar_contrato').prop('disabled', false);
			}else if(data.code == 400){
				$('#cpf').val('');
				$('#contrato').val('');
				message = 'Não foi possivél localizar a proposta! Verifique o código do contrato';
			}else{
				$('#cpf').val('');
				$('#contrato').val('');
				message = 'Algo inesperado aconteceu! Código '+ data;
			}
			if (message != ''){
				swal({
					title: message,
					icon: type,
				});
			}
		}, 'json');
	}
}

async function AJAX(parms, url, type){
	response = null;	
	await $.ajax({
		type: type,
		url: base_url + url,
		data: parms,
		async: false,
		success : function(data) {
			// console.log(data);
			response = JSON.parse(data);
		}
	});

	return response;
}