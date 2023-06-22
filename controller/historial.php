<?php
include_once '../config/conexion1.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$expediente = (isset($_POST['expediente'])) ? $_POST['expediente'] : '';
$dni = (isset($_POST['dni'])) ? $_POST['dni'] : '';
$año = (isset($_POST['año'])) ? $_POST['año'] : '';

$consulta = "SELECT count(*) total
FROM historial h where expediente='$expediente' and date_format(fecha, '%Y')='$año' and dni='$dni'";
$resultado = $conexion->prepare($consulta);
$resultado->execute(); 
$resultado->fetch(PDO::FETCH_ASSOC);

$consulta = "SELECT idhistorial, accion, area, date_format(fecha, '%d/%m/%Y') fecha, time_format(fecha, '%H:%i:%s %p') hora, descrip
FROM historial h where expediente='$expediente' and date_format(fecha, '%Y')='$año' and dni='$dni'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();        

print '<div class="timeline" id="histo">

<div class="time-label">
  <span class="bg-purple">HISTORIAL DEL TRÁMITE: EXPEDIENTE:<b> '.$expediente.'</b></span>
</div>';
while($datos = $resultado->fetch(PDO::FETCH_ASSOC)) {

    switch($datos['accion']){
        case 'DERIVADO':
            print '<div>
                    <i class="fas fa-arrow-circle-right bg-yellow"></i>
                    <div class="timeline-item">
                      <span style="font-size:18px" class="time"><i class="fas fa-clock"></i> '. $datos['hora'].'</span>
                      <h3 style="font-size:18px" class="timeline-header">El trámite fue <b>'. $datos['accion'].'</b> a
                        <b>'.$datos['area'].'</b> el <b>'. $datos['fecha'].'</b></h3>
  
                      <div style="font-size:15px" class="timeline-body">
                      '. $datos['descrip'].'
                      </div>
                    </div>
                  </div>';
            break;
        case 'ACEPTADO':
            print '<div><i class="fas fa-check bg-green"></i><div class="timeline-item">
            <span style="font-size:18px" class="time"><i class="fas fa-clock"></i> '. $datos['hora'].'</span>
            <h3 style="font-size:18px" class="timeline-header">El trámite fue <b>'. $datos['accion'].'</b> en <b>'.$datos['area'].'</b> el <b>'. $datos['fecha'].'</b></h3>
            <div style="font-size:15px" class="timeline-body">'. $datos['descrip'].'</div></div></div>';
            break;
        case 'RECHAZADO':
            print '<div><i class="fas fa-remove-format bg-red"></i><div class="timeline-item">
            <span style="font-size:18px" class="time"><i class="fas fa-clock"></i> '. $datos['hora'].'</span>
            <h3 style="font-size:18px" class="timeline-header">El trámite fue <b>'. $datos['accion'].'</b> en <b>'.$datos['area'].'</b> el <b>'. $datos['fecha'].'</b></h3>
            <div style="font-size:15px" class="timeline-body">'. $datos['descrip'].'</div></div></div>';
            break;
        case 'ARCHIVADO':
            print '<div><i class="fas fa-save bg-blue"></i><div class="timeline-item">
            <span style="font-size:18px" class="time"><i class="fas fa-clock"></i> '. $datos['hora'].'</span>
            <h3 style="font-size:18px" class="timeline-header">El trámite fue <b>'. $datos['accion'].'</b> en <b>'.$datos['area'].'</b> el <b>'. $datos['fecha'].'</b></h3>
            <div style="font-size:15px" class="timeline-body">'. $datos['descrip'].'</div></div></div>';
            break;
    }
}
print '
<div>
<i class="fas fa-clock bg-gray"></i>
</div></div>';