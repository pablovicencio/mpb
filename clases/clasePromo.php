<?php
require_once '../recursos/db/db.php';
   

/*/////////////////////////////
Clase Promo
////////////////////////////*/

class PromoDAO 
{
    private $id_promo;
    private $fec_uso;

    public function __construct($id_promo=null,
                                $fec_uso=null
                                ) {



    $this->id_promo = $id_promo;
    $this->fec_uso = $fec_uso;
    
    }

    public function getPromo() {
    return $this->id_promo;
    }

    /*///////////////////////////////////////
    Guardar Uso Promo
    //////////////////////////////////////*/
    public function uso_promo() {

    			 try{
             
                $pdo = AccesoDB::getCon();

                $sql_uso_promo = " INSERT INTO `uso_promo`
                                    (
                                    `fec_uso_promo`,
                                    `fk_id_promo`)
                                    VALUES
                                    (:fec,
                                     :id)";


                $stmt = $pdo->prepare($sql_uso_promo);
                
                $stmt->bindParam(":fec", $this->fec_uso, PDO::PARAM_STR);
                $stmt->bindParam(":id", $this->id_promo, PDO::PARAM_INT);
                $stmt->execute();
        

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='http://publimatch.cl/';</script>"; 
            }

    }
    
    
    /*///////////////////////////////////////
    Registrar Visita promo
    //////////////////////////////////////*/
    public function reg_promo($touch, $nav, $fec) {

                 try{
             
                $pdo = AccesoDB::getCon();

                $sql_reg_vis = " INSERT INTO `reg_visita`
                                    (
                                    `id_promo`,
                                    `touch`,
                                    `nav`,
                                    `fec`)
                                    VALUES
                                    (
                                    :id_promo,
                                    :touch,
                                    :nav,
                                    :fec)";


                $stmt = $pdo->prepare($sql_reg_vis);
                
                $stmt->bindParam(":id_promo", $this->id_promo, PDO::PARAM_INT);
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