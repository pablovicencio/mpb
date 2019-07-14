<?php 
if( isset($_GET['id']) ){
    //Si la sesión esta seteada no hace nada
    $id = $_GET['id'];
    $anu = $_GET['anu'];
    $com = $_GET['com'];
  }
  else{
    //Si no lo redirige a la pagina index para que inicie la sesion 
    header("location: ../index.php");
  }   
   require_once dirname( __DIR__ ).'/clases/Funciones.php';
  
  $fun = new Funciones();   


?>
<!DOCTYPE html>
<html lang="es">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Publimatch es una plataforma donde puedes encontrar una gran variedad de locales comerciales, restaurantes, eventos y servicios que el gran Valle de Aconcagua tiene para ti. Los mejores anuncios de Los Andes, San Esteban, Calle Larga, San Felipe">
    <meta name="author" content="Pablo Vicencio">

    <title>PubliMatch - Avisos publicitarios</title>
    <link rel="canonical" href="https://www.publimatch.cl/" >
      
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- Plugin CSS -->
    <link href="../vendor/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="../css/freelancer.min.css" rel="stylesheet">
    <link href="../css/rrss.css" rel="stylesheet">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>




    <script type="text/javascript">
      function modalListaProd(anu) {
            $("#tbody_modalprod").empty();
            var table = document.getElementById("tabla_prod");
            //or use :  var table = document.all.tableid;
            for(var i = table.rows.length - 1; i > 0; i--)
            {
              table.deleteRow(i);
            }
             $.ajax({
              url: '../controles/controlListaProd.php',
              type: 'POST',
              data: {"anu":anu},
              dataType:'json',
              success:function(result){
                
                var filas = Object.keys(result).length;
             
                for (  i = 0 ; i < filas; i++){ //cuenta la cantidad de registros
                  var nuevafila= "<tr><td>" + 
                  result[i].nombre_prod + "</td><td>" +
                  result[i].desc_prod + "</td><td>$" +
                  result[i].precio_prod +"</td></tr>"
             
                  $("#tabla_prod").append(nuevafila)
                }
          
              }
          })
            
        
        }

      function isMobile() {
          try{ 
              document.createEvent("TouchEvent"); 
              document.getElementById("menuMob").style.display = "block";
              document.getElementById("menuMobFoo").style.display = "block";
              var touch = 'S';
              $(".carro").css({"width": "50vw", "height": "50vw"});
              $(".carroimg").css({"width": "auto", "height": "50vw"});

                  if(navigator.userAgent.match(/Android/i)){
                    var nav = 'Android';
                        
                }else if (navigator.userAgent.match(/BlackBerry/i)){
                    var nav = 'BlackBerry';
                        
                }else if (navigator.userAgent.match(/iPhone/i)){
                    var nav = 'iPhone';
                        
                }else if (navigator.userAgent.match(/iPad/i)){
                    var nav = 'iPad';
                        
                }else if (navigator.userAgent.match(/iPod/i)){
                    var nav = 'iPod';
                        
                }else if (navigator.userAgent.match(/Opera Mini/i)){
                    var nav = 'Opera Mini';
                        
                }else if (navigator.userAgent.match(/IEMobile/i)){
                    var nav = 'EMobile';
                        
                }


          }
          catch(e){ 
              document.getElementById("menuDesk").style.display = "block";
              var touch = 'N'
              var nav = 'Desk-'+navigator.appCodeName;
              $(".carro").css({"width": "40vw", "height": "27vw"});
              $(".carroimg").css({"width": "auto", "height": "27vw"});
          }
              


          

              $.ajax({
              type: "POST",
              url: '../controles/controlEstVisita.php',
              data:{t :touch, n :nav, a :<?php echo $id;?>},
              success: function (result) { 
              



              },
              error: function(){
                      
              }
            });



      }




        $(document).ajaxStart(function() {
          $("#formbuscar").hide();
          $("#loading").show();
             }).ajaxStop(function() {
          $("#loading").hide();
          $("#formbuscar").show();
          });  

  $(document).ready(function() {
          $("#formevaluar").submit(function() { 


            swal({
              text: 'Ingresa tu correo electronico',
              content: "input",
              button: {
                text: "Evaluar",
                closeModal: false,
              },
            })
            .then(mail => {
              if (!mail) throw null;


                        $.ajax({
              type: "POST",
              url: '../controles/controlEvaluar.php',
              data:$("#formevaluar").serialize()+"&id_anu=<?php echo $id;?>"+"&mail="+mail,
              success: function (result) { 
              var msg = result.trim();

                switch(msg) {
                        case '0':
                            swal("Error", "Verifique los datos de su evaluación", "warning");
                            break;
                        case '1':
                            swal("Error Base de Datos", "Error de base de datos, comuniquese con el administrador", "warning");
                            break;
                        case '2':
                            swal("Error", "Ups, al parecer hay un problema con tu correo, por favor intentalo nuevamente", "warning");
                            break;
                        default:
                            swal("Evaluación Ingresada", msg, "success",{
                                  buttons: false,
                                  timer: 3000,
                                });
                            setTimeout('document.location.reload(true)',3000);

                    }



              },
              error: function(){
                      alert('Verifique los datos')      
              }
            });

             
            })
            .catch(err => {
              if (err) {
                swal("Oh no!", "Tu evaluación no se ha guardado", "error");
              } else {
                swal.stopLoading();
                swal.close();
              }
            });







  
            return false;
          });
        }); 
    </script>

      <style>
  
    .slide {
      background-color: #34495E;
  }
  #anuncio{text-align: left!important; 
            background-color: #f8f9fa;
            padding: 10px;
            border-radius: 10px 10px 10px 10px;
            -moz-border-radius: 10px 10px 10px 10px;
            -webkit-border-radius: 10px 10px 10px 10px;
            border: 0px solid #000000;
            color: black;}
   #puntos {
  width: 250px;
  margin: 0 auto;
  height: 50px;
}

