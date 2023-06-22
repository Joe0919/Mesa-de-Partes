<?php
include_once '../config/conexion1.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';

$area = (isset($_POST['area'])) ? $_POST['area'] : '';


switch($opcion){
    
    case 4:    //CONSULTA PARA TRAMITES ENVIADOS RESPECTIVAMENTE
        $consulta = "select nro_expediente expediente, date_format(fechad, '%d/%m/%Y') Fecha, tipodoc, dni, concat(nombres,' ',ap_paterno,' ',ap_materno) Datos, origen, area, estado
        from derivacion d, documento dc, areainstitu a, area ae, persona p, tipodoc t where d.iddocumento=dc.iddocumento and
        d.idareainstitu=a.idareainstitu and a.idarea=ae.idarea and dc.idpersona=p.idpersona and dc.idtipodoc=t.idtipodoc
        and origen='$area' order by fechad desc";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
$conexion=null;