<?php
require_once "../partesuperior.php";


$institucion1 = mysqli_query($conexion, "select * from institucion");

$consulta = mysqli_query($conexion, "select a.idarea ID,area from empleado e, persona p, areainstitu a, area ae
where e.idpersona=p.idpersona and e.idareainstitu=a.idareainstitu and ae.idarea=a.idarea and dni='$dni';");
$resultado = mysqli_fetch_assoc($consulta);

$area_actual = $resultado['area'];

// $area = mysqli_query($conexion, "select a.idarea ID, cod_area, area from institucion i, area a, areainstitu ae where ae.idinstitucion=i.idinstitucion and ae.idarea=a.idarea and area!='$area_actual'");

// $consulta1=mysqli_query($conexion,"select date_format();");
$resultado1 = mysqli_fetch_assoc($consulta);

?>

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
            <a href="#" class="nav-link active">
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
            <li class="font-w-600 li-nav-info"><i class="nav-icon fas fa-file-medical"></i>Trámites</li>
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
              <h3 class="card-title font-w-600 card-header-title">Listado de Trámites Registrados</h3>


            </div>
            <!-- /.card-header -->
            <div class="card-body">

              <table id="tablaTramites" class="table table-hover table-data">
                <thead>
                  <tr>
                    <th rowspan="2">Expediente</th>
                    <th rowspan="2">Fecha</th>
                    <th rowspan="2">Tipo Doc</th>
                    <th colspan="2">Remitente</th>
                    <th colspan="2">Localización</th>
                    <th rowspan="2">Estado</th>
                    <th style="width:2px;" rowspan="2">Más...</th>

                  </tr>
                  <tr>
                    <th>DNI</th>
                    <th>Datos</th>
                    <th>Origen</th>
                    <th>Actual</th>
                  </tr>
                </thead>
                <tbody>

                  <!-- ESPACIO DE LLENADO AUTOMATICO DE LOS DATOS CORRESPONDIENTES -->

                </tbody>
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

<!-- FIN  DEL CONTENIDO PRINCIPAL -->

<?php require_once("../parteinferior.php") ?>