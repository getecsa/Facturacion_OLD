<div id="divNotificacion" />
<div class="contenedor">
            <div class="header">
                <img alt="Movistar" class="logotipo" src="images/logo.png" />
                <h1></h1>
            </div>
            <div class="content">
                <div class="login">
 <?php
if($_GET["Error"]==1)
    echo "<h2>Error 01: Usuario ó Contraseña Invalido en Sistema</h2>";

if($_GET["Error"]==2)
    echo "<h2>Error 02: Usuario ó Contraseña Invalido en Active Directory</h2>";

if($_GET["Error"]==3)
    echo "<h2>Error 03: El usuario de Active Directory no existe en el directorio del sistema</h2>";

?>

               </div>
            </div>
</div>
</div>