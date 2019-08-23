<?php
require_once '../recursos/db/db.php';

/*/////////////////////////////
/////////Clase Usuario/////////
/////////////////////////////*/

class UsuarioDAO    
{
    private $id_usu;
    private $nombre;
    private $mail;
    private $pass;
    private $fec_cre;
    private $vigencia;






    public function __construct($id_usu=null,
                                $nombre=null,
                                $mail=null,
                                $pass=null,
                                $fec_cre=null,
                                $vigencia=null) 
                                {


    $this->id_usu       = $id_usu;
    $this->nombre       = $nombre;
    $this->mail         = $mail;
    $this->pass         = $pass;
    $this->fec_cre      = $fec_cre;
    $this->vigencia     = $vigencia;
    }

    public function getUsu() {
    return $this->id_usu;
    }
    /*///////////////////////////////////////
    /////////////////Login //////////////////
    ///////////////////////////////////////*/
    public function login(){

        try{

                
                $pdo = AccesoDB::getCon();

                $sql_login = "select id_usu id, nom_usu,mail_usu,pass_usu
                from usuario where vig_usu = 1 and mail_usu = :mail";

                $stmt = $pdo->prepare($sql_login);
                $stmt->bindParam(":mail", $this->mail, PDO::PARAM_STR);
           
                $stmt->execute();

               

                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                
                if ($this->pass == $row["pass_usu"]){
                    session_start();
                        $_SESSION['id'] = $row['id'];
                        $_SESSION['mail'] = $row['mail_usu'];
                        $_SESSION['nom'] = $row['nom_usu'];
                        $_SESSION['start'] = time();
                        $_SESSION['expire'] = $_SESSION['start'] + (5 * 60);
                        
                        //echo"<script type=\"text/javascript\">       window.location='../pag_usu/inicio.php';</script>";
                        echo"0";
                         
                        
                }else{
                    
                   echo "-2";
                   //echo"<script type=\"text/javascript\">alert('Error, favor verifique sus datos e intente nuevamente o comuniquese con su Administrador de Sistema.');window.location='../index.html';</script>"; 
                }

        } catch (Exception $e) {
                echo"-1";
                //echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../../index.html';</script>"; 
        }
    }





    /*///////////////////////////////////////
    /////////////Crear Usuario///////////////
    ///////////////////////////////////////*/
    public function crear_usuario() {


        try{
             
                $pdo = AccesoDB::getCon();

                 $sql_crear_usu = " INSERT INTO `usuario`(`nom_usu`,
                                                            `mail_usu`,
                                                            `pass_usu`,
                                                            `fec_cre_usu`,
                                                            `vig_usu`
                                                            )

                 VALUES(:nombre,:mail,:pass,:fec_cre,:vigencia)";


                $stmt = $pdo->prepare($sql_crear_usu);
                
                $stmt->bindParam(":nombre", $this->nombre, PDO::PARAM_STR);
                $stmt->bindParam(":mail", $this->mail, PDO::PARAM_STR);
                $stmt->bindParam(":pass", $this->pass, PDO::PARAM_STR);
                $stmt->bindParam(":fec_cre", $this->fec_cre, PDO::PARAM_STR);
                $stmt->bindParam(":vigencia", $this->vigencia, PDO::PARAM_BOOL);

                $stmt->execute();
        

            } catch (Exception $e) {
                echo"-1";
            }
    }


    /*///////////////////////////////////////
    //////////Modificar Usuario//////////////
    ///////////////////////////////////////*/
    public function modificar_usuario() {


        try{
             
                $pdo = AccesoDB::getCon();

                $sql_mod_usu = "UPDATE `usuario`
                                    SET
                                    `nom_usu` = :nombre,
                                    WHERE `id_usu` = :id ";


                $stmt = $pdo->prepare($sql_mod_usu);
                $stmt->bindParam(":nombre", $this->nombre, PDO::PARAM_STR);
                $stmt->bindParam(":id", $this->id_usu, PDO::PARAM_INT);

                $stmt->execute();
        

            } catch (Exception $e) {
                echo "-1";
                //echo"Error, comuniquese con el administrador".  $e->getMessage()."";
            }
    }

    /*///////////////////////////////////////
    //////////Actualizar Contraseña /////////
    ///////////////////////////////////////*/
    public static function actualizar_contraseña($id,$pwd){

        try{

                
                $pdo = AccesoDB::getCon();

                $sql_pwd = "update usuarios
                set pass_usu = :pwd
                where id_usu = :id";


                
                $stmt = $pdo->prepare($sql_pwd);
                $stmt->bindParam(":pwd", $pwd, PDO::PARAM_STR);
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);
           
                $stmt->execute();
        

        } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../../index.html';</script>"; 
        }
    }


}

    ?>