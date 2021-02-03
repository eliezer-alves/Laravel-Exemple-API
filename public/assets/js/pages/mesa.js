$(document).ready(function() {
	console.log(' -> init mesa.js');
});

$("#form_nova_proposta_analise").bind('change', function(){
	$("#btn_confirma_nova_proposta_analise_modal").prop('disabled', true);
});

$("#btn_nova_proposta").click(function(){
	limpa_input_modal_nova_proposta();
	$('#modal_nova_proposta').modal('show');
});

$("#btn_simular_nova_proposta_analise_modal").click(function(){
	console.log('here');
	simular_proposta_cnpj(1);
	$("#btn_confirma_nova_proposta_analise_modal").prop('disabled', false);
});

$(document.body).on('click', '.btn_enviar_contrato_socio', function(){
	if($("#btn_enviar_contrato_socio_"+($(this).val())).is(':disabled')){
		swal({
			title:'Proposta ainda não aprovada!',
			icon: 'error',
		});
		return;
	}
	enviar_contrato_socio($(this).val());
});


function limpa_input_modal_nova_proposta(){
	$("#parcelas").val('');
	$("#valorPmt").val('');
	$("#valorFinanciado").val('');
	$("#totalParcelas").val('');
}

function enviar_contrato_socio(Ctrl_Socio){
	
	data = {
		Ctrl_Socio: Ctrl_Socio
	};
	console.log(data);

	$.post(
		base_url + "/ContratoPj/enviarContratoPj",
		data,
		function(data){
			console.log(data);
			if(data.code==200){
				swal({
					title: 'Link enviado com sucesso!',
					icon: 'success',
				});
				$("#data_envio_contrato_analise_"+Ctrl_Socio).val(today());
			}else{
				swal({
					title: data.resultado.message,
					icon: 'error',
				});
			}
	},'json');
}
