$(document).ready(function(){

    // funcion para cambio de select en solicitud 
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
                    $comboDocumentos.append("<option value="+documento.id+">" + documento.nombre + "</option>");
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

    
    //funcion para refactura 
    $("#cboDocumentos").change(function() {
        // obtenemos el valor seleccionado
        var documentos = $(this).val();
      if((documentos==3) || (documentos==4)){
        //$(".sol_oculto").css("display","block");
        $(".sol_oculto").show();
      }
      else {
       $(".sol_oculto").css("display","none");
      
      }

    });


    //funcion para agregar en facturacion

                var contenedor      = $("#agregar_detalle"); 
                var AddButton       = $("#agregar_campo_fac"); 
               
                var x = $("#agregar_detalle").length + 1;
              
                var FieldCount = x-1; 

                $(AddButton).click(function (e)  
                {
                       
                            FieldCount++; 
                            $(contenedor).append('<tr class="add_factura"><td><input type="text" size="10" name="add_con['+ FieldCount +'][0]"  placeholder="Codigo '+ FieldCount +'"/> </td><td><input type="text" name="add_con['+ FieldCount +'][1]"  placeholder="Descripcion '+ FieldCount +'"/></td><td class="calcular_subtotal"><input type="text" size="10" name="add_con['+ FieldCount +'][2]"  placeholder="Unidades '+ FieldCount +'"/></td><td class="calcular_subtotal"><input type="text" size="10" name="add_con['+ FieldCount +'][3]"  placeholder="Precio '+ FieldCount +'"/></td><td><input type="text" size="10" name="add_con['+ FieldCount +'][4]"  placeholder="Cargo '+ FieldCount +'"/></td><td class="calcular_subtotal"><input type="text" size="10" name="add_con['+ FieldCount +'][5]"  placeholder="Descuento '+ FieldCount +'"/></td><td><input type="text" size="10" name="add_con['+ FieldCount +'][6]"  class="suma_subtotal" placeholder="Subtotal '+ FieldCount +'"/><a href="#" class="eliminar">&times;</a></td></tr>');
                            x++; 
                     
                return false;
                });


                $("body").on("click",".eliminar", function(e){ 
                        if( x > 1 ) {
                                $(this).parent().parent().remove();
                               // $(this).parent('td').remove(); 
                                x--;
                        }
                return false;
                });


 // calculamos el total de todos los grupos


            //funcion para sumar en factura los subtotales
            $( "#agregar_detalle" ).click(function() {
                    
                    
                    $( ".calcular_subtotal" ).keyup(function() {
                        var total_subtotal=0;
                           
                            $(".suma_subtotal").each(function(i){

                                var n = parseFloat(this.value);
                                if(!isNaN(n))
                                total_subtotal += n;

                               }); console.log(total_subtotal);
                                    $(".total_subtotal").html(total_subtotal);


                    
                     });




               });
/*
        $("#agregar_detalle").keyup(function()
        {   
             var importe=$(this).find("input[name=importe]").val();
            // var importe=$(this).find("td:eq(3) > input").val();
             var unidad=$(this).find("td:eq(2) > input").val();  

           console.log(importe);
           /*
            var unidades=$(this).find("input[name=cantidad]").val();
            $(this).find("[class=total]").html(parseInt(importe)*parseInt(unidades));
            

            var total=0;
            $(".grupo .total").each(function(){
                total=total+parseInt($(this).html());
            })
            $(".total .total").html(total);
        
            var calculo = $(this).find("td:eq(2) > input").val() * $(this).find("td:eq(5) > input").val(); 
       
              $(this).find("td:eq(6) > input").val(calculo)

        });

*/

}); 
