<?php
 //Validar que el usuario este logueado y exista un UID
if ( ! ($_SESSION['autenticado'] == 'SI' && isset($_SESSION['uid'])) )
{
    header('location: index.php');
}

    $id_usuario=$_SESSION['uid'];
    $id_area=$_SESSION['area'];

// form anidado 
     
include("cliente.php");

?>

        <div class="contenedor">
            <div class="header">
                 <h1 class="h1_header">
                   Nueva Solicitud
                </h1>
            
            </div>
                <div class="content">
                    <form action="homepage.php?id=nueva_factura" method="post">
                        <table class="content"><tr>
  <td>Tipo de cliente: </td>
  <td>

            <select id="cboClientes">
                <option value="0">Seleccione un Tipo de Cliente</option>
                <?php
                    $clientes = obterTiposClientes();
                    echo $clientes;
                    foreach ($clientes as $cliente) { 
                        echo '<option value="'.$cliente->id.'">'.$cliente->nombre.'</option>';        
                    }
                ?>
            </select>
        </div>
            

                                        <tr>
                                            <td>Tipo de documento:</td>    
                                            <td><select id="cboDocumentos">
                                                <option value="0">Seleccione un Documento</option>
                                               </select>
                                            </td>
                                        </tr>        
                                      
                                        <tr>
                                           <td>Código cliente:</td>  
                                           <td><input type="text" name="codigo_cliente" required/></td>
                                        </tr>
                                        <tr>
                                           <td></td>  
                                           <td><input type="submit" ID="btnLogin"  value="Enviar" /></td>
                                        </tr>
                                </table>
                    </form>

               </div>
        </div>