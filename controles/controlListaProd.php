<?php
      
	require_once '../clases/Funciones.php';

	try{

		$anu = stripcslashes ($_POST['anu']);

		 $fun = new Funciones();
		 $re = $fun->Busca_lista_prod($anu);
		 


          $prod = array();


          foreach($re as $row){

                $prod[] = $row;
    
              }
		ob_end_clean();
		
		echo json_encode($prod);
	
	} catch (Exception $e) {
		//echo($e);
		echo"'Error, verifique los datos'",  $e->getMessage(); 

	}
?>