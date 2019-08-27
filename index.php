<?php 
session_start(); 
if( isset($_SESSION['id']) ){
    //Si la sesión esta seteada no hace nada
    $id = $_SESSION['id'];
  }
  else{
    $id = 0;
  }   
   require_once 'clases/Funciones.php';
  $fun = new Funciones();    
?>
<!DOCTYPE html>
<html lang="es">
  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Mapa de los precios bajos">
    <meta name="author" content="Pablo Vicencio">

    <title>Mapa de los precios bajos</title>
    <link rel="canonical" href="https://www.mapadelospreciosbajos.cl/" >

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- Plugin CSS -->
    <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="css/freelancer.min.css" rel="stylesheet">
    <link href="css/rrss.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyDLYOM6tQISHF4gQOpUNGhTk98Ob-2-OBg"></script>
    <script src="js/map.js"></script>
    <script src="js/main_cli.js"></script>
    <script type="application/javascript" src="js/cookie.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">







  </head>

  <body id="page-top" onload="isMobile()">

<div id="menuMob" name="menuMob" style="display: none;">
<nav class="navbar navbar-expand-lg bg-secondary fixed-top text-uppercase" id="mainNav">
      <div class="container">
        <img src="img/logo.jpg" width="60" height="60" class="d-inline-block align-top" alt="">
        <!--<a class="navbar-brand js-scroll-trigger" href="index.php">Mapa de los precios bajos</a>-->
      </div>
    </nav>
</div>

<div id="menuDesk" name="menuDesk" style="display: none;">
  <nav class="navbar navbar-expand-sm bg-secondary fixed-top text-uppercase" id="mainNav">
    <a class="navbar-brand js-scroll-trigger" href="index.php" id="link-home" name="link-home">
    <img src="img/logo.jpg" width="30" height="30" class="d-inline-block align-top" alt="">
    Mapa de los precios bajos
  </a>
          <ul class="navbar-nav ml-auto" >
            <li class="nav-item mx-0 mx-lg-1">
                <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="index.php" id="link-home-mob" name="link-home-mob"><i class="fa fa-home" aria-hidden="true"></i></a>
            </li>
            <li class="nav-item mx-0 mx-lg-1">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="vista/vistaMicuenta.php" id="link-com-mob" name="link-com-mob"><i class="fa fa-address-card" aria-hidden="true"></i></a><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="vista/vistaMicuenta.php" id="link-com" name="link-com"> Mi Cuenta</a>
            </li>
            <li class="nav-item mx-0 mx-lg-1">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#conocenos" id="link-con-mob" name="link-con-mob"><i class="fa fa-users" aria-hidden="true"></i></a><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#conocenos" id="link-con" name="link-con">Nosotros</a>
            </li>
            <li class="nav-item mx-0 mx-lg-1">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#contacto" id="link-anu-mob" name="link-anu-mob"><i class="fa fa-space-shuttle" aria-hidden="true"></i></a><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#contacto" id="link-anu" name="link-anu">Contactanos</a>
            </li>


                
          </ul>
  </nav>

</div>
<div class="sticky-container">
    <ul class="sticky">
      <li>
            <img src="img/rrss/shopping-cart.png" width="32" height="32">
            <p><a href="#modalProd" class="portfolio-item" onclick="modalListaProd();">Carro <br><span id="prod_carro"></span></a></p>
        </li>
       <li>
            <img src="img/rrss/instagram-circle.png" width="32" height="32">
            <p><a href="https://www.instagram.com/" target="_blank">Siguenos en <br>Instagram</a></p>
        </li>
        <li>
            <img src="img/rrss/facebook-circle.png" width="32" height="32">
            <p><a href="https://www.facebook.com/" target="_blank">Siguenos en <br>Facebook</a></p>
        </li>
        <li>
            <img src="img/rrss/whatsapp-circle.png" width="32" height="32">
            <p><a href="https://api.whatsapp.com/send?phone=56996643838" target="_blank">Contactanos en <br>WhatsAPP</a></p>
        </li>
    </ul>
