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

if( (!isset($_POST["cod_cliente"])) || (!isset($_POST["razon_social"]))  ){

    header('Location: homepage.php?id=nueva_factura');
}


$array_cont=$_POST["array_cont"];  
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


 $query="INSERT INTO solicitudes (fecha_solicitud,reservada,area_idarea,tipo_cliente_idtipo_cliente,users_id_usuario,estado_actual) VALUES (now(),0,'".$id_area."','".$tipo_cliente."','".$id_usuario."',1)";
 $result=$mysqli->query($query);
 $id_solicitud=$mysqli->insert_id;

      if($result){
        
            $query="INSERT INTO historial_estados (fecha,estado_solicitud_idestado_solicitud,solicitudes_idSolicitudes,users_id_usuario,area_id_area) VALUES (now(),0,'".$id_solicitud."','".$id_usuario."','".$id_area."')";
            $result0=$mysqli->query($query);

            if($result0){        
                        $query="INSERT INTO documento (id_codigo_cliente,dias_vencimiento,leyenda_doc,compa_fac,IVA_idIVA,Moneda_idMoneda,tipo_documento_idtipo_doc,solicitudes_idSolicitudes,razon_social,leyenda_mat,salida,motivos) VALUES ('".$cod_cliente."','".$dias_ven."','".$leyenda_doc."','".$compa_fac."','".$iva."','".$moneda."','".$tipo_documento."','". $id_solicitud."','".$razon_social."','".$leyenda_mat."','".$salida."','".$motivo_sol."')";
                        $result1=$mysqli->query($query);
                        $id_documento=$mysqli->insert_id;
                          if($result1){
                            for($i=1;$i<=$num_concepto;$i++){
                              $id_concepto=$array_cont[$i][0];
                              $tx_concepto=$array_cont[$i][1];
                              $fac_unidades=$array_cont[$i][2];
                              $fac_precio_uni=$array_cont[$i][3];
                              $fac_descuento=$array_cont[$i][5];

                                        $query="INSERT INTO conceptos_doc (id_codigo_concepto,tx_concepto,fac_unidades,fac_precio_uni,fac_descuento,documento_iddocumento) VALUES ('".$id_concepto."','".$tx_concepto."','".$fac_unidades."','".$fac_precio_uni."','".$fac_descuento."','".$id_documento."')";
                                        $result2=$mysqli->query($query);
                                             if($result2){
                                                if($num_concepto==$i){
                                                  header('Location: homepage.php?id=solicitante');
                                                }
                                             }
                                             else{
                                              echo "no guardado" . $mysqli->error;
                                             }
                              }



                          } else{
                           echo "Error: No guardado 2" . $mysqli->error;
                          }               
                      

                    } else {
                      echo "Error: No guardado 1" . $mysqli->error;
                    }
            } else{
              echo "Error: No guardado 0" . $mysqli->error;
            }

      }

  if(isset($_POST["submit"])) {
  
  $array_cont=$_POST["add_cont"]; 
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

?>
  <form class="formulario_n" action="#" method="post">
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
                            $id_iva=$row['id_iva'];
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


                        <label for="salida">Salida:</label><p><?php echo $salida;?></p>
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
      <td><?php echo $array_cont[$i][0]; ?>
      <input  type="hidden" name="array_cont[<?php echo $i; ?>][0]" value="<?php echo $array_cont[$i][0]; ?>" /></td>
      <td><?php echo $array_cont[$i][1]; ?>
      <input  type="hidden" name="array_cont[<?php echo $i; ?>][1]" value="<?php echo $array_cont[$i][1]; ?>" />
      </td>
      <td><?php echo $array_cont[$i][2]; ?>
      <input  type="hidden" name="array_cont[<?php echo $i; ?>][2]" value="<?php echo $array_cont[$i][2]; ?>" />
      </td>
      <td><?php echo $array_cont[$i][3]; ?>
      <input  type="hidden" name="array_cont[<?php echo $i; ?>][3]" value="<?php echo $array_cont[$i][3]; ?>" />
      </td>
      <td><?php echo $array_cont[$i][4]; ?>
      <input  type="hidden" name="array_cont[<?php echo $i; ?>][4]" value="<?php echo $array_cont[$i][4]; ?>" />
      </td>
      <td><?php echo $array_cont[$i][5]; ?>
      <input  type="hidden" name="array_cont[<?php echo $i; ?>][5]" value="<?php echo $array_cont[$i][5]; ?>" />
      </td>
      <td><?php echo $array_cont[$i][6]; ?>
      <input  type="hidden" name="array_cont[<?php echo $i; ?>][6]" value="<?php echo $array_cont[$i][6]; ?>" />
      </td>
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
   <input  type="hidden" id="num_concepto" name="num_concepto" value="<?php echo $num_concepto; ?>">                  
   <input  type="hidden" id="cod_cliente" name="cod_cliente" value="<?php echo $cod_cliente; ?>">                  
   <input  type="hidden" id="motivo_sol" name="motivo_sol" value="<?php echo $motivo_sol; ?>">                  
   <input  type="hidden" id="dias_ven" name="dias_ven" value="<?php echo $dias_ven; ?>">                  
   <input  type="hidden" id="leyenda_doc" name="leyenda_doc" value="<?php echo $leyenda_doc; ?>">                  
   <input  type="hidden" id="razon_social" name="razon_social" value="<?php echo $razon_social; ?>">                  
   <input  type="hidden" id="compa_fac" name="compa_fac" value="<?php echo $compa_fac; ?>">                  
   <input  type="hidden" id="moneda" name="moneda" value="<?php echo $moneda; ?>">                  
   <input  type="hidden" id="salida" name="salida" value="<?php echo $salida; ?>">                  
   <input  type="hidden" id="tipo_cliente" name="tipo_cliente" value="<?php echo $tipo_cliente; ?>">                  
   <input  type="hidden" id="tipo_documento" name="tipo_documento" value="<?php echo $tipo_documento; ?>">                 
   <input  type="hidden" id="iva" name="iva" value="<?php echo $id_iva; ?>">                 
   <input  type="hidden" id="leyenda_mat" name="leyenda_mat" value="<?php echo $leyenda_mat; ?>">                 


                    <input type="submit" id="submit" name="submit_pro" value="Enviar" >
            
                  </div>

        </form>
<?php } ?>

<form class="formulario_n" action="homepage.php?id=nueva_factura" method="post">
				 <div class="boton_envio">
							 	 <input type="submit" id="submit" name="submit_pro" value="Regresar" >
				</div>
</form>					
          </div>
        </div>
 </div>   