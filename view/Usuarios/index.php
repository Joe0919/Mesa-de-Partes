<?php
require_once "../partesuperior.php";

$query1 = mysqli_query($conexion, "SELECT * FROM roles");
$query2 = mysqli_query($conexion, "SELECT * FROM roles");
?>

<!-- MODAL INGRESO DE USUARIO-->
<div class="modal fade" id="modalusuario">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" id="modal-header">
        <h4 class="modal-title modal-title-h4" id="modal-title">GESTIÓN DE USUARIOS</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">x</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formnew">
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="inputName">DNI</label>
                <input type="text" class="form-control" name="idni" id="idni" onkeypress='return validaNumericos(event)' maxlength="8" minlength="8">
                <b id="Aviso"></b>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="inputName">Nombres</label>
                <input type="text" class="form-control" name="inombre" id="inombre">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="inputName">Apellido Paterno</label>
                <input type="text" class="form-control" name="iappat" id="iappat">
              </div>
            </div>

            <div class="col-sm-6">
              <div class="form-group">
                <label for="inputName">Apellido Materno</label>
                <input type="text" class="form-control" name="iapmat" id="iapmat">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="inputEmail">Celular</label>
                <input type="text" class="form-control" name="icel" id="icel">
              </div>
            </div>

            <div class="col-sm-6">
              <div class="form-group">
                <label for="inputEmail">Dirección</label>
                <input type="text" class="form-control" name="idir" id="idir">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="inputMessage">Email</label>
                <input type="email" class="form-control1" name="iemail" id="iemail">
                <b id="AvisoE"></b>
              </div>
            </div>

            <div class="col-sm-6">
              <div class="form-group">
                <label for="inputEmail">Nombre Usuario</label>
                <input type="text" class="form-control1" name="inomusu" id="inomusu">
                <b id="error1"></b>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-4">
              <div class="form-group">
                <label>Rol</label> &nbsp;
                <a class="btn btn-flat bg-success btn-a1">...</a>
                <select class="form-control" name="tipo" id="tipo">
                  <?php while ($datos = mysqli_fetch_array($query1)) { ?>
                    <option value="<?php echo $datos['idroles']  ?>"> <?php echo $datos['rol'] ?></option>
                  <?php } ?>
                </select>

              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label>Contraseña</label>
                <input type="password" class="form-control" name="ipasss" id="ipasss" />
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label for="inputEmail">Confirmar Contraseña</label>
                <input type="password" class="form-control" name="ipassco" id="ipassco" />
                <p id="error2"></p>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn1 btn-danger" data-dismiss="modal" onclick="limpiarcampos()">Cancelar</button>
        <button type="button" class="btn btn1 btn-primary" id="guardar">Registrar</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<!-- MODAL EDICIÓN DE USUARIO-->
