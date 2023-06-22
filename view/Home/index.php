
<?php 
 include("../../config/conexion.php");
 include("../../config/conexion2.php");
 
if (!isset($_SESSION["idusuarios"])) {
  header("Location: http://localhost/Sistema_MesaPartes/Acceso/");
}
$iduser=$_SESSION["idusuarios"];
$foto=$_SESSION["foto"];
$dni=$_SESSION["dni"];

$consulta=mysqli_query($conexion,"select idinstitucion, ae.idarea IDa, area from empleado e, persona p, areainstitu a, area ae
where e.idpersona=p.idpersona and e.idareainstitu=a.idareainstitu and ae.idarea=a.idarea and dni='$dni';");
$area = mysqli_fetch_assoc($consulta);

$institucion=mysqli_query($conexion,"select * from institucion where idinstitucion='1'");
$row = mysqli_fetch_assoc($institucion);

$consulta=mysqli_query($conexion,"select a.idarea Ida from empleado e, persona p, areainstitu a, area ae
where e.idpersona=p.idpersona and e.idareainstitu=a.idareainstitu and ae.idarea=a.idarea and dni='$dni';");
$res = mysqli_fetch_assoc($consulta);
$ida = $res['Ida'];

$cant=mysqli_query($conexion,"SELECT count(*) total FROM documento where estado='PENDIENTE'");
$fila = mysqli_fetch_assoc($cant);
$cant1=mysqli_query($conexion,"SELECT count(*) total FROM documento where estado='RECHAZADO'");
$fila1 = mysqli_fetch_assoc($cant1);
$cant2=mysqli_query($conexion,"SELECT count(*) total FROM documento where estado='ACEPTADO'");
$fila2 = mysqli_fetch_assoc($cant2);

$cant=mysqli_query($conexion,"SELECT count(*) total FROM documento where estado='PENDIENTE' and idubi='$ida'");
$filaP = mysqli_fetch_assoc($cant);
$cant=mysqli_query($conexion,"SELECT count(*) total FROM documento where estado='RECHAZADO' and idubi='$ida'");
$filaR = mysqli_fetch_assoc($cant);
$cant=mysqli_query($conexion,"SELECT count(*) total FROM documento where estado='ACEPTADO' and idubi='$ida'");
$filaA = mysqli_fetch_assoc($cant);

$consulta=mysqli_query($conexion,"SELECT distinct date_format(fechad,'%Y') año FROM derivacion");


require_once "../partesuperior.php";
?>
 
    <!-- Modal Generación de Reportes -->
    <div class="modal fade" id="ModalInformes"  >
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 style="font-weight:600" class="modal-title">GENERADOR DE INFORME DOCUMENTARIO:</h4>
          &nbsp;<b id="idc" style="color:#8C0505;font-size: 1.4rem;"></b> 
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">  
          

          <div class="row">
            <div class="col-sm-6">
              <div align="center">
                  <label>Estado del Documento: </label>
                  <select  class="form-control" style="width:300px;height:45px;font-weight:600;text-align:center;font-size:18px" name="cbovista" id="cboreport">                      
                      <option value="0">TODOS</option>
                      <option value="PENDIENTE">PENDIENTES</option>
                      <option value="ACEPTADO">ACEPTADOS</option>
                      <option value="RECHAZADO">RECHAZADOS</option>
                      <option value="ARCHIVADO">ARCHIVADOS</option>
                  </select>
              </div>
            </div>
            <div class="col-sm-6">
              <div align="center">
                    <label>Forma del Reporte: </label>
                    <select  class="form-control"  style="width:300px;height:45px;font-weight:600;text-align:center;font-size:18px;" name="cboreport1" id="cboreport1">                      
                        <option value=0>Seleccione</option> 
                        <option value=1>POR AÑO</option>
                        <option value=2>POR MES Y AÑO</option>
                        <option value=3>POR RANGO DE FECHAS</option>
                    </select>
                </div>
            </div>
          </div>
            <br>

            <form id="formreport">
          <div class="row" id="re">
            <div class="col-sm-6">
              <div align="center" id="reportaño">
                  <label>AÑO: </label>
                  <select class="form-control" style="width:300px;height:45px;font-weight:600;text-align:center;font-size:18px" name="cboaño" id="cboaño">                      
                                <?php while($datos=mysqli_fetch_array($consulta)) {?>
                                    <option value="<?php echo $datos['año']?>"> <?php echo $datos['año']?></option>
                                <?php }?>
                  </select>
              </div>
            </div>
            <div class="col-sm-6" >
              <div align="center" id="reportmes">
                    <label>MES: </label>
                    <select  class="form-control" style="width:300px;height:45px;font-weight:600;text-align:center;font-size:18px;" name="cbormes" id="cbormes">                      
                        <option value="">Seleccione</option>
                        <option value="01">ENERO</option>
                        <option value="02">FEBRERO</option>
                        <option value="03">MARZO</option>
                        <option value="04">ABRIL</option>
                        <option value="05">MAYO</option>
                        <option value="06">JUNIO</option>
                        <option value="07">JULIO</option>
                        <option value="08">AGOSTO</option>
                        <option value="09">SETIEMBRE</option>
                        <option value="10">OCTUBRE</option>
                        <option value="11">NOVIEMBRE</option>
                        <option value="12">DICIEMBRE</option>
                    </select>
                </div>
            </div>
          </div>
          <br>
            <div class="row" id="reportrango">
                <div class="col-sm-12">
                  <div id="sandbox-container">
                    <div class="input-daterange input-group" id="datepicker">
                        <span class="input-group-addon">DESDE: &nbsp;</span>
                        <input type="text" class="input-sm form-control" name="start" id="start" value=""/>
                        <span class="input-group-addon">&nbsp; HASTA: &nbsp;</span>
                        <input type="text" class="input-sm form-control" name="end" id="end" value=""/>
                    </div>
                  </div>
                </div>
            </div>

          </form>

        </div>
        <div class="modal-footer justify-content-between">
          <button style="height:40px;width:120px" type="button" class="btn btn-danger" data-dismiss="modal">Cerrar </button>
          <button style="height:40px;width:180px" type="button" class="btn btn-primary" id="btnReport">Generar Reporte</button>
        </div>
      </div>
    </div>
</div>


<!-- INICIO DEL CONTENIDO PRINCIPAL-->
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-11">
          <h1 style="text-align:center;color:black;font-weight:600;">SISTEMA DE MESA DE PARTES VIRTUAL</h1>
        </div>
        <div class="col-sm-1">

          <ol class="breadcrumb float-sm-right">
            <li style="font-weight:600"><i class="nav-icon fas fa-home"></i>&nbsp;Inicio</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">

      <div class="row">

        <section class="col-lg-12 connectedSortable">


        <?php if($area['area'] == "ADMIN SISTEMA"){?>
          
          <div class="card card-outline card-info">
            <div class="card-header">
              <h3 style="font-size: 1.2rem;font-weight: 500;">
                <i class="ion ion-md-folder-open mr-1"></i>&nbsp;<b>INFORMACIÓN DOCUMENTARIA GENERAL:<b></h3>
              <div class="row">
                <div class="col-md-4 col-sm-6 col-12">
                  <div class="info-box bg-danger">
                    <span class="info-box-icon bg-danger"><img src="/Sistema_MesaPartes/public/assets/img/rechazado.png"></span>
                    <div class="info-box-content">
                      <span style="font-weight:600;font-size:20px;" class="info-box-text">RECHAZADOS</span>
                      <span style="font-weight:600;font-size:40px;" ><?php echo $fila1['total']?></span>
                      <span style="font-weight:500;font-size:18px;" class="progress-description">Total de Documentos</span>
                    </div>
                  </div>
                </div>
                <div class="col-md-4 col-sm-6 col-12">
                  <div class="info-box bg-primary">
                    <span class="info-box-icon bg-primary"><img src="/Sistema_MesaPartes/public/assets/img/pendiente.png"></span>
                    <div class="info-box-content">
                      <span style="font-weight:600;font-size:20px;" class="info-box-text">PENDIENTES</span>
                      <span style="font-weight:600;font-size:40px;"><?php echo $fila['total']?></span>
                      <span style="font-weight:500;font-size:18px;" class="progress-description">Total de Documentos</span>
                    </div>
                  </div>
                </div>
                <div class="col-md-4 col-sm-6 col-12">
                  <div class="info-box bg-green">
                    <span class="info-box-icon bg-green"><img src="/Sistema_MesaPartes/public/assets/img/documentos.png"></span>
                    <div class="info-box-content">
                      <span style="font-weight:600;font-size:20px;" class="info-box-text">ACEPTADOS</span>
                      <span style="font-weight:600;font-size:40px;" ><?php echo $fila2['total']?></span>
                      <span style="font-weight:500;font-size:18px;" class="progress-description">Total de Documentos</span>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- /.card-header -->
          </div>
        <?php }?>

        <div class="card card-outline card-fuchsia">
            <div class="card-header">
              <h3 style="font-size: 1.2rem;font-weight: 500;">
                <i class="ion ion-md-folder-open mr-1"></i>&nbsp;<b>RESUMEN DE TRÁMITES DEL ÁREA:<b></h3>
              <div class="row">
                <div class="col-md-4 col-sm-6 col-12">
                  <div class="info-box bg-danger">
                    <span class="info-box-icon bg-danger"><img src="/Sistema_MesaPartes/public/assets/img/rechazado.png"></span>
                    <div class="info-box-content">
                      <span style="font-weight:600;font-size:20px;" class="info-box-text">RECHAZADOS</span>
                      <span style="font-weight:600;font-size:40px;" ><b id="cantR"><?php echo $filaR['total'];?></b></span>
                      <span style="font-weight:500;font-size:18px;" class="progress-description">Total de Documentos</span>
                    </div>
                  </div>
                </div>
                <div class="col-md-4 col-sm-6 col-12">
                  <div class="info-box bg-primary">
                    <span class="info-box-icon bg-primary"><img src="/Sistema_MesaPartes/public/assets/img/pendiente.png"></span>
                    <div class="info-box-content">
                      <span style="font-weight:600;font-size:20px;" class="info-box-text">PENDIENTES</span>
                      <span style="font-weight:600;font-size:40px;"><b id="cantP"><?php echo $filaP['total'];?></b></span>
                      <span style="font-weight:500;font-size:18px;" class="progress-description">Total de Documentos</span>
                    </div>
                  </div>
                </div>
                <div class="col-md-4 col-sm-6 col-12">
                  <div class="info-box bg-green">
                    <span class="info-box-icon bg-green"><img src="/Sistema_MesaPartes/public/assets/img/documentos.png"></span>
                    <div class="info-box-content">
                      <span style="font-weight:600;font-size:20px;" class="info-box-text">ACEPTADOS</span>
                      <span style="font-weight:600;font-size:40px;" ><b id="cantA"><?php echo $filaA['total'];?></b></span>
                      <span style="font-weight:500;font-size:18px;" class="progress-description">Total de Documentos</span>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- /.card-header -->
          </div>
        </section>

      </div>

    </div>
  </section>

</div>
<!-- FIN  DEL CONTENIDO PRINCIPAL -->
<?php require_once ("../parteinferior.php")?>