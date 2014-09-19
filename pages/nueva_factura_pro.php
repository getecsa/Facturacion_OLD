<div id="divNotificacion" />
      <div class="contenedor">
                  <div class="header">
                      <img alt="Movistar" class="logotipo" src="images/logo.png" />
                      <h1>Confirmacion Factura</h1>
                  </div>
          <div class="content">
<?php
include("config.php");

	if(isset($_POST["submit_pro"])) {
	
	$array_cont=$_POST["add_con"];	
	$num_concepto=$_POST['num_concepto'];
	$cod_cliente=$_POST['cod_cliente'];
	$motivo_sol=$_POST['motivo_sol'];
	$dias_ven=$_POST['dias_ven'];
	$leyenda_doc=$_POST['leyenda_doc'];
	$iva=$_POST["iva"];
	$leyenda_mat=$_POST['leyenda_mat'];
	$razon_social=$_POST['razon_social'];
	$compa_fac=$_POST['compa_fac'];
	$moneda=$_POST['moneda'];
	$salida=$_POST['salida'];
  $tipo_cliente=$_POST['tipo_cliente'];
  $tipo_documento=$_POST['tipo_documento'];
  $id_area=$_SESSION['area'];
  $id_usuario=$_SESSION['uid'];
  
/*
    if(isset($_POST["submit_pro"])){

      $sql="INSERT INTO solicitudes (fecha_solicitud,reservada,area_idarea,tipo_cliente_idtipo_cliente,users_id_usuario,estado_actual)
                 VALUES (now(),0,'".$id_area."','".$tipo_cliente."','".$id_usuario."',1)";
      $result=mysql_db_query($db, $sql, $link);

      if(result){
        echo "guardado";
      } else {
        echo "error no guardo";
      }
    
    }
*/    

?>
  <form class="formulario_n" action="homepage.php?id=nueva_factura_pro" method="post">
                    <fieldset>
                      <div class="column">
                        <label for="cod_cliente">Código de cliente:</label><p><?php echo $cod_cliente;?></p>
                        <label for="motivo_sol">Motivo de solicitud:</label><p><?php echo $motivo_sol;?></p>
                        <label for="dias_ven">Días de vencimiento:</label><p><?php echo $dias_ven;?></p>
                        <label for="leyenda_doc">Leyenda del documento:</label><p><?php echo $leyenda_doc;?></p>
                      </div>  
                      <div class="column bottom">   
                      <label for="iva">IVA:</label>
                        <?php 
                            $sql_iva="select * from iva where id_iva=$iva";
                            $result_iva=mysql_db_query($db, $sql_iva,$link);
                            if($row=mysql_fetch_array($result_iva)){
                            echo "<p>",$row['valor_tx'],"</p>";
                              }
                          ?>
                    <label for="leyenda_mat">Leyenda Material:</label><p><?php echo $leyenda_mat;?></p>
                      </div>

                      <div class="column">      
                        <label for="razon_social">Razón Social:</label><p><?php echo $razon_social;?></p>
                        <label for="compa_fac">Compañia facturadora:</label><p><?php echo $compa_fac;?></p>
                        <label for="moneda">Moneda:</label>
                        <?php 
                            $sql_moneda="select * from moneda where id_moneda=$moneda";
                            $result_moneda=mysql_db_query($db, $sql_moneda,$link);
                            if($row=mysql_fetch_array($result_moneda)){
                            echo "<p>",$row['moneda'],"</p>";
                              }
                          ?>


                        <label for="salida">Salida/Extra:</label><p><?php echo $salida;?></p>
                      </div>
                    
  <div id="detalles_factura">
  <table class="gridview" id="agregar_detalle">
    <tr>
      <td>Codigo Concepto</td>
      <td>Descripcion Concepto</td>
      <td>Unidades</td>
      <td>Precio Unitario</td>
      <td>Cargo</td>
      <td>Descuento</td>
      <td>Subtotal</td>
    </tr>
    <?php
    $subtotal=0;
    for($i=1;$i<=$num_concepto;$i++){
    $subtotal=$subtotal+$array_cont[$i][6];
    ?>
    <tr class="add_factura">
      <td><?php echo $array_cont[$i][0]; ?></td>
      <td><?php echo $array_cont[$i][1]; ?></td>
      <td><?php echo $array_cont[$i][2]; ?></td>
      <td><?php echo $array_cont[$i][3]; ?></td>
      <td><?php echo $array_cont[$i][4]; ?></td>
      <td><?php echo $array_cont[$i][5]; ?></td>
      <td><?php echo $array_cont[$i][6]; ?></td>
    </tr>
    <?php } ?>
    </table>
    <table class="gridview">
    <tr>
    <td colspan="3"><a href="#" id="adjuntar_archivos"><div class="agregar_observacion botones">Adjuntar Archivos</div></a></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
   </tr> 
   <tr>
    <td colspan="3">&nbsp;</td>
    <td>SubTotal:</td>
    <td></td>
    <td></td>
    <td class="total_subtotal"><?php echo $subtotal; ?></td>
   </tr>   
    <tr>
    <td colspan="3">&nbsp;</td>
    <td>IVA:</td>
    <td></td>
    <td></td>
    <td><?php
    $sql="select * from iva where id_iva=$iva";
    $result=mysql_db_query($db,$sql,$link);
    $row=mysql_fetch_array($result);
    $iva=$row['valor_int']*$subtotal;
    echo $iva; ?></td>
   </tr>   
    <tr>
    <td colspan="3">&nbsp;</td>
    <td>IEPS:</td>
    <td></td>
    <td></td>
    <td>$0</td>
   </tr>
   <tr>
    <td colspan="3">&nbsp;</td>
    <td>Total:</td>
    <td></td>
    <td></td>
    <td><?php echo $iva+$subtotal; ?></td>
   </tr>
  </table> 
        </fieldset>
                   <div class="boton_envio">
                    <input  type="hidden" id="tipo_doc" value="1" name="tipo_doc">
                    <input  type="hidden" id="num_concepto" value="" name="num_concepto">
                    <input type="submit" id="submit" name="submit_pro" value="Enviar" >
                    <input type="reset" value="Borrar" >
                  </div>

        </form>


<?php
	}else {
		echo "Error en captura de informacion";
		}
?>
          </div>
        </div>
 </div>   