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