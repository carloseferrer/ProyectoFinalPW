<?php

require_once('connection.php'); //Llamando a la conexión para BD


if(isset($_GET['id'])){


    $id_producto = $_GET['id'];
    
    $sql_query = "DELETE FROM produccion WHERE id_producto = $id_producto;";
    $con ->query($sql_query);

}

header("location: produccion.php");


?>