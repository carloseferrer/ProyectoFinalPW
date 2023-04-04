<?php require_once "controllerUserData.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Registro de Usuario</title>
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
              <a href="produccion.php"><span class="fa fa-briefcase mr-3"></span> Productos Necesarios</a>
            </li>
	          <li>
              <a href="#"><span class="fa-solid fa-credit-card mr-3"></span> Ordenes de Compra</a>
	          </li>
	          <li>
                  <a href="#"><span class="fa-solid fa-chart-simple mr-3"></span> Graficas y Datos</a>
	          </li>
              <br>
              <li>
                  <span class="mr-3"> Sistema</span>
              </li>
              <li>
                  <a href="registrarUsuario.php"><span class="fa-solid fa-user mr-3"></span> Agregar Usuario</a>
	          </li>
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
            <h1 class="text-center">Ingresa los datos correspondientes</h1> <br>
            <?php
                    if(count($errors) == 1){
                        ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                            ?>
                        </div>
                        <?php
                    }elseif(count($errors) > 1){
                        ?>
                        <div class="alert alert-danger">
                            <?php
                            foreach($errors as $showerror){
                                ?>
                                <li><?php echo $showerror; ?></li>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
            <br>
            <div class="card card-outline card-primary">
                <div class="card-body" style="color:black;">
                    <form action="procesoRegistro.php" method="POST" id="registro" enctype = "multipart/form-data">
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input class="form-control" type="text" name="fname" placeholder="Full Name" required value="<?php echo $name ?>">
                        </div>
                        <div class="form-group">
                            <label for="name">Correo Electronico</label>
                            <input class="form-control" type="email" name="email" placeholder="Email Address" required value="<?php echo $email ?>">
                        </div>
                        <div class="form-group">
                            <label for="name">Contraseña</label>
                            <input class="form-control" type="password" name="password" placeholder="Password" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Confirmar Contraseña</label>
                            <input class="form-control" type="password" name="cpassword" placeholder="Confirm password" required>
                        </div>
                        <div class="form-group">
                            <label>Tipo de Usuario * (Recuerda que un Administrador tiene funciones adicionales)*</label> 
                            <select class="custom-select" name="estado" aria-label="Default select example" id="" >
                                <option value="1">Administrador</option>
                                <option value="2">Empleado</option>
                            </select>
                        </div>
                        <div class="form-group ">
                            <label for="name" class="control-label">Avatar</label>
                            <div class="custom-file">
                                <input class="custom-file-input rounded-circle" type="file" name="avatar" placeholder="Confirm password" onchange="getImagePreview(event)" required>
                                <label class="custom-file-label" for="customFile">Escoger Archivo</label>
                            </div>
                        </div>
                        <br>
                        <div id="preview" class="form-group d-flex justify-content-center"></div>
                        <br>
                    </form>
                </div>
                <div class="card-footer">
                    <div class="col-md-12">
                        <div class="row">
                            <button class="btn btn-sm btn-primary mr-2" type="submit" name="signup" value="Signup" form="registro">Registrar</button>
                            <a class="btn btn-sm btn-secondary" href="RegistrarUsuario.php">Cancelar</a>
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

    <script>
    function getImagePreview(event){
        
        var image=URL.createObjectURL(event.target.files[0]);
        var imagediv= document.getElementById('preview');
        var newimg=document.createElement('img');
        imagediv.innerHTML='';
        newimg.src=image;
        newimg.width="100";
        newimg.style.borderRadius="8px";
        imagediv.appendChild(newimg);
    }
    </script>
    
</body>
</html>
</body>
</html>