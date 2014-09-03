<?php

if (isset($_POST['btnLogin'])){

    include("conectar_bd.php");  
    conectar_bd();
     
    $usr = $_POST['txtUsuario'];
    $pw = $_POST['txtContraseña'];


echo $usr;
     
    $sql = "SELECT id_usuario, tbl_users.id_TipoUsuario as IdTipo,tx_nombre, tx_apellidoPaterno, tx_apellidoMaterno,  ctg_tiposusuario.tx_TipoUsuario as TipoUsuario FROM tbl_users
            INNER JOIN ctg_tiposusuario
            ON tbl_users.id_TipoUsuario = ctg_tiposusuario.id_TipoUsuario
            WHERE tx_username = '".$usr."'
            AND tx_password = '".$pw."' ";  
    $result = mysql_query($sql,$conexion); 
 
    $uid = "";
     
    //Si existe al menos una fila
    if( $fila=mysql_fetch_array($result) )
    {       
        
        $uid = $fila['id_usuario'];
        $id_TipoUsuario = $fila['IdTipo'];
        session_start();  
        $_SESSION['autenticado']    = 'SI';
        $_SESSION['uid']            = $uid;
        $_SESSION['TipoUsuario']        = $fila['TipoUsuario'];
        $_SESSION['nombre']        = $fila['tx_nombre'];
        $_SESSION['paterno']        = $fila['tx_apellidoPaterno'];
        $_SESSION['materno']        = $fila['tx_apellidoMaterno'];
         if($id_TipoUsuario==14 || $id_TipoUsuario==12 || $id_TipoUsuario==5){
                header('Location: principal.php');
        }
        else {
             header('Location: principalOper.php');
        }
                 
               
        
    }

    else {
        header('Location: index.php?id=errorUsuario');
    }

}
    else{

?>
                     

<!-- inicio -->
<form id="form1" action="#" method="post" >
        <div id="divNotificacion" />
        <div class="contenedor">
            <div class="header">
                <img alt="Movistar" class="logotipo" src="images/logo.png" />
                <h1>
                    
            </div>
            <div class="content">
                <div class="login">
                    <h2>Login
                    </h2>
                    <img src="images/candado.jpg" alt="Login" />
                    <p>
                        
                        Usuario:
                        <input type="text" id="txtUsuario" name="txtUsuario" MaxLength="20"/>
                    
                    </p>
                    
                      <p>
                        
                        Contraseña:
                        <input type = "password" id="txtContraseña" name="txtContraseña" MaxLength="20"/>
                    
                    </p>
                    <p>
                        &nbsp;</p>
                    <p>
                        <input type="submit" id="btnLogin" name="btnLogin" value="Ingresar" >
                        
                    </p>
                </div>
            </div>

        </div>
           
         </form>
<?php } ?>