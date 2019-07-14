<?php

 if( isset($_POST['a'])){
  		//Si la sesión esta seteada no hace nada
  		$anu = $_POST['a'];
  	}
  	else{
 		echo"2"; 
 	}         
 	
 	require_once '../clases/claseAnuncio.php';

	try{
			
			$touch = $_POST['t'];
			$nav = $_POST['n'];
			$fec = date("Y-m-d H:i:s", time());

			$dao = new AnuncioDAO($anu,'');
 		
			$visita = $dao->reg_visita($touch, $nav, $fec);
			
			echo $visita; 
				
					
	} catch (Exception $e) {
		echo"'Error, comuniquese con el administrador".  $e->getMessage()." '"; 
	}
?>