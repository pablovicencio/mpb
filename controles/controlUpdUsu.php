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

	try{
			$nom = $_POST['nom'];

			$dao = new UsuarioDAO($us,$nom,'','','','');
 		
			$upd_usu = $dao->modificar_usuario();
			
			if (count($upd_usu)>0){
					echo "-1";     
			} else {
				echo $nom." Modificado";  
				
			}
	} catch (Exception $e) {
		echo"-1"; 
	}
?>