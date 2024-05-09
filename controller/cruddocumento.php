<?php
include_once '../config/conexion1.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$origen = (isset($_POST['origen'])) ? $_POST['origen'] : '';
$destino = (isset($_POST['destino'])) ? $_POST['destino'] : '';
$descripcion = (isset($_POST['descrip'])) ? $_POST['descrip'] : '';


$bdr = (isset($_POST['bdr'])) ? $_POST['bdr'] : '';

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$expediente = (isset($_POST['id'])) ? $_POST['id'] : '';
$expe = (isset($_POST['nrexpe'])) ? $_POST['nrexpe'] : '';
$año = (isset($_POST['año'])) ? $_POST['año'] : '';
$dni = (isset($_POST['dni'])) ? $_POST['dni'] : '';
$area = (isset($_POST['area'])) ? $_POST['area'] : '';
$estado = (isset($_POST['estado'])) ? $_POST['estado'] : '';
$idarea = (isset($_POST['idarea'])) ? $_POST['idarea'] : '';
$idder = (isset($_POST['idder'])) ? $_POST['idder'] : '';

if ($bdr != '') {
    $opcion = 8; 
}
switch($opcion){
    case 1://ACCION PARA TRAMITES DERIVADOS
        $consulta = "INSERT into derivacion values (null,sysdate(),'$origen','$destino','$expediente','$descripcion')";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "UPDATE documento SET estado='PENDIENTE', idubi='$destino' WHERE iddocumento='$expediente'";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "INSERT into historial values (null,sysdate(),'$expe','$dni','DERIVADO',(select area from area a, areainstitu e 
        where a.idarea=e.idarea and idareainstitu='$destino'),'$descripcion')";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        
        $consulta = "select nro_expediente expediente, nro_doc nro, tipodoc, dni, concat(nombres,' ',ap_paterno,' ',ap_materno) Datos, origen, area, estado
        from derivacion d, documento dc, areainstitu a, area ae, persona p, tipodoc t where d.iddocumento=dc.iddocumento and 
        d.idareainstitu=a.idareainstitu and a.idarea=ae.idarea and dc.idpersona=p.idpersona and dc.idtipodoc=t.idtipodoc ORDER BY nro_expediente DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);       
        break;    
    case 2://ACCION PARA TRAMITES ACEPTADOS
        $consulta = "UPDATE documento SET estado='ACEPTADO' WHERE iddocumento='$expediente';";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        
        $consulta = "INSERT into historial values(null,sysdate(),'$expe','$dni','ACEPTADO','$area','$descripcion')";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC); 
        break; 
    case 3://ACCION PARA TRAMITES RECHAZADOS
        if ($origen == 'SECRETARIA' || $origen == 'SECRETARíA') {
            $consulta = "UPDATE derivacion SET descripcion='$descripcion' where idderivacion='$idder'";			
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            $consulta = "INSERT into historial values (null,sysdate(),'$expe','$dni','RECHAZADO','SECRETARíA','$descripcion')";		
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
        }else{
            $consulta = "INSERT into derivacion values (null,sysdate(),'$origen','8','$expediente','$descripcion')";			
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            $consulta = "INSERT into historial values (null,sysdate(),'$expe','$dni','RECHAZADO','$origen','$descripcion')";		
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            $consulta = "INSERT into historial values (null,sysdate(),'$expe','$dni','DERIVADO','SECRETARÍA','$descripcion')";		
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
        }
        $consulta = "UPDATE documento SET estado='RECHAZADO' WHERE iddocumento='$expediente'";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);       
        break;
    case 4: //MOSTRAR EN LA TABLA PRINCIPAL
        $consulta = "select nro_expediente expediente,  date_format(fechad, '%d/%m/%Y') Fecha, tipodoc, dni, concat(nombres,' ',ap_paterno,' ',ap_materno) Datos, origen, area, estado
        from derivacion d, documento dc, areainstitu a, area ae, persona p, tipodoc t where d.iddocumento=dc.iddocumento and
        d.idareainstitu=a.idareainstitu and a.idarea=ae.idarea and dc.idpersona=p.idpersona and dc.idtipodoc=t.idtipodoc order by fechad desc;";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;

    case 5: //MOSTRAR DATOS PARA EL MODAL DE ACEPTACION Y PARA EL MODAL DE DERIVACION EL ID DOCUMENTO, ADEMAS PARA MAS INFORMACION
        $consulta = "select idderivacion ID, nro_expediente,dc.iddocumento doc, nro_doc,folios, estado, tipodoc, asunto, dni, concat(nombres,' ',ap_paterno,' ',ap_materno) Datos, ruc_institu, institucion, archivo, area
        from derivacion d, documento dc, areainstitu a, area ae, persona p, tipodoc t where d.iddocumento=dc.iddocumento and
        d.idareainstitu=a.idareainstitu and a.idarea=ae.idarea and dc.idpersona=p.idpersona and dc.idtipodoc=t.idtipodoc and nro_expediente='$expediente ';";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 6: //CONSULTA PARA EL BOTON DE SEGUIMIENTO
        $consulta = "select idderivacion ID, date_format(fechad, '%d/%m/%Y') Fecha ,area , descripcion
        from derivacion d, documento dc, areainstitu a, area ae, persona p, tipodoc t where d.iddocumento=dc.iddocumento and
        d.idareainstitu=a.idareainstitu and a.idarea=ae.idarea and dc.idpersona=p.idpersona and dc.idtipodoc=t.idtipodoc and nro_expediente='$expediente';";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 7: //CONSULTA PARA MOSTRAR DATOS DE LA BUSQUEDA DE UN TRAMITE
        $consulta = "select count(*) total from derivacion d, documento dc, areainstitu a, area ae, persona p, tipodoc t where d.iddocumento=dc.iddocumento and
                d.idareainstitu=a.idareainstitu and a.idarea=ae.idarea and dc.idpersona=p.idpersona and dc.idtipodoc=t.idtipodoc
                and nro_expediente='$expediente' and date_format(fechad, '%Y')='$año' and dni='$dni';";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetch(PDO::FETCH_ASSOC);

        if ($data['total'] == 0) {
            $data = 0;
        }else{
        $consulta = "select idderivacion ID, date_format(fechad, '%d/%m/%Y') Fecha ,area , descripcion, nro_expediente, nro_doc, folios, tipodoc, asunto, dni,
        concat(nombres,' ',ap_paterno,' ',ap_materno) Datos, ruc_institu, institucion
                from derivacion d, documento dc, areainstitu a, area ae, persona p, tipodoc t where d.iddocumento=dc.iddocumento and
                d.idareainstitu=a.idareainstitu and a.idarea=ae.idarea and dc.idpersona=p.idpersona and dc.idtipodoc=t.idtipodoc
                and nro_expediente='$expediente' and date_format(fechad, '%Y')='$año' and dni='$dni';";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        }
        break;
    case 8: //MOSTRAR TABLA DE TRAMITES PENDIENTES DE UNA DETERMINADA AREA
        $consulta = "select nro_expediente expediente,date_format(fechad, '%d/%m/%Y') Fecha, tipodoc, dni, concat(nombres,' ',ap_paterno,' ',ap_materno) Datos, origen, area, estado
        from derivacion d, documento dc, areainstitu a, area ae, persona p, tipodoc t where d.iddocumento=dc.iddocumento and
        d.idareainstitu=a.idareainstitu and a.idarea=ae.idarea and dc.idpersona=p.idpersona and dc.idtipodoc=t.idtipodoc
        and area='$area' and estado='$estado' and idubi='$idarea' 
        order by expediente desc, Fecha desc";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 10: //PARA PODER ARCHIVAR EL DOCUMENTO
        $consulta = "UPDATE documento SET estado='ARCHIVADO' WHERE iddocumento='$expediente';";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        $consulta = "INSERT into historial values(null,sysdate(),'$expe','$dni','ARCHIVADO','$area','$descripcion')";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 11: 
        $consulta = "select nro_expediente expediente, nro_doc nro, tipodoc, dni, concat(nombres,' ',ap_paterno,' ',ap_materno) Datos, origen, area, estado
        from derivacion d, documento dc, areainstitu a, area ae, persona p, tipodoc t where d.iddocumento=dc.iddocumento and
        d.idareainstitu=a.idareainstitu and a.idarea=ae.idarea and dc.idpersona=p.idpersona and dc.idtipodoc=t.idtipodoc
        and area='$area' and estado='RECHAZADO';";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
$conexion=null;