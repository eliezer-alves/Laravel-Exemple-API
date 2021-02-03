var retorno = '';
var flag = false;
var tipo_logradouro_cache;
var flag_cep = false;

$(document).ready(function () {
  console.log(' -> init utils.js');
  $('html,body').scrollTop(0);

  $(".rgx_endereco").bind('keyup', regex_endereco);
  $(".rgx_endereco").bind('change', normalize_letters_endereco);
  $(".tipo_logradouro").bind('change', check_tipo_logradouro);

});


$('.topPage').click(() => {
  $('html, body').scrollTop(0);
});

$("#dataPrimeiroVencimento").ready(function () {
  define_intervalo_datas();
});

$("#dataPrimeiroVencimento").change(function () {
  valida_data();
});

function valida_parametros(parametros) {
  if (parametros.error != '') {
    swal({
      title: "Validação do Formulário",
      text: parametros.error,
      icon: "error",
    });
    return false;
  }
  return true;
}

function valida_data() {
  let data_ini = toDate($('#dataInicio').val()).getTime();
  let data_fim = toDate($('#dataPrimeiroVencimento').val()).getTime();
  let diff = data_fim - data_ini;

  let dias = Math.ceil(diff / (1000 * 60 * 60 * 24));

  if (dias < 30 || isNaN(data_ini)) {
    swal({
      title: "Validação do Formulário",
      text: 'Prazo mínimo 30 dias!',
      icon: "error",
    });
    return false;
  } else if (dias > 60) {
    swal({
      title: "Validação do Formulário",
      text: 'Prazo máximo 60 dias!',
      icon: 'error',
    });
    return false;
  }
  return true;
}


function define_intervalo_datas() {
  min = 30;
  max = 60;
  if ($('#dataInicio').val() == null || $('#dataInicio').val() == '') {
    return;
  }
  let data_ini = toDate($('#dataInicio').val()).getTime();
  console.log(data_ini);
  let data_venc = data_ini + (min * 24 * 60 * 60 * 1000);
  let data_venc_2 = data_ini + (max * 24 * 60 * 60 * 1000);
  data_1 = toDate_milissegundos(data_venc);
  data_2 = toDate_milissegundos(data_venc_2);
  console.log(data_1);
  console.log(data_2);
  // date = new Date(data_venv);
  $("#intervalo_datas_venc").html(data_1 + ' &emsp; ' + data_2);
  $("#dataPrimeiroVencimento").val(data_1);
  // var hoje        = new Date();
  // console.log(hoje);
}

function toDate(dateStr) {
  if (dateStr != null) {
    var parts = dateStr.split("/");
    return new Date(parts[2], parts[1] - 1, parts[0]);
  }
  return;
}

function toDate_milissegundos(milissegundos) {
  var datetime = milissegundos; // anything
  var date = new Date(datetime);
  var options = {
    year: 'numeric', month: 'numeric', day: 'numeric',
  };

  var result = date.toLocaleDateString('pt-br', options); // 10/29/2013
  return result;
}

function today() {
  var today = new Date();
  var dd = String(today.getDate()).padStart(2, '0');
  var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
  var yyyy = today.getFullYear();

  today = mm + '/' + dd + '/' + yyyy;

  return today;
}

function setCidadesUf(uf) {
  console.log(uf);
  proxy = 'https://cors-anywhere.herokuapp.com/';
  myUrl = 'http://educacao.dadosabertosbr.com/api/cidades/' + uf;
  $.ajax({
    type: "GET",
    url: proxy + myUrl,
    contentType: 'application/json',
    dataType: 'json',
  }).done(function (data) {

    // console.log(data);
    createSelectCidadesUf(data);

  }).fail(function () {

    console.log(data);

  }).always(function (e) {

  });
}

function createSelectCidadesUf(uf) {
  html = '' +
    '<div class="input-group col-md-12">' +
    '<select name="cidadeResidencial" id="cidade_s3" style="width: 100%;">';

  for (i = 0; i < uf.length; i++) {
    // console.log(uf[i].split(':')[1]);
    cidade = uf[i].split(':')[1];
    html += '<option value="' + cidade + '">' + cidade + '</option>'
  }

  html += '' +
    '</select>' +
    '</div>';

  $("#_cidades").html(html);
  $("#cidade_s3").prop('disabled', false);
  $("#cidade_s3").select2();

}

