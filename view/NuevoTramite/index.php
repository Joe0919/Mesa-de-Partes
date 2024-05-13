<?php
require_once "../partesuperior.php";

$query = mysqli_query($conexion, "SELECT * FROM tipodoc");

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
          <a href="#" class="nav-link active">
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
            <li class="font-w-600 li-nav-info"><i class="nav-icon fas fa-plus-circle"></i>Nuevo</li>
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

          <div class="card card-danger">
            <div class="card-header">
              <h3 class="card-title"><i class="fas fa-plus-circle"></i>&nbsp;&nbsp;NUEVO TRÁMITE</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">

                <div class="col-sm-6">
                  <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title">DATOS DEL REMITENTE</h3>
                    </div>
                    <div class="card-body">
                      <form id="formulario-tramite" onsubmit="submitForm(event)" name="formulario-tramite" enctype="multipart/form-data" method="post">
                        <label>Tipo de Persona: </label><span class="span-red"> (*)</span>
                        <div class="row mb-2">
                          <div class="col-sm-6">
                            <div class="custom-control custom-radio">
                              <input class="custom-control-input" type="radio" id="customRadio1" name="customRadio" checked value="natural">
                              <label for="customRadio1" class="custom-control-label">Natural</label>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="custom-control custom-radio">
                              <input class="custom-control-input" type="radio" id="customRadio2" name="customRadio" value="juridica">
                              <label for="customRadio2" class="custom-control-label">Jurídica</label>
                            </div>
                          </div>
                        </div>
                        <div id="mostrar">
                          <div class="form-group">
                            <input type="hidden" class="form-control" id="idpersona" name="idpersona">
                            <label>RUC </label><span class="span-red"> (*)</span>
                            <input type="text" class="form-control" id="idruc" name="idruc" onkeypress="return validaNumericos(event)" maxlength="11" minlength="11">
                          </div>

                          <div class="form-group">
                            <label>Entidad </label><span class="span-red"> (*)</span>
                            <input type="text" class="form-control" id="identi" name="identi">
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label>DNI</label><span class="span-red"> (*)</span>
                              <input type="text" class="form-control" onkeypress='return validaNumericos(event)' maxlength="8" minlength="8" name="iddni" id="iddni" required>
                            </div>
                          </div>
                          <div class="col-sm-2">
                            <input id="validar" type="button" class="btn btn-success" value="Validar">
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label>Nombres </label><span class="span-red"> (*)</span>
                              <input type="text" class="form-control" id="idnombre" name="idnombre" required>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label>Apellido Paterno </label><span class="span-red"> (*)</span>
                              <input type="text" class="form-control" id="idap" name="idap" required>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label>Apellido Materno </label><span class="span-red"> (*)</span>
                              <input type="text" class="form-control" id="idam" name="idam" required>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label>N° Celular </label><span class="span-red"> (*)</span>
                          <input type="text" class="form-control" id="idcel" onkeypress='return validaNumericos(event)' minlength="9" required name="idcel">
                        </div>
                        <div class="form-group">
                          <label>Dirección </label><span class="span-red"> (*)</span>
                          <input type="text" class="form-control" id="iddirec" required name="iddirec">
                        </div>
                        <div class="form-group">
                          <label>Correo </label><span class="span-red"> (*)</span>
                          <input type="text" class="form-control1" id="idcorre" required name="idcorre">
                          <i><b id="Vcorreo"></b></i>
                        </div>
                        <span class="span-red">(*) Campos Obligatorios </span>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="card card-info">
                    <div class="card-header">
                      <h3 class="card-title">DATOS DEL DOCUMENTO</h3>
                    </div>

                    <div class="card-body">
                      <div class="form-group">
                        <label>Tipo</label><span class="span-red"> (*)</span>
                        <select class="select-new" name="idtipo" id="idtipo">
                          <?php
                          while ($datos = mysqli_fetch_array($query)) {
                          ?>
                            <option value="<?php echo $datos['idtipodoc']  ?>"> <?php echo $datos['tipodoc'] ?></optiomn>
                            <?php
                          }
                            ?>
                        </select>
                        <span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span>
                      </div>
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label>N° Documento </label><span class="span-red"> (*)</span>
                            <input type="text" class="form-control" id="idnrodoc" onkeypress='return validaNumericos(event)' required name="idnrodoc">
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label>N° Folios </label><span class="span-red"> (*)</span>
                            <input type="number" class="form-control" id="idfolios" required name="idfolios">
                          </div>
                        </div>

                      </div>
                      <div class="form-group">
                        <label>Asunto </label><span class="span-red"> (*)</span>
                        <textarea class="form-control" rows="3" id="idasunto" placeholder="Ingrese el asunto del documento" required name="idasunto"></textarea>
                      </div>

                      <div class="form-group">
                        <label>Adjuntar archivo (pdf.)</label><span class="span-red"> (*)</span>
                        <div class="file">
                          <p id="alias"></p>
                          <label for="idfile" id="archivo">Elige el Archivo...</label>
                          <input type="file" id="idfile" name="idfile" required accept="application/pdf">
                        </div>
                      </div>
                      <div class="custom-control custom-checkbox div-check">
                        <input class="form-check-input input-check" type="checkbox" id="check" name="check" value="option1" required>

                        <label for="customCheckbox4" class="form-check-label">&nbsp;Declaro que la
                          información proporcionada es válida y verídica.
                          Y Acepto que las comunicaciones sean enviadas a la dirección de correo y
                          celular que proporcione.<span class="span-red"> (*)</span></label>

                      </div>
                      <br>
                      <div class="col-sm-12">
                        <button type="submit" id="Enviar" class="btn btn-block btn-success" onclick="return RegistroDocumento()">Enviar Trámite</button>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
            <!-- /.card-body -->
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