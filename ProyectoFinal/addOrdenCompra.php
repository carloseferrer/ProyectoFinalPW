<?php

include_once('connection.php');

$nombre_producto = "";
$unidades = "";
$precio_producto = "";
$nombre_proveedor = "";
$direccion_proveedor = "";
$estado = "";


if($_SERVER['REQUEST_METHOD']== 'POST'){

    $nombre_producto  = $_POST['nombre_producto'];
    $unidades = $_POST['unidades'];
    $precio_producto = $_POST['precio_producto'];
    $nombre_proveedor = $_POST['nombre_proveedor'];
    $direccion_proveedor = $_POST['direccion_proveedor'];
    $estado = $_POST['estado'] ;


    do {

        
        $sql_query = "INSERT INTO orden_compra (nombre_producto, unidades, precio_producto, nombre_proveedor, direccion_proveedor ,estado)".
                     "VALUES ('$nombre_producto', '$unidades' ,'$precio_producto', '$nombre_proveedor', '$direccion_proveedor' ,'$estado')";
        $result = $con->query($sql_query);
        
        if(!$result){
            die("Invalid Query". $con->error);
            break;
        }

        


        header("location: ordenesCompra.php");
        exit;

    } while (false);
}


?>