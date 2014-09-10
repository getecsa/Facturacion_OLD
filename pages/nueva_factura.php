<?php
include("config.php");

$sql_iva="select * from iva";
$result_iva=mysql_db_query($db, $sql_iva,$link);

$sql_moneda="select * from moneda";
$result_moneda=mysql_db_query($db, $sql_moneda,$link);

// $cod_cliente=$_POST['codigo_cliente'];

?>
<div id="divNotificacion" />
<div class="contenedor">
            <div class="header">
                <img alt="Movistar" class="logotipo" src="images/logo.png" />
                <h1>Nueva Factura</h1>
            </div>
<div class="content">
	<form class="formulario_n">
		<fieldset>
			<div class="column">
				<label for="cod_cliente">Código de cliente:</label><input type="text" name="cod_cliente" id="cod_cliente"/>
				<label for="motivo_sol">Motivo de solicitud:</label><input type="text" name="motivo_sol" id="motivo_sol"/>
				<label for="dias_ven">Días de vencimiento:</label><input type="text" name="dias_ven" id="dias_ven" />
				<label for="leyenda_doc">Leyenda del documento:</label><input type="text" name="leyenda_doc" id="leyenda_doc"/>
			</div>	
			<div class="column bottom">		
			<label for="iva">IVA:</label>
			<select id="iva">
					<?php 
						while($row=mysql_fetch_array($result_iva)){
						echo "<option value='",$row['id_iva'],"'>",$row['valor_tx'],"</option>";
							}
					?>
			</select>
			<label for="leyenda_mat">Leyenda Material:</label><input type="text" name="leyenda_mat" id="leyenda_mat"/>
			</div>

			<div class="column">			
				<label for="razon_social">Razón Social:</label><input type="text" name="razon_social" id="razon_social"/>
				<label for="compa_fac">Compañia facturadora:</label><input type="text" name="compa_fac" id="compa_fac" />
				<label for="moneda">Moneda:</label>
				<select>
					<?php 
						while($row=mysql_fetch_array($result_moneda)){
						echo "<option value='",$row['id_moneda'],"'>",$row['moneda'],"</option>";
							}
					?>
				</select>


				<label for="salida">Salida/Extra:</label><input type="text" name="salida" id="salida"/>
			</div>
		
			<div class="detalles_factura">
                <ul>
                  <li class="title">Codigo Concepto</li>
                  <li class="uno">13321</li>
                  <li class="dos">64456</li>
                  <li class="uno">458546</li>
                </ul>

                <ul class="ancho_descripcion">
                  <li class="title">Descripcion Concepto</li>
                  <li class="uno">Recarga Tiempo Aire</li>
                  <li class="dos">Recarga Tiempo Aire</li>
                  <li class="uno">Recarga Tiempo Aire</li>
				  <li><div class="agregar_observacion botones">Agregar Concepto</li>
                </ul>

                <ul>
                  <li class="title">Unidades</li>
                  <li class="uno">1</li>
                  <li class="dos">1</li>
                  <li class="uno">1</li>
                </ul>

                <ul>
                  <li class="title">Precio Unitario</li>
                  <li class="uno">$200.00</li>
                  <li class="dos">$150.00</li>
                  <li class="uno">$100.00</li>
                  <li class="title">SubTotal:</li>
                  <li class="title2">IVA:</li>
                  <li class="title">Total:</li>
                </ul>

                <ul>
                  <li class="title">Cargo</li>
                  <li class="uno">$200.00</li>
                  <li class="dos">$150.00</li>
                  <li class="uno">$100.00</li>
                  <li class="title">$450.00</li>
                  <li class="title2">&nbsp;</li>
                  <li class="title">&nbsp;</li>
                </ul>                                

                <ul>
                  <li class="title">Descuento</li>
                  <li class="uno">$0</li>
                  <li class="dos">$0</li>
                  <li class="uno">$0</li>                  
                  <li class="title">$0</li>
                  <li class="title2">&nbsp;</li>
                  <li class="title">&nbsp;</li>
                </ul>  

                <ul>
                  <li class="title">Subtotal</li>
                  <li class="uno">$200.00</li>
                  <li class="dos">$150.00</li>
                  <li class="uno">$100.00</li>
                  <li class="title">$450.00</li>   
                  <li class="title2">$72.00</li>  
                  <li class="title">$522.00</li>                      
                </ul>  
		</div>
<center>
<input type="submit" id="submit"  value="Enviar" >
<input type="reset" value="Borrar" >
</center>
		</fieldset>
	</form>

