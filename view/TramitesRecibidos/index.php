<?php
require_once "../partesuperior.php";

$institucion1 = mysqli_query($conexion, "select * from institucion");

$consulta = mysqli_query($conexion, "select a.idarea ID,area from empleado e, persona p, areainstitu a, area ae
where e.idpersona=p.idpersona and e.idareainstitu=a.idareainstitu and ae.idarea=a.idarea and dni='$dni';");
$resultado = mysqli_fetch_assoc($consulta);

$area_actual = $resultado['area'];

$areas = mysqli_query($conexion, "select ae.idareainstitu ID, cod_area, area from institucion i, area a, areainstitu ae where ae.idinstitucion=i.idinstitucion and ae.idarea=a.idarea and area!='$area_actual'");

// $consulta1=mysqli_query($conexion,"select date_format();");
$resultado1 = mysqli_fetch_assoc($consulta);
?>

<!-- MODAL DE ACEPTACION-->
<div class="modal fade" id="modalacept">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header" id="modal-header">
        <h4 class="modal-title modal-title-h4" id="modal-title">ACEPTAR/RECHAZAR TRÁMITE</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">x</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="Formaceptacion">

          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <input type="hidden" class="form-control" name="idder" id="idder">
                <input type="hidden" class="form-control" name="iddoc1" id="iddoc1">
                <input type="hidden" class="form-control" name="dnir1" id="dnir1">
                <input type="hidden" class="form-control" name="exped" id="exped">

                <label>N° Documento </label><span class="span-red"> (*)</span>
                <input type="text" class="form-control input-form" id="inrodoc1" disabled name="inrodoc1">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>N° Folios </label><span class="span-red"> (*)</span>
                <input type="number" class="form-control input-form" id="ifolio1" disabled name="ifolio1">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>N° Expediente </label><span class="span-red"> (*)</span>
                <input type="text" class="form-control input-form" id="iexpediente1" disabled name="iexpediente1">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Estado </label><span class="span-red"> (*)</span>
                <input type="text" class="form-control input-form" id="iestad1" disabled name="iestad1">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>Tipo</label><span class="span-red"> (*)</span>
                <input type="text" class="form-control input-form" id="itipodoc1" disabled name="itipodoc1">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Asunto </label><span class="span-red"> (*)</span>
                <textarea disabled class="form-control input-form" rows="3" id="iasunt1" name="iasunt1"></textarea>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label>Descripción: </label><span class="span-gray">(Opcional)</span>
                <textarea class="form-control" rows="3" id="des" name="des" placeholder="Ingrese la descripción..."></textarea>
              </div>
            </div>
          </div>

        </form>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn1 btn-primary" data-dismiss="modal" id="btnCerra">Cerrar</button>
        <div class="justify-content-between">
          <button type="button" class="btn btn1 btn-success ms-2" id="btnAcepta">Aceptar</button>
          <button type="button" class="btn btn1 btn-danger" id="btnRechazar">Rechazar</button>
        </div>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<!-- MODAL MAS INFORMACION-->
<div class="modal fade" id="modalmas">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header" id="modal-header">
        <h4 class="modal-title modal-title-h4" id="modal-title">Datos del Trámite</h4>
        <div class=".col-md-4 .ms-auto">
          <a id="iddocumento" href="#" class="btn a-link btn-primary ">Documento</a>
          <a id="idremitent" href="#" class="btn a-link btn-light ">Remitente</a>
          <a id="idvistapre" href="#" class="btn a-link btn-light ">Vista previa</a>
        </div>
      </div>
      <div class="modal-body">
        <form>
          <div id="tramite1">
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <input type="hidden" class="form-control" name="iddoc" id="iddoc">

                  <label>N° Documento </label><span class="span-red"> (*)</span>
                  <input type="text" class="form-control input-form" id="inrodoc" disabled name="inrodoc">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>N° Folios </label><span class="span-red"> (*)</span>
                  <input type="number" class="form-control input-form" id="ifolio" disabled name="ifolio">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label>N° Expediente </label><span class="span-red"> (*)</span>
                  <input type="text" class="form-control input-form" id="iexpediente" disabled name="iexpediente">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Estado </label><span class="span-red"> (*)</span>
                  <input type="text" class="form-control input-form" id="iestad" disabled name="iestad">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Tipo</label><span class="span-red"> (*)</span>
                  <input type="text" class="form-control input-form" id="itipodoc" disabled name="itipodoc">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Asunto </label><span class="span-red"> (*)</span>
                  <textarea disabled class="form-control input-form" rows="3" id="iasunt" name="iasunt"></textarea>
                </div>
              </div>
            </div>
          </div>

          <div id="remitente1">
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label>DNI </label><span class="span-red"> (*)</span>
                  <input type="number" class="form-control input-form" id="iddni1" disabled name="iddni1">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Tipo de Persona: </label><span class="span-red"> (*)</span>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="custom-control custom-radio">
                        <input disabled class="custom-control-input" type="radio" id="customRadio1" name="customRadio" value="natural">
                        <label for="customRadio1" class="custom-control-label">Natural</label>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="custom-control custom-radio">
                        <input disabled class="custom-control-input" type="radio" id="customRadio2" name="customRadio" value="juridica">
                        <label for="customRadio2" class="custom-control-label">Jurídica</label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label>RUC </label><span class="span-red"> (*)</span>
                  <input type="text" class="form-control input-form" id="iruc" disabled name="iruc">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Entidad </label><span class="span-red"> (*)</span>
                  <input type="text" class="form-control input-form" id="iinsti" disabled name="iinsti">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label>Apellidos y Nombres </label><span class="span-red"> (*)</span>
                  <input type="text" class="form-control input-form" id="idremi" disabled name="idremi">
                </div>
              </div>
            </div>
          </div>

          <div id="vista1">
            <div>
              <iframe id="iframePDF" frameborder="0" scrolling="no" width="100%" height="480px"></iframe>
            </div>

          </div>
        </form>
      </div>
      <div class="modal-footer">
        <a target="_blank" class="btn btn-flat btn-a2 bg-gradient-primary" id="NuevoPDF">
          <i class="nav-icon fas fa-file-pdf"></i>Abrir en nueva pestaña </a>
        <button type="button" class="btn btn1 btn-success" id="BotonCerrar1">Cerrar</button>

      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<!-- MODAL SEGUIMIENTO-->
<div class="modal fade" id="modalseguir">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header" id="modal-header">
        <h4 class="modal-title modal-title-h4" id="modal-title">Seguimiento del Trámite: Expediente</h4>&nbsp;&nbsp;
        <p id="nrodesc1" class="p-descrip"></p>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <table id="tablaSeguimiento" class="table table-hover table-data">
          <thead>
            <tr>
              <th>ID</th>
              <th>Fecha</th>
              <th>Ubic. Actual</th>
              <th>Descripción</th>
            </tr>
          </thead>
          <tbody>
          </tbody>


          </tbody>
          <tfoot>
            <tr>
              <th>ID</th>
              <th>Fecha</th>
              <th>Ubic. Actual</th>
              <th>Descripción</th>
            </tr>
          </tfoot>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn1 btn-success" data-dismiss="modal">Cerrar</button>

      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<!-- MODAL DERIVACION-->
<div class="modal fade" id="modalderivar">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header" id="modal-header">
        <h4 class="modal-title modal-title-h4" id="modal-title">Derivar/Finalizar Trámite:</h4>&nbsp;&nbsp;
        <p id="nrodesc" class="p-descrip"></p>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formderivacion">

          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <input type="hidden" class="form-control" name="exp1" id="exp1">
                <input type="hidden" class="form-control" name="dnir" id="dnir">
                <input type="hidden" class="form-control" name="exp" id="exp">
                <label>Fecha: </label><span class="span-red"> (*)</span>

                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                  <input class="input-date" readonly="" type="text" id="datepicker1" value="<?php echo $fechaActual = date('d/m/Y') ?>">
                  <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                  </div>
                </div>

              </div>
            </div>

            <div class="col-sm-6">
              <div class="form-group">
                <label>Acción: </label><span class="span-red"> (*)</span>
                <select class="select-new" name="idaccion" id="idaccion">
                  <option value="1">DERIVAR</option>
                  <option value="2">ARCHIVAR</option>
                </select>
              </div>
            </div>
          </div>
          <div id="column" class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>Área Origen: </label><span class="span-red"> (*)</span>
                <input type="text" class="form-control input-form" id="idorigen" readonly="" value="<?php echo $area_actual ?>" name="idorigen">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Área Destino: </label><span class="span-red"> (*)</span>
                <select class="select-new" name="iddestino" id="iddestino">
                  <?php
                  while ($datos = mysqli_fetch_array($areas)) {
                  ?>
                    <option value="<?php echo $datos['ID'] ?>"> <?php echo $datos['area'] ?></optiomn>
                    <?php
                  }
                    ?>
                </select>
              </div>
            </div>
          </div>
          <div id="des1" class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label>Descripción: </label><span class="span-gray">(Opcional)</span>
                <textarea class="form-control" rows="3" id="iddescripcion" name="iddescripcion" placeholder="Ingrese la descripción..."></textarea>
              </div>
            </div>
          </div>


        </form>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn1  btn-danger" data-dismiss="modal" onclick="limpiarderivacion()">Cancelar</button>
        <button type="button" class="btn btn1 btn-primary" id="derivar">Derivar</button>
        <button type="button" class="btn btn1 btn-primary" id="finalizar">Archivar</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<!-- ACORDEÓN DEL PANEL DE ADMINISTRACIÓNL-->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a class="brand-link navbar-lightblue">
    <img src="../../<?php echo $row['logo'] ?>" alt="Logo" class="brand-image img-circle elevation-3 img-logo">
    <span class="brand-text span-logo">HACDP</span>
  </a>
  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item menu-open">
          <a href="../../view/Home/" class="nav-link">
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
          <a href="#" class="nav-link active">
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

<!-- INICIO DEL CONTENIDO -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-11">
          <h1 class="title-content-h1">SISTEMA DE MESA DE PARTES VIRTUAL</h1>
        </div>
        <div class="col-sm-1">
          <ol class="breadcrumb float-sm-right">
            <li class="font-w-600 li-nav-info"><i class="nav-icon fas fa-file-download"></i>Trámites Recibidos</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card card-danger card-outline">
            <div class="card-header ">
              <h3 class="card-title font-w-600 card-header-title">Listado de Trámites Recibidos</h3>
              <div style="float:right;">
                <label>Listar por: </label>
                <select class="select-reporte select-info" name="cbovista" id="cbovista">
                  <option value="PENDIENTE">PENDIENTES</option>
                  <option value="ACEPTADO">ACEPTADOS</option>
                  <option value="RECHAZADO">RECHAZADOS</option>
                  <option value="ARCHIVADO">ARCHIVADOS</option>
                </select>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

              <table id="tablaTRecibidos" class="table table-hover table-data">
                <thead>
                  <tr>
                    <th rowspan="2">Expediente</th>
                    <th rowspan="2">Fecha Registro</th>
                    <th rowspan="2">Tipo Doc</th>
                    <th colspan="2">Remitente</th>
                    <th colspan="2">Localización</th>
                    <th rowspan="2">Estado</th>
                    <th style="width:2px;" rowspan="2">Más...</th>
                    <th rowspan="2">Acción</th>
                  </tr>
                  <tr>
                    <th>DNI</th>
                    <th>Datos</th>
                    <th>Origen</th>
                    <th>Actual</th>
                  </tr>
                </thead>
                <tbody>

                  <!-- CONTENIDO QUE SE RELLENA CON DATATABLES -->

                </tbody>
              </table>
            </div>
          </div>

        </div>
      </div>
    </div>
</div>
</section>
</div>
</div>
</div>
<!-- FIN  DEL CONTENIDO PRINCIPAL -->

<?php require_once("../parteinferior.php") ?>