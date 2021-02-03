function moeda(valor, sifrao = false, casas = 2, separdor_decimal = ',', separador_milhar = '.') {
    
    var valor_total = Math.round(valor * (Math.pow(10, casas)));
    var inteiros = parseInt(valor_total / parseFloat(Math.pow(10, casas)));
    var centavos = parseInt(valor_total % parseFloat(Math.pow(10, casas)));
    
    if(centavos < 0){
        centavos *= -1;
    }

    if (centavos % 10 == 0 && centavos + "".length < 2) {
        centavos = centavos + "0";
    } else if (centavos < 10) {
        centavos = "0" + centavos;
    }

    var milhares = parseInt(inteiros / 1000);
    inteiros = inteiros % 1000;

    var retorno = "";

    if (milhares > 0) {
        retorno = milhares + "" + separador_milhar + "" + retorno
        if (inteiros == 0) {
            inteiros = "000";
        } else if (inteiros < 10) {
            inteiros = "00" + inteiros;
        } else if (inteiros < 100) {
            inteiros = "0" + inteiros;
        }
    }
    retorno += inteiros + "" + separdor_decimal + "" + centavos;
    
    if(sifrao){
        retorno = 'R$ '+retorno;
    }
    
    if (retorno.indexOf('-') > -1){
        retorno = retorno.replace('-', '');
        retorno = '-'+retorno;
    }
    
    return retorno;
}

function pad (str, max) {
  str = str.toString();
  return str.length < max ? pad("0" + str, max) : str;
}

function stringToDate(_date,_format = "dd/MM/yyyy",_delimiter = "/"){
    var formatLowerCase=_format.toLowerCase();
    var formatItems=formatLowerCase.split(_delimiter);
    var dateItems=_date.split(_delimiter);
    var monthIndex=formatItems.indexOf("mm");
    var dayIndex=formatItems.indexOf("dd");
    var yearIndex=formatItems.indexOf("yyyy");
    var month=parseInt(dateItems[monthIndex]);
    month-=1;
    var formatedDate = new Date(dateItems[yearIndex],month,dateItems[dayIndex]);
    return formatedDate;
}