#puntos p {
  text-align: center;
}

#puntos label {
  font-size: 20px;
}

input[type="radio"] {
  display: none;
}

label {
  color: grey;
}

.clasificacion {
  direction: rtl;
  unicode-bidi: bidi-override;
}

label:hover,
label:hover ~ label {
  color: orange;
}

input[type="radio"]:checked ~ label {
  color: orange;
}



  </style>

  </head>

<body id="page-top" onload="isMobile()">
<div id="menuMob" name="menuMob" style="display: none;">
<nav class="navbar navbar-expand-lg bg-secondary fixed-top text-uppercase" id="mainNav">
      <div class="container">
        <img src="../img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
        <a class="navbar-brand js-scroll-trigger" href="../index.php">PubliMatch</a>
      </div>
    </nav>
</div>

<div id="menuDesk" name="menuDesk" style="display: none;">
  <nav class="navbar navbar-expand-sm bg-secondary fixed-top text-uppercase" id="mainNav">
    <a class="navbar-brand js-scroll-trigger" href="../index.php" id="link-home" name="link-home">
    <img src="../img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
    Publimatch
  </a>
          <ul class="navbar-nav ml-auto" >
            <li class="nav-item mx-0 mx-lg-1">
                <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="../index.php" id="link-home-mob" name="link-home-mob"><i class="fa fa-home" aria-hidden="true"></i></a>
            </li>
            <li class="nav-item mx-0 mx-lg-1">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#sugeridos" id="link-com-mob" name="link-com-mob"><i class="fa fa-th-large" aria-hidden="true"></i></a><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#sugeridos" id="link-com" name="link-com"> Sugeridos</a>
            </li>
            <li class="nav-item mx-0 mx-lg-1">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#contacto" id="link-anu-mob" name="link-anu-mob"><i class="fa fa-space-shuttle" aria-hidden="true"></i></a><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#contacto" id="link-anu" name="link-anu">Anunciate!</a>
            </li>
                                      <?php 
                                        $re1 = $fun->busca_promo(0);   
                                         if (!empty($re1)) {
                                           echo '<li class="nav-item mx-0 mx-lg-1">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="vistaPromociones.php?id=1" id="link-promo-mob" name="link-promo-mob"><i class="fa fa-bell" aria-hidden="true"></i></a><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="vistaPromociones.php?id=1" id="link-promo" name="link-promo">Promos!</a>
            </li>';
                                          }
                                        ?>       



                
          </ul>
  </nav>

