<script>

function enviar_parametro(valor){ 
location = location.pathname + '?id=solicitante&param=' + valor; 
// suponiendo que 'param' es el nombre como se reflejara en PHP; 
// location.pathname hace referencia a la ruta actual, de ser necesario puedes cambiarlo a la direccion que procesara los datos en PHP; 
} 

 
 
</script>

<?php 


error_reporting(E_ALL ^ E_NOTICE);
if($_GET['param'] == '')
{$param = 'Pendiente';}
else {
$param = $_GET['param'];
}
?>

<div class="contenedor">
            <div class="header">
                 <h1 class="h1_header">
                    <?php echo utf8_encode($_SESSION['username']);?> 
                </h1>
            
            </div>
                <div class="content">
 
                                                  <H2>Solicitudes <?php echo $param;?></H2>
                    <table class="gridview"   >
<tr >
                        <td colspan="7" align="right" bgcolor="00517A"><font color="#fff">Filtro de solicitud:
                        <select id='mySelect' onchange='enviar_parametro(this.value);'>
<option value='...'>---</option> 
<option value='Pendiente'>Pendiente</option> 
<option value='Rechazada'>Rechazada</option>
<option value='Aceptada'>Aceptada</option> 

</select> </font></td>
                        
                        
                        
                    </tr>
<p></p>
                    <tr bgcolor="00517A">
                        <td ><font color="#fff">ID</font></td>
                        <td ><font color="#fff">Tipo de solictud</font></td>
                        <td ><font color="#fff">Fecha Ingreso</font></td>
                        
                    </tr>
                    <tr>
            
                        <td><a href="ver_folio.php?height=450&width=600" title="Folio 5324" class="thickbox"> 5324</a></td>
                        <td><a href="ver_folio.php?height=450&width=600" title="Folio 5324" class="thickbox"> Factura</a></td>
                        <td><a href="ver_folio.php?height=450&width=600" title="Folio 5324" class="thickbox"> XXXXXXXXXXX</a></td>
                       
                    </tr>
                    <tr>
                        <td><a href="ver_folio.php?height=450&width=600" title="Folio 5324" class="thickbox"> 5324</a></td>
                        <td><a href="ver_folio.php?height=450&width=600" title="Folio 5324" class="thickbox"> Nota Crédito</a></td>
                        <td><a href="ver_folio.php?height=450&width=600" title="Folio 5324" class="thickbox"> XXXXXXXXXXX</a></td>
                       
                    </tr>
                    
            </table>


               </div>
        </div>