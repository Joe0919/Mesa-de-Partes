<?php
include_once '../config/conexion1.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$idinstitu = (isset($_POST['idinsti'])) ? $_POST['idinsti'] : '';

$rucinsti = (isset($_POST['rucinsti'])) ? $_POST['rucinsti'] : '';
$razon = (isset($_POST['razon'])) ? strtoupper(trim($_POST['razon'])) : '';
$direc = (isset($_POST['direc'])) ? strtoupper(trim($_POST['direc'])) : '';


switch($opcion){
    
    case 1:    //MOSTRAR DATOS DE LA INSTITUCIÓN
        $consulta = "SELECT * FROM institucion i where idinstitucion='$idinstitu'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2:
        $consulta = "SELECT count(*) total FROM institucion i where ruc='$rucinsti' and razon='$razon' and dirección='$direc'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetch(PDO::FETCH_ASSOC);

        if ($data['total'] == 0) {
            $consulta = "UPDATE institucion SET ruc='$rucinsti', razon='$razon', dirección='$direc' where idinstitucion='$idinstitu'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();        
            $data=$resultado->fetch(PDO::FETCH_ASSOC);
        }else{
            $data == 1;
        }
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
$conexion=null;