</div>
<div class="sticky-container">
    <ul class="sticky">
       <li>
            <img src="../img/rrss/instagram-circle.png" width="32" height="32">
            <p><a href="https://www.instagram.com/publimatch.cl/" target="_blank">Siguenos en <br>Instagram</a></p>
        </li>
        <li>
            <img src="../img/rrss/facebook-circle.png" width="32" height="32">
            <p><a href="https://www.facebook.com/Publimatch-352753218615695" target="_blank">Siguenos en <br>Facebook</a></p>
        </li>
        <li>
            <img src="../img/rrss/whatsapp-circle.png" width="32" height="32">
            <p><a href="https://api.whatsapp.com/send?phone=56996643838" target="_blank">Contactanos en <br>WhatsAPP</a></p>
        </li>
    </ul>
</div>
  <div id="loading" style="display: none;">
    <center><img src="../img/load.gif"></center>
  </div>
    <!-- Header -->
    <header class="masthead bg-primary text-white text-center" id="mainCont">
      <div class="container" id="container">
          <div class="row">

        <?php 
                                        $re = $fun->cargar_anuncio($id);   
                                        foreach($re as $row)      
                                            {
                                               
                                            }   
                                            echo '<h2 class=" text-uppercase">'.$row['nom_anuncio'].'</h2><br>';
                                        ?>     



        </div>
          <div class="row" id="anuncio" name="anuncio">
          <div class="col-8">
             
                

                  <div id="img" class="carousel slide" data-ride="carousel">
                      <!-- The slideshow -->
                      <center><div class="carousel-inner carro">
                      <?php 
                                          $i=1;
                                          $re1 = $fun->cargar_imgs($id);   
                                          foreach($re1 as $row1) { 
                                            
                                                if ($i==1) {
                                                  $img=' active';
                                                }else
                                                {$img='';}
                                                 echo '<div class="carousel-item'.$img.'" >
                          <a class="portfolio-item d-block mx-auto" href="#modal'.$row1['id_img'].'"><img src="'.$row1['img'].'" alt="'.$row['nom_anuncio'].'" class="carroimg"></a>
                        </div>

                          <div class="portfolio-modal mfp-hide" id="modal'.$row1['id_img'].'">
      <div class="portfolio-modal-dialog bg-white">
        <a class="close-button d-none d-md-block portfolio-modal-dismiss" href="#">
          <i class="fa fa-3x fa-times"></i>
        </a>
        <div class="container text-center">
          <div class="row">
            <div class="col-lg-8 mx-auto">
              <img src="'.$row1['img'].'" alt="'.$row['nom_anuncio'].'" style="width: 100%; height: 100%">
              <div id="portafolio" name="portafolio"></div>
              <a class="btn btn-primary btn-lg rounded-pill portfolio-modal-dismiss" href="#">Volver</a>
            </div>
          </div>
        </div>
      </div>
    </div>
                        ';
                                            $i++;

                                              }  
                
                                          ?>   
                      </div>
                      
                      <!-- Left and right controls -->
                      <a class="carousel-control-prev" href="#img" data-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                      </a>
                      <a class="carousel-control-next" href="#img" data-slide="next">
                        <span class="carousel-control-next-icon"></span>
                      </a>
                    </div>
                    <span class="font-weight-bold"><?php echo $row['nom_comuna']; ?></span><br>
                    <span class="font-weight-bold"><?php echo $row['dir_anuncio']; ?></span><br><br>
                    <span >Telefonos: <a href="tel:<?php echo $row['fono1']; ?>"><?php echo $row['fono1']; ?></a> - <a href="tel:<?php echo $row['fono2']; ?>"><?php echo $row['fono2']; ?></a></span><br><br>


                   
                </div><br><br>

            <div class="col-4">


