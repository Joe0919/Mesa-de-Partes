<?php
include_once '../config/conexion1.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$idpersona = (isset($_POST['idper'])) ? $_POST['idper'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';
$codigo = (isset($_POST['codigo'])) ? strtoupper(trim($_POST['codigo']))  : '';
$area = (isset($_POST['area'])) ? $_POST['area'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$dni = (isset($_POST['dni'])) ? $_POST['dni'] : '';

switch($opcion){
    case 1: //AGREGAR
        $consulta = "SELECT count(*) total FROM empleado where cod_empleado='$codigo'";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        $data=$resultado->fetch(PDO::FETCH_ASSOC);

        if ($data['total'] == 0) {
            $consulta = "INSERT INTO empleado VALUES(null,'$codigo','$idpersona','$area')";			
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(); 

            $consulta = "UPDATE usuarios SET estado='ACTIVO' where dni='$dni'";			
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(); 
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        }else{
            $data = 1;
        }
        break;    
    case 2://EDITAR   
        $consulta = "SELECT count(*) total FROM empleado where cod_empleado='$codigo' and idempleado != '$id'";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        $data=$resultado->fetch(PDO::FETCH_ASSOC);

        if ($data['total'] == 0) {
            $consulta = "SELECT count(*) total FROM empleado where cod_empleado='$codigo' and idareainstitu='$area' and idempleado = '$id'";			
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(); 
            $data=$resultado->fetch(PDO::FETCH_ASSOC);

            if ($data['total'] == 0) {
                $consulta = "UPDATE empleado SET cod_empleado='$codigo',idareainstitu='$area' where idempleado = '$id'";			
                $resultado = $conexion->prepare($consulta);
                $resultado->execute(); 
                $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
            }else{
                $data = 2;
            }
        }else{
            $data = 1;
        }
        break;
    case 3://ELIMINAR
        $consulta = "DELETE FROM empleado WHERE idempleado='$id'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();  
        
        $consulta = "UPDATE usuarios SET estado='DESACTIVADO' where dni='$dni'";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        break;
    case 4://MOSTRAR EN TABLA
        $consulta = "select idempleado ID, cod_empleado Codigo, dni, concat(ap_paterno,' ',ap_materno,' ',nombres) Datos, telefono, area
        from empleado e, persona p, areainstitu a, area ae
        where e.idpersona=p.idpersona and e.idareainstitu=a.idareainstitu and ae.idarea=a.idarea";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 5: //DEVOLVER DATOS USUARIO
        $consulta = "select idusuarios ID1, idpersona ID2, p.dni dni, nombres ,ap_paterno ap, ap_materno am, telefono, direccion
        from persona p, usuarios u
        where p.dni=u.dni and idpersona='$idpersona'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 6: //PARA MOSTRAR DATOS DEL EMPLEADO
        $consulta = "select idempleado ID, p.dni dni, nombres ,ap_paterno ap, ap_materno am, telefono, direccion, cod_empleado cod, idareainstitu ID2
        from empleado e, persona p
        where e.idpersona=p.idpersona and idempleado='$id'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    
}

print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
$conexion=null;