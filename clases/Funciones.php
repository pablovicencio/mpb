<?php
require_once dirname( __DIR__ ) .'/recursos/db/db.php';

class Funciones 
{


    /*///////////////////////////////////////
    Validar contraseña 
    //////////////////////////////////////*/
        public function validar_pwd($id,$ident){
            try{
                
                
                $pdo = AccesoDB::getCon();
                            if ($ident == 0) {
                                $sql = "select pass_ope pass
                                        from operador where id_ope = :id";
                            
                            }else if ($ident == 1) {
                                $sql = "select pass_usu pass
                                        from usuario where id_usu = :id";
                            }
        
                       
                                
                            
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                $stmt->execute();
                $response = $stmt->fetchAll();
                return $response;
            } catch (Exception $e) {
            echo"-1";
            //echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../../index.html';</script>";
            }
        }



    /*///////////////////////////////////////
    listas guardadas
    //////////////////////////////////////*/
        public function cargar_list_usu($id){

            try{
                
                
                $pdo = AccesoDB::getCon();

                    $sql = "select a.id_lista, a.nom_lista, a.fec_cre_lista, sum(cant_prod) cant
                        from lista_compra a, det_lista b 
                        where a.id_lista = b.lista_det
                        and  a.usu_cre_lista = :id
                        group by a.id_lista, a.nom_lista, a.fec_cre_lista";

                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                $stmt->execute();

                $response = $stmt->fetchAll();
                return $response;

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); </script>";
            }
        }






    /*////////////////////////////////////////////
    ////////////// GENERAR PASS //////////////////
    ////////////////////////////////////////////*/ 
    public function generaPass(){
        //Se define una cadena de caractares. Te recomiendo que uses esta.
        $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
        //Obtenemos la longitud de la cadena de caracteres
        $longitudCadena=strlen($cadena);
         
        //Se define la variable que va a contener la contraseña
        $pass = "";
        //Se define la longitud de la contraseña, en mi caso 10, pero puedes poner la longitud que quieras
        $longitudPass=6;
         
        //Creamos la contraseña
        for($i=1 ; $i<=$longitudPass ; $i++){
            //Definimos numero aleatorio entre 0 y la longitud de la cadena de caracteres-1
            $pos=rand(0,$longitudCadena-1);
         
            //Vamos formando la contraseña en cada iteraccion del bucle, añadiendo a la cadena $pass la letra correspondiente a la posicion $pos en la cadena de caracteres definida.
            $pass .= substr($cadena,$pos,1);
        }
        return $pass;
    }


    /*////////////////////////////////////////////
    ////////////// VALIDAR MAIL  //////////////////
    ////////////////////////////////////////////*/ 
    public function validar_mail($mail,$opc){
        try {
            
            $pdo = AccesoDB::getCon();
            if($opc == 1){
                $sql = "SELECT mail_usu FROM usuario where mail_usu = :mail";
             }// else if($opc == 2){
            //    $sql = "SELECT rut_emp FROM empresa where rut_emp = :rut";
            // } 

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":mail", $mail, PDO::PARAM_STR);
            $stmt->execute();
            $response = $stmt->fetchAll();
            return $response;
            
        } catch (Exception $e) {
            echo"-1";
            //echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../../index.html';</script>";
        }
    }



    /*///////////////////////////////////////
    Datos mi cuenta usuario
    //////////////////////////////////////*/
        public function cargar_datos_usu($id){

            try{
                
                
                $pdo = AccesoDB::getCon();

                    $sql = "select id_usu, nom_usu, mail_usu
                        from usuario
                        where  id_usu = :id";

                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                $stmt->execute();

                $response = $stmt->fetchAll();
                return $response;

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); </script>";
            }
        }


    /*///////////////////////////////////////
    Ubicar Lista
    //////////////////////////////////////*/
        public function ubicar_lista_prod($id){

            try{
                
                
                $pdo = AccesoDB::getCon();

                    $sql = "select a.id_prod, a.nom_prod,b.nom_tienda,a.cat_prod,a.img_prod,a.precio_uni_prod,b.longitud_tienda,b.latitud_tienda
                        from producto a inner join tienda b on a.tienda_prod = b.id_tienda
                        where a.vig_prod = 1 and b.vig_tienda = 1 and a.id_prod = :id";

                                
                            

                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                $stmt->execute();

                $response = $stmt->fetchAll();
                return $response;

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); </script>";
            }
        }





     /*///////////////////////////////////////
    Buscar Lista de productos
    //////////////////////////////////////*/
        public function busca_lista_prod($id, $cant,$ori){

            try{
                
                
                $pdo = AccesoDB::getCon();


                if ($ori == 1) {
                    $sql = "select a.id_prod, b.nom_tienda, a.nom_prod, :cant cant, (:cant * a.precio_uni_prod) precio
                            from producto a inner join tienda b 
                            on a.tienda_prod = b.id_tienda
                            where a.id_prod = :id";

                
                                
                            

                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                    $stmt->bindParam(":cant", $cant, PDO::PARAM_INT);

                }else if ($ori == 2) {
                    $sql = "select a.id_prod, b.nom_tienda, a.nom_prod, cant_prod cant, (cant_prod * a.precio_uni_prod) precio
                            from producto a inner join tienda b 
                            on a.tienda_prod = b.id_tienda,
                            lista_compra c, det_lista d
                            where 
                            c.id_lista = d.lista_det
                            and d.id_prod_det = a.id_prod
                            and c.id_lista = :id";

                
    
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(":id", $id, PDO::PARAM_INT);

                }

               
                    $stmt->execute();

                    $response = $stmt->fetchAll();
                    
                return $response;

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='index.php';</script>";
            }
        }




    /*///////////////////////////////////////
    Buscar lista de productos de anuncio
    //////////////////////////////////////*/
        public function busca_lista_anu($id){

            try{
                
                
                $pdo = AccesoDB::getCon();

               

                    $sql = "select count(id_pro) lista_prod from lista_productos where fk_anuncio = :id and vig_prod = 1";

                
                                
                            

                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                $stmt->execute();

                $response = $stmt->fetch(PDO::FETCH_ASSOC);
                return $response;

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='index.php';</script>";
            }
        }



    /*///////////////////////////////////////
    Buscar Promociones de anuncio
    //////////////////////////////////////*/
        public function busca_promo_anu($id){

            try{
                
                
                $pdo = AccesoDB::getCon();

               

                    $sql = "select count(id_promo) promo from promo where fk_id_anuncio = :id and vig_promo = 1 and duracion_promo > sysdate()";

                
                                
                            

                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                $stmt->execute();

                $response = $stmt->fetch(PDO::FETCH_ASSOC);
                return $response;

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='index.php';</script>";
            }
        }




  /*///////////////////////////////////////
    Buscar Promocion
    //////////////////////////////////////*/
        public function busca_promocion($id){

            try{
                
                
                $pdo = AccesoDB::getCon();

               

                    $sql = "select b.id_promo, a.nom_anuncio, b.desc_promo, b.img_promo, b.duracion_promo, qr_promo, a.maps_anuncio, 
                            (stock - IFNULL((select count(id_uso_promo) from uso_promo u where b.id_promo = u.fk_id_promo),0)) stock
                            from anuncios a inner join promo b on a.id_anuncio = b.fk_id_anuncio 
                            where b.vig_promo = 1 and b.id_promo = :id and a.vig_anuncio = 1";

                
                                
                            

                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                $stmt->execute();

                $response = $stmt->fetchAll();
                return $response;

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='index.php';</script>";
            }
        }






   /*///////////////////////////////////////
    Buscar Promociones
    //////////////////////////////////////*/
        public function busca_promo($id){

            try{
                
                
                $pdo = AccesoDB::getCon();

                if($id == 0){

                    $sql = "select b.id_promo, a.nom_anuncio, b.desc_promo, b.img_promo
                            from anuncios a inner join promo b on a.id_anuncio = b.fk_id_anuncio 
                            where b.vig_promo = 1 and a.fec_termino_anuncio >= sysdate() and b.duracion_promo > sysdate() and  b.fk_id_anuncio > 0 and a.vig_anuncio = 1";
                        }else{
                            $sql = "select b.id_promo, a.nom_anuncio, b.desc_promo, b.img_promo
                            from anuncios a inner join promo b on a.id_anuncio = b.fk_id_anuncio 
                            where b.vig_promo = 1 and a.fec_termino_anuncio >= sysdate() and b.duracion_promo > sysdate()  and b.fk_id_anuncio = :id and a.vig_anuncio = 1";
                        }

                
                                
                            

                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                $stmt->execute();

                $response = $stmt->fetchAll();
                return $response;

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='index.php';</script>";
            }
        }








    /*///////////////////////////////////////
    Cargar Busqueda
    //////////////////////////////////////*/
        public function cargar_portafolio($id){

            try{
                
                
                $pdo = AccesoDB::getCon();

               

                    $sql = "select count(p.id_promo) promo, a.id_anuncio, a.nom_anuncio,a.cat_anuncio , 
IFNULL((select ROUND((sum(b.nota_puntaje)/count(b.id_puntaje)), 0) from puntaje b where a.id_anuncio = b.fk_anuncio and b.vig_puntaje = 1),0) puntaje, 
IFNULL((select i.img from img_anuncio i where a.id_anuncio = i.fk_id_anuncio order by i.id_img limit 1),'https://www.w3schools.com/bootstrap4/img_avatar1.png') img
from anuncios a left join promo p on a.id_anuncio = fk_id_anuncio and p.duracion_promo > sysdate()
 where  a.cat_anuncio = :id  and a.vig_anuncio = 1 and a.fec_termino_anuncio >= sysdate() 
group by a.id_anuncio, a.nom_anuncio,a.cat_anuncio ";

                
                                
                            

                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                $stmt->execute();

                $response = $stmt->fetchAll();
                return $response;

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='index.php';</script>";
            }
        }




    /*///////////////////////////////////////
    Chequear horario de atención
    //////////////////////////////////////*/


    function check_time($t1, $t2, $tn) {
        if ($t2 >= $t1) {
                return $t1 <= $tn && $tn < $t2;
            } else {
                return ! ($t2 <= $tn && $tn < $t1);
            }
        }


    /*///////////////////////////////////////
    Cargar Imagenes Anuncio
    //////////////////////////////////////*/
        public function cargar_imgs($anu){

            try{
                
                
                $pdo = AccesoDB::getCon();

                            
                                $sql = "select id_img, img from img_anuncio where fk_id_anuncio = :anu";
                           
                                
                            

                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(":anu", $anu, PDO::PARAM_INT);
                $stmt->execute();

                $response = $stmt->fetchAll();
                return $response;

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='index.php';</script>";
            }
        }





    /*///////////////////////////////////////
    Cargar Anuncio
    //////////////////////////////////////*/
        public function cargar_anuncio($anu){

            try{
                
                $dia = date('N');
                $pdo = AccesoDB::getCon();

                            
                                $sql = "select a.nom_anuncio,c.nom_comuna,a.dir_anuncio, a.desc_anuncio,  a.fono1_anuncio fono1,a.fono2_anuncio fono2, 
ifnull(a.fb_anuncio,'0') fb,ifnull(a.ig_anuncio,'0') ig,ifnull(a.tw_anuncio,'0') tw,ifnull(a.ws_anuncio,'0') ws, h.hdesde_horario hdesde_anuncio, h.hhasta_horario hhasta_anuncio, a.maps_anuncio,
iFNULL((select ROUND((sum(b.nota_puntaje)/count(b.id_puntaje)), 0) from puntaje b where a.id_anuncio = b.fk_anuncio and b.vig_puntaje = 1),0) puntaje
 from anuncios a inner join comunas_cl c on a.comuna_anuncio = c.id_comuna inner join horario h on a.id_anuncio = h.fk_id_anuncio = 1 where  a.id_anuncio = :anu and a.vig_anuncio = 1 and h.vig_horario = 1 and dia_horario = :dia and a.fec_termino_anuncio >= sysdate()  ";
                           
                                
                            

                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(":anu", $anu, PDO::PARAM_INT);
                $stmt->bindParam(":dia", $dia, PDO::PARAM_INT);
                $stmt->execute();

                $response = $stmt->fetchAll();
                return $response;

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='index.php';</script>";
            }
        }







    /*///////////////////////////////////////
    Cargar Busqueda
    //////////////////////////////////////*/
        public function cargar_cat($com, $prod, $id){

            try{
                
                
                $pdo = AccesoDB::getCon();

               if($com == -1){

                    $sql = "select distinct * from (
select count(p.id_promo) promo,a.id_anuncio, a.nom_anuncio,a.cat_anuncio , 
IFNULL((select ROUND((sum(b.nota_puntaje)/count(b.id_puntaje)), 0) from puntaje b where a.id_anuncio = b.fk_anuncio and b.vig_puntaje = 1),0) puntaje,
IFNULL((select i.img from img_anuncio i where a.id_anuncio = i.fk_id_anuncio order by i.id_img limit 1),'https://www.w3schools.com/bootstrap4/img_avatar1.png') img
from anuncios a left join promo p on a.id_anuncio = fk_id_anuncio and p.duracion_promo > sysdate() where  a.comuna_anuncio <> :com and a.vig_anuncio = 1 and  a.id_anuncio <> :id and a.cat_anuncio = (select z.cat_anuncio from anuncios z where z.id_anuncio = :id) and a.fec_termino_anuncio >= sysdate() 
group by a.id_anuncio, a.nom_anuncio,a.cat_anuncio 
union all
select count(p.id_promo) promo,a.id_anuncio, a.nom_anuncio,a.cat_anuncio , 
IFNULL((select ROUND((sum(c.nota_puntaje)/count(c.id_puntaje)), 0) from puntaje c where a.id_anuncio = c.fk_anuncio and c.vig_puntaje = 1),0) puntaje,
IFNULL((select i.img from img_anuncio i where a.id_anuncio = i.fk_id_anuncio order by i.id_img limit 1),'https://www.w3schools.com/bootstrap4/img_avatar1.png') img
from anuncios a inner join cat_anuncio b on a.cat_anuncio = b.id_cat left join promo p on a.id_anuncio = fk_id_anuncio and p.duracion_promo > sysdate()
where b.nom_cat like :anu and a.comuna_anuncio <> :com and a.vig_anuncio = 1 and a.id_anuncio <> :id and a.fec_termino_anuncio >= sysdate() 
group by a.id_anuncio, a.nom_anuncio,a.cat_anuncio ) a";



                }elseif ($com == 0) {
                    $sql = "select a.id_prod, a.nom_prod,b.nom_tienda,a.cat_prod,a.img_prod,a.precio_uni_prod,b.longitud_tienda,b.latitud_tienda,a.precio_envase_prod
from producto a inner join tienda b on a.tienda_prod = b.id_tienda
where a.vig_prod = 1 and b.vig_tienda = 1 and a.nom_prod like";
                




                }else{

               

                    $sql = "select a.id_prod, a.nom_prod,b.nom_tienda,a.cat_prod,a.img_prod,a.precio_uni_prod,b.longitud_tienda,b.latitud_tienda,a.precio_envase_prod
                        from producto a inner join tienda b on a.tienda_prod = b.id_tienda
                        where a.vig_prod = 1 and b.vig_tienda = 1 and a.nom_prod like :prod and a.id_prod <> :id and b.comuna_tienda = :com order by a.precio_envase_prod desc";
}
                
                                
                           
        
            
            $prod = "%".$prod."%";   
                                
                            

                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(":prod", $prod, PDO::PARAM_STR);
                $stmt->bindParam(":com", $com, PDO::PARAM_INT);
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                $stmt->execute();

                $response = $stmt->fetchAll();
                return $response;

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); </script>";
            }
        }





    /*///////////////////////////////////////
    Cargar Comunas
    //////////////////////////////////////*/
        public function cargar_comunas($vig){

            try{
                
                
                $pdo = AccesoDB::getCon();

                            if ($vig == 0) {
                                $sql = "select comuna_id, comuna_nombre from comuna";
                            
                            }else if ($vig == 1) {
                                $sql = "select comuna_id, comuna_nombre from comuna where comuna_id = 5701";
                            }
        
                       
                                
                            

                $stmt = $pdo->prepare($sql);
                $stmt->execute();

                $response = $stmt->fetchAll();
                return $response;

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='index.php';</script>";
            }
        }
        
        
        
        
            //////////////////////////mails/////////////////////////////////////

        public function envia_mail_puntaje($mail){

            try{

                        $to = "$mail";
                        $subject = "Evaluación Publimatch";

                        $message = "
                        <html>
                        <head>
                        <title>Evaluación Publimatch</title>
                        </head>
                        <body>
                        <p>Gracias por tu evaluación, eres muy importante para nuestra comunidad.</p>
                        <br>
                        <b>PubliMatch</b>
                        </body>
                        </html>
                        ";

                        // Always set content-type when sending HTML email
                        $headers = "MIME-Version: 1.0" . "\r\n";
                        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                        // More headers
                        $headers .= 'From: <hola@publimatch.cl>' . "\r\n";

                        $bool = mail($to,$subject,$message,$headers);

                        if($bool){
                            return "1";//enviado
                        }else{
                            return "0";//no enviado
                        }

                        } catch (Exception $e) {
                                        echo"1";
                                    }
                                }
