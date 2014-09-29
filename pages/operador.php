<?php 
//error_reporting(E_ALL ^ E_NOTICE);  
    include("configuracion.php");
   // session_start();
    $id_user = $_SESSION['uid'];
    $id_area = $_SESSION['area'];
    $id_area_op= $_SESSION['area'];
    if(!isset($_POST['id_estado_sol'])){$_POST['id_estado_sol']=0;}
    $id_estado_click=$_POST['id_estado_sol'];
    if(!isset($_POST['valor_solicitud'])){$_POST['valor_solicitud']=0;}
    $valor_solicitud=$_POST['valor_solicitud'];


if($valor_solicitud!=0){
    $sql="UPDATE solicitudes
             SET reservada='1', estado_actual='1',area_flujo='$id_area',usuario_reserva='$id_user'
           WHERE id_solicitudes='$valor_solicitud'";
    $result=$mysqli->query($sql); 
      if($result){
        $sql1="INSERT INTO historial_estados (fecha,estado_solicitud_idestado_solicitud,solicitudes_idSolicitudes,users_id_usuario,area_id_area) 
                   VALUES (now(),1,'".$valor_solicitud."', '".$id_user."','".$id_area."' )";
        $result1=$mysqli->query($sql1);
          if($result1){
            echo "Guardado Insert";
          }
      }

    }else {
      echo "NADA";
    }

    
?>
<div class="contenedor">
            <div class="header">
                 <h1 class="h1_header">
                    <?php echo utf8_encode($_SESSION['username']);?> 
                </h1>
            
            </div>
                <div class="content">
                 <div class="datos_informacion">
                  <?php

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
                <?php 
                  $sql_estado="SELECT estado_sol
                          FROM estado_solicitud
                         WHERE id_estado_solicitud=0";
                  $result_estado=$mysqli->query($sql_estado);
                  $row=$result_estado->fetch_array(MYSQLI_ASSOC);

                ?>
                                                  <H2>Solicitudes <?php echo $row['estado_sol'];?></H2>
                    <table class="gridview">
<tr >
                        <td colspan="7" align="right" bgcolor="00517A"><font color="#fff">Filtro de solicitud:
<form action="#" method="post" id="id_estados_sol">
                        <select id='select_operador' name="id_estado_sol">
<option value='...'>---</option> 
<?php
  $sql_per="SELECT pe.id_estado_solicitud, es.estado_sol
          FROM permisos pe
    INNER JOIN estado_solicitud es ON pe.id_estado_solicitud=es.id_estado_solicitud 
         WHERE permiso=1 AND id_area='$id_area'";

    $result=$mysqli->query($sql_per);
    while($row = $result->fetch_array(MYSQLI_ASSOC)) {
?>
  <option value='<?php echo $row['id_estado_solicitud']; ?>'><?php echo $row['estado_sol']; ?></option> 
                        
<?php } ?>
                    
</select></font></form></td>
                        
                        
                        
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




if ($id_estado_click==0){
$sql="SELECT so.id_solicitudes, us.username,ar.tx_area,td.tipo_doc, date(so.fecha_solicitud) as fecha, es.estado_sol
        FROM solicitudes so
  INNER JOIN documento do ON so.id_solicitudes=do.solicitudes_idSolicitudes
  INNER JOIN historial_estados hi ON so.id_solicitudes=hi.solicitudes_idSolicitudes
  INNER JOIN tipo_documento td ON do.tipo_documento_idtipo_doc=td.id_tipo_doc
  INNER JOIN area ar ON so.area_idarea=ar.id_area
  INNER JOIN estado_solicitud es ON so.estado_actual=es.id_estado_solicitud
  INNER JOIN users us ON so.users_id_usuario=us.id_usuario
       WHERE area_flujo='$id_area_op' AND reservada=0 AND estado_actual='$id_estado_click'"  ;

}

if ($id_estado_click==1){
$sql="SELECT DISTINCT so.id_solicitudes, us.username,ar.tx_area,td.tipo_doc, date(so.fecha_solicitud) as fecha, es.estado_sol
        FROM solicitudes so
  INNER JOIN documento do ON so.id_solicitudes=do.solicitudes_idSolicitudes
  INNER JOIN historial_estados hi ON so.id_solicitudes=hi.solicitudes_idSolicitudes
  INNER JOIN tipo_documento td ON do.tipo_documento_idtipo_doc=td.id_tipo_doc
  INNER JOIN area ar ON so.area_idarea=ar.id_area
  INNER JOIN estado_solicitud es ON so.estado_actual=es.id_estado_solicitud
  INNER JOIN users us ON so.users_id_usuario=us.id_usuario
       WHERE usuario_reserva='$id_user' AND reservada=1 AND estado_actual='$id_estado_click'"  ;

}

    $result=$mysqli->query($sql);
    $bgcolor=0;
    while($row = $result->fetch_array(MYSQLI_ASSOC)) {
      if ($bgcolor%2==0){ $color="FFFFFF"; $bgcolor++; } else { $color="CEF6F5"; $bgcolor++;}
?>
                    <tr  bgcolor="<?php echo $color; ?>">
                        <td><?php echo $row['id_solicitudes']; ?></td>
                        <td><?php echo $row['username']; ?></td>
                        <td><?php echo $row['tx_area']; ?></td>
                        <td><?php echo $row['tipo_doc']; ?></td>
                        <td><?php echo $row['fecha']; ?></td>
                        <td><?php echo $row['estado_sol']; ?></td>
                        <td><a href="#" class="tomar_solicitud" id="<?php echo $row['id_solicitudes']; ?>"><span class="icon-checkmark"></span></a></td>
                    </tr>
<?php }  

?>
                            
            </table>

     </div>
        </div>
<form  action="#" method="post" id="tomar_solicitud">
  <input type="hidden" name="valor_solicitud" id="valor_solicitud" value="#">
</form>