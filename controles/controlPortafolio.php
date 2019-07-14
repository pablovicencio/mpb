<?php 


require_once '../clases/Funciones.php';


$fun = new Funciones();    
$id = stripcslashes ($_POST['id']);


?>


      <?php   
              
              $re = $fun->cargar_portafolio($id);
              if (!empty($re)) {
                      foreach($re as $row){
                     $puntaje = '';

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
                                  <a href="vista/vistaAnuncio.php?id='.$row['id_anuncio'].'&anu='.$row['nom_anuncio'].'&com=-1" class="btn btn-primary">Ver Mas</a><br>
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
                                  <a href="vista/vistaAnuncio.php?id='.$row['id_anuncio'].'&anu='.$row['nom_anuncio'].'&com=-1" class="btn btn-primary">Ver Mas</a><br>
                                  '.$puntaje.'
                                </div>
                                <div class="card-footer">
                                <br>
                                </div>
                              </div>
                              '
                  );
                  }
                    
                    }
              }
              
?>