<?php
include("config.php");

$sql_iva="select * from iva";
$result_iva=mysql_db_query($db, $sql_iva,$link);

$sql_moneda="select * from moneda";
$result_moneda=mysql_db_query($db, $sql_moneda,$link);

if( (!isset($_POST["tipo_cliente"])) || (!isset($_POST["tipo_cliente"]))  ){

    header('Location: homepage.php?id=nueva_solicitud');
}

$tipo_cliente=$_POST["tipo_cliente"];
$tipo_documento=$_POST["tipo_documento"];

?>
<div id="divNotificacion" />
  <div class="contenedor">
              <div class="header">
                  <img alt="Movistar" class="logotipo" src="images/logo.png" />
                  <h1>Nueva Nota de Credito</h1>
              </div>
  <div class="content">
                  <form class="formulario_n" action="homepage.php?id=nueva_factura_pro" method="post">
                    <fieldset>
                      <div class="column">
                        <label for="cod_cliente">Código de cliente:</label><input type="text" name="cod_cliente" id="cod_cliente" value="<?php echo $_POST['codigo_cliente'];?>" />
                        <label for="motivo_sol">Motivo de solicitud:</label><input type="text" name="motivo_sol" id="motivo_sol"/>
                        <label for="leyenda_doc">Leyenda del documento:</label><input type="text" name="leyenda_doc" id="leyenda_doc"/>
                        <label for="folio_fac_origen">Folio factura origen:</label><input type="text" name="folio_fac_origen" id="folio_fac_origen" />
                      </div>  
                      <div class="column bottom_nc">   
                      <label for="tipo_nc">Tipo Nota Credito:</label>
                      <select name="tipo_nc">
                        <option>Seleccione Tipo</option>
                        <option>Parcial</option>
                        <option>Total</option>
                      </select>
                      <label for="iva">IVA:</label>
                      <select id="iva" name="iva">
                          <?php 
                            while($row=mysql_fetch_array($result_iva)){
                            echo "<option value='",$row['id_iva'],"'>",$row['valor_tx'],"</option>";
                              }
                          ?>
                      </select>
                      <label for="monto_total_fac_orig">Monto Total (Fac Origen):</label><input type="text" name="monto_total_fac_orig" id="monto_total_fac_orig"/>
                      </div>

                      <div class="column">      
                        <label for="razon_social">Razón Social:</label><input type="text" name="razon_social" id="razon_social"/>
                        <label for="moneda">Moneda:</label>
                        <select name="moneda">
                          <?php 
                            while($row=mysql_fetch_array($result_moneda)){
                            echo "<option value='",$row['id_moneda'],"'>",$row['moneda'],"</option>";
                              }
                          ?>
                        </select>
                        <label for="fecha_emision_nc">Fecha Emision:</label><input type="text" name="fecha_emision_nc" id="fecha_emision_nc" />
                        <label for="monto_afectar_nc">Monto Afectar con NC:</label><input type="text" name="monto_afectar_nc" id="monto_afectar_nc"/>
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
    <tr class="add_factura">
      <td><input type="text" size="10" name="add_cont[1][0]" /> </td>
      <td><input type="text" name="add_cont[1][1]" /></td>
      <td><input type="text" size="10" name="add_cont[1][2]" class="calcular_subtotal total_unidades" /></td>
      <td><input type="text" size="10" name="add_cont[1][3]" class="calcular_subtotal" /></td>
      <td><input type="text" size="10" name="add_cont[1][4]" readonly class="suma_cargo"/></td>
      <td><input type="text" size="10" name="add_cont[1][5]" class="calcular_subtotal" /></td>
      <td><input type="text" size="10" name="add_cont[1][6]" readonly class="suma_subtotal" /></td>
    </tr>
    </table>
    <table class="gridview">
    <tr>
    <td colspan="3"><a href="#" id="agregar_campo_fac"><div class="agregar_observacion botones">Agregar Concepto</div></a></td>
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
    <td class="total_subtotal">$0</td>
   </tr>   
    <tr>
    <td colspan="3">&nbsp;</td>
    <td>IVA:</td>
    <td></td>
    <td></td>
    <td>$32</td>
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
    <td>$200</td>
   </tr>
  </table> 
        </fieldset>
                   <div class="boton_envio">
                    <input  type="hidden" id="num_concepto" value="1" name="num_concepto">
                    <input  type="hidden"  value="<?php echo $tipo_cliente; ?>" name="tipo_cliente">
                    <input  type="hidden"  value="<?php echo $tipo_documento; ?>" name="tipo_documento">
                    <input type="submit" id="submit" name="submit" value="Enviar" >
                    <input type="reset" value="Borrar" >
                  </div>

        </form>




       </div>
    </div>
 </div>   