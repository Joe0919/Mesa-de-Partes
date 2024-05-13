<?php
require_once "../partesuperior.php";
$consulta = mysqli_query($conexion, "select idinstitucion, area from empleado e, persona p, areainstitu a, area ae
where e.idpersona=p.idpersona and e.idareainstitu=a.idareainstitu and ae.idarea=a.idarea and dni='$dni';");
$area = mysqli_fetch_assoc($consulta);

$institucion = mysqli_query($conexion, "select * from institucion where idinstitucion='1'");
$row = mysqli_fetch_assoc($institucion);

$institucion1 = mysqli_query($conexion, "select * from institucion");

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
          <a href="#" class="nav-link active">
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
            <li class="font-w-600 li-nav-info"><i class="nav-icon fas fa-search"></i>Búsqueda</li>
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

          <div class="card card-primary" id="insert">
            <div class="card-header">
              <h3 class="card-title font-w-600 d-flex-gap"><i class="fas fa-search"></i>BÚSQUEDA DE EXPEDIENTES</h3>
            </div>

            <!-- /.card-header -->
            <div class="card-body">
              <p>*Para realizar la búsqueda de un documento presentado debe de ingresar el
                Número de Expediente del Documento y seleccionar el año de presentación:</p>
              <br>
              <div>

                <form id="FormBuscar">

                  <div class="form-group row justify-content-between">
                    <div class="d-flex align-items-center">
                      <label class="w-75 text-right mr-3">Nro Expediente:</label>
                      <input type="email" class="form-control" id="idexpb" onkeypress="return validaNumericos(event)" maxlength="6">
                    </div>
                    <div class="d-flex align-items-center">
                      <label class="w-75 text-right mr-3">DNI:</label>
                      <input type="email" class="form-control" id="iddnii" onkeypress="return validaNumericos(event)" maxlength="8">
                    </div>
                    <div class="d-flex align-items-center">
                      <label class="w-75 text-right mr-3">Año:</label>
                      <select class="form-control select-search" id="idtipob">
                        <?php
                        $currentYear = date('Y');
                        for ($i = $currentYear; $i >= 2020; $i--) {
                          echo "<option value='" . $i . "'>" . $i . "</option>";
                        }
                        ?>
                      </select>
                    </div>
                    <div>
                      <button type="button" id="btnBusca" class="btn btn2 btn-danger"><i class="fa fa-search"></i>BUSCAR</button>
                    </div>
                  </div>

                </form>
              </div>
            </div>

          </div>

          <div id="divNoFound">
            <div class="callout callout-warning">
              <div class="row">
                <div class="col-sm-3" align="right">
                  <img class="img-no-search" src="../../public/assets/img/error-404.png">
                </div>
                <div class="col-sm-9">
                  <br>
                  <h2><i class="fas fa-exclamation-triangle text-warning"></i> TRÁMITE NO ENCONTRADO.</h2>

                  <p>
                    No se encontro el trámite con los datos ingresado, puede ser por que no existe un trámite
                    registrado con esos datos.<br>
                    <b>Por favor, intente realizar nuevamente la búsqueda ingresando los datos correctos.<b>
                  </p>
                </div>
              </div>
            </div>
          </div>

          <div class="card card-olive" id="dat">
            <div class="card-header">
              <h3 class="card-title font-w-600 d-flex-gap"><i class="fas fa-file-pdf "></i> DATOS DEL TRÁMITE REALIZADO
              </h3>
            </div>
            <div class="row">
              <div class="col-sm-7">

              </div>
              <div class="col-sm-5">
                <br>
                <div class="row">
                  <div class="col-md-6">
                    <button type="button" class="btn btn3 btn-primary" id="btnNew"><i class="fa fa-search"></i>Nueva Búsqueda</button>
                  </div>
                  <div class="col-md-5">
                    <button type="button" class="btn btn3 btn-danger" id="btnhistorial"><i class="fa fa-plus"></i>Mostrar Historial</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-sm-6">
                  <div class="callout callout-success">

                    <table border="2" class="table-doc table-data" cellspacing="0" cellpadding="5" id="tableDoc">
                      <thead>
                        <tr>
                          <th colspan="2">
                            <h5 class="font-w-600">DATOS DEL DOCUMENTO</h5>
                            </font>
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th>Expediente</th>
                          <td>
                            <p id="celdaexpe"></p>
                          </td>
                        </tr>
                        <tr>
                          <th>N° Documento</th>
                          <td>
                            <p id="celdanro"></p>
                          </td>
                        </tr>
                        <tr>
                          <th>Tipo</th>
                          <td>
                            <p id="celdatipo"></p>
                          </td>
                        </tr>
                        <tr>
                          <th>Asunto</th>
                          <td>
                            <p id="celdasunto"></p>
                          </td>
                        </tr>
                      </tbody>
                    </table>

                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="callout callout-info">
                    <table border="2" class="table-remi table-data" cellspacing="0" cellpadding="5" id="tableRemitente">
                      <tr>
                        <th colspan="2">
                          <h5 class="font-w-600">DATOS DEL REMITENTE</h5>
                          </font>
                        </th>
                      </tr>
                      <tr>
                        <th>DNI</th>
                        <td>
                          <p id="celdadni"></p>
                        </td>
                      </tr>
                      <tr>
                        <th>Apellidos y Nombres</th>
                        <td>
                          <p id="celdadatos"></p>
                        </td>
                      </tr>
                      <tr>
                        <th>RUC</th>
                        <td>
                          <p id="celdaruc"></p>
                        </td>
                      </tr>
                      <tr>
                        <th>Entidad</th>
                        <td>
                          <p id="celdaenti"></p>
                        </td>
                      </tr>
                    </table>

                  </div>
                </div>
              </div>

            </div>

          </div>

          <!-- LINEA DE TIEMPO DEL DOCUMENTO -->
          <div id="linea">

          </div>
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