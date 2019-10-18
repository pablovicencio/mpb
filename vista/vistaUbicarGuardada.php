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


$fun = new Funciones();    
$TableData = stripcslashes ($_POST['data']);

                    

//$form = stripcslashes ($_POST['data1']);

// Decodificar el array JSON
$TableData= json_decode($TableData,TRUE);

//$form = json_decode($form,TRUE);

// ahora $ TableData se puede acceder como una matriz PHP
//var_dump($TableData);
              


          if (!empty($TableData)) {

                $prod = array();

                foreach($TableData as $fila){


                    $re = $fun->ubicar_lista_prod($fila['prod']);

                        foreach($re as $row){

                              array_push($prod,array( array("Nombre" => $row['nom_prod'],
                                                      "id" => $row['id_prod'],
                                                      "Position" => array(
                                                      "Longitude" => floatval($row['longitud_tienda']),
                                                      "Latitude" => floatval($row['latitud_tienda'])
                                                      ),
                                                      "precio" => $row['precio_uni_prod'],
                                                      "tienda" => $row['nom_tienda'],
                                                      "img_prod" => $row['img_prod'],
                                                      "precio_uni" => $row['precio_envase_prod']
                                                      )));
                  
                            }
                    }

               ob_end_clean();
              
               echo json_encode($prod);
    
              }

} catch (Exception $e) {
    //echo($e);
    echo"'Error, verifique los datos'",  $e->getMessage(); 

  }
          
?>