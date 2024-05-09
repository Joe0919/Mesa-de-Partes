<?php

require_once "../partesuperior.php";


$cant = mysqli_query($conexion, "SELECT count(*) total FROM documento where estado='PENDIENTE'");
$fila = mysqli_fetch_assoc($cant);
$cant1 = mysqli_query($conexion, "SELECT count(*) total FROM documento where estado='RECHAZADO'");
$fila1 = mysqli_fetch_assoc($cant1);
$cant2 = mysqli_query($conexion, "SELECT count(*) total FROM documento where estado='ACEPTADO'");
$fila2 = mysqli_fetch_assoc($cant2);

$cant = mysqli_query($conexion, "SELECT count(*) total FROM documento where estado='PENDIENTE' and idubi='$ida'");
$filaP = mysqli_fetch_assoc($cant);
$cant = mysqli_query($conexion, "SELECT count(*) total FROM documento where estado='RECHAZADO' and idubi='$ida'");
$filaR = mysqli_fetch_assoc($cant);
$cant = mysqli_query($conexion, "SELECT count(*) total FROM documento where estado='ACEPTADO' and idubi='$ida'");
$filaA = mysqli_fetch_assoc($cant);

$consulta = mysqli_query($conexion, "SELECT distinct date_format(fechad,'%Y') año FROM derivacion");


?>

