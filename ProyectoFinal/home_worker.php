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
    header('Location: index.php');
}

if($fetch_info['type'] == "1"){
    header("location: home.php");
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
    <link rel="stylesheet" href="./assets/css/style2.css">
    <link rel="stylesheet" href="./assets/css/material-icon.css">
    <link rel="stylesheet" href="./assets/css/icons.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>

    
    
</head>
<body>
    <nav class="navbar" style="background:#0071A8; heigth:100vw;">
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
              <a href="produccion.php"><span class="fa fa-briefcase mr-3"></span> Producción</a>
            </li>
	          <li>
              <a href="OrdenesCompra.php"><span class="fa-solid fa-credit-card mr-3"></span> Ordenes de Compra</a>
	          </li>
	        </ul>

            
	        <div class="footer">
                <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
	        </div>
            
        </div>
    </nav>
    
    <div class="container">

        <h2 class="text-center" style="margin-top:20px;">Bienvenido  <?php echo $fetch_info['name'] ?> este es el dashboard</h2> 

        <div class="p-4 p-md-5 pt-5">
            <div class="row">
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="card widget widget-stats custom-css1">
                        <div class="card-body">
                            <div class="widget-stats-container d-flex">
                                <div class="widget-stats-icon widget-stats-icon-warning">
                                    <div class="icon-css">
                                        <i class="fa-solid fa-spray-can-sparkles mr-3 fa-4x"></i>
                                    </div>
                                </div>
                                <div class="widget-stats-content flex-fill">
                                    <span class="widget-stats-title">Total Inventario</span> <br>
                                    <b><span class="widget-stats-amount">
                                        <?php
                                            include_once('connection.php');

                                            $sql = "SELECT COUNT(*) total FROM inventario;";
                                            $run_Sql = mysqli_query($con, $sql);
                                            $fetch_info = mysqli_fetch_assoc($run_Sql);
                                            echo ("
                                            <span style='font-size:20px;'>$fetch_info[total]</span>
                                            
                                            ");

                                        ?>
                                    </span></b>
                                    <span class="widget-stats-info"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="card widget widget-stats custom-css2">
                        <div class="card-body">
                            <div class="widget-stats-container d-flex">
                                <div class="widget-stats-icon widget-stats-icon-danger">
                                    <i class="fa fa-briefcase mr-3 fa-4x"></i>
                                </div>
                                <div class="widget-stats-content flex-fill">
                                    <span class="widget-stats-title">En produccion</span> <br>
                                    <b><span class="widget-stats-amount">
                                    <?php
                                            include_once('connection.php');

                                            $sql = "SELECT COUNT(*) total FROM produccion WHERE estado = \"En Produccion\";";
                                            $run_Sql = mysqli_query($con, $sql);
                                            $fetch_info = mysqli_fetch_assoc($run_Sql);
                                            
                                            echo ("
                                            <span style='font-size:20px;'>$fetch_info[total]</span>
                                            
                                            ");

                                        ?>
                                    </span></b>
                                    <span class="widget-stats-info"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="card widget widget-stats custom-css3">
                        <div class="card-body">
                            <div class="widget-stats-container d-flex">
                                <div class="widget-stats-icon widget-stats-icon-primary">
                                    <i class="fa-solid fa-credit-card fa-4x mr-3"></i>
                                </div>
                                <div class="widget-stats-content flex-fill">
                                    <span class="widget-stats-title">Ordenes Compra</span> <br>
                                    <b><span class="widget-stats-amount">
                                        <?php
                                            include_once('connection.php');

                                            $sql = "SELECT COUNT(*) total FROM orden_compra;";
                                            $run_Sql = mysqli_query($con, $sql);
                                            $fetch_info = mysqli_fetch_assoc($run_Sql);
                                            echo ("
                                            <span style='font-size:20px;'>$fetch_info[total]</span>
                                            
                                            ");

                                        ?>
                                    </span></b>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><br>


            <br>
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Productos mas Fabricados</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="masFabricados"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Productos mas pedidos</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="masVendidos"></canvas>
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
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<?php

    // Datos mas pedidos
    include_once('connection.php');
    $peticion2 = "SELECT * FROM orden_compra";
    $resultado = mysqli_query($con, $peticion2);
    $id = [];
    $nombre_producto = [];
    $unidades = [];

    if(mysqli_num_rows($resultado) > 0 ) {
        while($array2 = mysqli_fetch_array($resultado)){
            array_push($nombre_producto, $array2['nombre_producto']);
            array_push($unidades, $array2['unidades']);
        }
    }

    $numeroProductoVendido = array(0 ,0 ,0);
    $productosMasVendidos = array("","","");

    $longitud = count($unidades);
    for ($i = 0; $i < $longitud; $i++) {
        for ($j = 0; $j < $longitud - 1; $j++) {
            if ($unidades[$j] < $unidades[$j + 1]) {
                $temporal = $unidades[$j];
                $nombreTemporal = $nombre_producto[$j];
                $unidades[$j] = $unidades[$j + 1];
                $nombre_producto[$j] = $nombre_producto[$j + 1];
                $unidades[$j + 1] = $temporal;
                $nombre_producto[$j + 1] = $nombreTemporal;
        }
    } } 

    for($i = 0;$i < 3;$i++){
        $numeroProductoVendido[$i] = $unidades[$i];
        $productosMasVendidos[$i] = $nombre_producto[$i];
    }

 
    ?>


<?php

    // Productos mas fabricados
    include_once('connection.php');
    $peticion = "SELECT * FROM inventario";
    $resultado2 = mysqli_query($con, $peticion);
    $nombre_producto2 = [];
    $unidades2 = [];
    $mensajeError = "";

    if(mysqli_num_rows($resultado2) > 0 ){
        while($array = mysqli_fetch_array($resultado2)){
            array_push($nombre_producto2, $array['nombre_producto']);
            array_push($unidades2, $array['unidades']);
        }
    } else{
        $mensajeError =  "No hay suficientes Registro";
    }

    $numeroProductosFabricados = array(0, 0, 0);
    $productosMasFabricados = array("","","");

    $longitud = count($unidades2);

    for($i = 0; $i < $longitud; $i++){
        for($j = 0; $j < $longitud - 1; $j++){
            if($unidades2[$j] < $unidades2[$j + 1] ){
                $temporal = $unidades2[$j];
                $nombreTemporal = $nombre_producto2[$j];
                $unidades2[$j] = $unidades2[$j + 1];
                $nombre_producto2[$j] = $nombre_producto2[$j + 1];
                $unidades2[$j + 1] = $temporal;
                $nombre_producto2[$j + 1] = $nombreTemporal;

            }

        }
    }

    for($k = 0; $k < 3; $k++){

        $numeroProductosFabricados[$k] = $unidades2[$k];
        $productosMasFabricados[$k] = $nombre_producto2[$k];

    }


    ?>



    <!-- Primera Grafica -->

    <script>
        const CHART2 = document.getElementById("masFabricados");
        console.log(CHART2);
        let masFabricados = new Chart(CHART2, {
            type: "doughnut",
            data: {
                labels: [<?php echo '"'.implode('","',  $productosMasFabricados ).'"' ?>],
                datasets: [{
                    data: [<?php echo '"'.implode('","',  $numeroProductosFabricados ).'"' ?>],
                    fill: true,
                    tension: 0.1,
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)'
                    ],
                }]
        },
        options: {
            responsive: true
        }
    })
    </script>

    <!-- Segunda Grafica -->

<script>
        const CHART3 = document.getElementById("masVendidos");
        console.log(CHART3);
        let masVendidos = new Chart(CHART3, {
            type: "pie",
            data: {
                labels: [<?php echo '"'.implode('","',  $productosMasVendidos ).'"' ?>],
                datasets: [{
                    data: [<?php echo '"'.implode('","',  $numeroProductoVendido ).'"' ?>],
                    fill: true,
                    tension: 0.1,
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)'
                    ],
                }]
        },
        options: {
            responsive: true
        }
    })
    </script>


    
</body>
</html>