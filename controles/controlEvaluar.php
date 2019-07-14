<?php

 if( isset($_POST['estrellas']) and isset($_POST['id_anu']) and isset($_POST['mail']) ){
  		//Si la sesión esta seteada no hace nada
  		$id_anu = $_POST['id_anu'];
  		$nota = $_POST['estrellas'];
  		$mail = $_POST['mail'];
  	}
  	else{
 		//Si no lo redirige a la pagina index para que inicie la sesion	
 		echo("0");
 		goto salir;
 	}         
	     
 	require_once '../clases/claseAnuncio.php';
 	require_once '../clases/Funciones.php';

	try{
			$fun = new Funciones();


			$envio_mail = $fun->envia_mail_puntaje($mail);

			if ($envio_mail == 1) {
				$dao = new AnuncioDAO($id_anu,$nota);
			 		
						$eva_anu = $dao->ing_eva($mail);
						
						if ($eva_anu == 0){
						echo "1";    
						} else {
						echo"Evaluaste con nota: ".$nota.", gracias por apoyar nuestra comunidad";  }
			}else{
				echo "2"; 
			}


						


	salir:
	} catch (Exception $e) {
		echo"1"; 
	}
?>