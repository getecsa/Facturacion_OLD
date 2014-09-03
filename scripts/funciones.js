$(document).ready(function(){

    // cada vez que se cambia el valor del combo
    $("#cboClientes").change(function() {

        // obtenemos el valor seleccionado
        var cliente = $(this).val();

        // si es 0, no es un cliente
        if(cliente > 0)
        {
            //creamos un objeto JSON
            var datos = {
                idCliente : $(this).val()  
            };

            // utilizamos la función post, para hacer una llamada AJAX
            $.post("pages/documentos.php", datos, function(documentos) {

                // obtenemos el combo de documentos
                var $comboDocumentos = $("#cboDocumentos");

                // lo vaciamos
                $comboDocumentos.empty();

                // iteramos a través del arreglo
                $.each(documentos, function(index, documento) {

                    // agregamos opciones al combo
                    $comboDocumentos.append("<option>" + documento.nombre + "</option>");
                });
            }, 'json');
        }
        else
        {
            var $comboDocumentos = $("#cboDocumentos");
            $comboDocumentos.empty();
            $comboDocumentos.append("<option>Seleccione un Documento</option>");
        }
    });
}); 
