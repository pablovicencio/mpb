<?php

 session_start();
 
if(isset($_SESSION['id'])){
    //Si la sesión esta seteada no hace nada
    $us = $_SESSION['id'];
  }
  else{
    //Si no lo redirige a la pagina index para que inicie la sesion 
    header("location: ../index.php");
  }      
	     
	require_once '../clases/claseUsuario.php';
	require_once '../clases/Funciones.php';
	

	try{

		$pwd = $_POST['actpwd'];
        $newpwd1 = $_POST['newpwd1'];
        $newpwd2 = $_POST['newpwd2'];
        
        $usu = $_SESSION['id'];
        $mail = $_SESSION['mail'];
		

		
		
		$fun = new Funciones(); 

		
			$val = $fun->validar_pwd($usu,1); //1-usuario sistema/0-cliente sistema

			if ($val[0]['pass'] <> md5($pwd)){
			echo"1";  
			}else{

				if ($newpwd1 <> $newpwd2) {
					echo"2";  
				}else{

							$upd_pass = UsuarioDAO::actualizar_contraseña($usu,md5($newpwd1));
							$enviar_pass = $fun->correo_upd_pass($mail,$newpwd1);
							session_destroy();
							echo"Su Contraseña fue actualizada correctamente y enviada a su correo ".$newpwd1.". En 10 segundos se cerrara su sesión para que ingrese nuevamente"; 
							
								
			}
		}
		
	salir:
	} catch (Exception $e) {
		echo"3"; 

	}
?>