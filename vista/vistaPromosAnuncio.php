<?php 
if( isset($_GET['anu']) ){
    //Si la sesión esta seteada no hace nada
    $id = $_GET['anu'];
  }
  else{
    //Si no lo redirige a la pagina index para que inicie la sesion 
    header("location: ../index.php");
  }   
   require_once dirname( __DIR__ ).'/clases/Funciones.php';
  
  $fun = new Funciones();   

setlocale(LC_ALL,"es_ES");
?>
<!DOCTYPE html>
<html lang="es">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Publimatch es una plataforma donde puedes encontrar una gran variedad de locales comerciales, restaurantes, eventos y servicios que el gran Valle de Aconcagua tiene para ti. Las mejores promociones de Los Andes, San Esteban, Calle Larga, San Felipe">
    <meta name="author" content="Pablo Vicencio">

    <title>PubliMatch - Avisos publicitarios - Promos</title>
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>







    <script type="text/javascript">


      function isMobile() {
          try{ 
              document.createEvent("TouchEvent"); 
              document.getElementById("menuMob").style.display = "block";
              document.getElementById("menuMobFoo").style.display = "block";

          }
          catch(e){ 
              document.getElementById("menuDesk").style.display = "block";
          }
      }


        $(document).ajaxStart(function() {
          $("#formbuscar").hide();
          $("#loading").show();
             }).ajaxStop(function() {
          $("#loading").hide();
          $("#formbuscar").show();
          }); 


    function addZero(i) {
        if (i < 10) {
            i = "0" + i;
        }
        return i;
    }




    function modal(id) {
    console.log(id);
    document.getElementById("titulo_promo").innerHTML = "";
    document.getElementById("img_promo").src = "";
    document.getElementById("qr").src = "";
    document.getElementById("desc_promo").innerHTML = "";
    document.getElementById("final_promo").innerHTML = "";
    document.getElementById("mapa").innerHTML = "";
    
     $.ajax({
      url: '../controles/controlPromo.php',
      type: 'POST',
      data: {"id":id},
      dataType:'json',
      success:function(result){

              var fecha = new Date(result[0].duracion_promo);
              var options = {  month: 'long', day: 'numeric' };

              var h = addZero(fecha.getHours());
              var m = addZero(fecha.getMinutes());
         
              document.getElementById("titulo_promo").innerHTML = result[0].nom_anuncio;
              document.getElementById("img_promo").src = result[0].img_promo;
              document.getElementById("qr").src = result[0].qr_promo;
              document.getElementById("desc_promo").innerHTML = result[0].desc_promo;
              document.getElementById("final_promo").innerHTML = fecha.toLocaleDateString("es-ES", options);
              document.getElementById("hora_final_promo").innerHTML = h + ":" + m;
              document.getElementById("mapa").innerHTML = result[0].maps_anuncio;
              window.scroll(0, 0);

        
               },
                
              
              error: function(){
                      alert('Verifique los datos')      
              }
  })
   }
    </script>

      <style>

label {
  color: grey;
}


label:hover,
label:hover ~ label {
  color: orange;
}

.btn-primary:focus{color: white;}
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
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#contacto" id="link-anu-mob" name="link-anu-mob"><i class="fa fa-space-shuttle" aria-hidden="true"></i></a><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#contacto" id="link-anu" name="link-anu">Anunciate!</a>
            </li>    
                
          </ul>
  </nav>

</div>
  <div id="loading" style="display: none;">
    <center><img src="../img/load.gif"></center>
  </div>
    <!-- Header -->
    <header class="masthead bg-primary text-white text-center" id="mainCont">
      <div class="container" id="container">
          <h4>¡Aprovecha éstas Promos!</h4>
          <div class="row justify-content-center">
            

        <?php 
                                        $re = $fun->busca_promo($id);   
                                        foreach($re as $row)      
                                            {
                                               echo (
                                                      '  <div class="card" >
                                                              <img class="card-img-top" src="'.$row['img_promo'].'" alt="Card image">
                                                              <div class="card-body">
                                                                <h6 class="card-title">'.$row['nom_anuncio'].'</h6>
                                                                <div class="card-body">'.$row['desc_promo'].'</div>
                                                                <a class="btn btn-primary portfolio-item " href="#promocion-modal" onclick="modal('.$row['id_promo'].')" class="btn btn-primary">Ver Mas</a>
                                                              </div>
                                                            </div>
                                                            '
                                                );
                                            }   
                                        ?>     



        </div>

   

              
            
      </div>
    </header>

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
                  <input class="form-control" id="name" type="text" placeholder="Nombre" required="required" data-validation-required-message="Please enter your name.">
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <div class="control-group">
                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                  <label>Email</label>
                  <input class="form-control" id="email" type="email" placeholder="Email" required="required" data-validation-required-message="Please enter your email address.">
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <div class="control-group">
                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                  <label>Telefono</label>
                  <input class="form-control" id="phone" type="tel" placeholder="Telefono" required="required" data-validation-required-message="Please enter your phone number.">
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <div class="control-group">
                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                  <label>Mensaje</label>
                  <textarea class="form-control" id="message" rows="5" placeholder="Mensaje" required="required" data-validation-required-message="Please enter a message."></textarea>
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
        <small>Copyright &copy; PubliMatch 2018</small>
      </div>
    </div>
    </div>

    
    <div id="menuMobFoo" name="menuMobFoo" style="display: none;">
    <footer class="footer text-center">
    <nav class="navbar navbar-expand-sm bg-secondary  text-uppercase text-center" id="mainNav">
    
          <ul class="navbar-nav m-auto " >
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


  <!-- Promocion Modal -->
  <div class="portfolio-modal mfp-hide" id="promocion-modal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title" id="titulo_promo"  name="titulo_promo"></h4>
          <a class="close-button d-none d-md-block portfolio-modal-dismiss" href="#">
          <i class="fa fa-3x fa-times"></i>
        </a>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
           <div class="row">
                <div class="col-8">
                  <img id="img_promo" class="rounded float-left img-fluid" src="" >
                </div>
                <div class="col-4">
                  <div id="img_qr" name="img_qr">
                      <img id="qr" class="img-fluid" src="" >
                  </div>
                  <h6>Presenta este còdigo QR en el local para validar la promo</h6>
                </div>
           </div>
           <div class="row">
             <div class="col-12"><br>
                <p id="desc_promo" class="font-weight-bold"></p>
                <label>Esta promo finaliza el <span id="final_promo"  name="final_promo"></span>, a las <span id="hora_final_promo"  name="hora_final_promo"></span></label>
                <h6>Encuentra esta promo en:<h6>
                    <div class="embed-responsive embed-responsive-16by9" id="mapa">
                    </div>
              </div>
           </div>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <a class="btn btn-primary btn-lg rounded-pill portfolio-modal-dismiss" href="#">
                Volver</a>
        </div>
        
      </div>
    </div>
  </div>

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