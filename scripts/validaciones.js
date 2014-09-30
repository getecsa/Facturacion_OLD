function validarUsuarioForm()
{
    var formulario = document.form1;
    var msgError   = '';
    var flagError  = true;
    if(formulario.motivo_sol.value == 0){
        msgError  = 'Ingresar motivo de solicitud';
        showError(msgError);
        flagError = false;
        formulario.motivo_sol.focus();
        return false;
    }
    else if(formulario.dias_ven.value == 0){
        msgError  = 'Ingresar días de vencimiento';
        showError(msgError);
        flagError = false;
        formulario.dias_ven.focus();
        return false;
    }
        else if(formulario.leyenda_doc.value == 0){
        msgError  = 'Ingresar leyenda de documento';
        showError(msgError);
        flagError = false;
        formulario.leyenda_doc.focus();
        return false;
    }
    else if(formulario.iva.value == 0){
        msgError  = 'Ingresar IVA';
        showError(msgError);
        flagError = false;
        formulario.iva.focus();
        return false;
    }
    
     else if(formulario.leyenda_mat.value == 0){
        msgError  = 'Ingresar leyenda de material';
        showError(msgError);
        flagError = false;
        formulario.leyenda_mat.focus();
        return false;
    }
    else if(formulario.razon_social.value == 0){
        msgError  = 'Ingresar razón social';
        showError(msgError);
        flagError = false;
        formulario.razon_social.focus();
        return false;
    }
     else if(formulario.compa_fac.value == 0){
        msgError  = 'Ingresar compañia facturadora';
        showError(msgError);
        flagError = false;
        formulario.compa_fac.focus();
        return false;
    }
     else if(formulario.moneda.value == 0){
        msgError  = 'Ingresar moneda';
        showError(msgError);
        flagError = false;
        formulario.moneda.focus();
        return false;
    }
    
     else if(formulario.salida.value == 0){
        msgError  = 'Ingresar salida';
        showError(msgError);
        flagError = false;
        formulario.salida.focus();
        return false;
    }

   
     else if(formulario.elements[11].value == 0){
     	
        msgError  = 'Ingresar código';
        showError(msgError);
        flagError = false;
        formulario.elements[11].focus();
        return false;
    }
 

     else if(formulario.elements[12].value == 0){
        msgError  = 'Ingresar descripción';
        showError(msgError);
        flagError = false;
        formulario.elements[12].focus();
        return false;
    }
    
        else if(formulario.elements[13].value == 0){
        msgError  = 'Ingresar unidades';
        showError(msgError);
        flagError = false;
        formulario.elements[13].focus();
        return false;
    }
    
    else if(formulario.elements[14].value == 0){
        msgError  = 'Ingresar precio unitario';
        showError(msgError);
        flagError = false;
        formulario.elements[14].focus();
        return false;
    }
    else if(formulario.elements[16].value.length == 0){
        msgError  = 'Ingresar descuento';
        showError(msgError);
        flagError = false;
        formulario.elements[16].focus();
        return false;
    }

    return false;
  }


  
function validarUsuarioNuevaSolictud()
{
    var formulario = document.nueva_solicitud;
    var msgError   = '';
    var flagError  = true;
    if(formulario.tipo_cliente.value == 0){
        msgError  = 'Se debe seleccionar tipo de cliente';
        showError(msgError);
        flagError = false;
        formulario.tipo_cliente.focus();
        return false;
    }
   
  }  
  
  
  
  function showError(msg)
{
    $('#errorForm').text(msg);
    $('#errorForm').addClass('contentBoxError');
    $('#errorForm').css('display','inline');
    setTimeout(function() {  
        $("#errorForm").fadeOut('slow', function() {
            $('#errorForm').removeClass('contentBoxError');
            $('#errorForm').text('');
        });
    },2000);
}