<?php
//$hdesde = date( 'H:i', strtotime( $row['hdesde_anuncio'] )); 
//$hhasta = date( 'H:i', strtotime( $row['hhasta_anuncio'] )); 

$t1 =  date('His', strtotime($row['hdesde_anuncio'])) ;
$t2 =  date('His', strtotime($row['hhasta_anuncio']));
$tn = date('His');


$valida = $fun->check_time($t1, $t2, $tn) ? "si" : "no";



    if ($valida == 'si') {
      echo('<span class="font-weight-bold text-success">Disponible <img src="../img/check.gif" alt="Disponible" height="32" width="32"></span><br><br>');
    }else{
      echo('<span class="font-weight-bold text-danger">No Disponible <img src="../img/cancel.gif" alt="Disponible" height="32" width="32"></span><br><br>');
    }






?>



                  <div class="form-group">

                    
                    

                    <span class="badge badge-success"><label for="nota" style="color:white;font-size: 1rem;">★</label> <?php echo $row['puntaje']; ?></span><br><br>
                     <?php
                      if ($row['fb'] <> '0') {
                         echo '<a  href="'.$row['fb'].'" target="blank">
                  <i class="fab fa-fw fa-facebook-f" style="font-size:32px" ></i>
                </a>';
                       } 
                    ?>  
                    <?php
                      if ($row['ig'] <> '0') {
                         echo '<a  href="'.$row['ig'].'" target="blank">
                  <i class="fab fa-fw fa-instagram" style="font-size:32px" ></i>
                </a>';
                      } 
                    ?>  
                    <?php
                      if ($row['tw'] <> '0') {
                         echo '<a  href="'.$row['tw'].'" target="blank">
                  <i class="fab fa-fw fa-twitter" style="font-size:32px" ></i>
                </a>';
                       } 
                    ?>  
                    <?php
                      if ($row['ws'] <> '0') {
                         echo '<a  href="'.$row['ws'].'" target="blank">
                  <i class="fas fa-desktop" style="font-size:32px" ></i>
                </a><br>';
                       } 
                    ?> 



                  </div>

                  <div class="form-group">
                    <?php 
                                        $re1 = $fun->busca_promo_anu($id);   
                                         if ($re1['promo']>0) {
                                           echo '<a href="vistaPromosAnuncio.php?anu='.$id.'" class="btn btn-outline-success">Promos 
                                                  <span class="badge badge-dark">'.$re1['promo'].'</span></a>';
                                          }
                                        ?>      
                  </div>
                  <div class="form-group">
                    <?php 
                                        $re1 = $fun->busca_lista_anu($id);   
                                         if ($re1['lista_prod']>0) {

                                           echo '<a href="#modalProd" class="btn btn-outline-success portfolio-item " onclick="modalListaProd('.$id.');">Productos</a>';
                                          }
                                        ?>      
                  </div>

                    <div class="portfolio-modal mfp-hide" id="modalProd">
                          <div class="portfolio-modal-dialog bg-white">
                            <a class="close-button d-none d-md-block portfolio-modal-dismiss" href="#">
                              <i class="fa fa-3x fa-times"></i>
                            </a>
                            <div class="container text-center">
                              <div class="row">
                                <div class="col-lg-8 mx-auto">
                                  <h3 class="text-secondary text-uppercase mb-0" id="nom_anu" name="nom_anu"><?php echo $row['nom_anuncio']; ?></h3>
                                  <div id="portafolio" name="portafolio">
                                    <table class="table table-sm table-striped" id="tabla_prod" name="tabla_prod">
                                        <thead class="thead-dark">
                                          <tr>
                                            <th scope="col">Producto</th>
                                            <th scope="col">Descripción</th>
                                            <th scope="col">Precio</th>
                                          </tr>
                                        </thead>
                                        <tbody id="tbody_modalprod">
                                        </tbody>
                                    </table>
                                  </div>
                                  <a class="btn btn-primary btn-lg rounded-pill portfolio-modal-dismiss" href="#">Volver</a>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>


                
            </div>
            <div class="col-12">
                  <span ><?php echo $row['desc_anuncio']; ?></span><br><br>
                <form class="puntos" name="formevaluar" id="formevaluar">
                  <p class="clasificacion">
                    <input type="submit" class="btn btn-primary" id="btnAc" name="btnAc" value="Evaluar">
                       <input id="radio1" type="radio" name="estrellas" value="7"><!--
                    --><label for="radio1" style="font-size: 2rem";>★</label><!--
                    --><input id="radio2" type="radio" name="estrellas" value="6"><!--
                    --><label for="radio2" style="font-size: 2rem";>★</label><!--
                    --><input id="radio3" type="radio" name="estrellas" value="5"><!--
                    --><label for="radio3" style="font-size: 2rem";>★</label><!--
                    --><input id="radio4"  type="radio" name="estrellas" value="4"><!--
                    --><label for="radio4" style="font-size: 2rem">★</label><!--
                    --><input id="radio5" type="radio" name="estrellas" value="3"><!--
                    --><label for="radio5" style="font-size: 2rem">★</label><!--
                    --><input id="radio6" type="radio" name="estrellas" value="2"><!--
                    --><label for="radio6" style="font-size: 2rem">★</label><!--
                    --><input id="radio7" type="radio" name="estrellas" value="1"><!--
                    --><label for="radio7" style="font-size: 2rem">★</label>

                  </p>

                </form>

                  <br>

                  <h4><span class="badge badge-light">Encuentralo en:</span><h4>
                    <div class="embed-responsive embed-responsive-16by9">
                    <?php
                      
                         echo $row['maps_anuncio'];
                        
                    ?>  
                  </div>
                </div>

        </div>
   

              
            
      </div>
    </header>