async function onload_page(status) {
  if (status) {
    console.log('start load');
    document.getElementById('div_loading').style.left = "0px";
    document.getElementById('body').className = 'container body opacity_6';
  } else {
    console.log('end load');
    document.getElementById('div_loading').style.left = "-100%";
    document.getElementById('body').className = 'container body';
  }
}



// VALIDAÇÃO FORMULÁRIO-----------------------------------------------------------------------------------

$.validator.addMethod("verifica_cpf", function (e) {
  if (e === '') {
    return true;
  }
  else {
    var validacao;
    var cpfDigitado = 0;
    var cpfAux = 0;
    var valMultplicacao = 10;
    var soma = 0;
    var digito = 0;
    var regexCpfInvalido = '^0+$|^1+$|^3+$|^4+$|^5+$|^6+$|^7+$|^8+$|^9+$';

    cpfAux = e;

    cpfDigitado = cpfAux.replace('.', '');
    cpfDigitado = cpfDigitado.replace('.', '');
    cpfDigitado = cpfDigitado.replace('-', '');

    for (var i = 0; i <= 8; i++) {
      soma += cpfDigitado[i] * valMultplicacao;
      valMultplicacao--;
    }
    soma = soma % 11;
    if (soma <= 1)
      digito = 0;
    else
      digito = 11 - soma;

    if (digito != cpfDigitado[9] || cpfDigitado.match(regexCpfInvalido)) {
      retorno = '*Digite um CPF válido.';
      validacao = false;
    }
    else {
      valMultplicacao = 11;
      soma = 0;

      for (var i = 0; i <= 9; i++) {
        soma += cpfDigitado[i] * valMultplicacao;
        valMultplicacao--;
      }

      soma = soma % 11;
      if (soma <= 1)
        digito = 0;
      else
        digito = 11 - soma;

      if (digito != cpfDigitado[10]) {
        retorno = '*Digite um CPF válido.';
        validacao = false;
      } else {
        retorno = '';
        validacao = true;
      }
      return validacao;
    }
  }
}, function () { return retorno });

$.validator.addMethod("_phone", function (e) {
  var validacao = true;
  var phone = e;

  var regex = /^[2-9]\d{2}[2-9]\d{2}\d{4}$/;

  var formats = "(99)9999-9999|(99)99999-9999";
  var regex = RegExp("^(" +
    formats
      .replace(/([\(\)])/g, "\\$1")
      .replace(/9/g, "\\d") +
    ")$");
  x = phone.substr(4).replace('-', '');
  y = phone.substr(4, 5).replace('-', '');
  z = phone.substr(10).replace('-', '');

  console.log(x);
  console.log(y);
  console.log(z);



  // FIZ ESSA ZORRA MUITO À CONTRA-GOSTA MAS OS CARAS QUE SOLICITAM ESSE TIPO DE COISA SÃO OSSO
  var invalid_phones = ['123456789', '101010101', '111111111', '121212121', '131313131', '141414141', '151515151', '161616161', '171717171', '181818181', '191919191', '202020202', '212121212', '222222222', '232323232', '242424242', '252525252', '262626262', '272727272', '282828282', '292929292', '303030303', '313131313', '323232323', '333333333', '343434343', '353535353', '363636363', '373737373', '383838383', '393939393', '404040404', '414141414', '424242424', '434343434', '444444444', '454545454', '464646464', '474747474', '484848484', '494949494', '505050505', '515151515', '525252525', '535353535', '545454545', '555555555', '565656565', '575757575', '585858585', '595959595', '606060606', '616161616', '626262626', '636363636', '646464646', '656565656', '666666666', '676767676', '686868686', '696969696', '707070707', '717171717', '727272727', '737373737', '747474747', '757575757', '767676767', '777777777', '787878787', '797979797', '808080808', '818181818', '828282828', '838383838', '848484848', '858585858', '868686868', '878787878', '888888888', '898989898', '909090909', '919191919', '929292929', '939393939', '949494949', '959595959', '969696969', '979797979', '989898989', '999999999'];

  console.log(x);
  if (invalid_phones.includes(x))
    validacao = false;


  if (!regex.test(phone) || !validacao) {
    retorno = 'Digite um número válido.';
    return false;
  }

  retorno = '';
  return true;

}, function () { return retorno });

$.validator.addMethod("prazo", function (e) {
  retorno = '';
  validacao = true;
  prazo = parseInt(e);

  $("#btn_simular").prop('disabled', true);

  if (prazo < 1) {
    retorno = 'Mínimo 1 parcela.';
    return false;
  } else if (prazo > 36) {
    retorno = 'Máximo 36 parcelas.';
    return false;
  } else {
    $("#btn_simular").prop('disabled', false);
  }

  return true;
}, function () { return retorno });