</div>

  <div id="loading" style="display: none;">
    <center><img src="img/load.gif"></center>
  </div>







    <!-- Header -->
    <header class="masthead bg-primary text-black text-center" id="mainCont">
      <div id="map" style=" display:none">
              <div id="map-canvas"></div>
                <div id="markers">
                  <h5>Proximidad</h5>
                    <ul id="lista_prox"></ul>
                </div>

    </div>
      <div class="container" id="container">
        <form id="formbuscar" onsubmit="return false;"  >
        
        <h1 class="text-uppercase mb-0 bg-white border">Encuentra el mejor precio!</h1>

        <hr class="star-dark">
            <div class="row">
              
            
                <div class="col-lg-4">
                  <select name="comuna" id="comuna" class="form-control" required>
                    <option value="" selected disabled>Selecciona la Comuna</option>
                                       <?php 
                                        $re = $fun->cargar_comunas(1);   
                                        foreach($re as $row)      
                                            {
                                              ?>
                                               <option value="<?php echo $row['comuna_id'] ?>"><?php echo $row['comuna_nombre'] ?></option>
                                                  
                                              <?php
                                            }    
                                        ?>       
                  </select>
                </div>
                <div class="col-lg-4">
                  <input class="form-control" type="text" name="producto" id="producto" maxlength="100" placeholder="¿Que buscas? Ej. detergente, cafe">
                </div>
                <div class="col-lg-3">
                  <input class="btn btn-dark" type="submit" name="buscar" id="buscar" value="Buscar">
                </div>

              
            </div>

            <h2 class="font-weight-light mb-0 bg-light border">Busca - Compara - Compra Inteligente</h2>
            </form>
            
            
      </div>

     
    
    </header>
      <center>
        <br><button class="btn btn-primary btn-lg" style="display: none" id="volver" name="volver" onclick="volver()">Volver a buscar</button><br><br>
      </center>


    <!-- Portfolio Grid Section 
    <section class="portfolio" id="categorias">
      <div class="container">
        <h2 class="text-center text-uppercase text-secondary mb-0">Categorías</h2>
        <hr class="star-dark mb-5">
        <div class="row">
          <div class="col-md-6 col-lg-4">
            <a class="portfolio-item d-block mx-auto" href="#portafolio-modal" onclick="modal(1)">
            <h5 align="center">Categoria1</h5>
              <div class="portfolio-item-caption d-flex position-absolute h-100 w-100">
                <div class="portfolio-item-caption-content my-auto w-100 text-center text-white">
                  <i class="fas fa-search-plus fa-3x"></i>
                </div>
              </div>
              <img class="img-fluid" src="img/portfolio/ecoturismo.png" alt="">
            </a>
          </div>
          <div class="col-md-6 col-lg-4">
            <a class="portfolio-item d-block mx-auto" href="#portafolio-modal" onclick="modal(2)">
            <h5 align="center">Categoria2</h5>
              <div class="portfolio-item-caption d-flex position-absolute h-100 w-100">
                <div class="portfolio-item-caption-content my-auto w-100 text-center text-white">
                  <i class="fas fa-search-plus fa-3x"></i>
                </div>
              </div>
              <img class="img-fluid" src="img/portfolio/restaurantes.png" alt="">
            </a>
          </div>
          <div class="col-md-6 col-lg-4">
            <a class="portfolio-item d-block mx-auto" href="#portafolio-modal" onclick="modal(3)">
            <h5 align="center">Categoria3</h5>
              <div class="portfolio-item-caption d-flex position-absolute h-100 w-100">
                <div class="portfolio-item-caption-content my-auto w-100 text-center text-white">
                  <i class="fas fa-search-plus fa-3x"></i>
                </div>
              </div>
              <img class="img-fluid" src="img/portfolio/deportes.png" alt="">
            </a>
          </div>
          <div class="col-md-6 col-lg-4">
            <a class="portfolio-item d-block mx-auto" href="#portafolio-modal" onclick="modal(4)">
            <h5 align="center">Categoria4</h5>
              <div class="portfolio-item-caption d-flex position-absolute h-100 w-100">
                <div class="portfolio-item-caption-content my-auto w-100 text-center text-white">
                  <i class="fas fa-search-plus fa-3x"></i>
                </div>
              </div>
              <img class="img-fluid" src="img/portfolio/hoteleria.png" alt="">
            </a>
          </div>
          <div class="col-md-6 col-lg-4">
            <a class="portfolio-item d-block mx-auto" href="#portafolio-modal" onclick="modal(5)">
            <h5 align="center">Categoria5</h5>
              <div class="portfolio-item-caption d-flex position-absolute h-100 w-100">
                <div class="portfolio-item-caption-content my-auto w-100 text-center text-white">
                  <i class="fas fa-search-plus fa-3x"></i>
                </div>
              </div>
              <img class="img-fluid" src="img/portfolio/servicios.png" alt="">
            </a>
          </div>
          <div class="col-md-6 col-lg-4">
            <a class="portfolio-item d-block mx-auto" href="#portafolio-modal" onclick="modal(6)">
            <h5 align="center">Categoria6</h5>
              <div class="portfolio-item-caption d-flex position-absolute h-100 w-100">
                <div class="portfolio-item-caption-content my-auto w-100 text-center text-white">
                  <i class="fas fa-search-plus fa-3x"></i>
                </div>
              </div>
              <img class="img-fluid" src="img/portfolio/delivery.png" alt="">
            </a>
          </div>
        </div>
      </div>
    </section>-->

    <!-- About Section -->
    <section class="bg-primary text-white mb-0" id="conocenos">
      <div class="container">
        <h2 class="text-center text-uppercase text-white">Equipo Mapa de los precios bajos</h2>
        <hr class="star-light mb-5">
        <div class="row">
          <div class="col-lg-4 ml-auto">
            <p class="lead">Esta plataforma está desarrollada para ayudarte a realizar una compra inteligente comparando los diferentes precios del mercado. Nuestro equipo multidisciplinario está atento para resolver todas tus dudas de como publicar tu tienda o como realizar una búsqueda optima</p>
          </div>
          <div class="col-lg-4 mr-auto">
            <p class="lead">No esperes más y se parte de nuestra comunidad</p>
          </div>
        </div>
        
      </div>
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
            <h5 class="text-uppercase mb-4">Mapa de los precios bajos</h5>
            <p class="lead mb-0">Esta plataforma digital esta a cargo de 
              <a href="http://www.andescode.cl" target="_blank">Andescode</a>.</p>
          </div>
        </div>
      </div>
      <div class="copyright py-4 text-center text-white">
      <div class="container">
        <small>Copyright &copy; Mapa de los precios bajos 2019</small>
      </div>
    </div>
    </div>

    
    <div id="menuMobFoo" name="menuMobFoo" style="display: none;">
    <footer class="footer text-center">
    <nav class="navbar navbar-expand-sm bg-secondary  text-uppercase text-center" id="mainNav">
    
          <ul class="navbar-nav m-auto " >
            <li class="nav-item mx-0 mx-0">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="vista/vistaMicuenta.php" id="link-con-mob" name="link-con-mob"><i class="fa fa-address-card" aria-hidden="true"></i></a><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="vista/vistaMicuenta.php" id="link-con" name="link-con">Mi Cuenta</a>
            </li>
            <li class="nav-item mx-0 mx-0">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#conocenos" id="link-con-mob" name="link-con-mob"><i class="fa fa-users" aria-hidden="true"></i></a><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#conocenos" id="link-con" name="link-con">Nosotros</a>
            </li>
            <li class="nav-item mx-0 mx-0">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#contacto" id="link-anu-mob" name="link-anu-mob"><i class="fa fa-space-shuttle" aria-hidden="true"></i></a><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#contacto" id="link-anu" name="link-anu">Anunciate!</a>
            </li>
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



    

    <!-- listado Modal 1 -->
                  <div class="portfolio-modal mfp-hide" id="modalProd">
                          <div class="portfolio-modal-dialog bg-white">
                            <a class="close-button d-none d-md-block portfolio-modal-dismiss" href="#">
                              <i class="fa fa-3x fa-times"></i>
                            </a>
                            <div class="container text-center">
                              <div class="row">
                                <div class="col-lg-8 mx-auto">
                                  <h3 class="text-secondary text-uppercase mb-0">Lista de Compras</h3>
                                  <div id="listado" name="listado">
                                    <table class="table table-responsive table-sm table-striped " id="tabla_prod" name="tabla_prod">
                                        <thead class="thead-dark">
                                          <tr>
                                            <th scope="col">Tienda</th>
                                            <th scope="col">Producto</th>
                                            <th scope="col">Cantidad</th>
                                            <th scope="col">Precio Total</th>
                                            <th scope="col"><i class="fa fa-trash" aria-hidden="true"></i></th>
                                          </tr>
                                        </thead>
                                        <tbody id="tbody_modalprod">
                                        </tbody>
                                    </table>
                                  </div>
                                  <?php
                                  if ($id > 0) {
                                    echo '<a class="btn btn-warning portfolio-modal-dismiss" id="btn_guardar" nom="btn_guardar" onclick="guardarLista('.$id.')"><i class="fa fa-floppy-o" aria-hidden="true"></i></a>';
                                  }
                                  ?>
                                  <a class="btn btn-success portfolio-modal-dismiss" onclick="ubicar(1)"><i class="fa fa-map-marker" aria-hidden="true"></i></a>
                                  <a class="btn btn-danger portfolio-modal-dismiss" href="#">Volver</a>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>



    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/freelancer.min.js"></script>

  </body>

</html>
