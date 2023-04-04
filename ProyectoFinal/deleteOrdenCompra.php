<?php

require_once('connection.php'); //Llamando a la conexión para BD

if(isset($_GET['id'])){


    $id_orden = $_GET['id'];
    
    $sql_query = "DELETE FROM orden_compra WHERE id_orden = $id_orden;";
    $con ->query($sql_query);


}

header("location: ordenesCompra.php");


?>