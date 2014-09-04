<?php

if (isset($_POST['txtUsuario'])){
   
    //ldap
  
  /*  $usuario = $_POST['txtUsuario'];
    $pass = $_POST['txtContraseña'];
    
                              // $usuario = 'MRT06294';
                              // $pas = 'Rodrigo.09';
                               $ad_host = 'mexico.tem.mx';
                                    $ds = ldap_connect('mexico.tem.mx');
                if (!$ds) throw new Exception('No se pudo conectar al servidor mexico.tem.mx');
                define('LDAP_OPT_DIAGNOSTIC_MESSAGE', 0x0032);
                ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
                ldap_set_option($ds, LDAP_OPT_REFERRALS, 0);
                                $valor=explode('.',$ad_host);
                                $user = $valor[0].'\\'.$usuario;
                                $bind = ldap_bind($ds,$user,$pass);                                                                                                               
 
if($bind)
*/

   $usuario = $_POST['txtUsuario'];
   $pass = $_POST['txtContraseña'];
   //$usuario = 'MRT06294';
   //$pas = 'Rodrigo.09';
   $ldaphost = 'mexico.tem.mx';
   $ds=ldap_connect($ldaphost);  
   $valor=explode('.',$ldaphost);
   $user = $valor[0].'\\'.$usuario;
 
if ($ds) {
          //realizando la autenticacion
          $r=ldap_bind($ds, $user, $pass);
          if(!$r) die("Error: Usuario y Contraseña no existen en servidor principal<br>");

    include("config.php");
     
    $sql ="SELECT   id_usuario, username, nombre, n_paterno, n_materno,
                    users.area_idarea as id_area, area.tx_area as tx_area, area.oper_sol as oper_sol
             FROM   users
       INNER JOIN   area
               ON   users.area_idarea = area.id_area
            WHERE   username =  '$usuario'";

     $result=mysql_db_query($db, $sql, $link); 

    $uid = "";
     
    //Si existe al menos una fila
    if( $fila=mysql_fetch_array($result) )
       {       
        
                $uid = $fila['id_usuario'];
                $id_area = $fila['id_area'];
                session_start();  
                $_SESSION['autenticado']    = 'SI';
                $_SESSION['uid']            = $uid;
                $_SESSION['username']       = $fila['username'];
                $_SESSION['area']        = $fila['id_area'];
                $_SESSION['tx_area']        = $fila['tx_area'];
                $_SESSION['nombre']        = $fila['nombre'];
                $_SESSION['paterno']        = $fila['n_paterno'];
                $_SESSION['materno']        = $fila['n_materno'];
                $_SESSION['oper_sol']        = $fila['oper_sol'];

             if($fila['oper_sol']==0){
                        header('Location: index.php?id=operador');
                }
                else {
                     header('Location: index.php?id=solicitante');
                }
        
        }

            else  {
                header('Location: index.php?id=errorUsuario&Error=1');
                    }

 } else {
                echo "Error en conexion del servidor"; 
                    }

}
    else{

?>
                     

<!-- inicio -->

        <div id="divNotificacion" />
            <form id="form1" action="#" method="post" >

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
                        <input type = "password" id="txtContraseña" name="txtContraseña" MaxLength="20" required/>
                    
                    </p>
                    <p>
                        &nbsp;</p>
                    <p>
                        <input type="submit" ID="btnLogin"  value="Ingresar" >
                        
                    </p>
                </div>
            </div>

        </div>
           
         </form>
<?php } ?>