<section class="bg-primary text-white mb-0" id="sugeridos">




<center>
         <?php   
              
              $re3 = $fun->cargar_cat(-1, $anu, $id);
              if (!empty($re3)) {
              echo '<h3 class="text-center text-uppercase text-white">También te puede interesar</h3>';
                  foreach($re3 as $row3){
                   $puntaje = '';

                      for ($i=1; $i <= 7 ; $i++) { 
                            if ($row3['puntaje'] >= $i) {
                              $puntaje = $puntaje.'<label for="radio'.$i.'" style="color:orange;font-size: 1.5rem;">★</label>';
                            }else{
                              $puntaje = $puntaje.'<label for="radio'.$i.'" style="color:gray;font-size: 1.5rem;">★</label>';
                            }
                      }

                    echo (
                            '  <div class="card" >
                                    <img class="card-img-top" src="'.$row3['img'].'" alt="Card image">
                                    <div class="card-body">
                                      <h4 class="card-title">'.$row3['nom_anuncio'].'</h4>
                                      <a href="vistaAnuncio.php?id='.$row3['id_anuncio'].'&anu='.$anu.'&com='.$com.'" class="btn btn-primary">Ver Mas</a><br>
                                      '.$puntaje.'
                                    </div>
                                  </div>
                                  '
                      );
                  
                  }
            }
              ?>

    </center>
  </section>

    <!-- Contact Section -->
   <section id="contacto">
      <div class="container">
        <h2 class="text-center text-uppercase text-secondary mb-0">Anúnciate con nosotros!</h2>
        <hr class="star-dark mb-5">
        <div class="row">
          <div class="col-lg-8 mx-auto">
            <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19. -->
            <!-- The form should work on most web servers, but if the form is not working you may need to configure your web server differently. -->
            <form name="sentMessage" id="contactForm" novalidate="novalidate">
              <div class="control-group">
                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                  <label>Nombre</label>
                  <input class="form-control" id="name" type="text" placeholder="Nombre" required="required" data-validation-required-message="Por favor, ingresa tu nombre.">
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <div class="control-group">
                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                  <label>Email</label>
                  <input class="form-control" id="email" type="email" placeholder="Email" required="required" data-validation-required-message="Por favor, ingresa tu Email.">
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <div class="control-group">
                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                  <label>Telefono</label>
                  <input class="form-control" id="phone" type="tel" placeholder="Telefono" required="required" data-validation-required-message="Por favor ingresa tu número de telefono.">
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <div class="control-group">
                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                  <label>Mensaje</label>
                  <textarea class="form-control" id="message" rows="5" placeholder="Mensaje" required="required" data-validation-required-message="Por favor, ingresa tu mensaje."></textarea>
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <br>
              <div id="success"></div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary btn-xl" id="sendMessageButton">Enviar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>




