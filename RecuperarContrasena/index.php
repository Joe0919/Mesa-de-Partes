

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperación</title>
    <link rel="stylesheet" href="../public/assets/css/login.css">
    <link rel="shortcut icon" href="../public/assets/img/logo.png">

</head>

<body>
    <div class="formulario">
        <a href="../index.html"><img class="logo" src="../public/assets/img/logo.png"  alt="Logo Hospital" /></a>
        <h1>Recuperación de Contraseña</h1>
        <div id="h" style="text-align:center;"><i><b id="corre"></b></i></div>
        <form method="post" action="" id="recov">
            
            <div class="username" id="divdni">
                <input type="text" name="ingdni" id="ingdni" required maxlength="8" onkeypress='return validaNumericos(event)'>
                <label>Ingrese su DNI:</label>
            </div>
            <div class="username" id="divmail">
                <input type="text" name="vercorreo" id="vercorreo" required>
                <label>Ingrese Email Registrado: </label>
                
            </div>
            <div id="j"><b id="Vcorreo1"></b><br><br></div>

            <input type="hidden" name="enviar" value="si" >
            <button type="button" class="verif" id="verificar">Verificar</button>
            <button type="button" class="verif" id="verificarC">Verificar Correo</button><br><br><br><br>
            <div class="recordar">Regresar a <b><a href="../Acceso/">Inicio de Sesión</a></b></div>
        </form>
    </div>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
  <script src="../public/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/Sistema_MesaPartes/public/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script type="text/javascript" src="../public/assets/js/recovery.js"></script>
</body>

</html>