$.validator.addMethod("_required", function (e) {
  retorno = '';
  console.log(e);
  if (e == null || e == '') {
    console.log('here');
    retorno = 'Campo obrigatório.';
    return false;
  }
  return true;
}, function () { return retorno });

$.validator.addMethod("_prazo", function (e) {
  retorno = '';
  console.log(e);
  if (e < 1) {
    retorno = 'Mínimo uma parcela.';
    return false;
  } else if (e > 36) {
    retorno = 'Máximo 36 parcelas';
    return false;
  }
  return true;
}, function () { return retorno });


$.validator.addMethod("verifica_cpf_socio_repetido", function (e) {
  retorno = '';
  validacao = true;
  cpf = e;
  console.log(numeroSocios);
  x = 0;

  for (var i = numeroSocios; i >= 0; i--) {
    if ($("#cpf_" + i).val() == cpf) {
      x += 1;
    }
  }
  console.log(x);
  if (x > 1) {
    retorno = 'CPF já existente na lista!';
    return false;
  }

  return true;
}, function () { return retorno });

$.validator.addMethod("verifica_email_socio_repetido", function (e) {
  retorno = '';
  validacao = true;
  email = e;
  console.log(numeroSocios);
  x = 0;

  for (var i = numeroSocios; i >= 0; i--) {
    if ($("#email_" + i).val() == email) {
      x += 1;
    }
  }
  console.log(x);
  if (x > 1) {
    retorno = 'E-mail já existente na lista!';
    return false;
  }

  return true;
}, function () { return retorno });

$.validator.addMethod("verifica_celular_socio_repetido", function (e) {
  retorno = '';
  validacao = true;
  celular = e;
  console.log(numeroSocios);
  x = 0;

  for (var i = numeroSocios; i >= 0; i--) {
    if ($("#celular_" + i).val() == celular) {
      x += 1;
    }
  }
  console.log(x);
  if (x > 1) {
    retorno = 'Celular já existente na lista!';
    return false;
  }

  return true;
}, function () { return retorno });

$.validator.addMethod("_valida_cep", function (e) {
  retorno = '';
  validacao = true;
  if (!cep_valido) {
    retorno = 'CEP inválido!';
    return false;
  }

  return true;

}, function () { return retorno });

function regex_endereco() {

  $(this).val($(this).val().replace(/[^A-Za-z0-9 \-]/gm, '').toUpperCase());
}

function normalize_letters_endereco() {
  var special_characters = 'ÀÁÂÃÄÅàáâãäåÒÓÔÕÕÖØòóôõöøÈÉÊËèéêëðÇçÐÌÍÎÏìíîïÙÚÛÜùúûüÑñŠšŸÿýŽž';
  var normal_characters = 'AAAAAAaaaaaaOOOOOOOooooooEEEEeeeeeCcDIIIIiiiiUUUUuuuuNnSsYyyZz';
  special_characters.split('').forEach((element, index) => {
    $(this).val($(this).val().replace(element, normal_characters[index]).toUpperCase());
  });

  check = false;
  input_logradouro = $('#logradouro').val().split(' ')[0];
  $('.tipo_logradouro').children("option").map(function () {
    if (input_logradouro == this.text && !check) {
      tipo_logradouro_cache = input_logradouro;
      $('.tipo_logradouro').val(this.value);
      $('#logradouro').val($('#logradouro').val().replace(input_logradouro, '').trim());
      check = true;
    }
  })
  
  if (check){
    $('#tipo_logradouro').attr("readonly", true);
    flag = true;
  }
  if($('#logradouro').val() == ""){
    $('#tipo_logradouro').attr("readonly", false);
    tipo_logradouro_cache = '';
  }
}

function check_tipo_logradouro() {
  let selectedOption = $(this).children("option:selected").text();
  let tipo_logradouro = $('#logradouro').val().split(' ')[0];

  if (!flag) {
    tipo_logradouro_cache = tipo_logradouro;
  }

  if (selectedOption == tipo_logradouro && !flag) {
    console.log('aqui 1');
    $('#logradouro').val($('#logradouro').val().replace($('#logradouro').val().split(' ')[0], '').trim());
    flag = true;
  }
  else if (selectedOption != tipo_logradouro && flag) {
    if(flag_cep){
      $('#logradouro').val(tipo_logradouro_cache + " " + $('#logradouro').val().trim());
      flag = false;
    }
  }
  flag_cep= true;
}