/*///////////////////////////////////////
///////////////////////////////////////
///////////////////////////////////////
///////////////////////////////////////
///////////////////////////////////////*/




        /*///////////////////////////////////////
            enviar mail nuevo usuario
        //////////////////////////////////////*/
        public function mail_crear_usu($password,$nombre,$mail) {
            try{
                $to = $mail;
                        $subject = "Bienvenido a Mapa de los precios bajos";
                        $message = "
                        <html>
                        <head>
                        <title>Creación de Usuario - Mapa de los precios bajos</title>
                        </head>
                        <body>
                        <h2>Creación de Usuario</h2>
                        Estimado ".$nombre." se ha creado tu usuario para Mapa de los precios bajos.
                        <br>
                        Tus credenciales de ingreso son:
                        <br>
                        Mail: <b>".$mail."</b>
                        <br>
                        Contraseña: <b>".$password."</b>
                        <br><br>
                        Se despide Atte.
                        <br><br>
                        <h3>Mapa de los precios bajos</h3>
                        <br><br>
                        Este mensaje es enviado automaticamente, favor no responder.
                        </body>
                        </html>
                        ";
                        // Always set content-type when sending HTML email
                        $headers = "MIME-Version: 1.0" . "\r\n";
                        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                        // More headers
                        $headers .= 'From: <hola@mapadelospreciosbajos.cl>' . "\r\n";
                        $headers .= 'Cc: pvicencio@andescode.cl' . "\r\n";
                        mail($to,$subject,$message,$headers);
        } catch (Exception $e) {
                //throw $e;
                 echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../../index.html';</script>";
        }
        }


    



        /*///////////////////////////////////////
            enviar mail reset password
        //////////////////////////////////////*/
        public function correo_upd_pass($mail,$contraseña) {
            try{
                $to = $mail;
                        $subject = "Cambio de Contraseña Mapa de los precios bajos";
                        $message = "
                        <html>
                        <head>
                        <title>Cambio de Contraseña</title>
                        </head>
                        <body>
                        <h2>Actualización de contraseña</h2>
                        Estimad@ se ha actualizado su contraseña para Mapa de los precios bajos.
                        <br>
                        Tu Nueva Contraseña es:
                        <br><br>
                        Contraseña: <b>".$contraseña."</b>
                        <br><br>
                        Se despide Atte.
                        <br><br>
                        <h3>Mapa de los precios bajos</h3>
                        <br><br>
                        Este mensaje es enviado automaticamente, favor no responder.
                        </body>
                        </html>
                        ";
                        // Always set content-type when sending HTML email
                        $headers = "MIME-Version: 1.0" . "\r\n";
                        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                        // More headers
                        $headers .= 'From: <hola@mapadelospreciosbajos.cl>' . "\r\n";
                        $headers .= 'Cc: pvicencio@andescode.cl' . "\r\n";
                        mail($to,$subject,$message,$headers);
        } catch (Exception $e) {
                throw $e;
        }
        }
    }