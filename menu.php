<ul class="menu"> 
        <li> <a href="index.php?id=nueva_solicitud">Nueva Solicitud</a></li>
        <li> <a href="buscar.php" >Buscar Solicitud</a></li>
</ul>
<div class="bienvenida">
<p><b>Bienvenido:</b> <?php echo utf8_encode($_SESSION['username']);?></p>
<p><b><?php echo utf8_encode($_SESSION['tx_area']);?></b></p>
</div>
