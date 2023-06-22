<?php
include_once '../config/conexion1.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$codigo = (isset($_POST['icod'])) ? $_POST['icod'] : '';
$area = (isset($_POST['iarea'])) ? $_POST['iarea'] : '';
$insti = (isset($_POST['insti'])) ? $_POST['insti'] : '';


$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$area_id = (isset($_POST['id'])) ? $_POST['id'] : '';



switch($opcion){
    case 1: //INGRESO DE NUEVOS REGISTROS
        $consulta = "SELECT count(*) total from area where cod_area='$codigo' or area='$area'";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        $data=$resultado->fetch(PDO::FETCH_ASSOC); 

        if($data['total'] == 0){
            $consulta = "INSERT into area values (null,'$codigo','$area')";			
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(); 
            
            $consulta = "INSERT into areainstitu values (null,'$insti',(select idarea from area where cod_area='$codigo'))";			
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(); 

            $consulta = "select a.idarea ID, cod_area, area from institucion i, area a, areainstitu ae
            where ae.idinstitucion=i.idinstitucion and ae.idarea=a.idarea ORDER BY ID DESC LIMIT 1";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);       
        }else{
            $data=1;
        }
        break;    
    case 2: //EDICION DE LOS REGISTROS
        $consulta = "SELECT count(*) total from area where (cod_area='$codigo' or area='$area') and idarea != '$area_id'";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        $data=$resultado->fetch(PDO::FETCH_ASSOC); 

        if($data['total'] == 0){
            $data ='';
            $consulta = "SELECT count(*) total from area where (cod_area='$codigo' and area='$area') and idarea = '$area_id'";			
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data=$resultado->fetch(PDO::FETCH_ASSOC);

            if($data['total'] == 0){
            
                $consulta = "UPDATE area SET cod_area='$codigo', area='$area' WHERE idarea='$area_id'";		
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();   
                        
                $consulta = "select a.idarea ID, cod_area, area
                from institucion i, area a, areainstitu ae
                where ae.idinstitucion=i.idinstitucion and ae.idarea=a.idarea and a.idarea='$area_id'";     
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();
                $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
            }else{
                $data=2;    
            }
        }else{
            $data=1;
        }
        break;
    case 3: //ELIMINACION DE LOS REGISTROS
        $consulta = "select count(*) total from derivacion where idareainstitu='$area_id'";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        $data=$resultado->fetch(PDO::FETCH_ASSOC); 

        if($data['total'] == 0){

            $consulta = "select count(*) total from empleado where idareainstitu='$area_id'";			
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(); 
            $data=$resultado->fetch(PDO::FETCH_ASSOC); 

            if ($data['total'] == 0) {
                $consulta = "SELECT idarea FROM areainstitu where idareainstitu='$area_id';";			
                $resultado = $conexion->prepare($consulta);
                $resultado->execute(); 
                $data=$resultado->fetch(PDO::FETCH_ASSOC); 
                $iarea = $data['idarea'];

                $consulta = "DELETE FROM areainstitu WHERE idareainstitu='$area_id' ";		
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();

                $consulta = "DELETE FROM area WHERE idarea='$iarea'";		
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();

            }else{
                $data=1; 
            }
        }else {
            $data=1;
        }
        break;
    case 4: //VISTA PRINCIPAL DE LA TABLA
        $consulta = "select a.idarea ID, cod_area, area
        from institucion i, area a, areainstitu ae
        where ae.idinstitucion=i.idinstitucion and ae.idarea=a.idarea";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 5: //CONSULTA PARA MOSTRAR DATOS A EDITAR
        $consulta = "select a.idarea ID, cod_area, area
        from institucion i, area a, areainstitu ae
        where ae.idinstitucion=i.idinstitucion and ae.idarea=a.idarea and a.idarea='$area_id'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
$conexion=null;