<?php

include_once('connection.php');

ob_start();


$nombre_producto = "";
$materiales = "";
$unidades = "";
$mano_obra = "";
$estado = "";

if($_SERVER['REQUEST_METHOD']== 'POST'){
    $nombre_producto= $_POST['nombre_producto'];
    $materiales= $_POST['materiales'];
    $unidades= $_POST['unidades'];
    $mano_obra= $_POST['mano_obra'];
    $estado= $_POST['estado'];
    $errorMessage = "";

    $query_sql = "SELECT * FROM produccion WHERE nombre_producto = '$nombre_producto'";
    $validando = $con->query($query_sql);

    if($validando->num_rows > 0){
        $errorMessage = "El producto ".$nombre_producto." ya se encuentra registrado";
    } else {

        do {
    
            
            $sql_query = "INSERT INTO produccion (nombre_producto, materiales, unidades, mano_obra, estado)".
                         "VALUES ('$nombre_producto', '$materiales' ,'$unidades','$mano_obra', '$estado')";
            $result = $con->query($sql_query);
            
            if(!$result){
                die("Invalid Query". $con->error);
                break;
            }
            
            $materiales = "";
            $unidades = "";
            $mano_obra = "";
            $estado = "";
            
    
            echo('<script>window.location="produccion.php"</script>');
            exit;
    
        } while (false);
    
        
    }


}

?>