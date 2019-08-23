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
      
	require_once '../clases/Funciones.php';

	try{

		$id_lista = $_POST['lista'];

		//var_dump($lista);

		  $fun = new Funciones();
		  $re = $fun->busca_lista_prod($id_lista,0,2);

		  $lista = array();

		  foreach($re as $row){
		  	 $lista[] = $row;	  
          }

		 ob_end_clean();
		
		 echo json_encode($lista);
	
	} catch (Exception $e) {
		//echo($e);
		echo"'Error, verifique los datos'",  $e->getMessage(); 

	}
?>