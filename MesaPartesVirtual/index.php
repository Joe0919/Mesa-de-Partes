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
  <link rel="stylesheet" href="../public/assets/css/mspartes.css">
  <link rel="stylesheet" href="../public/assets/dist/css/adminlte.min1.css">
  <link rel="shorcut icon" href="../public/assets/img/logo.png">
  <link rel="stylesheet" href="../public/assets/plugins/fontawesome-free/css/all.min.css">
</head>

<body>

  <header id="expediente">
    <nav role="navigation" class="navbar navbar-gorehco navbar-static-top">
      <div class="container1">
        <div class="Navbar-wrapper">
          <a href="#" class="img">
            <a></a>
            <img src="../public/assets/img/logo.png" alt="Logo" style="width: 50px;height: 50px;"></a>
          <a class="navbar-brand">HOSPITAL ANTONIO CALDAS DOMíNGUEZ -
            POMABAMBA</a>
          <a href="../index.html" class="btn btn-sm btn-success">Ir a Página Principal</a>
          <a></a>
          <a></a>
        </div>
      </div>
    </nav>
  </header>
  <div data-v-269f0572="" class="container">
    <div data-v-269f0572="" class="card card-principal">
      <div data-v-269f0572="" class="card-header font-weight-bold">MESA DE PARTES VIRTUAL</div>
      <div style="margin-top:10px;">
        <div class="col-md-2" id="divL">
          <button type="button" id="btnLimpiar" class="btn btn-danger"><i class="fa fa-eraser"></i>&nbsp;Limpiar
            Campos</button>
        </div>
        <div class="col-md-2" id="divT">
          <button type="button" id="btnNuevoT" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;Nuevo
            Trámite</button>
        </div>
        <div class="col-md-2" id="divS">
          <button type="button" id="btnSeguir" class="btn btn-primary"><i class="fa fa-search"></i>&nbsp;&nbsp;Seguimiento</button>
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
                <span id="Avisoa" style="font-size:14px;color:green"><b>NOTA: Ud. se ha registrado antes, pero puede
                    editar su número de Celular, Correo y Dirección de ser necesario.</b></span>
                <form id="formulario-tramite" onsubmit="submitForm(event)" name="formulario-tramite" enctype="multipart/form-data" method="post">
                  <label>Tipo de Persona: </label><span style="color: red;font-weight: 600;">
                    (*)</span>


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
                      <label>RUC </label><span style="color: red;font-weight: 600;">
                        (*)</span>
                      <input type="text" class="form-control" id="idruc" name="idruc" onkeypress="return validaNumericos(event)" maxlength="11" minlength="11">
                    </div>

                    <div class="form-group">
                      <label>Entidad </label><span style="color: red;font-weight: 600;">
                        (*)</span>
                      <input type="text" class="form-control" id="identi" name="identi">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group">
                        <input type="hidden" class="form-control" id="idpersona" name="idpersona">
                        <label>DNI</label><span style="color: red;font-weight: 600;"> (*)</span>
                        <input type="text" class="form-control" onkeypress='return validaNumericos(event)' maxlength="8" minlength="8" name="iddni" id="iddni" required>
                      </div>
                    </div>
                    <div style="padding:0" class="col-sm-2">
                      <input style="margin:33px 0" id="validar" type="button" class="btn btn-success" value="Validar">
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Nombres </label><span style="color: red;font-weight: 600;">
                          (*)</span>
                        <input type="text" class="form-control" id="idnombre" name="idnombre" required>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Apellido Paterno </label><span style="color: red;font-weight: 600;">
                          (*)</span>
                        <input type="text" class="form-control" id="idap" name="idap" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Apellido Materno </label><span style="color: red;font-weight: 600;">
                          (*)</span>
                        <input type="text" class="form-control" id="idam" name="idam" required>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>N° Celular </label><span style="color: red;font-weight: 600;">
                      (*)</span>
                    <input type="text" class="form-control" id="idcel" onkeypress='return validaNumericos(event)' minlength="9" maxlength="9" required name="idcel">
                  </div>
                  <div class="form-group">
                    <label>Dirección </label><span style="color: red;font-weight: 600;">
                      (*)</span>
                    <input type="text" class="form-control" id="iddirec" required name="iddirec">
                  </div>
                  <div class="form-group">
                    <label>Correo </label><span style="color: red;font-weight: 600;"> (*)</span>
                    <input type="text" class="form-control1" id="idcorre" required name="idcorre">
                    <i><b id="Vcorreo"></b></i>
                  </div>
                  <span style="color: #ff0000;font-weight: 600;">Campos Obligatorios (*)</span>
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
                  <label>Tipo</label><span style="color: red;font-weight: 600;"> (*)</span>
                  <select style="width: 100%;height: 40px;font-weight:600;text-align:center;font-size:20px;" name="idtipo" id="idtipo">
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
                      <label>N° Documento </label><span style="color: red;font-weight: 600;">
                        (*)</span>
                      <input type="text" class="form-control" id="idnrodoc" onkeypress='return validaNumericos(event)' required name="idnrodoc">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>N° Folios </label><span style="color: red;font-weight: 600;">
                        (*)</span>
                      <input type="number" class="form-control" id="idfolios" required name="idfolios">
                    </div>
                  </div>

                </div>
                <div class="form-group">
                  <label>Asunto </label><span style="color: red;font-weight: 600;">(*)</span>
                  <textarea class="form-control" rows="3" id="idasunto" placeholder="Ingrese el asunto del documento" required name="idasunto"></textarea>
                </div>

                <div class="form-group">
                  <label>Adjuntar archivo (pdf.)</label><span style="color: red;font-weight: 600;">
                    (*)</span>
                  <div class="file">
                    <p id="alias"></p>
                    <label for="idfile" id="archivo">Elige el Archivo...</label>
                    <input type="file" id="idfile" name="idfile" required accept="application/pdf">
                  </div>

                </div>
                <div class="custom-control custom-checkbox">
                  <input class="form-check-input" style="width:20px;height:20px;" type="checkbox" id="check" name="check" value="option1" required>

                  <label for="customCheckbox4" class="form-check-label">Declaro que la
                    información proporcionada es válida y verídica.
                    Y Acepto que las comunicaciones sean enviadas a la dirección de corre y
                    celular que proporcione.<span style="color: red;font-weight: 600;">(*)</span></label>
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
        <div class="contenido" id="contenido" style="margin: 0 auto;width:100%;">
          <section class="content">
            <div class="container-fluid">
              <div class="row">
                <div class="col-12">

                  <div class="card card-primary" id="insert">
                    <div class="card-header">
                      <h3 class="card-title" style="font-weight:600; color:white"><i class="fas fa-search"></i>&nbsp;&nbsp;BÚSQUEDA DE EXPEDIENTES</h3>
                    </div>

                    <!-- /.card-header -->
                    <div class="card-body">
                      <h3 style="font-size: 18px;">*Para realizar la búsqueda de un documento presentado debe de ingresar el
                        Número de Expediente del Documento y seleccionar el año de presentación:</h3>
                      <br>
                      <div>

                        <form id="FormBuscar">
                          <div class="form-group row">
                            &nbsp;&nbsp;&nbsp;
                            <label class="etiqueta">Nro Expediente:</label>
                            <div class="col-sm-2">
                              <input type="email" class="form-control" id="idexpb" onkeypress="return validaNumericos(event)" maxlength="6">
                            </div>
                            &nbsp;&nbsp;&nbsp;
                            <label class="etiqueta">DNI:</label>
                            <div class="col-sm-2">
                              <input type="email" class="form-control" id="iddnii" onkeypress="return validaNumericos(event)" maxlength="8">
                            </div>
                            &nbsp;&nbsp;&nbsp;
                            <label class="etiqueta">Año:</label>
                            <div class="col-sm-2">
                              <select style="width:150px; font-weight:700; font-size:20px" class="form-control" id="idtipob">
                                <option value="2022">2022</option>
                              </select>

                            </div>

                            <div class="col-sm-3">
                              <button style="width:200px;height:40px;font-size:18px;float: right;" type="button" id="btnBusca" class="btn btn-danger btn-block"><i class="fa fa-search"></i>&nbsp;&nbsp;&nbsp;BUSCAR</button>
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
                          <img style="width: 140px; height: 140px;" src="../public/assets/img/error-404.png">
                        </div>
                        <div class="col-sm-9">
                          <br>
                          <h3><i class="fas fa-exclamation-triangle text-warning"></i> TRÁMITE NO ENCONTRADO.</h3>

                          <p style="font-size:18px;">
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
                      <h3 class="card-title"><i class="fas fa-file-pdf "></i>&nbsp;&nbsp;
                        DATOS DEL TRÁMITE REALIZADO
                      </h3>
                    </div>
                    <div class="row">
                      <div class="col-sm-7">

                      </div>
                      <div class="col-sm-5">
                        <br>
                        <div class="row">
                          <div class="col-md-6">

                            <button type="button" style="height:40px" class="btn btn-primary btn-block" id="btnNew"><i class="fa fa-search"></i>&nbsp;&nbsp;Nueva Búsqueda</button>
                          </div>
                          <div class="col-md-5">
                            <button type="button" style="height:40px" class="btn btn-danger btn-block" id="btnhistorial"><i class="fa fa-plus"></i>&nbsp;Mostrar Historial</button>
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

                            <table width="100%" border="2" cellspacing="0" cellpadding="5" id="tableDoc">
                              <tr>
                                <th colspan="2" style="background:#BDBDBD;text-align:center;">
                                  <h5 style="font-weight:600">DATOS DEL DOCUMENTO</h5>
                                  </font>
                                </th>
                              </tr>
                              <tr style="text-align:center;font-size:20px">
                                <th style="background:#D9D9D8;width: 45%;">Expediente</th>
                                <td>
                                  <p id="celdaexpe"></p>
                                </td>
                              </tr>
                              <tr style="text-align:center;font-size:20px">
                                <th style="background:#D9D9D8;">N° Documento</th>
                                <td>
                                  <p id="celdanro"></p>
                                </td>
                              </tr>
                              <tr style="text-align:center;font-size:20px">
                                <th style="background:#D9D9D8;">Tipo</th>
                                <td>
                                  <p id="celdatipo"></p>
                                </td>
                              </tr>
                              <tr style="text-align:center;font-size:18px">
                                <th style="background:#D9D9D8">Asunto</th>
                                <td>
                                  <p id="celdasunto"></p>
                                </td>
                              </tr>
                            </table>

                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="callout callout-info">

                            <table width="100%" border="2 black " cellspacing="0" cellpadding="5" id="tableRemitente">
                              <tr>
                                <th colspan="2" style="background:#BDBDBD ; text-align:center">
                                  <h5 style="font-weight:600">DATOS DEL REMITENTE</h5>

                                </th>
                              </tr>
                              <tr style="text-align:center;font-size:18px">
                                <th style="background:#D9D9D8;width: 45%;">DNI</th>
                                <td>
                                  <p id="celdadni"></p>
                                </td>
                              </tr>
                              <tr style="text-align:center;font-size:18px">
                                <th style="background:#D9D9D8;">Apellidos y Nombres</th>
                                <td>
                                  <p id="celdadatos"></p>
                                </td>
                              </tr>
                              <tr style="text-align:center;font-size:18px">
                                <th style="background:#D9D9D8;">RUc</th>
                                <td>
                                  <p id="celdaruc"></p>
                                </td>
                              </tr>
                              <tr style="text-align:center;font-size:18px">
                                <th style="background:#D9D9D8;">Entidad</th>
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