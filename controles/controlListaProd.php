<?php
      
	require_once '../clases/Funciones.php';

	try{

		$lista = $_POST['lista'];

		//var_dump($lista);

		  $fun = new Funciones();

		  $prod = array();

		  foreach($lista as $fila){

				  $re = $fun->busca_lista_prod($fila[0],$fila[1]);
		          foreach($re as $row){

		                array_push($prod,$row);
		    
		              }
          }

		 ob_end_clean();
		
		 echo json_encode($prod);
	
	} catch (Exception $e) {
		//echo($e);
		echo"'Error, verifique los datos'",  $e->getMessage(); 

	}
?>