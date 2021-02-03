$(document).ready(() => {
    verificaNome(true);
    verificaDataNascimento(true);
    verificaEstadoCivil(true);
    verificaCPF();
    verificaRG(true);
    verificaNomeMae(true);
    verificaEndereco(true);
    verificaCidade(true);
    verificaCEP(true);
    verificaUF(true);
    verificaCelular(true);
    verificaEmail(true);

    $(".tipo_logradouro").trigger('change');

    

});


function removerClasse(string){
    $(`#${string}`).removeClass('is-invalid text-danger');
}

function verificaNome(flag) {
    $('.name-validate').each(function () {
        if ($('#nome').val().trim().toUpperCase() !== $(this).contents().first().text().trim().toUpperCase()) {
            $(this).addClass('is-invalid text-danger');
            flag && $('#nome').addClass('is-invalid text-danger');
        }
        else {
            $(this).removeClass('is-invalid text-danger');
            $(this).addClass('is-valid text-success');
        }
    });
}

function verificaCPF() {
    $('.cpf-validate').each(function () {
        if ($('#cpf').val().trim().replace(/[^0-9]+/g, '') !== $(this).contents().first().text().trim().replace(/[^0-9]+/g, '')) {
            $(this).addClass('is-invalid text-danger');
        }
        else {
            $(this).removeClass('is-invalid text-danger');
            $(this).addClass('is-valid text-success');
        }
    });
}

function dataAtualFormatada(date) {
    dia = date.split('-')[2],
        mes = date.split('-')[1], //+1 pois no getMonth Janeiro começa com zero.
        ano = date.split('-')[0];
    return dia + "-" + mes + "-" + ano;
}

function verificaDataNascimento(flag) {

    $('.data-nascimento-validate').each(function () {
        dataInput = $(this).contents().first().text().trim().replace(/[^0-9]+/g, '-');
        dataConsulta = dataAtualFormatada($('#data_nascimento').val().trim());

        if (dataInput !== dataConsulta) {
            $(this).addClass('is-invalid text-danger');
            flag && $('#data_nascimento').addClass('is-invalid text-danger');
        }
        else {
            $(this).removeClass('is-invalid text-danger');
            $(this).addClass('is-valid text-success');
        }
    });
}

function verificaEstadoCivil(flag) {
    $('.estado-civil-validate').each(function () {
        if ($('#estado_civil').val().trim().toUpperCase() !== $(this).contents().first().text().trim().toUpperCase()) {
            $(this).addClass('is-invalid text-danger');
            flag && $('#estado_civil').addClass('is-invalid text-danger');
        }
        else {
            $(this).removeClass('is-invalid text-danger');
            $(this).addClass('is-valid text-success');
        }
    });
}

function verificaRG(flag) {
    $('.rg-validate').each(function () {
        if ($('#rg').val().trim() !== $(this).contents().first().text().trim()) {
            $(this).addClass('is-invalid text-danger');
            flag && $('#rg').addClass('is-invalid text-danger');
        }
        else {
            $(this).removeClass('is-invalid text-danger');
            $(this).addClass('is-valid text-success');
        }
    });
}

function verificaNomeMae(flag) {
    $('.nomeMae-validate').each(function () {
        if ($('#nome_mae').val().trim().toUpperCase() !== $(this).contents().first().text().trim().toUpperCase()) {
            $(this).addClass('is-invalid text-danger');
            flag && $('#nome_mae').addClass('is-invalid text-danger');
        }
        else {
            $(this).removeClass('is-invalid text-danger');
            $(this).addClass('is-valid text-success');
        }
    });
}

function verificaEndereco(flag) {
    let endereco = $('#id_tipo_logradouro').val() + ' ' + $('#logradouro').val();
    $('.logradouro-validate').each(function () {
        if (endereco.toUpperCase() !== $(this).contents().first().text().trim().toUpperCase()) {
            $(this).closest('.aviso').addClass('is-invalid text-danger');
            flag && $('#logradouro').addClass('is-invalid text-danger');
            
        }
        else {
            $(this).closest('.aviso').removeClass('is-invalid text-danger');
            $(this).closest('.aviso').addClass('is-valid text-success');
        }
    });
}

function verificaCidade(flag) {
    console.log($('#cidade').val().toUpperCase())
    $('.cidade-validate').each(function () {
        if ($('#cidade').val().trim().toUpperCase() !== $(this).contents().first().text().trim().toUpperCase()) {
            $(this).addClass('is-invalid text-danger');
            flag && $('#cidade').addClass('is-invalid text-danger');
        }
        else {
            $(this).removeClass('is-invalid text-danger');
            $(this).addClass('is-valid text-success');
        }
    });
}

function verificaCEP(flag) {
    $('.cep-validate').each(function () {
        if ($('#cep').val().trim().replace(/[^0-9]+/g, '') !== $(this).contents().first().text().trim()) {
            $(this).addClass('is-invalid text-danger');
            flag && $('#cep').addClass('is-invalid text-danger');
        }
        else {
            $(this).removeClass('is-invalid text-danger');
            $(this).addClass('is-valid text-success');
        }
    });
}

