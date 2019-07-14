<?php

 if( isset($_POST['p'])){
  		//Si la sesión esta seteada no hace nada
  		$promo = $_POST['p'];
  	}
  	else{
 		echo"2"; 
 	}         
 	
 	require_once '../clases/clasePromo.php';

	try{
			
			$touch = $_POST['t'];
			$nav = $_POST['n'];
			$fec = date("Y-m-d H:i:s", time());

			$dao = new PromoDAO($promo,'');
 		
			$visita = $dao->reg_promo($touch, $nav, $fec);
			
			echo $visita; 
				
					
	} catch (Exception $e) {
		echo"'Error, comuniquese con el administrador".  $e->getMessage()." '"; 
	}
?>