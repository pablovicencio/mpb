<?php
   
     require_once '../clases/claseUsuario.php';
     require_once '../clases/Funciones.php';
 
 	try{

    if( isset($_POST['nomusu']) and isset($_POST['mailusu']) ){


        $nom = $_POST['nomusu'];
        $mail = $_POST['mailusu'];
        $vig = 1;
        $fec_cre = date("Y-m-d h:m:s", time());
        

      

        $func = new Funciones();

        if($mail != ''){
            $validar = $func->validar_mail($mail,1);

            if(count($validar)==0){

                $password = $func->generaPass();

                $dao = new UsuarioDAO('',$nom,$mail,md5($password),$fec_cre,$vig);

                $crearUsu = $dao->crear_usuario();

                if(count($crearUsu)>0){
                    echo "1";    
                }else{
                    
                   $mailUsu = $func->mail_crear_usu($password,$nom,$mail); 
                   echo "Usuario ".$nom." Creado Correctamente, La Contraseña es: ".$password." y será enviada por Email.";
                }
            }else{
                //rut duplicado
                echo "-3";
            }
        }else{
            //ERRO DE MAIL INGRESADO VACIO
            echo "-2";
        }  

        }
    else{
      echo "-2";
    }
	

    } catch (Exception $e) {
       //ERROR DE BASE DE DATOS
       echo "-1"; 
     }
?>