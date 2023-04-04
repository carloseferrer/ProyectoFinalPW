<?php

require_once('connection.php'); //Llamando a la conexión para BD


$id_producto = "";
$nombre_producto = "";
$tipo_producto = "";
$unidades = "";
$precio_producto = "";
$descripcion = "";
$estado = "";


if ( $_SERVER ['REQUEST_METHOD'] == 'GET'){
    
    if(!isset($_GET["id"])){
        header('location: iventario.php');
        exit;
    }

    $id_producto = $_GET["id"];

    $sql_query = "SELECT * FROM inventario WHERE id_producto=$id_producto";
    $result = $con->query($sql_query);
    $row = $result->fetch_assoc();

    $nombre_producto = $row['nombre_producto'];
    $tipo_producto = $row['tipo_producto'];
    $unidades = $row['unidades'];
    $precio_producto = $row['precio_producto'];
    $descripcion = $row['descripcion'];
    $estado = $row['estado'];

} else {


    // POST

    $id_producto = $_POST['id'];
    $nombre_producto = $_POST['nombre_producto'];
    $tipo_producto = $_POST['tipo_producto'];
    $unidades = $_POST['unidades'];
    $precio_producto = $_POST['precio_producto'];
    $descripcion = $_POST['descripcion'];
    $estado = $_POST['estado'];


    do{


        $sql_query = "UPDATE inventario SET nombre_producto = '$nombre_producto', tipo_producto = '$tipo_producto', unidades = '$unidades', precio_producto = '$precio_producto', descripcion = '$descripcion', estado = '$estado' WHERE id_producto = $id_producto";
        $result = $con->query($sql_query);
        header('location: inventario.php');
        exit;

    } while(true);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Editar Inventario</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>
<body>
    <nav class="navbar" style="background:#0071A8;">
    <a class="navbar-brand" style="color:#fff;" href="#" >Casa Limpia C.A</a>
    <button type="button" class="btn btn-light"><a href="logout-user.php">Cerrar Sesion</a></button>
    </nav>
    
    <div class="wrapper d-flex align-items-stretch">
        <nav id="sidebar">
            <div class="custom-menu">
					<button type="button" id="sidebarCollapse" class="btn btn-primary">
	          <i class="fa fa-bars"></i>
	          <span class="sr-only">Toggle Menu</span>
	        </button>
        </div>
				<div class="p-4">
		  		<h1><a href="home.php" class="logo">Sistema Administrativo <span>Casa Limpia C.A</span></a></h1>
                  <ul class="list-unstyled components mb-5">
	          <li class="active">
	            <a href="home.php"><span class="fa-solid fa-gauge mr-3"></span> Dashboard</a>
	          </li>
	          <li>
	              <a href="inventario.php"><span class="fa-solid fa-spray-can-sparkles mr-3"></span> Inventario</a>
	          </li>
	          <li>
              <a href="produccion.php"><span class="fa fa-briefcase mr-3"></span> Produccion</a>
            </li>
	          <li>
              <a href="#"><span class="fa-solid fa-credit-card mr-3"></span> Ordenes de Compra</a>
	          </li>

              <br>
      
	        </ul>
            
	        <div class="footer">
                <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
	        </div>
            
        </div>
    </nav>
    
    <!-- Page Content  -->
    <!-- <div class="p-4 p-md-5 pt-5">
        <h1>Este es el Inventario</h1>
    </div> -->



    <div class="container">
    
        <div class="p-4 p-md-5 pt-5">
            <h1 class="text-center">Editar Inventario</h1> <br>
            <div class="card card-outline card-primary">
                <div class="card-body" style="color:black;">
                    <form method="POST" id="editarInventario">
                        <input type="hidden" name="id" value="<?php echo $id_producto;?>">
                        <div class="form-group">
                            <label> Nombre del Producto </label>
                            <input type="text" name="nombre_producto" class="form-control" placeholder="Enter First Name" value="<?php echo $nombre_producto;?>" required>
                        </div>

                        <div class="form-group">
                        <label>Tipo</label> 
                            <select class="custom-select" name="tipo_producto"aria-label="Default select example" id="" name="estado" value="<?php echo $tipo_producto;?>" required>
                                <option value="Materia Prima">Materia Prima</option>
                                <option value="Productos Terminados">Productos Terminados</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label> Unidades </label>
                            <input type="number" name="unidades" class="form-control" placeholder="Enter Last Name" value="<?php echo $unidades;?>" required>
                        </div>

                        <div class="form-group">
                            <label> Precio </label>
                            <input type="number" step="0.01" name="precio_producto" class="form-control" placeholder="Enter Course" value="<?php echo $precio_producto;?>" required>
                        </div>

                        <div class="form-group">
                            <label> Descripcion </label>
                            <input type="text" name="descripcion" class="form-control" placeholder="Enter Course" value="<?php echo $descripcion;?>" required>
                        </div>

                        <div class="form-group">
                        <label> Estado </label> 
                            <select class="custom-select" name="estado"aria-label="Default select example" id="" name="estado" value="<?php echo $estado;?>" required>
                                <option value="Activo">Activo</option>
                                <option value="Inactivo">Inactivo</option>
                            </select>
                        </div>
                        <div id="preview" class="form-group d-flex justify-content-center"></div>
                    </form>
                </div>
                <div class="card-footer">
                    <div class="col-md-12">
                        <div class="row">
                            <button class="btn btn-sm btn-primary mr-2" type="submit" name="editInventariobtn" form="editarInventario">Registrar</button>
                            <a class="btn btn-sm btn-secondary" href="inventario.php">Cancelar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="./assets/js/jquery.min.js"></script>
    <script src="./assets/js/popper.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <script src="./assets/js/main.js"></script>


    
</body>
</html>
</body>
</html>