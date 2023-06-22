<?php 
ob_start();
 include("../config/conexion.php");
 include("../config/conexion2.php");
if (!isset($_SESSION["idusuarios"])) {
  header("Location: http://localhost/Sistema_MesaPartes/Acceso/");
}

date_default_timezone_set('America/Lima');

$estado = (isset($_REQUEST['e'])) ? $_REQUEST['e'] : '';
$año = (isset($_REQUEST['a'])) ? $_REQUEST['a'] : '';
$mes = (isset($_REQUEST['m'])) ? $_REQUEST['m'] : '';
$desde = (isset($_REQUEST['d'])) ? $_REQUEST['d'] : '';
$hasta = (isset($_REQUEST['h'])) ? $_REQUEST['h'] : '';
$me = (isset($_REQUEST['me'])) ? $_REQUEST['me'] : '';

if($estado == '' || $estado == '0'){
  if ($desde == '') {
    if ($mes == '') {
      $variable = " and  date_format(fechad, '%Y')='$año' ";
      $type = "Mostrando por Año: ".$año."";
    }else{
      $variable = " and  date_format(fechad, '%Y')='$año' and date_format(fechad, '%m')='$mes' ";
      switch($monthNum){   
          case 1:
          $monthNameSpanish = "Enero";
          break;
          case 2:
          $monthNameSpanish = "Febrero";
          break;
          case 3:
          $monthNameSpanish = "Marzo";
          break;
          //...
      }
      $type = "Mostrando por Año: ".$año." y Mes: ".$monthName;
    }
  }else{
    $variable = " and fechad between '$desde' and DATE_ADD('$hasta', INTERVAL 1 DAY) ";
    $type = "Mostrando por Fechas entre: ".date("d-m-Y", strtotime($desde))." hasta: ".date("d-m-Y", strtotime($desde  ));
  }
}else{
  if ($desde == '') {
    if ($mes == '') {
      $variable = " and  date_format(fechad, '%Y')='$año' and estado='$estado' ";
    }else{
      $variable = " and  date_format(fechad, '%Y')='$año' and date_format(fechad, '%m')='$mes' and estado='$estado' ";
    }
  }else{
    $variable = " and fechad between '$desde' and DATE_ADD('$hasta', INTERVAL 1 DAY) and estado='$estado' ";
  }
}


