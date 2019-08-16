<?php 


require_once '../clases/Funciones.php';


$fun = new Funciones();    
$lista = $_POST['lista'];

              
              

          if (!empty($lista)) {

                $prod = array();

                foreach($lista as $fila){

                    $re = $fun->ubicar_lista_prod($fila[0]);
                        foreach($re as $row){

                              array_push($prod,array( array("Nombre" => $row['nom_prod'],
                                                      "id" => $row['id_prod'],
                                                      "Position" => array(
                                                      "Longitude" => floatval($row['longitud_tienda']),
                                                      "Latitude" => floatval($row['latitud_tienda'])
                                                      ),
                                                      "precio" => $row['precio_uni_prod'],
                                                      "tienda" => $row['nom_tienda'],
                                                      "img_prod" => $row['img_prod']
                                                      )));
                  
                            }
                    }

               ob_end_clean();
              
               echo json_encode($prod);
    
              }
          
?>