<?php 
session_start();
require "connection.php";
$email = "";
$name = "";
$avatar = "";
$errors = array();

//if user signup button
if(isset($_POST['signup'])){
    $name = mysqli_real_escape_string($con, $_POST['fname']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
    $estado = mysqli_real_escape_string($con, $_POST['estado']);
    $avatar = $_FILES['avatar']['name'];
    $tempname = $_FILES['avatar']['tmp_name'];
    move_uploaded_file($tempname, 'upload/'.$avatar);
    if($password !== $cpassword){
        $errors['password'] = "Las Contraseñas no coinciden";
    }
    $email_check = "SELECT * FROM usertable WHERE email = '$email'";
    $res = mysqli_query($con, $email_check);
    if(mysqli_num_rows($res) > 0){
        $errors['email'] = "El email que ingresaste ya esta registrado";
    }
    if(count($errors) === 0){
        $encpass = password_hash($password, PASSWORD_BCRYPT);
        $code = rand(999999, 111111);
        $status = "notverified";
        if($estado == "1"){
            $status = "verified";
            $code = 0;
            $type = 1;
            $insert_data = "INSERT INTO usertable (name, email, password, code, status, type, estado, avatar)
                            values('$name', '$email', '$encpass', '$code', '$status', '$type', 'Administrador', '$avatar')";
            $data_check = mysqli_query($con, $insert_data);
            header('location: RegistrarUsuario.php');
            // if($data_check){
            //     $subject = "Email Verification Code";
            //     $message = "Your verification code is $code";
            //     $sender = "From: shahiprem7890@gmail.com";
            //     if(mail($email, $subject, $message, $sender)){
            //         $info = "We've sent a verification code to your email - $email";
            //         $_SESSION['info'] = $info;
            //         $_SESSION['email'] = $email;
            //         $_SESSION['password'] = $password;
            //         header('location: user-otp.php');
            //         exit();
            //     }else{
            //         $errors['otp-error'] = "Failed while sending code!";
            //     }
            // }else{
            //     $errors['db-error'] = "Failed while inserting data into database!";
            // }
        } else{
            $type = 2;
            $code = 0;
            $status = "verified";
            $insert_data = "INSERT INTO usertable (name, email, password, code, status, type, estado, avatar)
                            values('$name', '$email', '$encpass', '$code', '$status', '$type', 'Empleado', '$avatar')";
            $data_check = mysqli_query($con, $insert_data);
            header('location: registrarUsuario.php');
            // if($data_check){
            //     $subject = "Email Verification Code";
            //     $message = "Your verification code is $code";
            //     $sender = "From: shahiprem7890@gmail.com";
            //     if(mail($email, $subject, $message, $sender)){
            //         $info = "We've sent a verification code to your email - $email";
            //         $_SESSION['info'] = $info;
            //         $_SESSION['email'] = $email;
            //         $_SESSION['password'] = $password;
            //         header('location: user-otp.php');
            //         exit();
            //     }else{
            //         $errors['otp-error'] = "Failed while sending code!";
            //     }
            // }else{
            //     $errors['db-error'] = "Failed while inserting data into database!";
            // }
        }
    }

}
    //if user click verification code submit button
    if(isset($_POST['check'])){
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
        $check_code = "SELECT * FROM usertable WHERE code = $otp_code";
        $code_res = mysqli_query($con, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $fetch_code = $fetch_data['code'];
            $email = $fetch_data['email'];
            $code = 0;
            $status = 'verified';
            $update_otp = "UPDATE usertable SET code = $code, status = '$status' WHERE code = $fetch_code";
            $update_res = mysqli_query($con, $update_otp);
            if($update_res){
                $_SESSION['fname'] = $name;
                $_SESSION['email'] = $email;
                header('location: home.php');
                exit();
            }else{
                $errors['otp-error'] = "Failed while updating code!";
            }
        }else{
            $errors['otp-error'] = "You've entered incorrect code!";
        }
    }

    //if user click login button
    if(isset($_POST['login'])){
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $check_email = "SELECT * FROM usertable WHERE email = '$email'";
        $res = mysqli_query($con, $check_email);
        if(mysqli_num_rows($res) > 0){
            $fetch = mysqli_fetch_assoc($res);
            $fetch_pass = $fetch['password'];
            if(password_verify($password, $fetch_pass)){
                $_SESSION['email'] = $email;
                $status = $fetch['status'];
                if($status == 'verified'){
                    $type = $fetch['type'];
                    if($type == 1){
                        $_SESSION['email'] = $email;
                        $_SESSION['password'] = $password;
                        header('location: home.php');
                    } else{
                        $_SESSION['email'] = $email;
                        $_SESSION['password'] = $password;
                        header('location: home_worker.php');
                    }
                }else{
                    $info = "It's look like you haven't still verify your email - $email";
                    $_SESSION['info'] = $info;
                    header('location: user-otp.php');
                }
            }else{
                $errors['email'] = "Correo o Contraseña erronea!";
            }
        }else{
            $errors['email'] = "Parece que no estas registrado! Conctacta con tu superior para saber mas detalles.";
        }
    }

    //if user click continue button in forgot password form
    if(isset($_POST['check-email'])){
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $check_email = "SELECT * FROM usertable WHERE email='$email'";
        $run_sql = mysqli_query($con, $check_email);
        if(mysqli_num_rows($run_sql) > 0){
            $code = rand(999999, 111111);
            $insert_code = "UPDATE usertable SET code = $code WHERE email = '$email'";
            $run_query =  mysqli_query($con, $insert_code);
            if($run_query){
                $subject = "Password Reset Code";
                $message = "Your password reset code is $code";
                $sender = "From: shahiprem7890@gmail.com";
                if(mail($email, $subject, $message, $sender)){
                    $info = "We've sent a passwrod reset otp to your email - $email";
                    $_SESSION['info'] = $info;
                    $_SESSION['email'] = $email;
                    header('location: reset-code.php');
                    exit();
                }else{
                    $errors['otp-error'] = "Failed while sending code!";
                }
            }else{
                $errors['db-error'] = "Something went wrong!";
            }
        }else{
            $errors['email'] = "Este correo electronico no existe";
        }
    }

    //if user click check reset otp button
    if(isset($_POST['check-reset-otp'])){
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
        $check_code = "SELECT * FROM usertable WHERE code = $otp_code";
        $code_res = mysqli_query($con, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $email = $fetch_data['email'];
            $_SESSION['email'] = $email;
            $info = "Please create a new password that you don't use on any other site.";
            $_SESSION['info'] = $info;
            header('location: new-password.php');
            exit();
        }else{
            $errors['otp-error'] = "You've entered incorrect code!";
        }
    }

    //if user click change password button
    if(isset($_POST['change-password'])){
        $_SESSION['info'] = "";
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
        if($password !== $cpassword){
            $errors['password'] = "Confirm password not matched!";
        }else{
            $code = 0;
            $email = $_SESSION['email']; //getting this email using session
            $encpass = password_hash($password, PASSWORD_BCRYPT);
            $update_pass = "UPDATE usertable SET code = $code, password = '$encpass' WHERE email = '$email'";
            $run_query = mysqli_query($con, $update_pass);
            if($run_query){
                $info = "Your password changed. Now you can login with your new password.";
                $_SESSION['info'] = $info;
                header('Location: password-changed.php');
            }else{
                $errors['db-error'] = "Failed to change your password!";
            }
        }
    }
    
   //if login now button click
    if(isset($_POST['login-now'])){
        header('Location: index.php');
    }
?>