$consulta=mysqli_query($conexion,"select nro_expediente expediente,  date_format(fechad, '%d/%m/%Y') Fecha, tipodoc, dni, concat(nombres,' ',ap_paterno,' ',ap_materno) Datos, origen, area, estado
from derivacion d, documento dc, areainstitu a, area ae, persona p, tipodoc t where d.iddocumento=dc.iddocumento and
d.idareainstitu=a.idareainstitu and a.idarea=ae.idarea and dc.idpersona=p.idpersona and dc.idtipodoc=t.idtipodoc and origen='EXTERIOR'".$variable."order by nro_expediente asc");

$result = mysqli_num_rows($consulta);

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Reporte de Trámites</title>
    <!-- <link rel="stylesheet" href="style.css"> -->
    <style>
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "roboto";
      }
      body{
        margin: 20pt 35pt;
      }
      p,
      label,
      span,
      table {
        /* font-family: 'BrixSansRegular'; */
        font-size: 11pt;
      }
      .h2 {
        /* font-family: 'BrixSansBlack'; */
        font-size: 14pt; 
        font-weight:600;
      }
      .h3 {
        /* font-family: 'BrixSansBlack'; */
        font-size: 14pt;
        display: block;
        background: #0a4661;
        color: #fff;
        text-align: center;
        padding: 3px;
        margin-bottom: 5px;
      }
      #page_pdf {
        width: 95%;
        margin: 15px auto 10px auto;
      }

      #factura_head,
      #factura_cliente,
      #factura_detalle {
        width: 100%;
        /* margin-bottom: 10px; */
      }
      .logo_factura {
        width: 25%;
      }
      .info_empresa {
        width: 50%;
        text-align: center;
        padding:0;
      }
      .info_factura {
        width: 25%;
        float:right;
      }
      .info_cliente {
        width: 100%;
      }
      .datos_cliente {
        width: 100%;
        padding: 10px 10px 0 6%;
      }
      .datos_cliente tr td {
        width: 50%;
      }

      .datos_cliente label {
        width: 130px;
        display: inline-block;
      }

      .datos_cliente p {
        display: inline-block;
      }

      .textright {
        text-align: right;
      }
      .textleft {
        text-align: left;
      }
      .textcenter {
        text-align: center;
      }
      .round {
        border-radius: 10px;
        border: 1px solid #0a4661;
        overflow: hidden;
        padding-bottom: 15px;
      }
      .round p {
        padding: 0 15px;
      }

      #factura_detalle {
        border-collapse: collapse;
        
      }
      #factura_detalle thead th {
        background: #2874A6;
        color: #FFF;
        padding: 5px;
        /* font-weight: 700; */
      }
      #detalle_productos tr:nth-child(even) {
        background: #ededed;
      }
      #detalle_totales span {
        /* font-family: 'BrixSansBlack'; */
      }
      .nota {
        font-size: 8pt;
      }
      .label_gracias {
        font-family: verdana;
        font-weight: bold;
        font-style: italic;
        text-align: center;
        margin-top: 20px;
      }
      .anulada {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translateX(-50%) translateY(-50%);
      }
      .Logo {
        width: 80px;
        height: 80px;
      }
    </style>
  </head>
  <body>
    <div id="page_pdf">
      <table id="factura_head">
        <tr>
          <td>
            <div>
              <img src="http://localhost/Sistema_MesaPartes/reporte/img/sello.jpg" width="80px" height="80px">
            </div>
          </td>
          <td >
            <div align="center">
              <span class="h2">HOSPITAL ANTONIO CALDAS DOMÍNGUEZ - POMABAMBA</span>
              <p>Dirección: Carretera Norte KM 1 S/N - Huajtchacra</p>
              <p>Teléfono: 043-4510028</p>
              <p>Email:</p>
            </div>
          </td>
          <td>
            <div>
              <img  src="http://localhost/Sistema_MesaPartes/reporte/img/logo.jpg" width="80px" height="80px">
            </div>
          </td>
        </tr>
      </table>

      <table id="factura_cliente">
        <tr>
          <td class="info_cliente">
            <div class="round">
              <span style="font-weight:600;" class="h3">DATOS DEL REPORTE</span>
              <table class="datos_cliente">
                <tr>
                  <td>
                    <label>Nombre del Reporte:</label>
                    <p>Trámites Ingresados</p>
                  </td>
                  <td>
                    <label>Fecha:</label>
                    <p><?php echo date("d/m/Y");?></p>
                  </td>
                </tr>
                <tr>
                  <td>
                    <label>Total de Registros:</label>
                    <p><?php echo mysqli_num_rows($consulta) ?></p>
                  </td>
                  <td>
                    <label>Hora:</label>
                    <p><?php echo date("g:i:s a");;?></p>
                  </td>
                </tr>
              </table>
            </div>
          </td>
        </tr>
      </table>
      <br>
      <p><?php echo $type;?></p>
      <span class="h2">DETALLE DE TABLA DE COLABORADORES REGISTRADOS:</span>
      <br>
      <br>
      <table id="factura_detalle" border="" height="40">
        <thead >
          <tr style="font-weight:600">
              <th>Exp.</th>
              <th>Ingreso</th>
              <th>T. Doc</th>  
              <th>DNI</th>
              <th>Remitente</th>
              <th>Estado</th>
          </tr>
        </thead>
        <tbody style="text-align: center">
        <?php
        if ($result > 0) {
          # code...
        
					while ($row = mysqli_fetch_assoc($consulta)){
			 		?>
        <tr height="40">
          <th><?php echo $row['expediente']; ?></th> 
          <th><?php echo $row['Fecha']; ?></th>
          <th><?php echo $row['tipodoc']; ?></th>
          <th><?php echo $row['dni']; ?></th>
          <th><?php echo $row['Datos']; ?></th>
          <th><?php echo $row['estado']; ?></th>
        </tr>
        <?php
					}
        }else{
          ?>
          <tr height="40">
            <th colspan="6">No se encontraron Registros por Mostrar</th> 

          </tr>
          <?php        
        }
					?>
        </tbody>
      </table>

    </div>
  </body>
</html>

<?php 
$html = ob_get_clean();
// echo $html;

require_once '../vendor/autoload.php';
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();

$options = $dompdf->getOptions();
$options->set(array('isRemoteEnabled' => true));
$dompdf->setOptions($options); 

$dompdf->set_option('defaultFont', 'brixsansregular');

$dompdf->loadHtml($html); // (Optional) Setup the paper size and orientation
$dompdf->setPaper("A4", "portrait"); //Render the HTML as PDF
$dompdf->render(); // Output the generated PDF to Browser
$dompdf->stream('Reporte.pdf',array('Attachment'=>false)); exit; 
?>
