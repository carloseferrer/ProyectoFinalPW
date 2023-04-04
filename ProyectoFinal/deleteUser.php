<?php

require_once('connection.php'); //Llamando a la conexión para BD

if(isset($_GET['id'])){


    $id = $_GET['id'];
    
    $sql_query = "DELETE FROM usertable WHERE id = $id;";
    $con ->query($sql_query);

}

header("location: registrarUsuario.php");





?>