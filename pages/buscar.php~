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
                <img alt="Movistar" class="logotipo" src="images/logo.png" />
                <h1>
                    <?php echo utf8_encode($_SESSION['username']);?>
                </h1>
            </div>
            <div class="content">

<form action="homepage.php?id=buscar" method="post">                 
<table width=30%>

<tr>
<td><h2 class="block">Folio:</h2></td>
<td>  <input type="text"></td>
<td> <input type="submit" value="Buscar Folio" name="buscar"></td>
<td></td>
</tr>
<tr>
<td><h2 class="block">Tipo Solicitud:</h2></td>
<td> <select>
                <option>Seleccione Solicitud</option>
                <option value="Factura">Factura</option>
                <option value="NC">Nota de Crédito</option>
                <option value="RFCon">Refactura Con Cambio</option>
                <option value="RFSin">Refactura Sin Cambio</option>
                 
                 </select></td>
<td> <input type="submit" value="Buscar Tipo" name="buscar"></td>
<td></td>
</tr>
</table>
</form>
                </div>    
               
               
               </div>


<?php 
if(isset($_POST["buscar"])) {
echo $_POST["buscar"]; 
}
?>