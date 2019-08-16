<?php 
session_start(); 
  require_once '../clases/Carrito.php';
  $miCarrito = new Carrito();
  if(isset($_SESSION['carrito'])){
        $cantidad = $_SESSION['cantidad'];
        $monto = $_SESSION['monto'];
  }else{
        $cantidad = 0;
        $monto = 0;
  }

  try{
    $id = $_POST['id'];
    $cant = $_POST['cant'];

    

    
  } catch (Exception $e) {
    throw $e;
  }
  
?>