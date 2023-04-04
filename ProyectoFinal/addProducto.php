<?php require_once "controllerUserData.php"; ?>
<?php 
$email = $_SESSION['email'];
$password = $_SESSION['password'];
if($email != false && $password != false){
    $sql = "SELECT * FROM usertable WHERE email = '$email'";
    $run_Sql = mysqli_query($con, $sql);
    if($run_Sql){
        $fetch_info = mysqli_fetch_assoc($run_Sql);
        $status = $fetch_info['status'];
        $code = $fetch_info['code'];
        if($status == "verified"){
            if($code != 0){
                header('Location: reset-code.php');
            }
        }else{
            header('Location: user-otp.php');
        }
    }
}else{
    header('Location: login-user.php');
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $fetch_info['name'] ?> | Home</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./assets/css/style.css">
    <!-- <style>
    @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
    nav{
        padding-left: 100px!important;
        padding-right: 100px!important;
        background: #6665ee;
        font-family: 'Poppins', sans-serif;
    } 
    nav a.navbar-brand{
        color: #fff;
        font-size: 30px!important;
        font-weight: 500;
    }
    button a{
        color: #6665ee;
        font-weight: 500;
    }
    button a:hover{
        text-decoration: none;
    }
    h1{
        position: absolute;
        top: 50%;
        left: 50%;
        width: 100%;
        text-align: center;
        transform: translate(-50%, -50%);
        font-size: 50px;
        font-weight: 600;
    }
    </style> -->
</head>
<body>
    <nav class="navbar" style="background:#0071A8;">
    <a class="navbar-brand" style="color:#fff;" href="#" >Casa Limpia C.A</a>
    <button type="button" class="btn btn-light"><a href="logout-user.php">Logout</a></button>
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
                                <?php

              if($fetch_info['type']== "2"){
                echo "
                
                <li class='active'>
                  <a href='home_worker.php'><span class='fa-solid fa-gauge mr-3'></span> Dashboard</a>
                </li>
                
                ";
              } else {
                echo "
                
                <li class='active'>
                  <a href='home.php'><span class='fa-solid fa-gauge mr-3'></span> Dashboard</a>
                </li>
                
                ";
              }
            
            ?>

	          <li>
	              <a href="inventario.php"><span class="fa-solid fa-spray-can-sparkles mr-3"></span> Inventario</a>
	          </li>
	          <li>
              <a href="produccion.php"><span class="fa fa-briefcase mr-3"></span> Productos Necesarios</a>
            </li>
	          <li>
              <a href="OrdenesCompra.php"><span class="fa-solid fa-credit-card mr-3"></span> Ordenes de Compra</a>
	          </li>
	          <li>
                  <a href="#"><span class="fa-solid fa-chart-simple mr-3"></span> Graficas y Datos</a>
	          </li>
              <?php
              if($fetch_info['type']== "1"){
                echo"
                
                <br>
                <li>
                    <span class='mr-3'> Sistema</span>
                </li>
                <li>
                  <a href='registrarUsuario.php'><span class='fa-solid fa-user mr-3'></span> Agregar Usuario</a>
                </li>
                
                ";
              }
            ?>
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



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Añadir Productos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="addInventario.php" method="POST">
      <div class="modal-body" style="color:black;">
                            <div class="form-group">
                                <label> Nombre del Producto </label> 
                                    <select class="custom-select" name="estado"aria-label="Default select example" id="" name="estado">
                                        <option selected disabled>Elige el Estado</option>
                                        <option value="Activo">Activo</option>
                                        <option value="Inactivo">Inactivo</option>
                                    </select>
                                </div>

                        <div class="form-group">
                            <label> Unidades </label>
                            <input type="number" name="unidades" class="form-control" placeholder="Enter Last Name">
                        </div>

                        <div class="form-group">
                            <label> Precio </label>
                            <input type="number" step="0.01" name="precio_producto" class="form-control" placeholder="Enter Course">
                        </div>

                        <div class="form-group">
                            <label> Descripcion </label>
                            <input type="text" name="descripcion" class="form-control" placeholder="Enter Course">
                        </div>

                        <div class="form-group">
                        <label> Estado </label> 
                            <select class="custom-select" name="estado"aria-label="Default select example" id="" name="estado">
                                <option selected disabled>Elige el Estado</option>
                                <option value="Activo">Activo</option>
                                <option value="Inactivo">Inactivo</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" name="insertdata" class="btn btn-primary">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="p-4 p-md-5 pt-5">
            <h1 class="text-center">Ordenes de Compra</h1> <br>
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <div class="card-tools float-right" style="padding-left:7px;">
                        <!-- Button trigger modal -->
                            <button type="button" class="btn btn-flait btn-primary" data-toggle="modal" data-target="#exampleModal"><span class="fas fa-plus"></span> Crear Nuevo</button>
                    </div>
                    <div class="card-tools float-left">
                        <div class="container">
                            <form action="" method="GET" >
                                <div class="card-tools float-left">
                                    <select class="custom-select" id="busquedaResultado" name="busquedaResultado" aria-label="Default select example">
                                        <option value="Todas">Todas</option>
                                        <option value="Abierta">Abiertas</option>
                                        <option value="Cerrada">Cerradas</option>
                                    </select>
                                </div>
                                <div class="card-tools float-left" style="margin-left:10px;">
                                    <button type="submit" name="busquedabtn" class="btn btn-flait btn-primary"><span class="fa-solid fa-magnifying-glass"></span> Buscar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-tools float-right">
                        <?php
                            if(isset($_GET['busquedabtn'])){
                                $resultado = $_GET['busquedaResultado'];
                            
                        ?>
                        <form action="descargarReporte.php" method="POST">
                            <input style="display:none;" type="text" name="resultado" value="<?php echo $resultado ?>">
                            <button type="" name="reportebtn" class="btn btn-flait btn-danger"><span class="fa-solid fa-file-pdf"></span> Reportes</button>
                        </form>
                        <?php
                        
                    } else{

                        ?>

                        <form action="descargarReporte.php" method="POST">
                            <button type="" name="reportebtn" class="btn btn-flait btn-danger"><span class="fa-solid fa-file-pdf"></span> Reportes</button>
                        </form>

                        <?php
                    }
                        ?>
                    </div>
                </div>
                <table class="table align-middle mb-0 bg-white">
                  <thead class="bg-light">
                    <tr>
                      <th>ID</th>
                      <th>Producto</th>
                      <th>Unidades</th>
                      <th>Precio</th>
                      <th>Iva 16%</th>
                      <th>Proveedor</th>
                      <th>Direccion del Proveedor</th>
                      <th>Total</th>
                      <th>Estado</th>
                      <th>Fecha Orden</th>
                      <th>Accion</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php

                        include_once('connection.php');

                        if(isset($_GET['busquedabtn'])){

                            $filtro = $_GET['busquedaResultado'];

                            if($filtro =="Abierta"){

                                $sql_query = "SELECT * FROM orden_compra WHERE estado = 'Abierta'";
                                $result = $con->query($sql_query);
    
                                if(!$result){
                                    die("Invalid Query". $con->error);
                                }
    
                                while($row = $result->fetch_assoc()){
                                
                                    $total = $row['unidades'] * $row['precio_producto'];
                                    $totalCompleto = $total + 0.16;
        
                                    if($row['estado']=="Abierta"){
        
                                        echo "
                                        
                                        
                                        <tr>
            
                                            <td>$row[id_orden]</td>
            
                                            <td>
                                                <div class='d-flex align-items-center'> 
                                                    <div class='ms-3'>
                                                        <p class='fw-bold mb-1'>$row[nombre_producto]</p>
                                                    </div>
                                                </div>
                                            </td>
            
                                            <td class='text-center'>$row[unidades]</td>
                                            <td>$row[precio_producto]$</td>
        
                                            <td>0,16</td>
        
        
                                            <td>
                                                <div class='d-flex align-items-center'> 
                                                    <div class='ms-3'>
                                                        <p class='fw-bold mb-1'>$row[nombre_proveedor]</p>
                                                    </div>
                                                </div>
                                            </td>
        
                                        <td>
                                            <div class='d-flex align-items-center'> 
                                                <div class='ms-3'>
                                                    <p class='fw-bold mb-1'>$row[direccion_proveedor]</p>
                                                </div>
                                            </div>
                                        </td>
                                            
        
                                        
                                        
                                        <td>$totalCompleto$</td>
                                        
                                        <td>
                                            <span class='badge badge-success rounded-pill d-inline'>$row[estado]</span>
                                        </td>
        
                                            <td>$row[fecha_orden]</td>


                                            
        
                                            <td>
                                                <div style='margin-left:7px;'>
                                                    <a class='action-css' style='margin-right: 5px; outline: hidden;'  href='descargarReportesIdOrd.php?id=$row[id_orden]'>
                                                    <i class='fa-solid fa-file-pdf' style='color:green;'></i> </a>
                                                    <a class='action-css' style='margin-right: 5px; outline: hidden;'  href='editInventario.php?id=$row[id_orden]'>
                                                        <i class='fa-solid fa-pen-to-square' style='color:#FFC107;'></i> </a>
                                                    <a class='action-css'  href='deleteInventario.php?id=$row[id_orden]'><i class='fa-solid fa-trash' style='color:red;'>  </i></a>
                                                </div>
                                            </td>


        
            
                                        </tr>
                                        ";
                                    } else{
                                        
                                        echo "
                                        
                                        
                                        <tr>
            
                                            <td>$row[id_orden]</td>
            
                                            <td>
                                                <div class='d-flex align-items-center'> 
                                                    <div class='ms-3'>
                                                        <p class='fw-bold mb-1'>$row[nombre_producto]</p>
                                                    </div>
                                                </div>
                                            </td>
            
                                            <td class='text-center'>$row[unidades]</td>
                                            <td>$row[precio_producto]$</td>
        
                                            <td>0,16</td>
        
        
                                            <td>
                                                <div class='d-flex align-items-center'> 
                                                    <div class='ms-3'>
                                                        <p class='fw-bold mb-1'>$row[nombre_proveedor]</p>
                                                    </div>
                                                </div>
                                            </td>
        
                                        <td>
                                            <div class='d-flex align-items-center'> 
                                                <div class='ms-3'>
                                                    <p class='fw-bold mb-1'>$row[direccion_proveedor]</p>
                                                </div>
                                            </div>
                                        </td>
                                            
        
                
                                            
                                            
                                            <td>$totalCompleto$</td>
                                            
                                            <td>
                                                <span class='badge badge-danger rounded-pill d-inline'>$row[estado]</span>
                                            </td>
        
                                            <td>$row[fecha_orden]</td>
        
                                            <td>
                                                <div style='margin-left:7px;'>
                                                    <a class='action-css' style='margin-right: 5px; outline: hidden;'  href='descargarReportesIdOrd.php?id=$row[id_orden]'>
                                                    <i class='fa-solid fa-file-pdf' style='color:green;'></i> </a>
                                                    <a class='action-css' style='margin-right: 5px; outline: hidden;'  href='editInventario.php?id=$row[id_orden]'>
                                                        <i class='fa-solid fa-pen-to-square' style='color:#FFC107;'></i> </a>
                                                    <a class='action-css'  href='deleteInventario.php?id=$row[id_orden]'><i class='fa-solid fa-trash' style='color:red;'>  </i></a>
                                                </div>
                                            </td>

            
                                        </tr>
                                        ";
                                    }
                                }
                            } 
                            
                            
                            else if($filtro =="Cerrada"){
                                $sql_query = "SELECT * FROM orden_compra WHERE estado = 'Cerrada'";
                                $result = $con->query($sql_query);
    
                                if(!$result){
                                    die("Invalid Query". $con->error);
                                }
    
                                while($row = $result->fetch_assoc()){
                                
                                    $total = $row['unidades'] * $row['precio_producto'];
                                    $totalCompleto = $total + 0.16;
        
                                    if($row['estado']=="Abierta"){
        
                                        echo "
                                        
                                        
                                        <tr>
            
                                            <td>$row[id_orden]</td>
            
                                            <td>
                                                <div class='d-flex align-items-center'> 
                                                    <div class='ms-3'>
                                                        <p class='fw-bold mb-1'>$row[nombre_producto]</p>
                                                    </div>
                                                </div>
                                            </td>
            
                                            <td class='text-center'>$row[unidades]</td>
                                            <td>$row[precio_producto]$</td>
        
                                            <td>0,16</td>
        
        
                                            <td>
                                                <div class='d-flex align-items-center'> 
                                                    <div class='ms-3'>
                                                        <p class='fw-bold mb-1'>$row[nombre_proveedor]</p>
                                                    </div>
                                                </div>
                                            </td>
        
                                        <td>
                                            <div class='d-flex align-items-center'> 
                                                <div class='ms-3'>
                                                    <p class='fw-bold mb-1'>$row[direccion_proveedor]</p>
                                                </div>
                                            </div>
                                        </td>
                                            
        
                                        
                                        
                                        <td>$totalCompleto$</td>
                                        
                                        <td>
                                            <span class='badge badge-success rounded-pill d-inline'>$row[estado]</span>
                                        </td>
        
                                            <td>$row[fecha_orden]</td>
        
                                            <td>
                                                <div style='margin-left:7px;'>
                                                    <a class='action-css' style='margin-right: 5px; outline: hidden;'  href='descargarReportesIdOrd.php?id=$row[id_orden]'>
                                                    <i class='fa-solid fa-file-pdf' style='color:green;'></i> </a>
                                                    <a class='action-css' style='margin-right: 5px; outline: hidden;'  href='editInventario.php?id=$row[id_orden]'>
                                                        <i class='fa-solid fa-pen-to-square' style='color:#FFC107;'></i> </a>
                                                    <a class='action-css'  href='deleteInventario.php?id=$row[id_orden]'><i class='fa-solid fa-trash' style='color:red;'>  </i></a>
                                                </div>
                                            </td>

            
                                        </tr>
                                        ";
                                    } else{
                                        
                                        echo "
                                        
                                        
                                        <tr>
            
                                            <td>$row[id_orden]</td>
            
                                            <td>
                                                <div class='d-flex align-items-center'> 
                                                    <div class='ms-3'>
                                                        <p class='fw-bold mb-1'>$row[nombre_producto]</p>
                                                    </div>
                                                </div>
                                            </td>
            
                                            <td class='text-center'>$row[unidades]</td>
                                            <td>$row[precio_producto]$</td>
        
                                            <td>0,16</td>
        
        
                                            <td>
                                                <div class='d-flex align-items-center'> 
                                                    <div class='ms-3'>
                                                        <p class='fw-bold mb-1'>$row[nombre_proveedor]</p>
                                                    </div>
                                                </div>
                                            </td>
        
                                        <td>
                                            <div class='d-flex align-items-center'> 
                                                <div class='ms-3'>
                                                    <p class='fw-bold mb-1'>$row[direccion_proveedor]</p>
                                                </div>
                                            </div>
                                        </td>
                                            
        
                
                                            
                                            
                                            <td>$totalCompleto$</td>
                                            
                                            <td>
                                                <span class='badge badge-danger rounded-pill d-inline'>$row[estado]</span>
                                            </td>
        
                                            <td>$row[fecha_orden]</td>
        
                                            <td>
                                                <div style='margin-left:7px;'>
                                                    <a class='action-css' style='margin-right: 5px; outline: hidden;'  href='descargarReportesIdOrd.php?id=$row[id_orden]'>
                                                    <i class='fa-solid fa-file-pdf' style='color:green;'></i> </a>
                                                    <a class='action-css' style='margin-right: 5px; outline: hidden;'  href='editInventario.php?id=$row[id_orden]'>
                                                        <i class='fa-solid fa-pen-to-square' style='color:#FFC107;'></i> </a>
                                                    <a class='action-css'  href='deleteInventario.php?id=$row[id_orden]'><i class='fa-solid fa-trash' style='color:red;'>  </i></a>
                                                </div>
                                            </td>

            
                                        </tr>
                                        ";
                                    }
                                }
                            } 
                            else{

                                $sql_query = "SELECT * FROM orden_compra";
                                $result = $con->query($sql_query);
    
                                if(!$result){
                                    die("Invalid Query". $con->error);
                                }
    
                                while($row = $result->fetch_assoc()){
                                
                                    $total = $row['unidades'] * $row['precio_producto'];
                                    $totalCompleto = $total + 0.16;
        
                                    if($row['estado']=="Abierta"){
        
                                        echo "
                                        
                                        
                                        <tr>
            
                                            <td>$row[id_orden]</td>
            
                                            <td>
                                                <div class='d-flex align-items-center'> 
                                                    <div class='ms-3'>
                                                        <p class='fw-bold mb-1'>$row[nombre_producto]</p>
                                                    </div>
                                                </div>
                                            </td>
            
                                            <td class='text-center'>$row[unidades]</td>
                                            <td>$row[precio_producto]$</td>
        
                                            <td>0,16</td>
        
        
                                            <td>
                                                <div class='d-flex align-items-center'> 
                                                    <div class='ms-3'>
                                                        <p class='fw-bold mb-1'>$row[nombre_proveedor]</p>
                                                    </div>
                                                </div>
                                            </td>
        
                                        <td>
                                            <div class='d-flex align-items-center'> 
                                                <div class='ms-3'>
                                                    <p class='fw-bold mb-1'>$row[direccion_proveedor]</p>
                                                </div>
                                            </div>
                                        </td>
                                            
        
                                        
                                        
                                        <td>$totalCompleto$</td>
                                        
                                        <td>
                                            <span class='badge badge-success rounded-pill d-inline'>$row[estado]</span>
                                        </td>
        
                                            <td>$row[fecha_orden]</td>

                                            <td>
                                            <div style='margin-left:7px;'>
                                                <a class='action-css' style='margin-right: 5px; outline: hidden;'  href='descargarReportesIdOrd.php?id=$row[id_orden]'>
                                                <i class='fa-solid fa-file-pdf' style='color:green;'></i> </a>
                                                <a class='action-css' style='margin-right: 5px; outline: hidden;'  href='editInventario.php?id=$row[id_orden]'>
                                                    <i class='fa-solid fa-pen-to-square' style='color:#FFC107;'></i> </a>
                                                <a class='action-css'  href='deleteInventario.php?id=$row[id_orden]'><i class='fa-solid fa-trash' style='color:red;'>  </i></a>
                                            </div>
                                        </td>

        
            
                                        </tr>
                                        ";
                                    } else{
                                        
                                        echo "
                                        
                                        
                                        <tr>
            
                                            <td>$row[id_orden]</td>
            
                                            <td>
                                                <div class='d-flex align-items-center'> 
                                                    <div class='ms-3'>
                                                        <p class='fw-bold mb-1'>$row[nombre_producto]</p>
                                                    </div>
                                                </div>
                                            </td>
            
                                            <td class='text-center'>$row[unidades]</td>
                                            <td>$row[precio_producto]$</td>
        
                                            <td>0,16</td>
        
        
                                            <td>
                                                <div class='d-flex align-items-center'> 
                                                    <div class='ms-3'>
                                                        <p class='fw-bold mb-1'>$row[nombre_proveedor]</p>
                                                    </div>
                                                </div>
                                            </td>
        
                                        <td>
                                            <div class='d-flex align-items-center'> 
                                                <div class='ms-3'>
                                                    <p class='fw-bold mb-1'>$row[direccion_proveedor]</p>
                                                </div>
                                            </div>
                                        </td>
                                            
        
                
                                            
                                            
                                            <td>$totalCompleto$</td>
                                            
                                            <td>
                                                <span class='badge badge-danger rounded-pill d-inline'>$row[estado]</span>
                                            </td>
        
                                            <td>$row[fecha_orden]</td>
        
                                            <td>
                                                <div style='margin-left:7px;'>
                                                    <a class='action-css' style='margin-right: 5px; outline: hidden;'  href='descargarReportesIdOrd.php?id=$row[id_orden]'>
                                                    <i class='fa-solid fa-file-pdf' style='color:green;'></i> </a>
                                                    <a class='action-css' style='margin-right: 5px; outline: hidden;'  href='editInventario.php?id=$row[id_orden]'>
                                                        <i class='fa-solid fa-pen-to-square' style='color:#FFC107;'></i> </a>
                                                    <a class='action-css'  href='deleteInventario.php?id=$row[id_orden]'><i class='fa-solid fa-trash' style='color:red;'>  </i></a>
                                                </div>
                                            </td>

            
                                        </tr>
                                        ";
                                    }
                                }
                            }
                        
                        
                        } 
                        
                        else{
                            $sql_query = "SELECT * FROM orden_compra";
                            $result = $con->query($sql_query);
    
                            if(!$result){
                                die("Invalid Query". $con->error);
                            }
    
                            while($row = $result->fetch_assoc()){
                                
                                $total = $row['unidades'] * $row['precio_producto'];
                                $totalCompleto = $total + 0.16;
    
                                if($row['estado']=="Abierta"){
    
                                    echo "
                                    
                                    
                                    <tr>
        
                                        <td>$row[id_orden]</td>
        
                                        <td>
                                            <div class='d-flex align-items-center'> 
                                                <div class='ms-3'>
                                                    <p class='fw-bold mb-1'>$row[nombre_producto]</p>
                                                </div>
                                            </div>
                                        </td>
        
                                        <td class='text-center'>$row[unidades]</td>
                                        <td>$row[precio_producto]$</td>
    
                                        <td>0,16</td>
    
    
                                        <td>
                                            <div class='d-flex align-items-center'> 
                                                <div class='ms-3'>
                                                    <p class='fw-bold mb-1'>$row[nombre_proveedor]</p>
                                                </div>
                                            </div>
                                        </td>
    
                                    <td>
                                        <div class='d-flex align-items-center'> 
                                            <div class='ms-3'>
                                                <p class='fw-bold mb-1'>$row[direccion_proveedor]</p>
                                            </div>
                                        </div>
                                    </td>
                                        
    
                                    
                                    
                                    <td>$totalCompleto$</td>
                                    
                                    <td>
                                        <span class='badge badge-success rounded-pill d-inline'>$row[estado]</span>
                                    </td>
    
                                        <td>$row[fecha_orden]</td>
    
                                        <td>
                                        <div style='margin-left:7px;'>
                                            <a class='action-css' style='margin-right: 5px; outline: hidden;'  href='descargarReportesIdOrd.php?id=$row[id_orden]'>
                                            <i class='fa-solid fa-file-pdf' style='color:green;'></i> </a>
                                            <a class='action-css' style='margin-right: 5px; outline: hidden;'  href='editInventario.php?id=$row[id_orden]'>
                                                <i class='fa-solid fa-pen-to-square' style='color:#FFC107;'></i> </a>
                                            <a class='action-css'  href='deleteInventario.php?id=$row[id_orden]'><i class='fa-solid fa-trash' style='color:red;'>  </i></a>
                                        </div>
                                    </td>

    
        
                                    </tr>
                                    ";
                                } else{
                                    
                                    echo "
                                    
                                    
                                    <tr>
        
                                        <td>$row[id_orden]</td>
        
                                        <td>
                                            <div class='d-flex align-items-center'> 
                                                <div class='ms-3'>
                                                    <p class='fw-bold mb-1'>$row[nombre_producto]</p>
                                                </div>
                                            </div>
                                        </td>
        
                                        <td class='text-center'>$row[unidades]</td>
                                        <td>$row[precio_producto]$</td>
    
                                        <td>0,16</td>
    
    
                                        <td>
                                            <div class='d-flex align-items-center'> 
                                                <div class='ms-3'>
                                                    <p class='fw-bold mb-1'>$row[nombre_proveedor]</p>
                                                </div>
                                            </div>
                                        </td>
    
                                    <td>
                                        <div class='d-flex align-items-center'> 
                                            <div class='ms-3'>
                                                <p class='fw-bold mb-1'>$row[direccion_proveedor]</p>
                                            </div>
                                        </div>
                                    </td>
                                        
    
            
                                        
                                        
                                        <td>$totalCompleto$</td>
                                        
                                        <td>
                                            <span class='badge badge-danger rounded-pill d-inline'>$row[estado]</span>
                                        </td>
    
                                        <td>$row[fecha_orden]</td>
    
                                        <td>
                                        <div style='margin-left:7px;'>
                                            <a class='action-css' style='margin-right: 5px; outline: hidden;'  href='descargarReportesIdOrd.php?id=$row[id_orden]'>
                                            <i class='fa-solid fa-file-pdf' style='color:green;'></i> </a>
                                            <a class='action-css' style='margin-right: 5px; outline: hidden;'  href='editInventario.php?id=$row[id_orden]'>
                                                <i class='fa-solid fa-pen-to-square' style='color:#FFC107;'></i> </a>
                                            <a class='action-css'  href='deleteInventario.php?id=$row[id_orden]'><i class='fa-solid fa-trash' style='color:red;'>  </i></a>
                                        </div>
                                    </td>

        
                                    </tr>
                                    ";
                                }
                            }

                        }
                        
                    
                    ?>
                    <!-- <tr>
                    <td>1</td>
                      <td>
                        <div class="d-flex align-items-center">
                          <img
                              src="https://mdbootstrap.com/img/new/avatars/8.jpg"
                              alt=""
                              style="width: 45px; height: 45px"
                              class="rounded-circle"
                              />
                          <div class="ms-3">
                            <p class="fw-bold mb-1">John Doe</p>
                            <p class="text-muted mb-0">john.doe@gmail.com</p>
                          </div>
                        </div>
                      </td>
                      <td>10</td>
                      <td>20,00</td>
                      <td>
                        <p class="fw-normal mb-1">Software engineer</p>
                        <p class="text-muted mb-0">IT department</p>
                      </td>
                      <td>
                        <span class="badge badge-success rounded-pill d-inline">Active</span>
                      </td>
                      <td>Senior</td>
                      <td>
                      <select name="" id="">
                            <option value="">Ver</option>
                            <option value="">Editar</option>
                            <option value="">Eliminar</option>
                        </select>
                      </td>
                    </tr>
                    <tr>
                    <td>2</td>
                      <td>
                        <div class="d-flex align-items-center">
                          <img
                              src="https://mdbootstrap.com/img/new/avatars/6.jpg"
                              class="rounded-circle"
                              alt=""
                              style="width: 45px; height: 45px"
                              />
                          <div class="ms-3">
                            <p class="fw-bold mb-1">Alex Ray</p>
                            <p class="text-muted mb-0">alex.ray@gmail.com</p>
                          </div>
                        </div>
                      </td>
                      <td>9</td>
                      <td>10,2</td>
                      <td>
                        <p class="fw-normal mb-1">Consultant</p>
                        <p class="text-muted mb-0">Finance</p>
                      </td>
                      <td>
                        <span class="badge badge-primary rounded-pill d-inline"
                              >Onboarding</span
                          >
                      </td>
                      <td>Junior</td>
                      <td>
                      <select name="" id="">
                            <option value="">Ver</option>
                            <option value="">Editar</option>
                            <option value="">Eliminar</option>
                        </select>
                      </td>
                    </tr>
                    <tr>
                    <td>3</td>
                      <td>
                        <div class="d-flex align-items-center">
                          <img
                              src="https://mdbootstrap.com/img/new/avatars/7.jpg"
                              class="rounded-circle"
                              alt=""
                              style="width: 45px; height: 45px"
                              />
                          <div class="ms-3">
                            <p class="fw-bold mb-1">Kate Hunington</p>
                            <p class="text-muted mb-0">kate.hunington@gmail.com</p>
                          </div>
                        </div>
                      </td>
                      <td>10</td>
                      <td>10,3</td>
                      <td>
                        <p class="fw-normal mb-1">Designer</p>
                        <p class="text-muted mb-0">UI/UX</p>
                      </td>
                      <td>
                        <span class="badge badge-danger rounded-pill d-inline">Awaiting</span>
                      </td>
                      <td>Senior</td>
                      <td>
                        <select name="" id="">
                            <option value="">Ver</option>
                            <option value="">Editar</option>
                            <option value="">Eliminar</option>
                        </select>
                      </td>
                    </tr>
                  </tbody> -->
                </table>
                <ul id="contextMenu" class="dropdown-menu" role="menu">
                    <li><a tabindex="-1" href="#" class="payLink">Pay</a></li>
                    <li><a tabindex="-1" href="#" class="delLink">Delete</a></li>
                </ul>
            </div>
        </div>
    </div>


    <script src="./assets/js/jquery.min.js"></script>
    <script src="./assets/js/popper.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <script src="./assets/js/main.js"></script>
    
</body>
</html>