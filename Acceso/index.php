<?php
    include("../config/conexion.php");

    if(isset($_SESSION["idusuarios"])){
        header("Location: http://localhost/Sistema_MesaPartes/view/Home/");
    }
    if(isset($_POST["enviar"]) and $_POST["enviar"]=="si"){
        require_once("../models/Usuario.php");
        $usuario = new Usuario();
        $usuario->login();
    }
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingreso al Sistema</title>
    <link rel="stylesheet" href="../public/assets/css/login.css">
    <link rel="shortcut icon" href="../public/assets/img/logo.png">

</head>

<body>
    <div class="formulario">
        <a href="../index.html"><img class="logo" src="../public/assets/img/logo.png"  alt="Logo Hospital" /></a>
        <h1>Inicio de Sesión</h1>
        <h3 style="text-align: center; font-size: 20px;font-style: italic;color: brown;">Sistema de Mesa de partes</h3>
        <?php
                if (isset($_GET["m"])){
                     switch($_GET["m"]){
                         case "1";
        ?>
                <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="d-flex align-items-center justify-content-start">
                        <i class="icon ion-ios-checkmark alert-icon tx-32 mg-t-5 mg-xs-t-0"></i>
                        <span style="font-size:14px; align-text:center;">&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
                         !! El Usuario y/o la contraseña son incorrectos.. !! </span>
                    </div>
                </div>
        <?php
        break;

        case "2";
        ?>
                <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="d-flex align-items-center justify-content-start">
                        <i class="icon ion-ios-checkmark alert-icon tx-32 mg-t-5 mg-xs-t-0"></i>
                        <span style="font-size:14px; align-text:center;">&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
                         !! Ingrese sus credenciales..  !! </span>
                    </div>
                </div>
        <?php
        break;
        }
        }
        ?>
        <form method="post" action="">

            <div class="username">
                <input type="text" name="usuario" required>
                <label>Usuario:</label>
            </div>
            <div class="username">
                <input type="password" required name="password">
                <label>Contraseña:</label>
            </div>

            <input type="hidden" name="enviar" value="si">
            <input type="submit" value="Ingresar"><br><br>
            <div class="recordar"><a href="../RecuperarContrasena/">¿Olvidó su contraseña?</a></div>
        </form>
    </div>
</body>

</html>