<!--         Footer  -->
    <div class="footer2 text-center">
      <div class="container">
        <div class="row">
          
          <div class="col-md-4 mb-5 mb-lg-0">
            <h5 class="text-uppercase mb-4">Visítanos</h5>
            <ul class="list-inline mb-0">
              <li class="list-inline-item">
                <a class="btn btn-outline-light btn-social text-center rounded-circle" target="blank" href="https://www.facebook.com/Publimatch-352753218615695">
                  <i class="fab fa-fw fa-facebook-f"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a class="btn btn-outline-light btn-social text-center rounded-circle" target="blank" href="https://www.instagram.com/publimatch.cl/">
                  <i class="fab fa-fw fa-instagram"></i>
                </a>
              </li>
            </ul>
          </div>
          <div class="col-md-4">
            <h5 class="text-uppercase mb-4">PubliMatch</h5>
            <p class="lead mb-0">Esta plataforma digital esta a cargo de 
              <a href="http://www.andescode.cl" target="_blank">Andescode</a>.</p>
          </div>
        </div>
      </div>
      <div class="copyright py-4 text-center text-white">
      <div class="container">
        <small>Copyright &copy; PubliMatch 2019</small>
      </div>
    </div>
    </div>

    
    <div id="menuMobFoo" name="menuMobFoo" style="display: none;">
    <footer class="footer text-center">
    <nav class="navbar navbar-expand-sm bg-secondary  text-uppercase text-center" id="mainNav">
    
          <ul class="navbar-nav m-auto " >
            <li class="nav-item mx-0 mx-0">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#sugeridos" id="link-con-mob" name="link-con-mob"><i class="fa fa-th-large" aria-hidden="true"></i></a><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#sugeridos" id="link-con" name="link-con">Sugeridos</a>
            </li>
            <li class="nav-item mx-0 mx-0">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#contacto" id="link-anu-mob" name="link-anu-mob"><i class="fa fa-space-shuttle" aria-hidden="true"></i></a><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#contacto" id="link-anu" name="link-anu">Anunciate!</a>
            </li>
                                      <?php 
                                        $re1 = $fun->busca_promo(0);   
                                         if (!empty($re1)) {
                                           echo '<li class="nav-item mx-0 mx-0">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="vistaPromociones.php?id=1" id="link-promo-mob" name="link-promo-mob"><i class="fa fa-bell" aria-hidden="true"></i></a><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="vistaPromociones.php?id=1" id="link-promo" name="link-promo">Promos!</a>
            </li>';
                                          }
                                        ?>       



                
          </ul>
  </nav>
</footer>
</div>

    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) 
    <div class="scroll-to-top d-lg-none position-fixed ">
      <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top">
        <i class="fa fa-chevron-up"></i>
      </a>
    </div>-->



    <!-- Bootstrap core JavaScript -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="../js/jqBootstrapValidation.js"></script>
    <script src="../js/contact_me.js"></script>

    <!-- Custom scripts for this template -->
    <script src="../js/freelancer.min.js"></script>

  </body>

</html>