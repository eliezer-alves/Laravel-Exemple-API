$(document).ready(() => {
  console.log(" -> init cadastro.js");
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

    $("#uf").val("");
    $("#uf").prop("readonly", false);

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
      $("#uf").val(endereco.uf);
      $("#uf")
        .attr("readonly", true)
        .attr("data-original-value", $("#uf").val())
        .on("change", function (i) {
          $(i.target).val($(this).attr("data-original-value"));
        });
    } else {
      $("#uf").attr("readonly", false);
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
      $("#bairro").prop("readonly", true);
    } else {
      $("#bairro").val("");
      $("#bairro").prop("readonly", false);
    }

    if (endereco.logradouro != null && endereco.logradouro != "") {
      $("#logradouro").val(endereco.logradouro);
      $("#logradouro").prop("readonly", true);
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

function validaTelefoneRepetido() {
  var celular = $("#celular").val();
  // console.log(celular);

  $.get(base_url + "/cadastro/validaTelefoneRepetido", {
    celular,
  }).done(function (response) {
    response = JSON.parse(response);
    swal(response.mensagem, {
      buttons: false,
      icon: response.status == 1 ? "success" : "error",
    });
  });
}
