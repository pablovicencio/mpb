<?php
require_once dirname( __DIR__ ) .'/recursos/db/db.php';

Class Carrito{
	public $miLista=array();
	public $total;
	public $cantidadTotal;


	function __construct(){
		
		$this ->total=0;
		$this ->cantidadTotal=0;
		
		
	}




	    /*///////////////////////////////////////
        Guardar Lista
        //////////////////////////////////////*/
        public function guardar_lista($TableData, $nom, $fec_cre, $id_usu, $vig) {

            try{

                
                $pdo = AccesoDB::getCon();




                $sql_lista = "INSERT INTO `lista_compra`
                                (`nom_lista`,`fec_cre_lista`,`usu_cre_lista`,`vig_lista`)
                                VALUES(:nom,:fec,:usu,:vig)";



                $stmt = $pdo->prepare($sql_lista);
                        $stmt->bindParam("nom", $nom, PDO::PARAM_STR);
                        $stmt->bindParam("fec", $fec_cre, PDO::PARAM_STR);
                        $stmt->bindParam("usu", $id_usu, PDO::PARAM_INT);
                        $stmt->bindParam("vig", $vig, PDO::PARAM_INT);
                $stmt->execute();



			if ($stmt->rowCount() > 0) {

				$sql_id_lista = "select id_lista from lista_compra order by 1 desc limit 1";

                $stmt = $pdo->prepare($sql_id_lista);
                $stmt->bindParam(":correo", $correo, PDO::PARAM_STR);
                $stmt->execute();


                $lista = $stmt->fetch(PDO::FETCH_ASSOC);



                foreach ($TableData as $row) {
                			  $id_lista = $lista["id_lista"];
                              $prod = $row['prod'];
                              $cant = $row['cant'];
                              $vig  = 1;
                              
                              
                              

                              
                            $sql_det_lista = "INSERT INTO `det_lista`
                                (`id_prod_det`,`vig_det`,`lista_det`,`cant_prod`)
                                VALUES(:prod, :vig, :lista, :cant)";



			                $stmt = $pdo->prepare($sql_det_lista);
			                        $stmt->bindParam("prod", $prod, PDO::PARAM_INT);
			                        $stmt->bindParam("vig", $vig, PDO::PARAM_INT);
			                        $stmt->bindParam("lista", $id_lista, PDO::PARAM_INT);
			                        $stmt->bindParam("cant", $cant, PDO::PARAM_INT);
			                $stmt->execute();




                              
                          }

             
    		}
        

            } catch (Exception $e) {
                 echo "-1";
                 //echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." ');</script>"; 
            }
        }




 

	//este método retorna el contenido del carrito
	public function get_content()
	{
		//asignamos el carrito a una variable
		$carrito = $this->miLista;
		//debemos eliminar del carrito el número de artículos
		//y el precio total para poder mostrar bien los artículos
		//ya que estos datos los devuelven los métodos 
		//articulos_total y precio_total
		return $carrito;
	}

	public function Agregar($id,$cant)
	{


		$existe=false;
				//var_dump($value["0"]);

		foreach(($_SESSION["carrito"]) as $key ) {
			
			if($id==$key[0]){
				$existe=true;
				//var_dump($value);
			}
		}
		//var_dump($existe);
		if ($existe==false) {
			//$this ->miLista[]=$pro;
			             
                             $_SESSION["carrito"][] =$pro;
                             echo "Producto agregado al carrito";
                                        
			                  }
                                        
			
			
			
		
		else{
			$this ->IncrementarCantidad($pro);
		}
		$this ->MontoTotal();
		
	}

	public function Eliminar($id)
	{
		unset($_SESSION["carrito"][$id]);
		$_SESSION["carrito"] = array_merge($_SESSION["carrito"]);
		$this ->MontoTotal();
		$_SESSION["cantidad"] = count($_SESSION["carrito"]);
		echo"Producto eliminado del carrito";
	}

	public function Limpiar()
	{
		unset ($this ->miLista);
	}

	public function MontoTotal()
    {
			$i=0;
			$_SESSION["monto"] = 0;
			foreach(($_SESSION["carrito"]) as $key ) {
				$dao = new bcDAO(); 

			              $re = $dao->cargar_carrito($key[0]);

			              foreach($re as $row){
			                $prod = $key;
			                $i++;
											$_SESSION["cantidad"] = $i;
											//echo $_SESSION["cantidad"];
			                               $_SESSION["monto"]+=$prod[2]*$row['precio_venta'];
			                               //echo $_SESSION["monto"];
			                                
			            }
			        }

	}
	
	public function Contar(){
		$this ->cantidadTotal=count($this->miLista);
	}

	public function IncrementarCantidad($pro)
	{
		$i=-1;
		$producto = array();
		foreach ($_SESSION["carrito"] as $key) {
			$i++;
			if (($key[0]==$pro[0])and($key[1]==$pro[1])) {
				
                $dao = new bcDAO(); 

			              $re = $dao->cargar_producto($pro[0]);

			              foreach($re as $row){
			                  switch ($pro[1]) {
                                      case 's':
                                        if(($key[2]+$pro[2]) > $row[stock_talla_s]){
                                            echo"Error, el stock es menor que la cantidad a agregar al carrito";
                                        }else{
                                            $producto=$key;
				//var_dump($key);

				$producto[2]=$producto[2]+$pro[2];

				
				//var_dump($producto);
				//var_dump($i);
				//var_dump($_SESSION["carrito"][$i]);


				$_SESSION["carrito"][$i]=$producto;
				echo"Producto agregado al carrito";
                                        }
                                        
                                        break;
                                        case 'm':
                                        if(($key[2]+$pro[2]) > $row[stock_talla_m]){
                                            echo"Error, el stock es menor que la cantidad a agregar al carrito";
                                        }else{
                                            $producto=$key;
				//var_dump($key);

				$producto[2]=$producto[2]+$pro[2];

				
				//var_dump($producto);
				//var_dump($i);
				//var_dump($_SESSION["carrito"][$i]);


				$_SESSION["carrito"][$i]=$producto;
				echo"Producto agregado al carrito";
                                        }
                                        break;
                                        case 'l':
                                        if(($key[2]+$pro[2]) > $row[stock_talla_l]){
                                            echo"Error, el stock es menor que la cantidad a agregar al carrito";
                                        }else{
                                            $producto=$key;
				//var_dump($key);

				$producto[2]=$producto[2]+$pro[2];

				
				//var_dump($producto);
				//var_dump($i);
				//var_dump($_SESSION["carrito"][$i]);


				$_SESSION["carrito"][$i]=$producto;
				echo"Producto agregado al carrito";
                                        }
                                        break;
                                        case 'xl':
                                        if(($key[2]+$pro[2]) > $row[stock_talla_xl]){
                                            echo"Error, el stock es menor que la cantidad a agregar al carrito";
                                        }else{
                                            $producto=$key;
				//var_dump($key);

				$producto[2]=$producto[2]+$pro[2];

				
				//var_dump($producto);
				//var_dump($i);
				//var_dump($_SESSION["carrito"][$i]);


				$_SESSION["carrito"][$i]=$producto;
				echo"Producto agregado al carrito";
                                        }
                                        break;
                                      
                                      
                                    }
			              }
				
			}
			
		}
		//$producto[2]=1;
		/*$producto[2]=$producto[2]+$pro[2];
		//var_dump($producto);*/

		foreach ($_SESSION["carrito"] as $key ) {
			if (($key[0]==$pro[0])and($key[1]==$pro[1])) {
				//var_dump($_SESSION["carrito"][$value[2]]);
				
			}
		}

		
		//$this ->MontoTotal();
	}


	function __destruct(){
		$this->total=0;
		$this->cantidadTotal=0;
	}
}
?>