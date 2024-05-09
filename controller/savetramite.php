<?php

require_once("../config/conexion2.php");


$ruc=trim($_POST['idruc']);
$entidad=strtoupper(trim($_POST['identi']));
$dni=trim($_POST['iddni']);
$nombres=strtoupper(trim($_POST['idnombre']));
$appat=strtoupper(trim($_POST['idap']));
$apmat=strtoupper(trim($_POST['idam']));
$cel=trim($_POST['idcel']);
$direc=strtoupper(trim($_POST['iddirec']));
$correo=trim($_POST['idcorre']);

$idper=trim($_POST['idpersona']);
$tipo=trim($_POST['idtipo']);
$nrodoc=trim($_POST['idnrodoc']);
$folios=trim($_POST['idfolios']);
$asunto=strtoupper(trim($_POST['idasunto']));


$xped = mysqli_query($conexion,"SELECT gen_nroexpediente() res");
$fila = mysqli_fetch_assoc($xped);
$expediente = $fila['res'];

$a = "../";
$ruta = "files/docs/";    	  

$ruta_aux = $a . $ruta ;

$file_tmp_name = $_FILES['idfile']['tmp_name'];
$new_name_file = $a . $ruta . $expediente . '_' . date('Y') . '_'. $dni . '.pdf';
$nuevo = $ruta . $expediente . '_' . date('Y') . '_'. $dni . '.pdf';

if (!file_exists($ruta_aux)) {
    mkdir($ruta_aux);
}


if (move_uploaded_file($file_tmp_name, $new_name_file)) {
    $existe = mysqli_query($conexion,"SELECT count(*) total FROM persona where dni='$dni'");
    $fila1 = mysqli_fetch_assoc($existe);

    if ($fila1['total'] == 0) {
            
        $resultado1 = mysqli_query($conexion,"INSERT into persona values (null,'$dni','$appat','$apmat','$nombres','$correo','$cel','$direc','$ruc','$entidad');");
    }else{
        $resultado1 = mysqli_query($conexion,"UPDATE persona SET email='$correo',telefono='$cel',direccion='$direc' where idpersona='$idper'");
        $resultado1 = mysqli_query($conexion,"UPDATE usuarios SET email='$correo', fechaedicion=sysdate() where dni=(select dni from persona where idpersona='$idper')"); 
    }

    $existe1 = mysqli_query($conexion,"SELECT idpersona ID FROM persona where dni='$dni'");
    $fila2 = mysqli_fetch_assoc($existe1);
    $id = $fila2['ID'];
    $consulta2 = "INSERT into documento values (null, '$expediente','$nrodoc','$folios','$asunto','PENDIENTE','$nuevo','$id','$tipo','8')";			
    $resultado2 = mysqli_query($conexion,$consulta2);

    $inser = mysqli_query($conexion,"INSERT into historial values(null,sysdate(),'$expediente','$dni','DERIVADO','SECRETARÍA','INGRESO DE NUEVO TRÁMITE')");
    
    if($inser){
        $iddoc= mysqli_query($conexion,"SELECT max(iddocumento) idmax from documento");
        $resu = mysqli_fetch_assoc($iddoc);
        $lastid = $resu['idmax'];

        $consulta = "INSERT into derivacion values (null, sysdate(),'EXTERIOR','8','$lastid','')";			
        $resultado = mysqli_query($conexion,$consulta);
        $last = mysqli_insert_id($conexion);

        

        $consul= mysqli_query($conexion,"select nro_expediente expediente, nro_doc nro, tipodoc, concat(nombres, ' ',ap_paterno,' ',ap_materno) Datos, date_format(fechad, '%d/%m/%Y') Fecha
        from derivacion d, documento dc, areainstitu a, area ae, persona p, tipodoc t where d.iddocumento=dc.iddocumento and
        d.idareainstitu=a.idareainstitu and a.idarea=ae.idarea and dc.idpersona=p.idpersona and dc.idtipodoc=t.idtipodoc and idderivacion='$last'");
        $data = mysqli_fetch_assoc($consul);

        require_once("../public/assets/plugins/PHPMailer/clsMail.php");
        $mailSend = new clsMail();

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
            
                <p>Estimado(a): <b>'.$nombres.' '.$appat.' '.$apmat.'</b></p><hr>
                <p>Se le envía este email por parte de la <b>Mesa de Partes Virtual</b> del <b>Hospital Antonio Caldas Domínguez - Pomabamba.</b>
                    <br>Para informarle que su trámite a sido enviado por lo que se le da a conocer información del trámite recepcionado:
                </p>
                
                
                <div id="table">
                    <table width="100%" border="2" cellspacing="0" cellpadding="5" id="tableDoc">
                        <tr>
                          <th colspan="2" style="text-align:center;color:red;font-size: 1.7rem;height: 50px;padding: 0;">
                            DATOS DEL DOCUMENTO</th>
                        </tr>
                        <tr style="text-align:center;font-size:20px">
                          <th style="width: 40%;">EXPEDIENTE</th>
                          <td>'.$data['expediente'].'</td>
                        </tr>
                        <tr style="text-align:center;font-size:20px">
                          <th>N°. DOCUMENTO</th>
                          <td>'.$data['nro'].'</td>
                        </tr>
                        <tr style="text-align:center;font-size:20px">
                          <th>TIPO</th>
                          <td>'.$data['tipodoc'].'</td>
                        </tr>
                        <tr style="text-align:center;font-size:18px">
                          <th>REMITENTE</th>
                          <td>'.$data['Datos'].'</td>
                        </tr>
                        <tr style="text-align:center;font-size:18px">
                          <th>FECHA</th>
                          <td>'.$data['Fecha'].'</td>
                        </tr>
                      </table>
                </div>
                
                <p>Puede realizar el seguimiento de su trámite puede ingresar a la plataforma de la <b>Mesa de Partes Virtual</b> en la pestaña <b><i>Seguimiento</i></b>
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
    
        $enviado =  $mailSend->metEnviar("MESA DE PARTES VIRTUAL - HACDP","Usuario","$correo","TRÁMITE ENVIADO", $bodyHTML);
        


        print '<label><b>Expediente</b>&nbsp;: '.$data['expediente'].'</label><br>'. 
        '<label><b>Nro. Documento</b>&nbsp;: '.$data['nro'].'</label><br>'. 
        '<label><b>Tipo</b>&nbsp;: '.$data['tipodoc'].'</label><br>'. 
        '<label><b>Remitente</b>&nbsp;: '.$data['Datos'].'</label><br>'. 
        '<label><b>Fecha</b>&nbsp;: '.$data['Fecha'].'</label>';
    }else{
        print 'Error no se guardo en el historial';
    }
    
}else{
    print 'ERROR AL GUARDAR EL ARCHIVO';
}





    
    