function verificaUF(flag) {
    $('.uf-validate').each(function () {
        if ($('#uf_cliente').val().trim().toUpperCase() !== $(this).contents().first().text().trim().toUpperCase()) {
            $(this).addClass('is-invalid text-danger');
            flag && $('#uf_cliente').addClass('is-invalid text-danger');
        }
        else {
            $(this).removeClass('is-invalid text-danger');
            $(this).addClass('is-valid text-success');
        }
    });
}

function verificaCelular(flag) {
    $('.celular-validate').each(function () {
        if ($('#celular').val().trim().toUpperCase() !== $(this).contents().first().text().trim().toUpperCase()) {
            $(this).addClass('is-invalid text-danger');
            flag && $('#celular').addClass('is-invalid text-danger');
        }
        else {
            $(this).removeClass('is-invalid text-danger');
            $(this).addClass('is-valid text-success');
        }
    });
}

function verificaEmail(flag) {
    $('.email-validate').each(function () {
        if ($('#email').val().trim().toUpperCase() !== $(this).contents().first().text().trim().toUpperCase()) {
            $(this).addClass('is-invalid text-danger');
            flag && $('#email').addClass('is-invalid text-danger');
        }
        else {
            $(this).removeClass('is-invalid text-danger');
            $(this).addClass('is-valid text-success');
        }
    });
}

$("#cep").on('change', async function(){

	cep = $(this).val().replace(/[^0-9.]/g, '');

	dados_endereco = await $.ajax({
		type: 'GET',
		url: 'http://viacep.com.br/ws/'+cep+'/json/'
	}).done((response)=>{
		return response;
	});

    setEnderecoCep(dados_endereco);
});



$('#salvar').click(function(){
    $('#modal_loading_salvar_alteracoes').modal('show');
    
    $(function() {
        var current_progress = 0;
        var interval = setInterval(function() {
            current_progress += 10;
            $("#dynamic")
            .css("width", current_progress + "%")
            .attr("aria-valuenow", current_progress)
            .text(current_progress + "% Carregando");
            if (current_progress >= 2000)
                clearInterval(interval);
        }, 5000);
      });
});

$("#cep").on("change", async function () {
    cep = $(this)
      .val()
      .replace(/[^0-9.]/g, "");
  
    dados_endereco = await $.ajax({
      type: "GET",
      url: "http://viacep.com.br/ws/" + cep + "/json/",
    }).done((response) => {
      return response;
    });
  
    setEnderecoCep(dados_endereco);
  });

function setEnderecoCep(endereco) {
    // console.log(endereco);
    if (endereco.length == 0) {
      cep_valido = false;
  
      $("#uf_cliente").val("");
      $("#uf_cliente").prop("readonly", false);
  
      $("#cidade").val("");
      $("#cidade").prop("readonly", false);
  
      $("#logradouro").val("");
      $("#logradouro").prop("readonly", false);
  
      $("#bairro").val("");
      $("#bairro").prop("readonly", false);
  
      $("#complemento").val("");
      $("#complemento").prop("readonly", false);
    } else {
      cep_valido = true;
  
      if (endereco.uf != null && endereco.uf != "") {
        $("#uf_cliente").val(endereco.uf);
        $("#uf_cliente")
          .attr("readonly", true)
          .attr("data-original-value", $("#uf_cliente").val())
          .on("change", function (i) {
            $(i.target).val($(this).attr("data-original-value"));
          });
      } else {
        $("#uf_cliente").attr("readonly", false);
      }
  
      if (endereco.localidade != null && endereco.localidade != "") {
        $("#cidade").val(endereco.localidade);
        $("#cidade").prop("readonly", true);
      } else {
        $("#cidade").val("");
        $("#cidade").attr("readonly", false);
      }
  
      if (endereco.bairro != null && endereco.bairro != "") {
        $("#bairro").val(endereco.bairro);
        // $("#bairro").prop("readonly", true);
      } else {
        $("#bairro").val("");
        $("#bairro").prop("readonly", false);
      }
  
      if (endereco.logradouro != null && endereco.logradouro != "") {
        $("#logradouro").val(endereco.logradouro);
        // $("#logradouro").prop("readonly", true);
      } else {
        $("#logradouro").val("");
        $("#logradouro").prop("readonly", false);
      }
  
      if (endereco.complemento != null && endereco.complemento != "") {
        $("#complemento").val(endereco.logradouro);
      } else {
        $("#complemento").val("");
        $("#complemento").attr("readonly", false);
      }
    }
  
    $(".rgx_endereco").trigger('change');
    flag_cep = false;
  
      $(".tipo_logradouro").trigger('change');
    // $("#form_proposta").validate().element("#cep");
  }
