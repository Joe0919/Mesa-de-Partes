<?php
require_once "../partesuperior.php";

$institucion1 = mysqli_query($conexion, "select * from institucion");

$empleados = mysqli_query($conexion, "select p.idpersona ID,  concat('DNI : ',p.dni,' : ',ap_paterno,' ', ap_materno,' ',nombres) Datos
from (usuarios u inner join persona p on u.dni=p.dni) left join empleado e on p.idpersona = e.idpersona
where e.idpersona is null");

$areaE = mysqli_query($conexion, "select i.idareainstitu ID, area from area a, areainstitu i where i.idarea=a.idarea");
?>


<!-- MODAL GESTION DE EMPLEADOS-->
<div class="modal fade" id="modalEmpleado">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title modal-title-h4">GESTIÓN DE EMPLEADOS:</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="FormEmpleado">
          <div id="usuar" class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label>Usuarios Registrados Pendientes: (*)</label>
                <select class="form-control select" name="UsuE" id="UsuE">
                  <?php while ($datos = mysqli_fetch_array($empleados)) { ?>
                    <option value="<?php echo $datos['ID']  ?>"> <?php echo $datos['Datos'] ?></optiomn>
                    <?php } ?>
                </select>
              </div>
            </div>
          </div>
          <div class="div-info" id="Informacion">
            <p class="p-info">Información del Usuario:</p>
            <input type="hidden" class="form-control" id="idper" name="idper">
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label class="color-blue">DNI</label>
                  <input type="text" class="form-control input-form" id="dniU" disabled name="dniU">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label class="color-blue">NOMBRES</label>
                  <input type="text" class="form-control input-form" id="nomU" disabled name="nomU">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label class="color-blue">APELLIDO PATERNO</label>
                  <input type="text" class="form-control input-form" id="apU" disabled name="apU">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label class="color-blue">APELLIDO MATERNO</label>
                  <input type="text" class="form-control input-form" id="amU" disabled name="amU">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label class="color-blue">CELULAR</label>
                  <input type="text" class="form-control input-form" id="celU" disabled name="celU">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label class="color-blue">DIRECCIÓN</label>
                  <input type="text" class="form-control input-form" id="dirU" disabled name="dirU">
                </div>
              </div>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>CÓDIGO (*)</label>
                <input type="text" class="form-control input-form" id="codU" name="codU">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>ÁREA (*)</label>
                <select class="form-control select" name="areaE" id="areaE">
                  <?php while ($datos = mysqli_fetch_array($areaE)) { ?>
                    <option value="<?php echo $datos['ID']  ?>"> <?php echo $datos['area'] ?></optiomn>
                    <?php } ?>
                </select>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn1 btn-danger" data-dismiss="modal" id="SalirE">Cancelar </button>
        <button type="button" class="btn btn1 btn-primary" id="EditarE">Editar</button>
        <button type="button" class="btn btn1 btn-primary" id="GuardarE">Guardar</button>
      </div>
    </div>
  </div>
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
            <a href="#" class="nav-link active">
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
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-11">
          <h1 class="title-content-h1">SISTEMA DE MESA DE PARTES VIRTUAL</h1>
        </div>
        <div class="col-sm-1">
          <ol class="breadcrumb float-sm-right">
            <li class="font-w-600 li-nav-info"><i class="nav-icon fas fa-user-friends"></i>&nbsp;Empleados</li>
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
              <h3 class="card-title font-w-600 card-header-title">Listado de Empleados Registrados</h3>
              <a class="btn btn-flat btn-a bg-success" data-toggle="modal" id="NuevoEmpleado">
                <i class="nav-icon fas fa-plus"></i>Nuevo Registro </a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <a Target="_blank" class="btn btn-flat btn-a bg-gray-dark" href="../../reporte/reporte-empleados.php" id="ReportUsu">
                <i class="nav-iconfas fas fa-file-pdf"></i>Generar Reporte </a>
              <table id="tablaEmpleados" class="table table-hover table-data">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Código</th>
                    <th>DNI</th>
                    <th>Apellidos y Nombres</th>
                    <th>Celular</th>
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
                    <th>DNI</th>
                    <th>Apellidos y Nombres</th>
                    <th>Celular</th>
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

</div>
<!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
</div>
</div>
<!-- /.content-wrapper -->

<!-- FIN  DEL CONTENIDO PRINCIPAL -->

<?php require_once("../parteinferior.php") ?>