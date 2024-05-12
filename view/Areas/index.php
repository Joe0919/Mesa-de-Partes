<?php
require_once "../partesuperior.php";

$institucion1 = mysqli_query($conexion, "select * from institucion");

?>


<!-- MODAL INGRESO Y EDICION DE AREAS-->
<div class="modal fade" id="modalarea">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" id="modal-header">
        <h4 class="modal-title modal-title-h4" id="modal-title">GESTIÓN DE ÁREAS</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">x</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formarea">

          <input type="hidden" class="form-control" name="idid" id="idid">

          <div class="form-group">
            <label for="inputName">Código</label>
            <input type="text" class="form-control" name="icod" id="icod" onkeypress="return validaNumericos(event)">
          </div>

          <div class="form-group">
            <label for="inputName">Área</label>
            <input type="text" class="form-control" name="iarea" id="iarea">
          </div>
          <div class="form-group">
            <label>Institución</label> &nbsp;
            <a class="btn btn-flat bg-success btn-a1">...</a>
            <select class="form-control" name="tipoinsti" id="tipoinsti">
              <?php while ($datos = mysqli_fetch_array($institucion1)) { ?>
                <option value="<?php echo $datos['idinstitucion']  ?>">
                  <?php echo $datos['razon'] ?></optiomn>
                <?php } ?>
            </select>
          </div>
        </form>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn1 btn-danger" data-dismiss="modal" onclick="limpiarcamposarea()">Cancelar</button>
        <button type="button" class="btn btn1 btn-primary" id="editara">Editar</button>
        <button type="button" class="btn btn1 btn-primary" id="guardara">Guardar</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>


<!-- Main Sidebar Container -->
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
            <a href="#" class="nav-link active">
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
            <li class="font-w-600"><i class="nav-icon fas fa-home"></i>&nbsp;Áreas</li>
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
            <div class="card-header">
              <h3 class="card-title font-w-600 card-header-title">Listado de Áreas Registradas</h3>
              <a class="btn btn-flat btn-a bg-success" data-toggle="modal" id="Nuevoa">
                <i class="nav-icon fas fa-plus"></i>Nuevo Registro </a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <a Target="_blank" class="btn btn-flat btn-a bg-gray-dark" href="../../reporte/reporte-areas.php" id="ReportUsu">
                <i class="nav-iconfas fas fa-file-pdf"></i>Generar Reporte </a>
              <table id="tablaAreas" class="table table-hover table-data">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Código</th>
                    <th>Área</th>
                    <th>Acción</th>
                  </tr>
                </thead>
                <tbody>

                  <!-- ESPACIO DE LLENADO AUTOMATICO DE LOS DATOS CORRESPONDIENTES -->

                </tbody>
                <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Código</th>
                    <th>Área</th>
                    <th>Acción</th>
                  </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>

    <!-- /.container-fluid -->
  </section>
</div>
<!-- /.content -->
</div>
</div>
</div>
<!-- /.content-wrapper -->

<!-- FIN  DEL CONTENIDO PRINCIPAL -->
<?php require_once("../parteinferior.php") ?>