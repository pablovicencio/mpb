<?php 


require_once '../clases/Funciones.php';


$fun = new Funciones();    
$comuna = stripcslashes ($_POST['comuna']);
$producto = stripcslashes ($_POST['producto']);

?>


      <?php   
              
              $re = $fun->cargar_cat($comuna, $producto, 0);
              //foreach($re as $row){
               /*$puntaje = '';

                  for ($i=1; $i <= 7 ; $i++) { 
                        if ($row['puntaje'] >= $i) {
                          $puntaje = $puntaje.'<label for="radio'.$i.'" style="color:orange;font-size: 1.5rem;">★</label>';
                        }else{
                          $puntaje = $puntaje.'<label for="radio'.$i.'" style="color:gray;font-size: 1.5rem;">★</label>';
                        }
                  }

                  if ($row['promo'] > 0) {
                    echo (
                        '  <div class="card" >
                                <img class="card-img-top" src="'.$row['img'].'" alt="Card image">
                                <div class="card-body">
                                  <h4 class="card-title">'.$row['nom_anuncio'].'</h4>
                                  <a href="vista/vistaAnuncio.php?id='.$row['id_anuncio'].'&anu='.$producto.'&com='.$comuna.'" class="btn btn-primary">Ver Mas</a><br>
                                  '.$puntaje.'
                                </div>
                                <div class="card-footer">
                                <a href="vista/vistaPromosAnuncio.php?anu='.$row['id_anuncio'].'" class="btn btn-outline-success">
                                  Promos <span class="badge badge-dark">'.$row['promo'].'</span>
                                </a><br>
                                </div>
                              </div>
                              '
                  );
                  }else{
                    echo (
                        '  <div class="card" >
                                <img class="card-img-top" src="'.$row['img'].'" alt="Card image">
                                <div class="card-body">
                                  <h4 class="card-title">'.$row['nom_anuncio'].'</h4>
                                  <a href="vista/vistaAnuncio.php?id='.$row['id_anuncio'].'&anu='.$producto.'&com='.$comuna.'" class="btn btn-primary">Ver Mas</a><br>
                                  '.$puntaje.'
                                </div>
                                <div class="card-footer">
                                <br>
                                </div>
                              </div>
                              '
                  );
                  }*/



                
              
              //}

          if (!empty($re)) {
                $datos = array();


              foreach($re as $row){
                $fila=array($row['nom_prod'] => array(
                                                      "Position" => array(
                                                      "Longitude" => floatval($row['longitud_tienda']),
                                                      "Latitude" => floatval($row['latitud_tienda'])
                                                      )
                                                      ));





                 $datos[] = $fila;

    
              }
            ob_end_clean();
    
            echo json_encode($datos);
          }
?>


