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
    echo "<h2>Error 01: Usuario ó Contraseña Invalido</h2>";

if($_GET["Error"]==2)
    echo "<h2>Error 02: Usuario no existe en servidor Mexico Team MX</h2>";

 ?>

               </div>
            </div>
</div>
</div>