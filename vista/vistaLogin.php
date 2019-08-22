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
    <script src="js/login_cli.js"></script>
    <script type="application/javascript" src="js/cookie.js"></script>






  </head>

  <body id="page-top" onload="isMobile()">

<div id="menuMob" name="menuMob" style="display: none;">
<nav class="navbar navbar-expand-lg bg-secondary fixed-top text-uppercase" id="mainNav">
      <div class="container">
        <!--<img src="" width="30" height="30" class="d-inline-block align-top" alt="">-->
        <a class="navbar-brand js-scroll-trigger" href="index.php">Mapa de los precios bajos</a>
      </div>
    </nav>
</div>

<div id="menuDesk" name="menuDesk" style="display: none;">
  <nav class="navbar navbar-expand-sm bg-secondary fixed-top text-uppercase" id="mainNav">
    <a class="navbar-brand js-scroll-trigger" href="index.php" id="link-home" name="link-home">
    <img src="img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
    Mapa de los precios bajos
  </a>
          <ul class="navbar-nav ml-auto" >
            <li class="nav-item mx-0 mx-lg-1">
                <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="index.php" id="link-home-mob" name="link-home-mob"><i class="fa fa-home" aria-hidden="true"></i></a>
            </li>
            <li class="nav-item mx-0 mx-lg-1">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#categorias" id="link-com-mob" name="link-com-mob"><i class="fa fa-address-card" aria-hidden="true"></i></a><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#categorias" id="link-com" name="link-com"> Mi Cuenta</a>
            </li>
            <li class="nav-item mx-0 mx-lg-1">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#conocenos" id="link-con-mob" name="link-con-mob"><i class="fa fa-users" aria-hidden="true"></i></a><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#conocenos" id="link-con" name="link-con">Nosotros</a>
            </li>
            <li class="nav-item mx-0 mx-lg-1">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#contacto" id="link-anu-mob" name="link-anu-mob"><i class="fa fa-space-shuttle" aria-hidden="true"></i></a><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#contacto" id="link-anu" name="link-anu">Contactanos</a>
            </li>
            <!--                           <?php 
                                        $re1 = $fun->busca_promo(0);   
                                         if (!empty($re1)) {
                                           echo '<li class="nav-item mx-0 mx-lg-1">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="vista/vistaPromociones.php?id=1" id="link-promo-mob" name="link-promo-mob"><i class="fa fa-bell" aria-hidden="true"></i></a><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="vista/vistaPromociones.php?id=1" id="link-promo" name="link-promo">Promos!</a>
            </li>';
                                          }
                                        ?>       
 -->


                
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


<div class="container" id="main">
  <div class="row">
    <div class="col-12">
      <h3>Ingresar</h3>
    </div>
    <div id="loading" style="display: none;">
    <center><img src="../recursos/img/load.gif"></center>
    </div>
  </div>
  <hr>
  <div class="row" id="login">
    <form  id="formLogin" onsubmit="return false;">
      <div class="col-12">
        <div class="form-group">
          <label for="nom">Mail:</label>
          <input type="text" class="form-control" id="mail_usu" name="mail_usu" required>
        </div>
        <div class="form-group">
          <label for="mail">Password:</label>
          <input type="password" class="form-control" id="pass_usu" name="pass_usu"required>
        </div>
       
      </div>
              
      <div class="col-12 text-center">
      <br>
      <input type="submit" class="btn btn-info" id="btn-login" name="btn-Login">Acceder</button> 
      </div>
    </form>
    </div>
  </div>




    

    
    <div id="menuMobFoo" name="menuMobFoo" style="display: none;">
    <footer class="footer text-center">
    <nav class="navbar navbar-expand-sm bg-secondary  text-uppercase text-center" id="mainNav">
    
          <ul class="navbar-nav m-auto " >
            <li class="nav-item mx-0 mx-0">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#categorias" id="link-con-mob" name="link-con-mob"><i class="fa fa-address-card" aria-hidden="true"></i></a><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="vista/micuenta.php" id="link-con" name="link-con">Mi Cuenta</a>
            </li>
            <li class="nav-item mx-0 mx-0">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#conocenos" id="link-con-mob" name="link-con-mob"><i class="fa fa-users" aria-hidden="true"></i></a><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#conocenos" id="link-con" name="link-con">Nosotros</a>
            </li>
            <li class="nav-item mx-0 mx-0">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#contacto" id="link-anu-mob" name="link-anu-mob"><i class="fa fa-space-shuttle" aria-hidden="true"></i></a><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#contacto" id="link-anu" name="link-anu">Anunciate!</a>
            </li>
            <!--                           <?php 
                                        $re1 = $fun->busca_promo(0);   
                                         if (!empty($re1)) {
                                           echo '<li class="nav-item mx-0 mx-0">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="vista/vistaPromociones.php?id=1" id="link-promo-mob" name="link-promo-mob"><i class="fa fa-bell" aria-hidden="true"></i></a><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="vista/vistaPromociones.php?id=1" id="link-promo" name="link-promo">Promos!</a>
            </li>';
                                          }
                                        ?>     -->   



                
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
                  <div class="portfolio-modal mfp-hide" id="modalPass">
                          <div class="portfolio-modal-dialog bg-white">
                            <a class="close-button d-none d-md-block portfolio-modal-dismiss" href="#">
                              <i class="fa fa-3x fa-times"></i>
                            </a>
                            <div class="container text-center">
                              <div class="row">
                                <div class="col-lg-8 mx-auto">
                                  <h3 class="text-secondary text-uppercase mb-0">Actualizar Contraseña</h3>
                                    <br>
                                    <div class="col-12">
                                          <form  id="formActPwd" onsubmit="return false;">
                                          <div class="form-group row">
                                            <label class="col-sm-6 col-form-label" >Contraseña Actual:</label>
                                            <div class="col-sm-6">
                                            <input type="password" class="form-control" id="actpwd" placeholder="Ingresa tu contraseña" maxlength="6" name="actpwd">
                                            </div>
                                          </div>

                                          <div class="form-group row">
                                            <label class="col-sm-6 col-form-label" >Nueva Contraseña:</label>
                                            <div class="col-sm-6">
                                            <input type="password" class="form-control" id="newpwd1" placeholder="Nueva contraseña" maxlength="6" name="newpwd1">
                                            </div>
                                          </div>

                                          <div class="form-group row">
                                            <label class="col-sm-6 col-form-label" >Repita la Nueva Contraseña:</label>
                                            <div class="col-sm-6">
                                            <input type="password" class="form-control" id="newpwd2" placeholder="Nueva contraseña" maxlength="6" name="newpwd2">
                                            </div>
                                          </div>
                                            <center><input type="submit" class="btn btn-info" id="btnAc" name="btnAc" value="Actualizar"></center> 
                                            <br>
                                          </form>
                                      </div>
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