<?php
require_once("../public/assets/plugins/PHPMailer/clsMail.php");
include_once '../config/conexion1.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
$mailSend = new clsMail();

$dniC = (isset($_POST['dniC'])) ? $_POST['dniC'] : '';
$vercorreo = (isset($_POST['vercorreo'])) ? trim($_POST['vercorreo']) : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';

$idusuario = (isset($_POST['idusuario'])) ? $_POST['idusuario'] : '';
$idpersona = (isset($_POST['idpersona'])) ? $_POST['idpersona'] : '';
$newcontra = (isset($_POST['newcontra'])) ? $_POST['newcontra'] : '';
$usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';


switch($opcion){
    case 1:
        $consulta = "SELECT count(*) total FROM usuarios u, persona p where p.dni=u.dni and u.dni='$dniC';";
        $resultado = $conexion->prepare($consulta); 
        $resultado->execute();
        $data=$resultado->fetch(PDO::FETCH_ASSOC); 
        if ($data['total'] == 0) {
            $data = 1;
        }else{
            $consulta = "SELECT u.email em FROM usuarios u, persona p where p.dni=u.dni and u.dni='$dniC';";
            $resultado = $conexion->prepare($consulta); 
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC); 
        } 
        break;
    case 2:
        $consulta = "SELECT count(*) total FROM usuarios u, persona p where p.dni=u.dni and u.email='$vercorreo';";
        $resultado = $conexion->prepare($consulta); 
        $resultado->execute();
        $data=$resultado->fetch(PDO::FETCH_ASSOC); 
        if ($data['total'] == 0) {
            $data = 1;
        }else{
            $consulta = "SELECT idpersona, idusuarios, concat(nombres,' ',ap_paterno,' ',ap_materno) datos FROM usuarios u, persona p where p.dni=u.dni and u.dni='$dniC';";
            $resultado = $conexion->prepare($consulta); 
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC); 
        } 
        break;
    case 3:
        $consulta = "UPDATE usuarios SET contraseña='$newcontra', fechaedicion=sysdate() where idusuarios='$idusuario';";
        $resultado = $conexion->prepare($consulta); 
        $resultado->execute();  
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        if ($resultado == true) {
            $bodyHTML = '<html>
        <head>
            <title> Mensaje HTML </title>
            
            <style>
                body{
                    font-family: -apple-system, BlinkMacSystemFont, Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
                }
                h1 {
                    font-size: 1.6rem;
                    padding: 12px;
                    color: #F4FA58;
                    margin: 0;
                }
        
                h2 {
                    font-size: 1.4rem;
                    margin: 0;
                    color: white;
                }
                #titu{
                    background-color: #096B87;
                    text-align: center;
                    height: 105px;
                }
                #table{
                    margin: 0 auto;
                    width: 60%;
                }
            </style>
        </head>
        
        <body>
            <div id="titu">
                <h1>HOSPITAL ANTONIO CALDAS DOMÍNGUEZ - POMABAMBA</h1>
                <h2>MESA DE PARTES VIRTUAL</h2>
            </div>
            
                <p>Estimado(a): <b>'.$usuario.'</b></p><hr>
                <p>Se le envía este email por parte de la <b>Mesa de Partes Virtual</b> del <b>Hospital Antonio Caldas Domínguez - Pomabamba.</b>
                    <br>Para informarle que se realizó satisfactoriamente el cambio de su contraseña:
                </p>
                
                
                <div id="table" style="border-radius: 10px; background-color: rgb(214, 236, 255);text-align:center;">
                    <h1 style="color: green"> 
                        Su nueva contraseña es:
                    </h1>
                    <h2 style="color: blue; font-weight: 600;"> 
                        '.$newcontra.'
                    </h2>
                    <h3>
                        Le recomendamos ingresar al sistema y cambiar su contraseña para asi evitar cualquier inconveniente o robo de información.
                    </h3>
                    <br>
                </div>
                
                    <br>Saludos cordiales
                    <br><b>HOSPITAL ANTONIO CALDAS DOMÍNGUEZ - POMABAMBA</b>
                </p>
        
                <p style="color: #094A8A;">_______________________________<br>
                <b>OFICINA DE SISTEMAS Y TELECOMUNICACIONES - HACDP</b> <br>
                <b>Contáctos:</b> 043-4510028<br>
                <b>Dirección:</b> Carretera Norte KM 1 S/N - Huajtchacra<br>
                <b>Plataforma Web:</b> 
                </p>
        </body>
        </html>';
        $enviado =  $mailSend->metEnviar("MESA DE PARTES VIRTUAL - HACDP","Usuario","$vercorreo","CAMBIO DE CONTRASEÑA", $bodyHTML);
        }else{
            $data=1;
        }
        break;
}
$opcion = '';
print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
$conexion=null;