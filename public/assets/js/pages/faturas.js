$(document).ready(function() {

    $("#form-filter").submit(function() {
        $(".btn-filter").prop('disabled', true).html('Carregando...');
    });
    var msg_s = '';
    var msg_e = '';

    $(".btn-enviar-fatura, .btn-reenviar-fatura").click(function(e) {
        e.preventDefault();
        if ($(this).hasClass('btn-reenviar-fatura')) {
            $("#modal_confirmar_body").hide();
        } else {
            $("#modal_confirmar_body").show();
        }
        var url = $(this).attr('href');
        msg_s = $(this).attr('data-ss');
        msg_e = $(this).attr('data-er');
        $("#confirmar-btn").attr('href', url);
        $("#modal_confirmar").modal('show');
    });

    $(".btn-aberta").click(function(){
        swal({
            title: "A fatura ainda esta aberta" ,         
			icon: "info",
		});
    });     

    $("#confirmar-btn").click(function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        if ($("#reenviar-check:checked").length > 0) {
            url = url + '/1';
        }
        $("#confirmar-btn").removeAttr('href').html('<i class="fas fa-circle-notch fa-spin"></i> Aguarde...');

        $.ajax({
            type: "GET",
            url: url
        }).done(function(data) {
            $("#faturas_table").hide();
            console.log(data);
            alert(msg_s);
            location.reload();
        }).fail(function() {
            $("#faturas_table").hide();
            alert(msg_e);
            location.reload();
        }).always(function() {
            $("#confirmar-btn").html('Enviar');
            $("#modal_confirmar").modal('hide');
        });
    });

    if ($("#faturas_table").length > 0) {
        createDataTables("#faturas_table")
    }

    $("#vencimento").focus();
});

function createDataTables(idTable) {

    var excelCsv = {
        exportOptions: {
            format: {
                body: function(data, row, column, node) {
                    if (data.includes('R$')) {
                        data = data.replace(/[R$.]/g, '');
                        data = data.replace(/[,]/g, '.');
                        if (data.includes('-')) {
                            data = data.replace(/[ ]/g, '');
                        }
                    } else if (column == 7) {
                        data = data.replace(/\<br\>/g, ' - ')
                    } else if (column == 8) {
                        data = $(data).attr('href');
                    }
                    return data;
                }
            }
        }
    };

    var pdf = {
        exportOptions: {
            format: {
                body: function(data, row, column, node) {
                    if (column == 7) {
                        data = data.replace(/\<br\>/g, '\n');
                    } else if (column == 8) {
                        data = $(data).attr('href');
                    }
                    return data;
                }
            }
        }
    };

    $(idTable).DataTable({
        "language": {
            "url": base_url + "/system/datatables/js/utils/DataTable-Portuguese-Brasil.json"
        },
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "Tudo"]
        ],
        dom: 'Blfrtip',
        'scrollY': false,
        'scrollX': true,
        buttons: [
            $.extend(true, {}, excelCsv, {
                extend: 'excel',
                className: 'btn btn-outline-primary',
                text: '<i class="c-black-500 ti-import"></i> &nbsp;EXCEL',
                filename: 'relatorio',
                title: 'Relatório',
                pageSize: 'LEGAL',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                }
            }),
            $.extend(true, {}, pdf, {
                extend: 'pdfHtml5',
                className: 'btn btn-outline-primary',
                text: '<i class="c-black-500 ti-import"></i> &nbsp;PDF',
                orientation: 'landscape',
                filename: 'relatorio',
                title: 'Relatório',
                orientation: 'landscape',
                pageSize: 'A4',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                }
            }),
            $.extend(true, {}, excelCsv, {
                extend: 'csv',
                className: 'btn btn-outline-primary',
                text: '<i class="c-black-500 ti-import"></i> &nbsp;CSV',
                filename: 'relatorio',
                title: 'Relatório',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                }
            }),
        ]
    });


}

function expirada(contrato){
    swal({
        title: $("#btn_expirou_" + contrato).val() + " dias de atraso" ,
        text: "Entre em contato com o cliente para negociar um acordo",            
        icon: "info",
    });
}