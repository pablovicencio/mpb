<?php
require_once '../recursos/db/db.php';
   

/*/////////////////////////////
Clase Anuncio
////////////////////////////*/

class AnuncioDAO 
{
    private $id_anu;
    private $nota;

    public function __construct($id_anu=null,
                                $nota=null
                                ) {



    $this->id_anu = $id_anu;
    $this->nota = $nota;
    
    }

    public function getAnu() {
    return $this->id_anu;
    }

    /*///////////////////////////////////////
    Ingresar Evaluacion
    //////////////////////////////////////*/
    public function ing_eva($mail) {

    			 try{
             
                $pdo = AccesoDB::getCon();

                $sql_ing_eva = " INSERT INTO `puntaje`
                                    (
                                    `nota_puntaje`,
                                    `vig_puntaje`,
                                    `fk_anuncio`,
                                    `mail_visita`)
                                    VALUES
                                    (
                                    :nota,
                                    1,
                                    :id_anu,
                                    :mail)";


                $stmt = $pdo->prepare($sql_ing_eva);
                
                $stmt->bindParam(":nota", $this->nota, PDO::PARAM_INT);
                $stmt->bindParam(":id_anu", $this->id_anu, PDO::PARAM_INT);
                $stmt->bindParam(":mail", $mail, PDO::PARAM_STR);
                $stmt->execute();

                if ($stmt->rowCount() <> 0) {
                    return 1;
                 }else{
                    return 0;
                 }

        

            } catch (Exception $e) {
                echo"Error, comuniquese con el administrador".  $e->getMessage().""; 
            }

    }
    
    /*///////////////////////////////////////
    Registrar Visita anuncio
    //////////////////////////////////////*/
    public function reg_visita($touch, $nav, $fec) {
                 try{
             
                $pdo = AccesoDB::getCon();
                $sql_reg_vis = " INSERT INTO `reg_visita`
                                    (
                                    `id_anuncio`,
                                    `touch`,
                                    `nav`,
                                    `fec`)
                                    VALUES
                                    (
                                    :id_anu,
                                    :touch,
                                    :nav,
                                    :fec)";
                $stmt = $pdo->prepare($sql_reg_vis);
                
                $stmt->bindParam(":id_anu", $this->id_anu, PDO::PARAM_INT);
                $stmt->bindParam(":touch", $touch, PDO::PARAM_STR);
                $stmt->bindParam(":nav", $nav, PDO::PARAM_STR);
                $stmt->bindParam(":fec", $fec, PDO::PARAM_STR);
                $stmt->execute();
                if ($stmt->rowCount() <> 0) {
                    return 1;
                 }else{
                    return 2;
                 }
        
            } catch (Exception $e) {
                echo"Error, comuniquese con el administrador".  $e->getMessage().""; 
            }
    }

}