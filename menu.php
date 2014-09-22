 <?php
session_start();

 //Validar que el usuario este logueado y exista un UID
if (($_SESSION['autenticado'] == 'SI' && isset($_SESSION['uid'])) )
{
?>
<ul class="menu"> 
        <li> <a href="homepage.php?id=nueva_solicitud">Nueva Solicitud</a></li>
        <li> <a href="buscar.php" >Buscar Solicitud</a></li>
</ul>
<div class="bienvenida">
<p><b>Bienvenido:</b> <?php echo utf8_encode($_SESSION['username']);?></p>
<p><b><?php echo utf8_encode($_SESSION['tx_area']);?></b></p>
</div>

<?php    
}
?>
