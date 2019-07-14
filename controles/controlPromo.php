<?php

 if( isset($_POST['id']) ){
  		//Si la sesión esta seteada no hace nada
  		$id_promo = stripcslashes ($_POST['id']);
  	}
  	else{
 		//Si no lo redirige a la pagina index para que inicie la sesion	
 		header("location: ../index.php");
 		
 	}         
	     
 	require_once '../clases/Funciones.php';
  

	try{
			

			$fun = new Funciones();   
 		
			$re = $fun->busca_promocion($id_promo);
			
			$promo = array();

			foreach($re as $row){

                $promo[] = $row;
    
              }
		ob_end_clean();
		
		echo json_encode($promo);

	
	} catch (Exception $e) {
		echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../vista/vistaPromociones.php';</script>"; 
	}
?>