<!-- Modal Generación de Reportes -->
<div class="modal fade" id="ModalInformes">
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
              <select class="form-control" style="width:300px;height:45px;font-weight:600;text-align:center;font-size:18px" name="cbovista" id="cboreport">
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
              <select class="form-control" style="width:300px;height:45px;font-weight:600;text-align:center;font-size:18px;" name="cboreport1" id="cboreport1">
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
                  <?php while ($datos = mysqli_fetch_array($consulta)) { ?>
                    <option value="<?php echo $datos['año'] ?>"> <?php echo $datos['año'] ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-sm-6">
              <div align="center" id="reportmes">
                <label>MES: </label>
                <select class="form-control" style="width:300px;height:45px;font-weight:600;text-align:center;font-size:18px;" name="cbormes" id="cbormes">
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
                  <input type="text" class="input-sm form-control" name="start" id="start" value="" />
                  <span class="input-group-addon">&nbsp; HASTA: &nbsp;</span>
                  <input type="text" class="input-sm form-control" name="end" id="end" value="" />
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

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a class="brand-link navbar-lightblue">
    <img src="/Sistema_MesaPartes/<?php echo $row['logo'] ?>" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text" style="font-weight:600;font-size:1.4rem;">HACDP</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">


    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item menu-open">
          <a href="#" class="nav-link active">
            <i class="nav-icon fas fa-home"></i>
            <p>
              Inicio
            </p>
          </a>
        </li>
        <?php if ($area['area'] == "ADMIN SISTEMA") { ?>
          <li class="nav-item">
            <a href="../../view/Usuarios/" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Usuarios
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../../view/Areas/" class="nav-link">
              <i class="nav-icon fas fa-square-full"></i>
              <p>
                Áreas
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../../view/Empleados/" class="nav-link">
              <i class="nav-icon fas fa-user-friends"></i>
              <p>
                Empleados
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../../view/Tramites/" class="nav-link">
              <i class="nav-icon fas fa-file-medical"></i>
              <p>
                Trámites
              </p>
            </a>
          </li>
        <?php } ?>
        <li class="nav-item">
          <a href="../../view/NuevoTramite/" class="nav-link">
            <i class="nav-icon fas fa-user-friends"></i>
            <p>
              Nuevo Trámite
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="../../view/TramitesRecibidos/" class="nav-link">
            <i class="nav-icon fas fa-user-friends"></i>
            <p>
              Trámites Recibidos
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="../../view/TramitesEnviados/" class="nav-link">
            <i class="nav-icon fas fa-user-friends"></i>
            <p>
              Trámites Enviados
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="../../view/Busqueda/" class="nav-link">
            <i class="nav-icon fas fa-search-minus"></i>
            <p>
              Búsqueda de Trámites
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#ModalInformes" class="nav-link" data-toggle="modal">
            <i class="nav-icon fas fa-file-contract"></i>
            <p>
              Informes
            </p>
          </a>
        </li>

      </ul>
    </nav>

  </div>
</aside>
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

    <!-- INICIO DEL CONTENIDO PRINCIPAL-->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <section class="col-lg-12 connectedSortable">
          <?php if ($area['area'] == "ADMIN SISTEMA") { ?>
            <div class="card card-outline card-info">
              <div class="card-header">
                <h3 style="font-size: 1.2rem;font-weight: 500;">
                  <i class="ion ion-md-folder-open mr-1"></i>&nbsp;<b>INFORMACIÓN DOCUMENTARIA GENERAL:<b>
                </h3>
                <div class="row">
                  <div class="col-md-4 col-sm-6 col-12">
                    <div class="info-box bg-danger">
                      <span class="info-box-icon bg-danger"><img src="/Sistema_MesaPartes/public/assets/img/rechazado.png"></span>
                      <div class="info-box-content">
                        <span style="font-weight:600;font-size:20px;" class="info-box-text">RECHAZADOS</span>
                        <span style="font-weight:600;font-size:40px;"><?php echo $fila1['total'] ?></span>
                        <span style="font-weight:500;font-size:18px;" class="progress-description">Total de Documentos</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-6 col-12">
                    <div class="info-box bg-primary">
                      <span class="info-box-icon bg-primary"><img src="/Sistema_MesaPartes/public/assets/img/pendiente.png"></span>
                      <div class="info-box-content">
                        <span style="font-weight:600;font-size:20px;" class="info-box-text">PENDIENTES</span>
                        <span style="font-weight:600;font-size:40px;"><?php echo $fila['total'] ?></span>
                        <span style="font-weight:500;font-size:18px;" class="progress-description">Total de Documentos</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-6 col-12">
                    <div class="info-box bg-green">
                      <span class="info-box-icon bg-green"><img src="/Sistema_MesaPartes/public/assets/img/documentos.png"></span>
                      <div class="info-box-content">
                        <span style="font-weight:600;font-size:20px;" class="info-box-text">ACEPTADOS</span>
                        <span style="font-weight:600;font-size:40px;"><?php echo $fila2['total'] ?></span>
                        <span style="font-weight:500;font-size:18px;" class="progress-description">Total de Documentos</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div><!-- /.card-header -->
            </div>
          <?php } ?>

          <div class="card card-outline card-fuchsia">
            <div class="card-header">
              <h3 style="font-size: 1.2rem;font-weight: 500;">
                <i class="ion ion-md-folder-open mr-1"></i>&nbsp;<b>RESUMEN DE TRÁMITES DEL ÁREA:<b>
              </h3>
              <div class="row">
                <div class="col-md-4 col-sm-6 col-12">
                  <div class="info-box bg-danger">
                    <span class="info-box-icon bg-danger"><img src="/Sistema_MesaPartes/public/assets/img/rechazado.png"></span>
                    <div class="info-box-content">
                      <span style="font-weight:600;font-size:20px;" class="info-box-text">RECHAZADOS</span>
                      <span style="font-weight:600;font-size:40px;"><b id="cantR"><?php echo $filaR['total']; ?></b></span>
                      <span style="font-weight:500;font-size:18px;" class="progress-description">Total de Documentos</span>
                    </div>
                  </div>
                </div>
                <div class="col-md-4 col-sm-6 col-12">
                  <div class="info-box bg-primary">
                    <span class="info-box-icon bg-primary"><img src="/Sistema_MesaPartes/public/assets/img/pendiente.png"></span>
                    <div class="info-box-content">
                      <span style="font-weight:600;font-size:20px;" class="info-box-text">PENDIENTES</span>
                      <span style="font-weight:600;font-size:40px;"><b id="cantP"><?php echo $filaP['total']; ?></b></span>
                      <span style="font-weight:500;font-size:18px;" class="progress-description">Total de Documentos</span>
                    </div>
                  </div>
                </div>
                <div class="col-md-4 col-sm-6 col-12">
                  <div class="info-box bg-green">
                    <span class="info-box-icon bg-green"><img src="/Sistema_MesaPartes/public/assets/img/documentos.png"></span>
                    <div class="info-box-content">
                      <span style="font-weight:600;font-size:20px;" class="info-box-text">ACEPTADOS</span>
                      <span style="font-weight:600;font-size:40px;"><b id="cantA"><?php echo $filaA['total']; ?></b></span>
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
</div>
<!-- FIN  DEL CONTENIDO PRINCIPAL -->
<?php require_once("../parteinferior.php") ?>