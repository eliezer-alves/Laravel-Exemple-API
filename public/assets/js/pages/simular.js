function simularvalor(Valor, Restricao){

	onload_page(true);
	data = {
        Valor: Valor,
        Restricao: Restricao
	}
	$.post(
		base_url + "/simular/valor",
		data,
		function(data){			
			onload_page(false);

			if(data.code!=200){			
				swal({
					title: 'Erro: Problema ao simular!',
					icon: 'error',
				});
			}else{
				swal({
					title: 'Simulação realizada com sucesso!',
					icon: 'success',
				});
                console.log(data);
                document.getElementById('resultado_simulacao').innerHTML = data.message;
			}
        },'json');
}