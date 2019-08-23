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
       
  //require_once '../clases/Funciones.php';
  require_once '../clases/claseCarrito.php';

  try{
        // unescape los valores de cadena en la matriz JSON
$TableData = stripcslashes ($_POST['data']);

//$form = stripcslashes ($_POST['data1']);

// Decodificar el array JSON
$TableData= json_decode($TableData,TRUE);

//$form = json_decode($form,TRUE);

// ahora $ TableData se puede acceder como una matriz PHP
//var_dump($TableData);


  
    $nom = stripcslashes ($_POST['nomLista']);
    $fec_cre = date("Y-m-d h:i:s", time());
    $id_usu = $us;
    $vig = 1;
    
    
    

    
    $dao = new Carrito();
    
    
    $guardar_lista = $dao->guardar_lista($TableData, $nom, $fec_cre, $id_usu, $vig);
      
      if (count($guardar_lista)>0){
      echo"Error de base de datos, comuniquese con el administrador";    
      } else {
        echo"Lista ".$nom." guardada"; 
  }
    
    
      

  } catch (Exception $e) {
    echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_co/entrenamiento.php';</script>"; 



  }
?>