<!-- en tabla 
<table class="gridview"  id="tabla">
                    <tr>
                        <td>Código de cliente: </td>
                        <td colspan="3"><input type="text" name="" size="15"></td>                     
                        <td >Razón Social:</td> 
                        <td colspan="3"><input type="text" name="raz_social" size="40" value="Nombre E Apellido A Apellido B"></td>

                       
                    </tr>
                    <tr>
                        <td>Motivo de solicitud: </td>
                        <td colspan="3"><input type="text" name="" size="15"></td>                     
                        <td >Compañia facturadora:</td> 
                        <td colspan="3"><input type="text" name="" size="40   " value="XXXXXXXX"></td>

                       
                    </tr>
                    
                    <tr>
                        <td>Días de vencimiento:</td> 
                        <td><input type="text" name="" size="15" value="xxxx"></td>  
                         <td>IVA:</td> 

                        <td><select>
                        <option>Seleccione IVA</option>
                        <option>16%</option>
                        <option>11%</option>
                        <option>0%</option></select></td>
                        <td>Moneda:</td> 
                        <td><select>
                        <option>Seleccione Moneda</option>
                        <option>MXN</option>
                        <option>USD</option>
                        <option>EUR</option></select></td>
                          <td colspan="2"></td>
                    </tr>
                   
                   
 <tr>
 								<td>Leyenda del documento:</td>    
                        <td><input type="text" name="" size="15"></td>
                        <td >Leyenda Material</td>
                        <td ><input type="text"></td>
                        <td >Salida/Extra</td>
                        <td ><input type="text" ><td>
                        <td colspan="2"></td>
                    </tr>                                 
                   
                   
                    <tr>
                        <td colspan="8" >
                            
                        </td>
                    </tr>

                    <tr bgcolor="00517A">
                        <td ><font color="#fff">Código de concepto</font></td>
                        <td colspan="2" ><font color="#fff">Descripción del concepto</font></td>
                        <td ><font color="#fff">Unidades</font></td>
                        <td ><font color="#fff">Precio unitario</font></td>
                        <td ><font color="#fff">Cargo</font></td>
                        <td ><font color="#fff">Descuento</font></td>
                        <td ><font color="#fff">Subtotal</font></td>
                        
                    </tr>
                     
                    <tr>
                        <td ><input type="text" name="" size="10"
                         value="xxxx"></td>
                        <td colspan="2" ><input type="text" name="" size="10" value="xxxxxxxxxx"></td>
                        <td ><input type="text" name="" size="10" value="xxxx"></td>
                        <td ><input type="text" name="" size="10" value="xxxx"></td>
                        <td ><input type="text" name="" size="10" value="xxxx"></td>
                        <td ><input type="text" name="" size="10" value="xxxx"></td>
                        <td ><input type="text" name="" size="10" value="xxxx"></td>
                        
                    </tr>

                    <tr>
                        <td ><input type="text" name="" size="10"
                         value="xxxx"></td>
                        <td colspan="2" ><input type="text" name="" size="10" value="xxxxxxxxxx"></td>
                        <td ><input type="text" name="" size="10" value="xxxx"></td>
                        <td ><input type="text" name="" size="10" value="xxxx"></td>
                        <td ><input type="text" name="" size="10" value="xxxx"></td>
                        <td ><input type="text" name="" size="10" value="xxxx"></td>
                        <td ><input type="text" name="" size="10" value="xxxx"></td>
                        
                    </tr>
                     <tr>
                        
                       <td colspan="8" ><input type="button"  value="Agregar concepto" ></td>
                    </tr>
                     <tr>
                        <td colspan="2"></td>
                       <td colspan="2"></td>
                       <td></td>
                        <td  bgcolor="00517A"><font color="#fff">Sumatoría Cargos</font></td>
                        <td  bgcolor="00517A"><font color="#fff">Sumatoría Descuentos</font></td>
                        <td  bgcolor="00517A"><font color="#fff">Sumatoría Subtotal</font></td>
                        
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td colspan="2"></td>
                        <td></td>
                         <td ><input type="text" name="" size="15" value="$ XXX,XXX,XXX"></td>
                        <td ><input type="text" name="" size="15" value="$ XXX,XXX,XXX"></td>
                        <td ><input type="text" name="" size="15" value="$ XXX,XXX,XXX"></td>
                        
                    </tr>
                     <tr>
                        <td colspan="2"></td>
                        <td colspan="2"></td>
                        <td></td>
                        <td colspan="2" bgcolor="00517A"><font color="#fff">Total solicitud:</font></td>
                        <td colspan="2"><input type="text" name="" size="15" value="$ XXX,XXX,XXX"></td>
                        
                    </tr>
                    </table>
                    <br>
                    <table class="gridview"  id="tabla" >
						 <tr>
                        <td ></td>
                        <td ></td>
                        <td >OBSERVACIONES </td>
                        <td ><textarea rows="5" cols="22">	</textarea><td>
                        <td ><input type="submit" ID="btnLogin"  value="Enviar" ></td>
                    </tr>                                              
                    
            </table>

-->
            </div>
</div>
</div>