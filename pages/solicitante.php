<?php 
error_reporting(E_ALL ^ E_NOTICE);	
	include("conectar_bd.php");
	session_start();
 	$id_user = $_SESSION['uid'];
	
		
		if(isset($_POST['form_1']))
				{
						$id = $_POST['id'];
						$comentario = $_POST['comentario'];


						$insert = "INSERT INTO observaciones(  `observacion` ,  `fecha_observacion` ,  `users_id_usuario` ,  `solicitudes_id_solicitudes` )
 								VALUES ( '$comentario', now(), '$id_user', '$id')";

						mysqli_query($con, $insert);
				}	

		if($_GET['param'] == '')
				{$param = 'Pendiente';}
		else {
			$param = $_GET['param'];
		}
?>
<script>
function enviar_parametro(valor){ 
location = location.pathname + '?id=solicitante&param=' + valor; 
// suponiendo que 'param' es el nombre como se reflejara en PHP; 
// location.pathname hace referencia a la ruta actual, de ser necesario puedes cambiarlo a la direccion que procesara los datos en PHP; 
}  
</script>


<div class="contenedor">
            <div class="header">
                 <h1 class="h1_header">
                    <?php echo utf8_encode($_SESSION['username']);?> 
                </h1>
            
            </div>
                <div class="content">
 
                                                  <H2>Solicitudes <?php echo $param;?></H2>
                    <table class="gridview">
<tr >
                        <td colspan="7" align="right" bgcolor="00517A"><font color="#fff">Filtro de solicitud:
                        <select id='mySelect' onchange='enviar_parametro(this.value);'>
<option value='...'>---</option> 
<option value='Pendiente'>Pendiente</option> 
<option value='Rechazada'>Rechazada</option>
<option value='Aceptada'>Aceptada</option> 

</select> </font></td>
                        
                        
                        
                    </tr>
                    <tr bgcolor="00517A">
                        <td ><font color="#fff">ID</font></td>
                        <td ><font color="#fff">Tipo de solictud</font></td>
                        <td ><font color="#fff">Fecha Ingreso</font></td>
                        
                    </tr>
<?php 


$sql = "SELECT s.id_solicitudes, td.tipo_doc, date(s.fecha_solicitud) as fecha
FROM solicitudes s, documento d, historial_estados he, tipo_documento td
WHERE s.id_solicitudes = d.solicitudes_idSolicitudes
AND s.id_solicitudes = he.solicitudes_idSolicitudes
AND d.tipo_documento_idtipo_doc = td.id_tipo_doc
AND s.`users_id_usuario` = '$id_user'
AND he.estado_solicitud_idestado_solicitud=0 || he.estado_solicitud_idestado_solicitud=1 || he.estado_solicitud_idestado_solicitud=2
|| he.estado_solicitud_idestado_solicitud=5 || he.estado_solicitud_idestado_solicitud=6";



if ($rs = mysqli_query($con, $sql)) {
	/* fetch array asociativo*/
while ($fila = mysqli_fetch_assoc($rs)) {
		
?>

                    <tr>
            
                        <td><a href="ver_folio.php?id=<?php echo $fila["id_solicitudes"];?>" title="Folio <?php echo $fila["id_solicitudes"];?>" class="thickbox"><?php echo $fila["id_solicitudes"]; ?></a></td>
                        <td><a href="ver_folio.php?id=<?php echo $fila["id_solicitudes"];?>" title="Folio <?php echo $fila["id_solicitudes"];?>" class="thickbox"> <?php echo utf8_encode($fila["tipo_doc"]); ?></a></td>
                        <td><a href="ver_folio.php?id=<?php echo $fila["id_solicitudes"];?>" title="Folio <?php echo $fila["id_solicitudes"];?>" class="thickbox"> <?php echo $fila["fecha"]; ?></a></td>
                       
                    </tr>
<?php }
}		
?>
                    
            </table>


               </div>
        </div>