<div class="modal fade" id="modalEdusuario">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" id="modal-header">
        <h4 class="modal-title modal-title-h4" id="modal-title">EDICIÓN DE USUARIOS</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">x</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formEdit">
          <input type="hidden" class="form-control" name="idusu" id="idusu">
          <input type="hidden" class="form-control" name="idper" id="idper">
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="inputName">DNI</label>
                <input type="text" class="form-control" name="idni" id="idni1" onkeypress='return validaNumericos(event)' maxlength="8" minlength="8">
                <b id="Aviso"></b>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="inputName">Nombres</label>
                <input type="text" class="form-control" name="inombre" id="inombre1">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="inputName">Apellido Paterno</label>
                <input type="text" class="form-control" name="iappat" id="iappat1">
              </div>
            </div>

            <div class="col-sm-6">
              <div class="form-group">
                <label for="inputName">Apellido Materno</label>
                <input type="text" class="form-control" name="iapmat" id="iapmat1">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="inputEmail">Celular</label>
                <input type="text" class="form-control" name="icel" id="icel1">
              </div>
            </div>

            <div class="col-sm-6">
              <div class="form-group">
                <label for="inputEmail">Dirección</label>
                <input type="text" class="form-control" name="idir" id="idir1">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="inputMessage">Email</label>
                <input type="email" class="form-control1" name="iemail" id="iemail1">
                <b id="AvisoE"></b>
              </div>
            </div>

            <div class="col-sm-6">
              <div class="form-group">
                <label for="inputEmail">Nombre Usuario</label>
                <input type="text" class="form-control1" name="inomusu" id="inomusu1">
                <b id="error1"></b>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>Rol</label> &nbsp;
                <a class="btn btn-flat bg-success btn-a1">...</a>
                <select class="form-control" name="tipo" id="tipo1">
                  <?php while ($datos = mysqli_fetch_array($query2)) { ?>
                    <option value="<?php echo $datos['idroles'] ?>"> <?php echo $datos['rol'] ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Estado</label> &nbsp;
                <select class="form-control" name="estado1" id="estado1">
                  <option value="ACTIVO">ACTIVO</option>
                  <option value="DESACTIVADO">DESACTIVADO</option>
                </select>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn1 btn-danger" data-dismiss="modal" onclick="limpiarcampos()">Cancelar</buttontyle=>
          <button type="button" class="btn btn1 btn-primary" id="Editar">Editar</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<!-- MODAL CAMBIO DE CONTRASEÑA-->
<div class="modal fade" id="modaleditpsw1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title modal-title-h4">CAMBIO DE CONTRASEÑA:</h4>
        <b id="idc" class="b-modal-info"></b>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formC">
          <div class="form-group">
            <label>Contraseña Actual</label>
            <input type="password" class="form-control1" name="ipsw" id="ipsw" />
          </div>
          <div class="form-group">
            <label>Contraseña Nueva</label>
            <input type="password" class="form-control1" name="ipasss1" id="ipasss1" />
          </div>
          <div class="form-group">
            <label>Confirmar nueva contraseña</label>
            <input type="password" class="form-control1" name="ipassco1" id="ipassco1" />
            <b id="error3"></b>
          </div>
        </form>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn1 btn-danger" data-dismiss="modal" id="SalirC">Cancelar </button>
        <button type="button" class="btn btn1 btn-primary" id="BtnContra">Actualizar</button>
      </div>
    </div>
  </div>
</div>

<!-- MODAL FOTO-->
<div class="modal fade" id="modalfoto">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title modal-title-h4">CAMBIO DE FOTO DE PERFIL:</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form id="FormFoto">
        <div class="modal-body modal-body-center">
          <h1 class="modal-body-title">Foto de perfil Actual</h1>
          <img class="modal-photo" id="FotoP" name="FotoP">
          <br><br>
          <div class="form-group">
            <label>Elegir Foto (jpg)</label><span class="span-red"> (*)</span>
            <div class="file">
              <input type="hidden" id="opcion" name="opcion" value='10'>
              <input type="hidden" id="iddni1" name="iddni1">
              <input type="hidden" id="idusua" name="idusua">
              <input type="file" id="idfile1" name="idfile1" required accept=".jpg">
            </div>

          </div>

        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn1 btn-danger" data-dismiss="modal">Cancelar </button>
          <button type="submit" class="btn btn1 btn-primary" id="CambiarF">Cambiar</button>
        </div>
      </form>
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
            <a href="#" class="nav-link active">
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
            <li class="font-w-600 li-nav-info"><i class="nav-icon fas fa-user"></i>Usuarios</li>
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
              <h3 class="card-title font-w-600 card-header-title">Listado de Usuarios Registrados</h3>
              <a class="btn btn-flat btn-a bg-success" data-toggle="modal" id="Nuevo">
                <i class="nav-icon fas fa-plus"></i>Nuevo Registro </a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <a Target="_blank" class="btn btn-flat btn-a bg-gray-dark" href="../../reporte/reporte-areas.php" id="ReportUsu">
                <i class="nav-iconfas fas fa-file-pdf"></i>Generar Reporte </a>
              <table id="tablaUsuarios" class="table table-hover table-data">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>DNI</th>
                    <th>Email</th>
                    <th>Estado</th>
                    <th class="th-photo">Foto</th>
                    <th>Acción</th>
                  </tr>
                </thead>
                <tbody>

                  <!-- ESPACIO DE LLENADO AUTOMATICO DE LOS DATOS CORRESPONDIENTES -->

                </tbody>
                <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>DNI</th>
                    <th>Email</th>
                    <th>Estado</th>
                    <th class="th-photo">Foto</th>
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
<!-- /.content-wrapper -->
</div>
</div>
<!-- FIN  DEL CONTENIDO PRINCIPAL -->

<?php require_once("../parteinferior.php") ?>