<?php
require_once("../config/conexion2.php");

$query = mysqli_query($conexion, "SELECT * FROM tipodoc");
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Mesa de Partes Virtual - HACDP</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- <link rel="stylesheet" href="../public/assets/css/mspartes.css"> -->
  <link rel="stylesheet" href="../public/assets/css/style.css">
  <link rel="stylesheet" href="../public/assets/dist/css/adminlte.min1.css">
  <link rel="shorcut icon" href="../public/assets/img/logo.png">
  <link rel="stylesheet" href="../public/assets/plugins/fontawesome-free/css/all.min.css">
</head>

<body>
  <header id="expediente" class="container header">
    <nav class="naveg">
      <div>
        <a href="#" class="img">
          <img src="../public/assets/img/logo.png" alt="Logo" class="img-logo"></a>
        <h1 class="titulo">HOSPITAL ANTONIO CALDAS DOMíNGUEZ -
          POMABAMBA</h1>
        <a href="../index.html" class="btn btn-sm btn-success">Ir a Página Principal</a>
      </div>
    </nav>
  </header>
  <div class="container">
    <div class="card card-principal">
      <div class="card-header font-weight-bold">MESA DE PARTES VIRTUAL</div>
      <div>
        <div class="col-md-2" id="divL">
          <button type="button" id="btnLimpiar" class="btn btn-danger"><i class="fa fa-eraser"></i>Limpiar Campos</button>
        </div>
        <div class="col-md-2" id="divT">
          <button type="button" id="btnNuevoT" class="btn btn-success"><i class="fa fa-plus"></i>Nuevo Trámite</button>
        </div>
        <div class="col-md-2" id="divS">
          <button type="button" id="btnSeguir" class="btn btn-primary"><i class="fa fa-search"></i>Seguimiento</button>
        </div>
      </div>
      <div class="card-body">
        <div id="mesa">
          <div class="col-md-6">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">DATOS DEL REMITENTE</h3>
              </div>

              <div class="card-body">
                <span id="Avisoa" class="aviso-span"><b>NOTA: Ud. se ha registrado antes, pero puede
                    editar su número de Celular, Correo y Dirección de ser necesario.</b></span>
                <form id="formulario-tramite" onsubmit="submitForm(event)" name="formulario-tramite" enctype="multipart/form-data" method="post">
                  <label>Tipo de Persona: </label><span class="span-red">(*)</span>
                  <div class="row">
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
                      <label>RUC </label><span class="span-red">(*)</span>
                      <input type="text" class="form-control" id="idruc" name="idruc" onkeypress="return validaNumericos(event)" maxlength="11" minlength="11">
                    </div>

                    <div class="form-group">
                      <label>Entidad </label><span class="span-red">(*)</span>
                      <input type="text" class="form-control" id="identi" name="identi">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group">
                        <input type="hidden" class="form-control" id="idpersona" name="idpersona">
                        <label>DNI</label><span class="span-red">(*)</span>
                        <input type="text" class="form-control" onkeypress='return validaNumericos(event)' maxlength="8" minlength="8" name="iddni" id="iddni" required>
                      </div>
                    </div>
                    <div class="col-sm-2">
                      <input id="validar" type="button" class="btn btn-success" value="Validar">
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Nombres </label><span class="span-red">(*)</span>
                        <input type="text" class="form-control" id="idnombre" name="idnombre" required>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Apellido Paterno </label><span class="span-red">(*)</span>
                        <input type="text" class="form-control" id="idap" name="idap" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Apellido Materno </label><span class="span-red">(*)</span>
                        <input type="text" class="form-control" id="idam" name="idam" required>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>N° Celular </label><span class="span-red">(*)</span>
                    <input type="text" class="form-control" id="idcel" onkeypress='return validaNumericos(event)' minlength="9" maxlength="9" required name="idcel">
                  </div>
                  <div class="form-group">
                    <label>Dirección </label><span class="span-red">(*)</span>
                    <input type="text" class="form-control" id="iddirec" required name="iddirec">
                  </div>
                  <div class="form-group">
                    <label>Correo </label><span class="span-red">(*)</span>
                    <input type="text" class="form-control1" id="idcorre" required name="idcorre">
                    <i><b id="Vcorreo"></b></i>
                  </div>
                  <span class="span-red">Campos Obligatorios (*)</span>
                  <br>

              </div>

            </div>
          </div>
          <div class="col-md-6">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">DATOS DEL DOCUMENTO</h3>
              </div>

              <div class="card-body">

                <div class="form-group">
                  <label>Tipo</label><span class="span-red">(*)</span>
                  <select class="select-new" name="idtipo" id="idtipo">
                    <?php
                    while ($datos = mysqli_fetch_array($query)) {
                    ?>
                      <option value="<?php echo $datos['idtipodoc']  ?>">
                        <?php echo $datos['tipodoc'] ?>
                        </optiomn>
                      <?php
                    }
                      ?>
                  </select>
                  <span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>N° Documento </label><span class="span-red">(*)</span>
                      <input type="text" class="form-control" id="idnrodoc" onkeypress='return validaNumericos(event)' required name="idnrodoc">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>N° Folios </label><span class="span-red">(*)</span>
                      <input type="number" class="form-control" id="idfolios" required name="idfolios">
                    </div>
                  </div>

                </div>
                <div class="form-group">
                  <label>Asunto </label><span class="span-red">(*)</span>
                  <textarea class="form-control" rows="3" id="idasunto" placeholder="Ingrese el asunto del documento" required name="idasunto"></textarea>
                </div>

                <div class="form-group">
                  <label>Adjuntar archivo (pdf.)</label><span class="span-red">(*)</span>
                  <div class="file">
                    <p id="alias"></p>
                    <label for="idfile" id="archivo">Elige el Archivo...</label>
                    <input type="file" id="idfile" name="idfile" required accept="application/pdf">
                  </div>

                </div>
                <div class="custom-control custom-checkbox">
                  <input class="form-check-input" type="checkbox" id="check" name="check" value="option1" required>

                  <label for="customCheckbox4" class="form-check-label">Declaro que la
                    información proporcionada es válida y verídica.
                    Y Acepto que las comunicaciones sean enviadas a la dirección de corre y
                    celular que proporcione.<span class="span-red">(*)</span></label>
                  <div id="errorcheck"></div>
                </div>
                <br>
                <div class="col-sm-12">
                  <button type="submit" id="Enviar" class="btn btn-block btn-success" onclick="return RegistroDocumento()">Enviar Trámite</button>
                </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="contenido" id="contenido">
          <section class="content">
            <div class="container-fluid">
              <div class="row">
                <div class="col-12">

                  <div class="card card-primary" id="insert">
                    <div class="card-header">
                      <h3 class="card-title"><i class="fas fa-search"></i>BÚSQUEDA DE EXPEDIENTES</h3>
                    </div>

                    <!-- /.card-header -->
                    <div class="card-body">
                      <h5>*Para realizar la búsqueda de un documento presentado debe de ingresar el
                        Número de Expediente del Documento y seleccionar el año de presentación:</h5>
                      <br>
                      <div>

                        <form id="FormBuscar">
                          <div class="form-group row">
                            <label class="etiqueta">Nro Expediente:</label>
                            <div class="col-sm-2">
                              <input type="email" class="form-control" id="idexpb" onkeypress="return validaNumericos(event)" maxlength="6">
                            </div>
                            <label class="etiqueta">DNI:</label>
                            <div class="col-sm-2">
                              <input type="email" class="form-control" id="iddnii" onkeypress="return validaNumericos(event)" maxlength="8">
                            </div>
                            <label class="etiqueta">Año:</label>
                            <div class="col-sm-2">
                              <select class="form-control select-search" id="idtipob">
                                <option value="2022">2022</option>
                              </select>

                            </div>

                            <div class="col-sm-3">
                              <button type="button" id="btnBusca" class="btn btn2 btn-danger btn-block"><i class="fa fa-search"></i></button>
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
                          <img class="img-no-search" src="../public/assets/img/error-404.png">
                        </div>
                        <div class="col-sm-9">
                          <br>
                          <h3><i class="fas fa-exclamation-triangle text-warning"></i> TRÁMITE NO ENCONTRADO.</h3>

                          <p>
                            No se encontro el trámite con los datos ingresado, puede ser por que no existe un trámite
                            registrado con esos datos.<br>
                            <b>Por favor, intente realizar la búsqueda ingresando los datos correctos.<b>
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="card card-olive" id="dat">
                    <div class="card-header">
                      <h3 class="card-title"><i class="fas fa-file-pdf "></i>DATOS DEL TRÁMITE REALIZADO
                      </h3>
                    </div>
                    <div class="row">
                      <div class="col-sm-7">

                      </div>
                      <div class="col-sm-5">
                        <br>
                        <div class="row">
                          <div class="col-md-6">

                            <button type="button" class="btn btn3 btn-primary btn-block" id="btnNew"><i class="fa fa-search"></i>Búsqueda</button>
                          </div>
                          <div class="col-md-5">
                            <button type="button" class="btn btn3 btn-danger btn-block" id="btnhistorial"><i class="fa fa-plus"></i>Mostrar Historial</button>
                          </div>
                          <div class="col-md-1">

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

              </div>
            </div>

        </div>
      </div>

    </div>


  </div>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
  <script src="../public/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/Sistema_MesaPartes/public/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script type="text/javascript" src="../public/assets/js/javascript.js"></script>
</body>

</html>