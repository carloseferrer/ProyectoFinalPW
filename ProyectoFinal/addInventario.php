<?php

include_once('connection.php');

ob_start();

$image_url = "";
$nombre_producto = "";
$tipo_producto = "";
$unidades = "";
$precio_producto = "";
$descripcion = "";
$estado = "";

if($_SERVER['REQUEST_METHOD']== 'POST'){
    $nombre_producto= $_POST['nombre_producto'];
    $tipo_producto = $_POST['tipo_producto'];
    $unidades= $_POST['unidades'];
    $precio_producto= $_POST['precio_producto'];
    $descripcion= $_POST['descripcion'];
    $estado= $_POST['estado'];
    $mensaje = "";

    $sql = "SELECT * FROM inventario WHERE nombre_producto = '$nombre_producto'";
    $validating = $con->query($sql);

    if($validating->num_rows > 0){
        $mensaje =" El producto ".$nombre_producto. " ya esta registrado";
    } 
    else {
        
            do {
        
        
                
                $sql_query = "INSERT INTO inventario (nombre_producto, tipo_producto, unidades, precio_producto, descripcion, estado)".
                             "VALUES ('$nombre_producto', '$tipo_producto' ,'$unidades','$precio_producto', '$descripcion', '$estado')";
                $result = $con->query($sql_query);
                
                if(!$result){
                    die("Invalid Query". $con->error);
                    break;
                }
                
                $nombre_producto = "";
                $tipo_producto = "";
                $unidades = "";
                $precio_producto = "";
                $descripcion = "";
                $estado = "";
                $mensaje = "";
        
                echo('<script>window.location="inventario.php"</script>');
                exit;
                
            } while (false);
            
        }
        
    
}
?>