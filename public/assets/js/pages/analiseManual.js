$(document).ready(function() {

})

$("#abreTelaAnalise").click(function(){
    $('#modal_loading_tela_analise').modal('show');
    
    $(function() {
        var current_progress = 0;
        var interval = setInterval(function() {
            if(current_progress!=100)
                current_progress += 10;
            $("#dynamic")
            .css("width", current_progress + "%")
            .attr("aria-valuenow", current_progress)
            .text(current_progress + "% Carregando");
            if (current_progress >= 3000)
                clearInterval(interval);
        }, 2000);
      });
});
