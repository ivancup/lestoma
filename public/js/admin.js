function mostrarSedes(ruta) {
    var form = $('#form_mostrar_proceso');
    $('#sedes_usuario').find('option').remove();
    $.ajax({

        url: ruta,
        type: 'GET',
        dataType: 'json',
        success: function (r) {
            console.log(r);

            $.each(r, function (key, data) { // indice, valor
                $("#sedes_usuario").append('<option value="' + key + '">' + data + '</option>');
            })
            $('#modal_mostrar_sedes').modal('toggle');
        },
        error: function () {
            alert('Ocurrio un error en el servidor ..');
        }
    });
}
function fecha(nombre) {
    $(nombre).daterangepicker({
        "locale": {
            "format": "DD/MM/YYYY",
            "separator": " - ",
            "applyLabel": "Aplicar",
            "cancelLabel": "Cancelar",
            "fromLabel": "De",
            "toLabel": "A",
            "customRangeLabel": "Custom",
            "weekLabel": "S",
            "daysOfWeek": [
                "Do",
                "Lu",
                "Ma",
                "Mi",
                "ju",
                "Vi",
                "Sa"
            ],
            "monthNames": [
                "Enero",
                "Febrero",
                "Marzo",
                "Abril",
                "Mayo",
                "Junio",
                "Julio",
                "Agosto",
                "Septiembre",
                "Octubre",
                "Noviembre",
                "Diciembre"
            ],
            "firstDay": 1
        },
        singleDatePicker: true,
        showDropdowns: true,
        maxDate: moment(),
        "drops": "down"

    });
}