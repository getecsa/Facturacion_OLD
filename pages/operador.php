<?php 
error_reporting(E_ALL ^ E_NOTICE);  
    include("conectar_bd.php");
   // session_start();
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
location = location.pathname + '?id=operador&param=' + valor; 
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
                 <div class="datos_informacion">
                  <?php
                                      if ($param=='Pendiente'){
                  $sql="SELECT so.id_solicitudes, td.tipo_doc, date(so.fecha_solicitud) as fecha
                          FROM solicitudes so
                    INNER JOIN documento do ON so.id_solicitudes=do.solicitudes_idSolicitudes
                    INNER JOIN historial_estados hi ON so.id_solicitudes=hi.solicitudes_idSolicitudes
                    INNER JOIN tipo_documento td ON do.tipo_documento_idtipo_doc=td.id_tipo_doc
                         WHERE so.users_id_usuario='$id_user'
                           AND so.estado_actual=0 || so.estado_actual=1 || so.estado_actual=2 || so.estado_actual=3 ||
                               so.estado_actual=5 || so.estado_actual=6";
                  }
                  ?>
                  <div class="datos_totales">
                <p>Total de solicitudes pendientes: <span>0</span></p> 
                <p>Total de solicitudes liberadas: <span>0</span></p> 
                <p>Total de solicitudes rechazadas: <span>0</span> </p> 
                <p>Total de solicitudes: <span>0</span></p> 
                  </div>

                  <div class="datos_totales right">
                <p>Solicitudes pendientes fuera dei tiempo: <span>0</span></p> 
                  </div>
                </div>
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
                        <td ><font color="#fff">Solicitante</font></td>
                        <td ><font color="#fff">Area</font></td>
                        <td ><font color="#fff">Tipo de solicitud</font></td>
                        <td ><font color="#fff">Fecha Ingreso</font></td>
                        <td ><font color="#fff">Estado</font></td>
                        <td ><font color="#fff">&nbsp;</font></td>
                      
                    </tr>
<?php 
  $id_user = $_SESSION['uid'];
  $id_area_op= $_SESSION['area'];

if ($param=='Pendiente'){
$sql="SELECT so.id_solicitudes, so.users_id_usuario,ar.tx_area,td.tipo_doc, date(so.fecha_solicitud) as fecha, es.estado_sol
        FROM solicitudes so
  INNER JOIN documento do ON so.id_solicitudes=do.solicitudes_idSolicitudes
  INNER JOIN historial_estados hi ON so.id_solicitudes=hi.solicitudes_idSolicitudes
  INNER JOIN tipo_documento td ON do.tipo_documento_idtipo_doc=td.id_tipo_doc
  INNER JOIN area ar ON so.area_idarea=ar.id_area
  INNER JOIN estado_solicitud es ON so.estado_actual=es.id_estado_solicitud
       WHERE area_flujo='$id_area_op' AND reservada=0";
}

if ($param=='Rechazada'){
$sql="SELECT so.id_solicitudes, td.tipo_doc, date(so.fecha_solicitud) as fecha
        FROM solicitudes so
  INNER JOIN documento do ON so.id_solicitudes=do.solicitudes_idSolicitudes
  INNER JOIN historial_estados hi ON so.id_solicitudes=hi.solicitudes_idSolicitudes
  INNER JOIN tipo_documento td ON do.tipo_documento_idtipo_doc=td.id_tipo_doc
       WHERE so.users_id_usuario='$id_user'
         AND so.estado_actual=4";

}

if ($param=='Aceptada'){
$sql="SELECT so.id_solicitudes, td.tipo_doc, date(so.fecha_solicitud) as fecha
        FROM solicitudes so
  INNER JOIN documento do ON so.id_solicitudes=do.solicitudes_idSolicitudes
  INNER JOIN historial_estados hi ON so.id_solicitudes=hi.solicitudes_idSolicitudes
  INNER JOIN tipo_documento td ON do.tipo_documento_idtipo_doc=td.id_tipo_doc
       WHERE so.users_id_usuario='$id_user'
         AND so.estado_actual=7";

}

   // $result=$mysqli->query($sql);
   // while($row = $result->fetch_array(MYSQLI_ASSOC)){
      $result=mysqli_query($con,$sql);
      while($row = mysqli_fetch_assoc($result)) {
?>
                    <tr>
                        <td><?php echo $row['id_solicitudes']; ?></td>
                        <td><?php echo $row['users_id_usuario']; ?></td>
                        <td><?php echo $row['tx_area']; ?></td>
                        <td><?php echo $row['tipo_doc']; ?></td>
                        <td><?php echo $row['fecha']; ?></td>
                        <td><?php echo $row['estado_sol']; ?></td>
                        <td>X</td>
                    </tr>
<?php } ?>
                    
            </table>


               </div>
        </div>