$(document).ready(function () {
  $("#guardar").prop("disabled", true);
  $("#NuevoPDF").hide();
  $("#remitente").hide();
  $("#vista").hide();
  $("#remitente1").hide();
  $("#vista1").hide();
  $("#editara").hide();
  $("#finalizar").hide();
  $("#mostrar").hide();
  $("#divNoFound").hide();
  $("#dat").hide();
  $("#linea").hide();
  $("#re").hide();
  $("#reportrango").hide();
  // $('#cboreport1').val('0');

  var user_id, id, opcion, dnipersona, ruc, archi, año, area, estado, bdr;
  opcion = 4;
  idarea = $("#idareaid").val();
  area = $("#idarealogin").val();
  estado = $("#cbovista").val();

  bdr = 1;
  $("input[name='customRadio']").change(function () {
    if ($(this).val() == "juridica") {
      $("#mostrar").show();
    } else {
      $("#mostrar").hide();
    }
  });

  /*=============================   MOSTRAR TABLA DE USUARIOS  ================================= */
  tablaUsuarios = $("#tablaUsuarios").DataTable({
    destroy: true,
    language: {
      url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
    },
    ajax: {
      url: "../../controller/crudusu.php",
      method: "POST", //usamos el metodo POST
      data: { opcion: opcion }, //enviamos opcion 4 para que haga un SELECT
      dataSrc: "",
    },
    ordering: false,
    columns: [
      { data: "idusuarios" },
      { data: "nombre" },
      { data: "dni" },
      { data: "email" },
      {
        data: "estado",
        render: function (data, type) {
          let country = "";
          switch (data) {
            case "ACTIVO":
              country = "bg-success";
              break;
            case "DESACTIVADO":
              country = "bg-gray";
              break;
          }
          return (
            '<span style="font-size:14px"  class="badge ' +
            country +
            '">' +
            data +
            "</span> "
          );
        },
      },
      {
        defaultContent:
          "<div class='text-center'><div class='btn-group'><button class='btn btn-warning btn-sm btnEditfoto'><i class='material-icons'>account_circle</i></button></div></div>",
      },
      {
        defaultContent:
          "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btnEditar'><i class='material-icons'>edit</i></button><button class='btn btn-secondary btn-sm btnpsw'><i class='material-icons'>lock</i></button><button class='btn btn-danger btn-sm btnBorrar'><i class='material-icons'>delete</i></button></div></div>",
      },
    ],
  });
  /*=============================   MOSTRAR TABLA EMPLEADOS  ================================= */
  tablaEmpleados = $("#tablaEmpleados").DataTable({
    destroy: true,
    language: {
      url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
    },
    ajax: {
      url: "../../controller/crudempleado.php",
      method: "POST", //usamos el metodo POST
      data: { opcion: opcion }, //enviamos opcion 4 para que haga un SELECT
      dataSrc: "",
    },
    ordering: false,
    columns: [
      { data: "ID" },
      { data: "Codigo" },
      { data: "dni" },
      { data: "Datos" },
      { data: "telefono" },
      { data: "area" },
      {
        defaultContent:
          "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btnEditarE'><i class='material-icons'>edit</i></button><button class='btn btn-danger btn-sm btnBorrarE'><i class='material-icons'>delete</i></button></div></div>",
      },
    ],
  });
  /*=============================   MOSTRAR TABLA DE AREAS  ================================= */
  tablaAreas = $("#tablaAreas").DataTable({
    destroy: true,
    language: {
      url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
    },
    ajax: {
      url: "../../controller/crudarea.php",
      method: "POST", //usamos el metodo POST
      data: { opcion: opcion }, //enviamos opcion 4 para que haga un SELECT
      dataSrc: "",
    },
    ordering: false,
    columns: [
      { data: "ID" },
      { data: "cod_area" },
      { data: "area" },
      {
        defaultContent:
          "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btnEditarAre'><i class='material-icons'>edit</i></button><button class='btn btn-danger btn-sm btnBorrarA'><i class='material-icons'>delete</i></button></div></div>",
      },
    ],
  });

  /*=============================   MOSTRAR TABLA DE TRÁMITES  ================================= */
  tablaTramites = $("#tablaTramites").DataTable({
    destroy: true,
    language: {
      url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
    },
    ajax: {
      url: "../../controller/cruddocumento.php",
      method: "POST", //usamos el metodo POST
      data: { opcion: opcion }, //enviamos opcion 4 para que haga un SELECT
      dataSrc: "",
    },
    ordering: false,
    columns: [
      { data: "expediente" },
      { data: "Fecha" },
      { data: "tipodoc" },
      { data: "dni" },
      { data: "Datos" },
      { data: "origen" },
      { data: "area" },
      {
        data: "estado",
        render: function (data, type) {
          let country = "";
          switch (data) {
            case "PENDIENTE":
              country = "bg-black";
              break;
            case "ACEPTADO":
              country = "bg-success";
              break;
            case "RECHAZADO":
              country = "bg-danger";
              break;
            case "ARCHIVADO":
              country = "bg-primary";
              break;
          }
          return (
            '<span style="font-size:14px"  class="badge ' +
            country +
            '">' +
            data +
            "</span> "
          );
        },
      },
      {
        defaultContent:
          "<div class='text-center'><div class='btn-group'><button class='btn btn-outline-dark btn-sm btnMas'><i class='material-icons'>add_circle</i></button></div></div>",
      },
    ],
  });
  /*=============================   MOSTRAR TABLA DE TRÁMITES RECIBIDOS CON ESTADO PENDIENTE================================= */
  tablaTRecibidos = $("#tablaTRecibidos").DataTable({
    destroy: true,
    language: {
      url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
    },
    ajax: {
      url: "../../controller/cruddocumento.php",
      method: "POST", //usamos el metodo POST
      data: {
        opcion: opcion,
        area: area,
        estado: estado,
        idarea: idarea,
        bdr: bdr,
      }, //enviamos opcion 4 para que haga un SELECT
      dataSrc: "",
    },
    ordering: false,
    columns: [
      { data: "expediente" },
      { data: "Fecha" },
      { data: "tipodoc" },
      { data: "dni" },
      { data: "Datos" },
      { data: "origen" },
      { data: "area" },
      { data: "estado" },
      {
        defaultContent:
          "<div class='text-center'><div class='btn-group'><button class='btn btn-outline-dark btn-sm btnMas'><i class='material-icons'>add_circle</i></button></div></div>",
      },
      {
        defaultContent:
          "<div class='text-center'><div class='btn-group'><button class='btn btn-success btn-sm btnAcept'><i class='material-icons'>task_alt</i></button></div></div>",
      },
    ],
  });
  /*=============================   MOSTRAR TABLA DE TRÁMITES ENVIADOS================================= */
  tablaTEnviados = $("#tablaTEnviados").DataTable({
    destroy: true,
    language: {
      url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
    },
    ajax: {
      url: "../../controller/cruddocumento1.php",
      method: "POST", //usamos el metodo POST
      data: { opcion: opcion, area: area }, //enviamos opcion 4 para que haga un SELECT
      dataSrc: "",
    },
    ordering: false,
    columns: [
      { data: "expediente" },
      { data: "Fecha" },
      { data: "tipodoc" },
      { data: "dni" },
      { data: "Datos" },
      { data: "origen" },
      { data: "area" },
      {
        data: "estado",
        render: function (data, type) {
          let country = "";
          switch (data) {
            case "PENDIENTE":
              country = "bg-black";
              break;
            case "ACEPTADO":
              country = "bg-success";
              break;
            case "RECHAZADO":
              country = "bg-danger";
              break;
            case "ARCHIVADO":
              country = "bg-primary";
              break;
          }
          return (
            '<span style="font-size:14px"  class="badge ' +
            country +
            '">' +
            data +
            "</span> "
          );
        },
      },
      {
        defaultContent:
          "<div class='text-center'><div class='btn-group'><button class='btn btn-outline-dark btn-sm btnMas'><i class='material-icons'>add_circle</i></button></div></div>",
      },
      {
        defaultContent:
          "<div class='text-center'><div class='btn-group'><button class='btn btn-warning btn-sm btnSeguir'><i class='material-icons'>search</i></button></div></div>",
      },
    ],
  });

  $("#idaccion").change(function () {
    var sel = $(this).val();
    if (sel == "2") {
      $("#column").hide();
      $("#finalizar").show();
      $("#derivar").hide();
    } else {
      $("#column").show();
      $("#finalizar").hide();
      $("#derivar").show();
    }
  });

  $("#cbovista").change(function () {
    var sel = $(this).val();
    switch (sel) {
      case "PENDIENTE":
        opcion = 8;
        estado = sel;
        //  alert(estado);

        tablaTRecibidos = $("#tablaTRecibidos").DataTable({
          destroy: true,
          language: {
            url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
          },
          ajax: {
            url: "../../controller/cruddocumento.php",
            method: "POST", //usamos el metodo POST
            data: {
              opcion: opcion,
              area: area,
              estado: estado,
              idarea: idarea,
            }, //enviamos opcion 4 para que haga un SELECT
            dataSrc: "",
          },
          ordering: false,
          columns: [
            { data: "expediente" },
            { data: "Fecha" },
            { data: "tipodoc" },
            { data: "dni" },
            { data: "Datos" },
            { data: "origen" },
            { data: "area" },
            {
              data: "estado",
              render: function (data, type) {
                let country = "";
                switch (data) {
                  case "PENDIENTE":
                    country = "bg-black";
                    break;
                  case "ACEPTADO":
                    country = "bg-success";
                    break;
                  case "RECHAZADO":
                    country = "bg-danger";
                    break;
                  case "ARCHIVADO":
                    country = "bg-primary";
                    break;
                }
                return (
                  '<span style="font-size:14px"  class="badge ' +
                  country +
                  '">' +
                  data +
                  "</span> "
                );
              },
            },
            {
              defaultContent:
                "<div class='text-center'><div class='btn-group'><button class='btn btn-outline-dark btn-sm btnMas'><i class='material-icons'>add_circle</i></button></div></div>",
            },
            {
              defaultContent:
                "<div class='text-center'><div class='btn-group'><button class='btn btn-success btn-sm btnAcept'><i class='material-icons'>task_alt</i></button></div></div>",
            },
          ],
        });

        break;
      case "ACEPTADO":
        estado = sel;
        opcion = 8;
        // alert(estado);

        tablaTRecibidos = $("#tablaTRecibidos").DataTable({
          destroy: true,
          language: {
            url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
          },
          ajax: {
            url: "../../controller/cruddocumento.php",
            method: "POST", //usamos el metodo POST
            data: {
              opcion: opcion,
              area: area,
              estado: estado,
              idarea: idarea,
            }, //enviamos opcion 4 para que haga un SELECT
            dataSrc: "",
          },
          ordering: false,
          columns: [
            { data: "expediente" },
            { data: "Fecha" },
            { data: "tipodoc" },
            { data: "dni" },
            { data: "Datos" },
            { data: "origen" },
            { data: "area" },
            {
              data: "estado",
              render: function (data, type) {
                let country = "";
                switch (data) {
                  case "PENDIENTE":
                    country = "bg-black";
                    break;
                  case "ACEPTADO":
                    country = "bg-success";
                    break;
                  case "RECHAZADO":
                    country = "bg-danger";
                    break;
                  case "ARCHIVADO":
                    country = "bg-primary";
                    break;
                }
                return (
                  '<span style="font-size:14px"  class="badge ' +
                  country +
                  '">' +
                  data +
                  "</span> "
                );
              },
            },
            {
              defaultContent:
                "<div class='text-center'><div class='btn-group'><button class='btn btn-outline-dark btn-sm btnMas'><i class='material-icons'>add_circle</i></button></div></div>",
            },
            {
              defaultContent:
                "<div class='text-center'><div class='btn-group'><button class='btn btn-warning btn-sm btnSeguir'><i class='material-icons'>search</i></button><button class='btn btn-danger btn-sm btnDerivar'><i class='material-icons'>output</i></button></div></div>",
            },
          ],
        });

        break;
      case "RECHAZADO":
        estado = sel;
        opcion = 8;
        // alert(estado);

        tablaTRecibidos = $("#tablaTRecibidos").DataTable({
          destroy: true,
          language: {
            url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
          },
          ajax: {
            url: "../../controller/cruddocumento.php",
            method: "POST", //usamos el metodo POST
            data: {
              opcion: opcion,
              area: area,
              estado: estado,
              idarea: idarea,
            }, //enviamos opcion 4 para que haga un SELECT
            dataSrc: "",
          },
          ordering: false,
          columns: [
            { data: "expediente" },
            { data: "Fecha" },
            { data: "tipodoc" },
            { data: "dni" },
            { data: "Datos" },
            { data: "origen" },
            { data: "area" },
            {
              data: "estado",
              render: function (data, type) {
                let country = "";
                switch (data) {
                  case "PENDIENTE":
                    country = "bg-black";
                    break;
                  case "ACEPTADO":
                    country = "bg-success";
                    break;
                  case "RECHAZADO":
                    country = "bg-danger";
                    break;
                  case "ARCHIVADO":
                    country = "bg-primary";
                    break;
                }
                return (
                  '<span style="font-size:14px"  class="badge ' +
                  country +
                  '">' +
                  data +
                  "</span> "
                );
              },
            },
            {
              defaultContent:
                "<div class='text-center'><div class='btn-group'><button class='btn btn-outline-dark btn-sm btnMas'><i class='material-icons'>add_circle</i></button></div></div>",
            },
            {
              defaultContent:
                "<div class='text-center'><div class='btn-group'><button class='btn btn-warning btn-sm btnSeguir'><i class='material-icons'>search</i></button></div></div>",
            },
          ],
        });
        break;
      case "ARCHIVADO":
        estado = sel;
        opcion = 8;
        // alert(estado);

        tablaTRecibidos = $("#tablaTRecibidos").DataTable({
          destroy: true,
          language: {
            url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
          },
          ajax: {
            url: "../../controller/cruddocumento.php",
            method: "POST", //usamos el metodo POST
            data: {
              opcion: opcion,
              area: area,
              estado: estado,
              idarea: idarea,
            }, //enviamos opcion 4 para que haga un SELECT
            dataSrc: "",
          },
          ordering: false,
          columns: [
            { data: "expediente" },
            { data: "Fecha" },
            { data: "tipodoc" },
            { data: "dni" },
            { data: "Datos" },
            { data: "origen" },
            { data: "area" },
            {
              data: "estado",
              render: function (data, type) {
                let country = "";
                switch (data) {
                  case "PENDIENTE":
                    country = "bg-black";
                    break;
                  case "ACEPTADO":
                    country = "bg-success";
                    break;
                  case "RECHAZADO":
                    country = "bg-danger";
                    break;
                  case "ARCHIVADO":
                    country = "bg-primary";
                    break;
                }
                return (
                  '<span style="font-size:14px"  class="badge ' +
                  country +
                  '">' +
                  data +
                  "</span> "
                );
              },
            },
            {
              defaultContent:
                "<div class='text-center'><div class='btn-group'><button class='btn btn-outline-dark btn-sm btnMas'><i class='material-icons'>add_circle</i></button></div></div>",
            },
            {
              defaultContent:
                "<div class='text-center'><div class='btn-group'><button class='btn btn-warning btn-sm btnSeguir'><i class='material-icons'>search</i></button></div></div>",
            },
          ],
        });
        break;
      default:
        alert("eRROR");
    }
  });
  var fila; //captura la fila, para editar o eliminar

  /*=============================   INICIO DE CRUD DE LAS TABLAS  ================================= */

  /*=============================   CRUD DE TABLA USUARIOS  ================================= */
  $("#idni").blur(function () {
    //Consulta de disponibilidad de DNI al cambiar el click
    idni = $("#idni").val();
    if (idni.length == 0) {
      $("#Aviso").text("Ingrese el Número de DNI").css("color", "red");
    } else {
      if (idni.length == 8) {
        opcion = 5;
        $.ajax({
          url: "../../controller/crudusu.php",
          type: "POST",
          datatype: "json",
          data: { opcion: opcion, idni: idni },
          success: function (response) {
            alert(response);
            switch (response) {
              case "1":
                $("#Aviso").text("DNI ya está registrado").css("color", "red");
                break;
              case "2":
                $("#Aviso").text("DNI no registrado").css("color", "green");
                break;
              default:
                $("#Aviso").text("Error").css("color", "red");
                break;
            }
          },
        });
      } else {
        $("#Aviso").text("El DNI debe tener 8 dígitos.").css("color", "red");
      }
    }
  });

  // $("#idni").keypress(function(e) { //Consulta de disponibilidad de DNI al dar enter
  //   if(e.which == 13) {
  //     e.preventDefault();
  //     idni = $('#idni').val();
  //     if(idni.length == 0){
  //       $('#Aviso').text("Ingrese el Número de DNI").css("color","red");
  //     }else{
  //       if(idni.length == 8){
  //         opcion = 5;
  //         $.ajax({
  //           url: "../../controller/crudusu.php",
  //           type: "POST",
  //           datatype:"json",
  //           data:  {opcion:opcion, idni:idni},
  //           success: function(response) {
  //             switch(response){
  //               case '1':
  //                 $('#Aviso').text("DNI ya está registrado").css("color","red");
  //                 break;
  //               case '2':
  //                 $('#Aviso').text("DNI no registrado").css("color","green");
  //                 break;
  //               default:
  //                 $('#Aviso').text("Error").css("color","red");
  //                 break;
  //             }
  //           }
  //         });
  //       }else{
  //         $('#Aviso').text("El DNI debe tener 8 dígitos.").css("color","red");
  //       }
  //     }
  //   }
  // });
  //submit para el Alta y Actualización

  $("#iemail").blur(function () {
    //Consulta de disponibilidad de EMAIL al cambiar el click
    iemail = $.trim($("#iemail").val());
    if (iemail.length == 0) {
      $("#AvisoE").text("Ingrese el Email").css("color", "red");
    } else {
      opcion = 7;
      $.ajax({
        url: "../../controller/crudusu.php",
        type: "POST",
        datatype: "json",
        data: { opcion: opcion, iemail: iemail },
        success: function (response) {
          switch (response) {
            case "1":
              $("#AvisoE").text("Email ya registrado").css("color", "red");
              break;
            case "2":
              $("#AvisoE").text("Email no registrado").css("color", "green");
              break;
            default:
              $("#AvisoE").text("Error").css("color", "red");
              break;
          }
        },
      });
    }
  });

  $("#inomusu").blur(function () {
    //Consulta de disponibilidad de EMAIL al cambiar el click
    inomusu = $.trim($("#inomusu").val());
    if (inomusu.length == 0) {
      $("#error1").text("Ingrese el Nombre de Usuario").css("color", "red");
    } else {
      opcion = 8;
      $.ajax({
        url: "../../controller/crudusu.php",
        type: "POST",
        datatype: "json",
        data: { opcion: opcion, inomusu: inomusu },
        success: function (response) {
          switch (response) {
            case "1":
              $("#error1")
                .text("Nombre de Usuario no Disponible")
                .css("color", "red");
              break;
            case "2":
              $("#error1")
                .text("Nombre de Usuario Disponible")
                .css("color", "green");
              break;
            default:
              $("#error1").text("Error").css("color", "red");
              break;
          }
        },
      });
    }
  });

  $("#guardar").click(function () {
    opcion = 1;
    idni = $.trim($("#idni").val());
    inombre = $.trim($("#inombre").val());
    iappat = $.trim($("#iappat").val());
    iapmat = $.trim($("#iapmat").val());
    icel = $.trim($("#icel").val());
    idir = $.trim($("#idir").val());
    iemail = $.trim($("#iemail").val());
    inomusu = $.trim($("#inomusu").val());
    tipo = $.trim($("#tipo").val());
    ipassco = $.trim($("#ipassco").val());
    Swal.fire({
      title: "¿Estás seguro?",
      text: "Guardar los datos registrados",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      cancelButtonText: "Cancelar",
      confirmButtonText: "Si, guardar",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "../../controller/crudusu.php",
          type: "POST",
          datatype: "json",
          data: {
            idni: idni,
            inombre: inombre,
            iappat: iappat,
            iapmat: iapmat,
            icel: icel,
            idir: idir,
            iemail: iemail,
            inomusu: inomusu,
            tipo: tipo,
            ipassco: ipassco,
            opcion: opcion,
          },
          success: function (data) {
            limpiarcampos();
            MostrarAlerta("Hecho", "Se agregó el registro", "success");
            tablaUsuarios.ajax.reload(null, false);
            $("#modalusuario").modal("hide");
          },
        });
      }
    });
  });

  //para limpiar los campos antes de dar de Alta una Persona
  $("#Nuevo").click(function () {
    opcion = 1; //alta
    user_id = null;
    limpiarcampos();
    $("#modalusuario").modal("show");
  });

  $(document).on("click", ".btnpsw", function () {
    fila = $(this);
    user_id = parseInt($(this).closest("tr").find("td:eq(0)").text());
    usu = $(this).closest("tr").find("td:eq(1)").text();
    $("#modaleditpsw1").modal({ backdrop: "static", keyboard: false });
    $("#idc").text(usu);
  });

  $(document).on("click", ".btnEditfoto", function () {
    $("#FotoP").attr("src", "");
    opcion = 6;
    fila = $(this).closest("tr");
    user_id = parseInt(fila.find("td:eq(0)").text()); //capturo el ID
    idni = fila.find("td:eq(2)").text();
    $.ajax({
      url: "../../controller/crudusu.php",
      type: "POST",
      datatype: "json",
      data: { opcion: opcion, user_id: user_id, idni: idni },
      success: function (response) {
        data = $.parseJSON(response);
        $("#iddni1").val(idni);
        $("#idusua").val(user_id);
        $("#FotoP").attr("src", "/Sistema_MesaPartes/" + data[0]["foto"]);
        $("#modalfoto").modal("show");
      },
    });
  });

  $("#guardar").click(function () {
    //Editar usuario
    opcion = 1;
    idni = $.trim($("#idni").val());
    inombre = $.trim($("#inombre").val());
    iappat = $.trim($("#iappat").val());
    iapmat = $.trim($("#iapmat").val());
    icel = $.trim($("#icel").val());
    idir = $.trim($("#idir").val());
    iemail = $.trim($("#iemail").val());
    inomusu = $.trim($("#inomusu").val());
    tipo = $.trim($("#tipo").val());
    Swal.fire({
      title: "¿Estás seguro?",
      text: "Guardar los datos registrados",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      cancelButtonText: "Cancelar",
      confirmButtonText: "Si, guardar",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "../../controller/crudusu.php",
          type: "POST",
          datatype: "json",
          data: {
            idni: idni,
            inombre: inombre,
            iappat: iappat,
            iapmat: iapmat,
            icel: icel,
            idir: idir,
            iemail: iemail,
            inomusu: inomusu,
            tipo: tipo,
            ipassco: ipassco,
            opcion: opcion,
          },
          success: function (data) {
            limpiarcampos();
            MostrarAlerta("Hecho", "Se agregó el registro", "success");
            tablaUsuarios.ajax.reload(null, false);
            $("#modalusuario").modal("hide");
          },
        });
      }
    });
  });

  $(document).on("click", ".btnEditar", function () {
    //Mostrar datos de usuario para edicion
    opcion = 6;
    fila = $(this).closest("tr");
    user_id = parseInt(fila.find("td:eq(0)").text()); //capturo el ID
    idni = fila.find("td:eq(2)").text();
    $.ajax({
      url: "../../controller/crudusu.php",
      type: "POST",
      datatype: "json",
      data: { opcion: opcion, user_id: user_id, idni: idni },
      success: function (response) {
        data = $.parseJSON(response);
        $("#idusu").val(data[0]["ID1"]);
        $("#idper").val(data[0]["ID2"]);
        $("#idni1").val(data[0]["dni"]);
        $("#inombre1").val(data[0]["nombres"]);
        $("#iappat1").val(data[0]["ap"]);
        $("#iapmat1").val(data[0]["am"]);
        $("#icel1").val(data[0]["telefono"]);
        $("#idir1").val(data[0]["direccion"]);
        $("#iemail1").val(data[0]["email"]);
        $("#inomusu1").val(data[0]["nombre"]);
        $("#tipo1").val(data[0]["IDR"]);
        $("#estado1").val(data[0]["estado"]);

        $("#modalEdusuario").modal("show");
      },
    });
  });

  //EDITAR DATOS DE USUARIO
  $("#Editar").click(function () {
    opcion = 2;
    idper = $("#idper").val();
    user_id = $("#idusu").val();
    idni = $.trim($("#idni1").val());
    inombre = $.trim($("#inombre1").val());
    iappat = $.trim($("#iappat1").val());
    iapmat = $.trim($("#iapmat1").val());
    icel = $.trim($("#icel1").val());
    idir = $.trim($("#idir1").val());
    iemail = $.trim($("#iemail1").val());
    inomusu = $.trim($("#inomusu1").val());
    tipo = $("#tipo1").val();
    estado = $("#estado1").val();
    if (
      idni.length <= 7 ||
      inombre.length <= 0 ||
      iappat.length <= 0 ||
      iapmat.length <= 0 ||
      icel.length <= 0 ||
      idir.length <= 0 ||
      iemail.length <= 0 ||
      inomusu.length <= 0
    ) {
      alert("Debe Completar correctamente todos los campos");
    } else {
      Swal.fire({
        title: "¿Estás seguro?",
        text: "Editar los datos del usuario",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Si, editar",
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: "../../controller/crudusu.php",
            type: "POST",
            datatype: "json",
            data: {
              opcion: opcion,
              idper: idper,
              user_id: user_id,
              idni: idni,
              inombre: inombre,
              iappat: iappat,
              iapmat: iapmat,
              icel: icel,
              idir: idir,
              iemail: iemail,
              inomusu: inomusu,
              tipo: tipo,
              estado: estado,
            },
            success: function (response) {
              data = $.parseJSON(response);
              if (data == 1) {
                alert(
                  "Hay registros que se repiten, asegurese de ingresar valores únicos"
                );
              } else {
                if (data == 2) {
                  limpiarcampos();
                  MostrarAlerta("Hecho", "Usted realizo el cambio", "success");
                  tablaUsuarios.ajax.reload(null, false);
                  $("#modalEdusuario").modal("hide");
                } else {
                  limpiarcampos();
                  MostrarAlerta(
                    "Hecho",
                    "Los datos fueron actualizados",
                    "success"
                  );
                  tablaUsuarios.ajax.reload(null, false);
                  $("#modalEdusuario").modal("hide");
                }
              }
            },
          });
        }
      });
    }
  });

  //Borrar usuario
  $(document).on("click", ".btnBorrar", function () {
    fila = $(this);
    idni = parseInt($(this).closest("tr").find("td:eq(2)").text());
    opcion = 3; //eliminar
    Swal.fire({
      title: "¿Estás seguro?",
      text: "Se eliminará al usuario seleccionado",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonText: "Cancelar",
      cancelButtonColor: "#d33",
      confirmButtonText: "Si, eliminar!",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "../../controller/crudusu.php",
          type: "POST",
          datatype: "json",
          data: { opcion: opcion, idni: idni },
          success: function (response) {
            data = $.parseJSON(response);
            if (data == 1) {
              MostrarAlerta(
                "Se tiene asociado datos",
                "El registro tiene datos asociado por lo que no se puede eliminar",
                "error"
              );
            } else {
              MostrarAlerta("Hecho", "Se eiiminó al usuario", "success");
              tablaUsuarios.row(fila.parents("tr")).remove().draw();
            }
          },
        });
      }
    });
  });

  //EDITAR CONTRASEÑA
  $("#BtnContra").click(function () {
    opcion = 9;
    ipswa = $("#ipsw").val();
    ipsw = $("#ipasss1").val();
    ipswn = $("#ipassco1").val();
    if (ipswa.length <= 0 || ipsw.length <= 0 || ipswn.length <= 0) {
      alert("Los campos no deben estar vacios");
    } else {
      Swal.fire({
        title: "¿Estás seguro?",
        text: "Se hará el cambio de contraseña",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Si, Actualizar",
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: "../../controller/crudusu.php",
            type: "POST",
            datatype: "json",
            data: {
              opcion: opcion,
              user_id: user_id,
              ipswa: ipswa,
              ipswn: ipswn,
            },
            success: function (response) {
              data = $.parseJSON(response);
              alert(data);
              if (data == 1) {
                MostrarAlerta(
                  "Incorrecto",
                  "La contraseña actual ingresada es incorrecta",
                  "error"
                );
              } else {
                $("#modaleditpsw").modal("hide");
                ResetForm("formC");
                $("#error3").text("");
                MostrarAlerta(
                  "Éxito",
                  "Se hizo el cambio de contraseña",
                  "success"
                );
              }
            },
          });
        }
      });
    }
  });

  $("#SalirC").click(function () {
    ResetForm("formC");
    $("#error3").text("");
  });

  //CAMBIO DE FOTO
  $("#FormFoto").on("submit", function (e) {
    e.preventDefault();
    opcion = 10;
    Swal.fire({
      title: "¿Estás seguro?",
      text: "Cambiar la foto de perfil",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      cancelButtonText: "Cancelar",
      confirmButtonText: "Si, Actualizar",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          type: "POST",
          url: "../../controller/crudusu.php",
          data: new FormData(this),
          contentType: false,
          processData: false,
          beforeSend: function () {},
          success: function (msg) {
            MostrarAlerta(
              "Hecho",
              "Se hizo el cambio de la foto de perfil",
              "success"
            );
            ResetForm("FormFoto");
            $("#modalfoto").modal("hide");
            $("#FotoP").attr("src", "");
          },
        });
      }
    });
  });

  $("#idfile1").change(function () {
    var file = this.files[0];
    var imagefile = file.type;
    var match = "image/jpeg";
    if (imagefile != match) {
      alert("Porfavor selecciona un imagen de tipo: JPG.");
      $("#idfile1").val("");
      return false;
    }
  });

  $("#idfilep").change(function () {
    var file = this.files[0];
    var imagefile = file.type;
    var match = "image/jpeg";
    if (imagefile != match) {
      alert("Porfavor selecciona un imagen de tipo: JPG.");
      $("#idfilep").val("");
      return false;
    } else {
    }
  });

  $("#Conf").click(function () {
    //Mostrar modal de datos del perfil
    opcion = 6;
    user_id = $("#iduser").val();
    idni = $("#dniuser").val();
    $.ajax({
      url: "../../controller/crudusu.php",
      type: "POST",
      datatype: "json",
      data: { opcion: opcion, user_id: user_id, idni: idni },
      success: function (response) {
        data = $.parseJSON(response);
        $("#idusup").val(data[0]["ID1"]);
        $("#idperp").val(data[0]["ID2"]);
        $("#idnip").val(data[0]["dni"]);
        $("#idnip").prop("readonly", true);
        $("#inombrep").val(data[0]["nombres"]);
        $("#iappatp").val(data[0]["ap"]);
        $("#iapmatp").val(data[0]["am"]);
        $("#icelp").val(data[0]["telefono"]);
        $("#idirp").val(data[0]["direccion"]);
        $("#iemailp").val(data[0]["email"]);
        $("#inomusup").val(data[0]["nombre"]);

        $("#modalUsu").modal({ backdrop: "static", keyboard: false });
      },
    });
  });

  $("#Actualizar").click(function () {
    opcion = 12;
    idper = $("#idperp").val();
    user_id = $("#idusup").val();
    inombre = $.trim($("#inombrep").val());
    iappat = $.trim($("#iappatp").val());
    iapmat = $.trim($("#iapmatp").val());
    icel = $.trim($("#icelp").val());
    idir = $.trim($("#idirp").val());
    iemail = $.trim($("#iemailp").val());
    inomusu = $.trim($("#inomusup").val());
    if (
      idni.length <= 7 ||
      inombre.length <= 0 ||
      iappat.length <= 0 ||
      iapmat.length <= 0 ||
      icel.length <= 0 ||
      idir.length <= 0 ||
      iemail.length <= 0 ||
      inomusu.length <= 0
    ) {
      alert("Debe Completar correctamente todos los campos");
    } else {
      Swal.fire({
        title: "¿Estás seguro?",
        text: "Editar los datos del usuario",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Si, editar",
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: "../../controller/crudusu.php",
            type: "POST",
            datatype: "json",
            data: {
              opcion: opcion,
              idper: idper,
              user_id: user_id,
              inombre: inombre,
              iappat: iappat,
              iapmat: iapmat,
              icel: icel,
              idir: idir,
              iemail: iemail,
              inomusu: inomusu,
            },
            success: function (response) {
              data = $.parseJSON(response);
              if (data == 1) {
                alert("El Email o nombre de usuario genera duplicidad");
              } else {
                if (data == 2) {
                  limpiarcampos();
                  MostrarAlerta("Hecho", "Usted realizo el cambio", "success");
                  tablaUsuarios.ajax.reload(null, false);
                  $("#modalEdusuario").modal("hide");
                } else {
                  ResetForm("formperfil");
                  MostrarAlerta(
                    "Hecho",
                    "Se actualizaron sus datos.",
                    "success"
                  );
                  $("#modalUsu").modal("hide");
                }
              }
            },
          });
        }
      });
    }
  });

  $("#Fot").click(function () {
    //Mostrar modal de foto de perfil
    $("#modalfotop").modal({ backdrop: "static", keyboard: false });
  });

  $("#FormFotop").on("submit", function (e) {
    e.preventDefault();
    opcion = 13;
    Swal.fire({
      title: "¿Estás seguro?",
      text: "Cambiar la foto de su perfil",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      cancelButtonText: "Cancelar",
      confirmButtonText: "Si, Actualizar",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          type: "POST",
          url: "../../controller/crudusu.php",
          data: new FormData(this),
          contentType: false,
          processData: false,
          beforeSend: function () {},
          success: function (msg) {
            alert(msg);
            MostrarAlerta(
              "Hecho",
              "Se hizo el cambio de la foto de perfil",
              "success"
            );
            $("#idfilep").val("");
            $("#modalfotop").modal("hide");
          },
        });
      }
    });
  });
  /*=============================   CRUD DE TABLA ÁREAS  ================================= */

  //submit para el Alta y Actualización
  $("#guardara").click(function () {
    opcion = 1;
    icod = $.trim($("#icod").val());
    iarea = $.trim($("#iarea").val().toUpperCase());
    insti = $.trim($("#tipoinsti").val());

    if (icod.length <= 0 || iarea.length <= 0 || insti.length <= 0) {
      alert("Debe Completar todos los campos");
    } else {
      Swal.fire({
        title: "¿Estás seguro?",
        text: "Guardar los datos registrados",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Si, guardar",
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: "../../controller/crudarea.php",
            type: "POST",
            datatype: "json",
            data: { icod: icod, iarea: iarea, insti: insti, opcion: opcion },
            success: function (response) {
              data = $.parseJSON(response);
              if (data == 1) {
                alert("Se encontraron registros con los mismos datos");
              } else {
                limpiarcamposarea();
                MostrarAlerta("Hecho", "Se agregó el registro", "success");
                tablaAreas.ajax.reload(null, false);
                $("#modalarea").modal("hide");
              }
            },
          });
        }
      });
    }
  });

  //para limpiar los campos para areas
  $("#Nuevoa").click(function () {
    $("#editara").hide();
    $("#guardara").show();
    user_id = null;
    limpiarcamposarea();
    $("#modalarea").modal("show");
  });

  //Mostrar datos a editar
  $(document).on("click", ".btnEditarAre", function () {
    opcion = 5; //editar
    fila = $(this).closest("tr");
    id = parseInt(fila.find("td:eq(0)").text()); //capturo el ID
    $.ajax({
      url: "../../controller/crudarea.php",
      type: "POST",
      datatype: "json",
      data: { opcion: opcion, id: id },
      success: function (response) {
        data = $.parseJSON(response);
        if (data.length > 0) {
          $("#editara").show();
          $("#guardara").hide();
          $("#idid").val(data[0]["ID"]);
          $("#icod").val(data[0]["cod_area"]);
          $("#iarea").val(data[0]["area"]);

          $("#modalarea").modal({ backdrop: "static", keyboard: false });
        }
      },
    });
  });

  //editar
  $("#editara").click(function () {
    opcion = 2;
    id = $.trim($("#idid").val());
    icod = $.trim($("#icod").val());
    iarea = $.trim($("#iarea").val().toUpperCase());
    insti = $.trim($("#tipoinsti").val());
    if (icod.length <= 0 || iarea.length <= 0 || insti.length <= 0) {
      alert("Debe Completar todos los campos");
    } else {
      Swal.fire({
        title: "¿Estás seguro?",
        text: "Editar los datos registrados",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Si, editar",
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: "../../controller/crudarea.php",
            type: "POST",
            datatype: "json",
            data: {
              id: id,
              icod: icod,
              iarea: iarea,
              insti: insti,
              opcion: opcion,
            },
            success: function (response) {
              data = $.parseJSON(response);
              if (data == 1) {
                alert(
                  "Hay registros que se repiten, asegurese de ingresar valores únicos"
                );
              } else {
                if (data == 2) {
                  limpiarcamposarea();
                  MostrarAlerta("Hecho", "Usted no hizo cambios", "success");
                  tablaAreas.ajax.reload(null, false);
                  $("#modalarea").modal("hide");
                } else {
                  limpiarcamposarea();
                  MostrarAlerta(
                    "Hecho",
                    "Los datos fueron actualizados",
                    "success"
                  );
                  tablaAreas.ajax.reload(null, false);
                  $("#modalarea").modal("hide");
                }
              }
            },
          });
        }
      });
    }
  });

  //Borrar Area
  $(document).on("click", ".btnBorrarA", function () {
    fila = $(this);
    id = parseInt($(this).closest("tr").find("td:eq(0)").text());
    opcion = 3; //eliminar
    Swal.fire({
      title: "¿Estás seguro?",
      text: "Se eliminará el registro seleccionado",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonText: "Cancelar",
      cancelButtonColor: "#d33",
      confirmButtonText: "Si, eliminar!",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "../../controller/crudarea.php",
          type: "POST",
          datatype: "json",
          data: { opcion: opcion, id: id },
          success: function (response) {
            data = $.parseJSON(response);
            if (data == 1) {
              MostrarAlerta(
                "Se tiene asociado datos",
                "El registro tiene datos asociado por lo que no se puede eliminar",
                "error"
              );
            } else {
              MostrarAlerta("Hecho", "Se eliminó el registro", "success");
              tablaAreas.row(fila.parents("tr")).remove().draw();
            }
          },
        });
      }
    });
  });
  /*=============================   CRUD DE TABLA EMPLEADOS  ================================= */
  $("#NuevoEmpleado").click(function () {
    ResetForm("FormEmpleado");
    $("#EditarE").hide();
    $("#GuardarE").show();
    $("#UsuE").val("-1");
    $("#usuar").show();
    $("#modalEmpleado").modal({ backdrop: "static", keyboard: false });
  });

  $("#GuardarE").click(function () {
    opcion = 1;
    cbo = $("#UsuE").val();
    idper = $("#idper").val();
    codigo = $("#codU").val();
    area = $("#areaE").val();
    dni = $("#dniU").val();
    if (
      idper.length == 0 ||
      codigo.length == 0 ||
      area.length == 0 ||
      $("#UsuE").val() == -1
    ) {
      alert("Porfavor Complete todos los campos Necesarios");
    } else {
      Swal.fire({
        title: "¿Estás seguro?",
        text: "Se registrará un nuevo empleado",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonText: "Cancelar",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, Guardar",
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: "../../controller/crudempleado.php",
            type: "POST",
            datatype: "json",
            data: {
              idper,
              idper,
              codigo: codigo,
              opcion: opcion,
              area: area,
              dni: dni,
            },
            success: function (response) {
              data = $.parseJSON(response);
              if (data == 1) {
                MostrarAlerta(
                  "Error",
                  "Ya existe el código ingresado",
                  "error"
                );
              } else {
                tablaEmpleados.ajax.reload(null, false);
                MostrarAlerta("Éxito", "El empleado fue registrado", "success");
                ResetForm("FormEmpleado");
                $("#modalEmpleado").modal("hide");
                $("#UsuE option[value='" + cbo + "']").remove();
              }
            },
          });
        }
      });
    }
  });

  $("#SalirE").click(function () {
    ResetForm("FormEmpleado");
  });

  $("#UsuE").change(function () {
    opcion = 5;
    var idper = $(this).val();
    $.ajax({
      url: "../../controller/crudempleado.php",
      type: "POST",
      datatype: "json",
      data: { idper, idper, opcion: opcion },
      success: function (response) {
        data = $.parseJSON(response);
        if (data.length > 0) {
          $("#idper").val(data[0]["ID2"]);
          $("#dniU").val(data[0]["dni"]);
          $("#nomU").val(data[0]["nombres"]);
          $("#apU").val(data[0]["ap"]);
          $("#amU").val(data[0]["am"]);
          $("#celU").val(data[0]["telefono"]);
          $("#dirU").val(data[0]["direccion"]);
        }
      },
    });
  });

  $(document).on("click", ".btnEditarE", function () {
    opcion = 6;
    fila = $(this).closest("tr");
    id = parseInt(fila.find("td:eq(0)").text()); //capturo el ID
    $.ajax({
      url: "../../controller/crudempleado.php",
      type: "POST",
      datatype: "json",
      data: { opcion: opcion, id: id },
      success: function (response) {
        data = $.parseJSON(response);
        if (data.length > 0) {
          $("#EditarE").show();
          $("#GuardarE").hide();
          $("#usuar").hide();

          $("#idper").val(data[0]["ID"]);
          $("#dniU").val(data[0]["dni"]);
          $("#nomU").val(data[0]["nombres"]);
          $("#apU").val(data[0]["ap"]);
          $("#amU").val(data[0]["am"]);
          $("#celU").val(data[0]["telefono"]);
          $("#dirU").val(data[0]["direccion"]);
          $("#codU").val(data[0]["cod"]);
          $("#areaE").val(data[0]["ID2"]);

          $("#modalEmpleado").modal({ backdrop: "static", keyboard: false });
        }
      },
    });
  });

  $("#EditarE").click(function () {
    opcion = 2;
    codigo = $("#codU").val();
    area = $("#areaE").val();
    if (codigo.length == 0 || area.length == 0) {
      alert("Porfavor Complete todos los campos Necesarios");
    } else {
      Swal.fire({
        title: "¿Estás seguro?",
        text: "Se editarán los datos del empleado",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonText: "Cancelar",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, Editar",
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: "../../controller/crudempleado.php",
            type: "POST",
            datatype: "json",
            data: { id: id, codigo: codigo, opcion: opcion, area: area },
            success: function (data) {
              if (data == 1) {
                MostrarAlerta(
                  "Error",
                  "Repeticion de datos, ingrese otros valores",
                  "error"
                );
              } else {
                if (data == 2) {
                  tablaEmpleados.ajax.reload(null, false);
                  MostrarAlerta("Éxito", "No se realizaron cambios", "success");
                  ResetForm("FormEmpleado");
                  $("#modalEmpleado").modal("hide");
                } else {
                  tablaEmpleados.ajax.reload(null, false);
                  MostrarAlerta(
                    "Éxito",
                    "Los datos fueron editados",
                    "success"
                  );
                  ResetForm("FormEmpleado");
                  $("#modalEmpleado").modal("hide");
                }
              }
            },
          });
        }
      });
    }
  });

  $(document).on("click", ".btnBorrarE", function () {
    opcion = 3;
    fila = $(this).closest("tr");
    id = parseInt(fila.find("td:eq(0)").text()); //capturo el ID
    dni = parseInt(fila.find("td:eq(2)").text()); //capturo el dni
    Swal.fire({
      title: "¿Estás seguro?",
      text: "Se eliminarán los datos del empleado",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonText: "Cancelar",
      cancelButtonColor: "#d33",
      confirmButtonText: "Si, Eliminar",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "../../controller/crudempleado.php",
          type: "POST",
          datatype: "json",
          data: { id: id, opcion: opcion, dni: dni },
          success: function (data) {
            MostrarAlerta("Hecho", "Se eliminó el registro", "success");
            tablaEmpleados.ajax.reload(null, false);
          },
        });
      }
    });
  });
  /*=============================   ACCIONES PARA TRAMITES RECIBIDOS ================================= */

  //Mostrar tabla de seguimienton de los datos
  $(document).on("click", ".btnSeguir", function () {
    opcion = 6;
    fila = $(this).closest("tr");
    id = fila.find("td:eq(0)").text(); //capturo el Nro expediente
    $("#nrodesc1").text(id);
    $("#modalseguir").modal("show");

    tablaSeguimiento = $("#tablaSeguimiento").DataTable({
      destroy: true,
      language: {
        url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
      },
      ajax: {
        url: "../../controller/cruddocumento.php",
        method: "POST", //usamos el metodo POST
        data: { opcion: opcion, id: id },
        dataSrc: "",
      },
      columns: [
        { data: "ID" },
        { data: "Fecha" },
        { data: "area" },
        { data: "descripcion" },
      ],
    });
  });

  $(document).on("click", ".btnAcept", function () {
    opcion = 5;
    fila = $(this).closest("tr");
    id = fila.find("td:eq(0)").text(); //capturo el Nro expediente
    dni = fila.find("td:eq(3)").text(); //capturo el Nro expediente
    $("#dnir1").val(dni);
    $.ajax({
      url: "../../controller/cruddocumento.php",
      type: "POST",
      datatype: "json",
      data: { opcion: opcion, id: id },
      success: function (response) {
        data = $.parseJSON(response);
        if (data.length > 0) {
          $("#idder").val(data[0]["ID"]);
          $("#iddoc1").val(data[0]["doc"]);
          $("#inrodoc1").val(data[0]["nro_doc"]);
          $("#ifolio1").val(data[0]["folios"]);
          $("#iexpediente1").val(data[0]["nro_expediente"]);
          $("#iestad1").val(data[0]["estado"]);
          $("#itipodoc1").val(data[0]["tipodoc"]);
          $("#iasunt1").val(data[0]["asunto"]);
          $("#modalacept").modal({ backdrop: "static", keyboard: false });
        }
      },
    });
  });

  $(document).on("click", ".btnDerivar", function () {
    fila = $(this).closest("tr");
    id = fila.find("td:eq(0)").text(); //capturo el Nro expediente
    dni = fila.find("td:eq(3)").text(); //capturo el DNI DEL remitente
    $("#exp1").val(id);
    $("#dnir").val(dni);
    $("#nrodesc").text(id);
    $("#modalderivar").modal("show");
    opcion = 5;
    $.ajax({
      url: "../../controller/cruddocumento.php",
      type: "POST",
      datatype: "json",
      data: { opcion: opcion, id: id },
      success: function (response) {
        data = $.parseJSON(response);
        if (data.length > 0) {
          $("#exp").val(data[0]["doc"]);
        }
      },
    });
  });

  $("#iddocumento").click(function () {
    $("#idremitent").addClass("btn btn-light");
    $("#iddocumento").removeClass("btn btn-light");
    $("#iddocumento").addClass("btn btn-primary");
    $("#idvistapre").addClass("btn btn-light");
    $("#tramite").show();
    $("#remitente").hide();
    $("#vista").hide();
    $("#NuevoPDF").hide();
  });
  $("#iddocumento").click(function () {
    $("#idremitent").addClass("btn btn-light");
    $("#iddocumento").removeClass("btn btn-light");
    $("#iddocumento").addClass("btn btn-primary");
    $("#idvistapre").addClass("btn btn-light");
    $("#tramite1").show();
    $("#remitente1").hide();
    $("#vista1").hide();
    $("#NuevoPDF").hide();
  });
  $("#idremitent").click(function () {
    $("#idremitent").removeClass("btn btn-light");
    $("#idremitent").addClass("btn btn-primary");
    $("#iddocumento").addClass("btn btn-light");
    $("#idvistapre").addClass("btn btn-light");
    $("#tramite").hide();
    $("#remitente").show();
    $("#vista").hide();
    $("#NuevoPDF").hide();
  });
  $("#idremitent").click(function () {
    $("#idremitent").removeClass("btn btn-light");
    $("#idremitent").addClass("btn btn-primary");
    $("#iddocumento").addClass("btn btn-light");
    $("#idvistapre").addClass("btn btn-light");
    $("#tramite1").hide();
    $("#remitente1").show();
    $("#vista1").hide();
    $("#NuevoPDF").hide();
  });
  $("#idvistapre").click(function () {
    $("#idremitent").addClass("btn btn-light");
    $("#iddocumento").addClass("btn btn-light");
    $("#idvistapre").removeClass("btn btn-light");
    $("#idvistapre").addClass("btn btn-primary");
    $("#tramite").hide();
    $("#remitente").hide();
    $("#vista").show();
    $("#NuevoPDF").show();
  });
  $("#idvistapre").click(function () {
    $("#idremitent").addClass("btn btn-light");
    $("#iddocumento").addClass("btn btn-light");
    $("#idvistapre").removeClass("btn btn-light");
    $("#idvistapre").addClass("btn btn-primary");
    $("#tramite1").hide();
    $("#remitente1").hide();
    $("#vista1").show();
    $("#NuevoPDF").show();
  });

  //Mostrar datos del documento

  $(document).on("click", ".btnMas", function () {
    opcion = 5;
    fila = $(this).closest("tr");
    id = fila.find("td:eq(0)").text(); //capturo el Nro expediente
    $.ajax({
      url: "../../controller/cruddocumento.php",
      type: "POST",
      datatype: "json",
      data: { opcion: opcion, id: id },
      success: function (response) {
        data = $.parseJSON(response);
        if (data.length > 0) {
          $("#modalmas").modal({ backdrop: "static", keyboard: false });
          $("#iddoc").val(data[0]["dc.iddocumento"]);
          $("#inrodoc").val(data[0]["nro_doc"]);
          $("#ifolio").val(data[0]["folios"]);
          $("#iexpediente").val(data[0]["nro_expediente"]);
          $("#iestad").val(data[0]["estado"]);
          $("#itipodoc").val(data[0]["tipodoc"]);
          $("#iasunt").val(data[0]["asunto"]);
          $("#iddni1").val(data[0]["dni"]);
          $("#idremi").val(data[0]["Datos"]);

          $("#iruc").val(data[0]["ruc_institu"]);
          $("#iinsti").val(data[0]["institucion"]);
          ruc = data[0]["ruc_institu"];
          archi = data[0]["archivo"];
          $("#iframePDF").attr(
            "src",
            "/Sistema_MesaPartes/" + data[0]["archivo"]
          );

          if (ruc == null || ruc == "" || ruc == " " || ruc == "  ") {
            $("#customRadio1").prop("checked", true);
          } else {
            $("#customRadio2").prop("checked", true);
          }
        }
      },
    });
  });

  $("#NuevoPDF").click(function () {
    $("#NuevoPDF").attr("href", "/Sistema_MesaPartes/" + archi);
  });

  $("#BotonCerrar").click(function () {
    $("#modalmas").modal("hide");
    $("#idremitent").addClass("btn btn-light");
    $("#iddocumento").removeClass("btn btn-light");
    $("#iddocumento").addClass("btn btn-primary");
    $("#idvistapre").addClass("btn btn-light");
    $("#tramite").show();
    $("#remitente").hide();
    $("#vista").hide();
    $("#NuevoPDF").hide();
    $("#iframePDF").attr("src", "");
    $("#customRadio1").prop("checked", false);
    $("#customRadio2").prop("checked", false);
    ruc = "";
    archi = "";
  });

  $("#btnCerra").click(function () {
    ResetForm("Formaceptacion");
  });

  $("#BotonCerrar1").click(function () {
    $("#modalmas").modal("hide");
    $("#idremitent").addClass("btn btn-light");
    $("#iddocumento").removeClass("btn btn-light");
    $("#iddocumento").addClass("btn btn-primary");
    $("#idvistapre").addClass("btn btn-light");
    $("#tramite1").show();
    $("#remitente1").hide();
    $("#vista1").hide();
    $("#NuevoPDF").hide();
    $("#iframePDF").attr("src", "");
    $("#customRadio1").prop("checked", false);
    $("#customRadio2").prop("checked", false);
    ruc = "";
    archi = "";
  });

  $("#derivar").click(function () {
    origen = $.trim($("#idorigen").val().toUpperCase());
    destino = $("#iddestino").val();
    acdes = $("#iddestino option:selected").text();
    nrexpe = $("#exp1").val();
    dni = $("#dnir").val();
    descrip = $.trim($("#iddescripcion").val().toUpperCase());
    id = $("#exp").val();
    opcion = 1;
    Swal.fire({
      title: "¿Estás seguro?",
      html: "El trámite será <b> DERIVADO </b> a <b>" + acdes + "</b>",
      icon: "warning",
      showCancelButton: true,
      confirmButtonC0olor: "#3085d6",
      cancelButtonColor: "#d33",
      cancelButtonText: "Cancelar",
      confirmButtonText: "Derivar",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "../../controller/cruddocumento.php",
          type: "POST",
          datatype: "json",
          data: {
            origen: origen,
            destino: destino,
            descrip: descrip,
            id: id,
            opcion: opcion,
            nrexpe: nrexpe,
            dni: dni,
          },
          success: function (response) {
            limpiarderivacion();
            MostrarAlerta("Hecho", "El trámite fue DERIVADO", "success");
            tablaTRecibidos.ajax.reload(null, false);
            $("#modalderivar").modal("hide");
          },
        });
      }
    });
  });

  $("#finalizar").click(function () {
    descrip = $.trim($("#iddescripcion").val().toUpperCase());
    id = $("#exp").val();
    nrexpe = $("#exp1").val();
    area = $("#idarealogin").val();
    dni = $("#dnir").val();
    opcion = 10;
    Swal.fire({
      title: "¿Estás seguro?",
      html: "El trámite será <b>ARCHIVADO</b>.",
      icon: "warning",
      showCancelButton: true,
      confirmButtonC0olor: "#3085d6",
      cancelButtonColor: "#d33",
      cancelButtonText: "Cancelar",
      confirmButtonText: "Archivar",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "../../controller/cruddocumento.php",
          type: "POST",
          datatype: "json",
          data: {
            id: id,
            opcion: opcion,
            area: area,
            descrip: descrip,
            nrexpe: nrexpe,
            dni: dni,
          },
          success: function (response) {
            limpiarderivacion();
            MostrarAlerta("Hecho", "El trámite fue ARCHIVADO", "success");
            tablaTRecibidos.ajax.reload(null, false);
            $("#modalderivar").modal("hide");
          },
        });
      }
    });
  });

  $("#btnAcepta").click(function () {
    opcion = 2;
    id = $("#iddoc1").val();
    dni = $("#dnir1").val();
    nrexpe = $("#iexpediente1").val();
    descrip = $.trim($("#des").val().toUpperCase());
    area = $("#idarealogin").val();
    Swal.fire({
      title: "¿Estás seguro?",
      text: "Aceptar el trámite derivado a su Área",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      cancelButtonText: "Cancelar",
      confirmButtonText: "Si, Aceptar",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "../../controller/cruddocumento.php",
          type: "POST",
          datatype: "json",
          data: {
            id: id,
            opcion: opcion,
            descrip: descrip,
            area: area,
            nrexpe: nrexpe,
            dni: dni,
          },
          success: function (response) {
            data = $.parseJSON(response);
            limpiaraceptacion();
            MostrarAlerta("Hecho", "El trámite ha sido aceptado", "success");
            tablaTRecibidos.ajax.reload(null, false);
            $("#modalacept").modal("hide");
          },
        });
      }
    });
  });

  $("#btnRechazar").click(function () {
    opcion = 3;
    origen = $.trim($("#idarealogin").val());
    descrip = $.trim($("#des").val().toUpperCase());
    id = $("#iddoc1").val();
    nrexpe = $("#iexpediente1").val();
    dni = $("#dnir1").val();
    idder = $("#idder").val();

    alert(
      id + " " + origen + " " + descrip + " " + nrexpe + " " + dni + " " + idder
    );
    Swal.fire({
      title: "¿Estás seguro?",
      text: "Al RECHAZAR el documento no podrá deshacer la acción",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      cancelButtonText: "Cancelar",
      confirmButtonText: "Si, Rechazar",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "../../controller/cruddocumento.php",
          type: "POST",
          datatype: "json",
          data: {
            id: id,
            opcion: opcion,
            nrexpe: nrexpe,
            origen: origen,
            dni: dni,
            descrip: descrip,
            idder: idder,
          },
          success: function (response) {
            data = $.parseJSON(response);
            limpiaraceptacion();
            MostrarAlerta("Hecho", "El trámite ha sido RECHAZADO", "success");
            tablaTRecibidos.ajax.reload(null, false);
            $("#modalacept").modal("hide");
          },
        });
      }
    });
  });
  /*=============================   ACCIONES PARA LA BUSQUEDA  ================================= */

  //Mostrar datos del documento

  $("#btnBusca").click(function () {
    opcion = 7;
    id = $.trim($("#idexpb").val());
    dni = $("#iddnii").val();
    año = $("#idtipob").val();
    if (id.length < 6 || dni.length < 8) {
      alert(
        "Por favor, complete correctamente todos los campos necesarios para la búsqueda"
      );
    } else {
      $.ajax({
        url: "../../controller/cruddocumento.php",
        type: "POST",
        datatype: "json",
        data: { opcion: opcion, id: id, año: año, dni: dni },
        success: function (response) {
          data = $.parseJSON(response);
          alert(data);
          if (data != 0) {
            $("#celdaexpe").text(data[0]["nro_expediente"]);
            $("#celdanro").text(data[0]["nro_doc"]);
            $("#celdatipo").text(data[0]["tipodoc"]);
            $("#celdasunto").text(data[0]["asunto"]);

            $("#celdadni").text(data[0]["dni"]);
            $("#celdadatos").text(data[0]["Datos"]);
            $("#celdaruc").text(data[0]["ruc_institu"]);
            $("#celdaenti").text(data[0]["institucion"]);
            $("#divNoFound").hide();
            $("#insert").hide();
            $("#dat").show();
            $("#btnhistorial").prop("disabled", false);
          } else {
            $("#divNoFound").show();
            ResetForm("FormBuscar");
            $("#idexpb").focus();
          }
        },
      });
    }
  });

  $("#btnhistorial").click(function () {
    expediente = $.trim($("#idexpb").val());
    dni = $("#iddnii").val();
    año = $("#idtipob").val();
    $.ajax({
      url: "../../controller/historial.php",
      type: "POST",
      datatype: "json",
      data: { expediente: expediente, año: año, dni: dni },
      success: function (response) {
        $("#linea").append(response);
        $("#linea").show();
        $("#btnhistorial").prop("disabled", true);
        window.location = "#linea";
      },
    });
  });

  $("#btnNew").click(function () {
    $("#celdaexpe").text("");
    $("#celdanro").text("");
    $("#celdatipo").text("");
    $("#celdasunto").text("");

    $("#celdadni").text("");
    $("#celdadatos").text("");
    $("#celdaruc").text("");
    $("#celdaenti").text("");
    $("#divNoFound").hide();
    ResetForm("FormBuscar");
    $("#linea").hide();
    $("#dat").hide();
    $("#insert").show();
    $("#histo").remove();
    $("#idexpb").focus();
  });

  // VALIDACION DE FORMATO DE CORREO
  $("#idcorre").keyup(function () {
    correo = $("#idcorre").val();
    if (ValidarCorreo(correo) == false) {
      $("#Vcorreo").text("Formato no válido").css("color", "red");
    } else {
      $("#Vcorreo").text("Formato válido").css("color", "green");
    }
  });

  //Mostrar modal general de cambio de contraseña
  $("#contra").click(function () {
    $("#modaleditpswG").modal({ backdrop: "static", keyboard: false });
  });

  $("#BtnContraG").click(function () {
    opcion = 9;
    user_id = $("#iduser").val();
    ipswa = $("#ipsw").val();
    ipsw = $("#ipasss1").val();
    ipswn = $("#ipassco1").val();
    if (ipswa.length <= 0 || ipsw.length <= 0 || ipswn.length <= 0) {
      alert("Los campos no deben estar vacios");
    } else {
      Swal.fire({
        title: "¿Estás seguro?",
        text: "Se hará el cambio de contraseña",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Si, Actualizar",
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: "../../controller/crudusu.php",
            type: "POST",
            datatype: "json",
            data: {
              opcion: opcion,
              user_id: user_id,
              ipswa: ipswa,
              ipswn: ipswn,
            },
            success: function (response) {
              data = $.parseJSON(response);
              // alert(data);
              if (data == 1) {
                MostrarAlerta(
                  "Incorrecto",
                  "La contraseña actual ingresada es incorrecta",
                  "error"
                );
              } else {
                $("#modaleditpswG").modal("hide");
                ResetForm("formC");
                $("#error3").text("");
                MostrarAlerta(
                  "Éxito",
                  "Se hizo el cambio de contraseña",
                  "success"
                );
              }
            },
          });
        }
      });
    }
  });

  //ACCIONES PARAR EL MODAL INSTITUCION GENERAL
  $("#institut").click(function () {
    opcion = 1;
    idinsti = $("#idinstitu").val();
    $.ajax({
      url: "../../controller/institucion.php",
      type: "POST",
      datatype: "json",
      data: { opcion: opcion, idinsti: idinsti },
      success: function (response) {
        data = $.parseJSON(response);
        if (data.length > 0) {
          $("#idinst").val(data[0]["idinstitucion"]);
          $("#iruci").val(data[0]["ruc"]);
          $("#irazoni").val(data[0]["razon"]);
          $("#idirei").val(data[0]["dirección"]);
          $("#modalinstitu").modal({ backdrop: "static", keyboard: false });
        }
      },
    });
  });

  $("#BtnContraG").click(function () {
    opcion = 9;
    user_id = $("#iduser").val();
    ipswa = $("#ipsw").val();
    ipsw = $("#ipasss1").val();
    ipswn = $("#ipassco1").val();
    if (ipswa.length <= 0 || ipsw.length <= 0 || ipswn.length <= 0) {
      alert("Los campos no deben estar vacios");
    } else {
      Swal.fire({
        title: "¿Estás seguro?",
        text: "Se hará el cambio de contraseña",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Si, Actualizar",
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: "../../controller/crudusu.php",
            type: "POST",
            datatype: "json",
            data: {
              opcion: opcion,
              user_id: user_id,
              ipswa: ipswa,
              ipswn: ipswn,
            },
            success: function (response) {
              data = $.parseJSON(response);
              alert(data);
              if (data == 1) {
                MostrarAlerta(
                  "Incorrecto",
                  "La contraseña actual ingresada es incorrecta",
                  "error"
                );
              } else {
                $("#modaleditpsw").modal("hide");
                ResetForm("formC");
                $("#error3").text("");
                MostrarAlerta(
                  "Éxito",
                  "Se hizo el cambio de contraseña",
                  "success"
                );
              }
            },
          });
        }
      });
    }
  });

  $("#institut").click(function () {
    opcion = 1;
    idinsti = $("#idinstitu").val();
    $.ajax({
      url: "../../controller/institucion.php",
      type: "POST",
      datatype: "json",
      data: { opcion: opcion, idinsti: idinsti },
      success: function (response) {
        data = $.parseJSON(response);
        if (data.length > 0) {
          $("#idinst").val(data[0]["idinstitucion"]);
          $("#iruci").val(data[0]["ruc"]);
          $("#irazoni").val(data[0]["razon"]);
          $("#idirei").val(data[0]["dirección"]);
          $("#modalinstitu").modal({ backdrop: "static", keyboard: false });
        }
      },
    });
  });
  $("#BtnEditInsti").click(function () {
    opcion = 2;
    idinsti = $("#idinst").val();
    rucinsti = $("#iruci").val();
    razon = $("#irazoni").val();
    direc = $("#idirei").val();
    Swal.fire({
      title: "¿Estás seguro?",
      text: "Se editarán los datos del empleado",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonText: "Cancelar",
      cancelButtonColor: "#d33",
      confirmButtonText: "Si, Editar",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "../../controller/institucion.php",
          type: "POST",
          datatype: "json",
          data: {
            opcion: opcion,
            idinsti: idinsti,
            rucinsti: rucinsti,
            razon: razon,
            direc: direc,
          },
          success: function (response) {
            data = $.parseJSON(response);
            if (data == 1) {
              MostrarAlerta("Hecho", "Usted no hizo cambios", "success");
              $("#modalinstitu").modal("hide");
            } else {
              MostrarAlerta("Hecho", "Los cambios se guardaron", "success");
              $("#modalinstitu").modal("hide");
            }
          },
        });
      }
    });
  });
  //VALIDACION DE INGRESO DE CONTRASEÑAS
  $("#ipassco").keyup(function () {
    var pass1 = $("#ipasss").val();
    var pass2 = $("#ipassco").val();

    if (pass1 == pass2) {
      $("#error2").text("Las contraseñas coinciden.").css("color", "green");
      $("#guardar").prop("disabled", false);
    } else {
      $("#error2").text("Las contraseñas no coinciden.").css("color", "red");
      $("#guardar").prop("disabled", true);
    }
    if (pass2 == "") {
      $("#error2").text("No se debe dejar en blanco").css("color", "red");
      $("#guardar").prop("disabled", true);
    }
  });

  $("#ipasss").keyup(function () {
    var pass1 = $("#ipasss").val();
    var pass2 = $("#ipassco").val();

    if (pass1 == pass2) {
      $("#error2").text("Las contraseñas coinciden.").css("color", "green");
      $("#guardar").prop("disabled", false);
    } else {
      $("#error2").text("Las contraseñas no coinciden.").css("color", "red");
      $("#guardar").prop("disabled", true);
    }
    if (pass2 == "") {
      $("#guardar").prop("disabled", true);
    }
  });

  $("#ipassco1").keyup(function () {
    var pass1 = $("#ipasss1").val();
    var pass2 = $("#ipassco1").val();

    if (pass1 == pass2) {
      $("#error3").text("Las contraseñas coinciden.").css("color", "green");
      $("#guardar").prop("disabled", false);
    } else {
      $("#error3").text("Las contraseñas no coinciden.").css("color", "red");
      $("#guardar").prop("disabled", true);
    }
    if (pass2 == "") {
      $("#error3").text("No se debe dejar en blanco").css("color", "red");
      $("#guardar").prop("disabled", true);
    }
  });

  $("#ipasss1").keyup(function () {
    var pass1 = $("#ipasss1").val();
    var pass2 = $("#ipassco1").val();

    if (pass1 == pass2) {
      $("#error3").text("Las contraseñas coinciden.").css("color", "green");
      $("#guardar").prop("disabled", false);
    } else {
      $("#error3").text("Las contraseñas no coinciden.").css("color", "red");
      $("#guardar").prop("disabled", true);
    }
  });
  // VALIDACION DEL DNI INGRESADO EN MESA DE PARTES
  $("#validar").click(function () {
    opcion = 11;
    var idni = $("#iddni").val();
    if (idni.length < 8) {
      alert("El DNI debe tener 8 digitos");
      $("#iddni").focus();
    } else {
      $.ajax({
        url: "../../controller/crudusu.php",
        type: "POST",
        datatype: "json",
        data: { idni: idni, opcion: opcion },
        success: function (response) {
          data = $.parseJSON(response);
          if (data.length < 1) {
            Swal.fire({
              position: "top-end",
              icon: "warning",
              title:
                "No se encuentra registrado. Complete correctamente los campos.",
              showConfirmButton: false,
              timer: 1800,
              // height: '850px'
            });
          } else {
            $("#idpersona").val(data[0]["idpersona"]);
            $("#idnombre").val(data[0]["nombres"]);
            $("#idap").val(data[0]["ap_materno"]);
            $("#idam").val(data[0]["ap_paterno"]);
            $("#idcel").val(data[0]["telefono"]);
            $("#iddirec").val(data[0]["direccion"]);
            $("#idcorre").val(data[0]["email"]);

            $("#idruc").val(data[0]["ruc_institu"]);
            $("#identi").val(data[0]["institucion"]);

            ruc = data[0]["ruc_institu"];

            if (ruc == null || ruc == "" || ruc == " " || ruc == "  ") {
              $("#customRadio1").prop("checked", true);
              $("#mostrar").hide();
            } else {
              $("#customRadio2").prop("checked", true);
              $("#mostrar").show();
            }
          }
        },
      });
    }
  });

  $("#btnReport").click(function () {
    estado = $("#cboreport").val();
    año = $("#cboaño").val();
    mes = $("#cbormes").val();
    desde = $("#start").val();
    hasta = $("#end").val();
    tipo = $("#cboreport1").val();
    d = convertirfecha(desde);
    h = convertirfecha(hasta);
    alert(d + " " + h);
    if (tipo == "0") {
      alert("POR FAVOR SELECCIONE LA FORMA DEL REPORTE");
      $("#cboreport1").focus();
    } else {
      if (tipo == "3" && (desde = "" || hasta == "")) {
        alert("POR FAVOR COMPLETE LOS CAMPOS REQUERIDOS");
        $("#start").focus();
      } else {
        window.open(
          "/Sistema_MesaPartes/reporte/reporte-documentos.php?e=" +
            estado +
            "&a=" +
            año +
            "&m=" +
            mes +
            "&d=" +
            d +
            "&h=" +
            h,
          "_blank"
        );
      }
    }
  });

  $("#cboreport1").change(function () {
    var sel = $(this).val();
    ResetForm("formreport");
    switch (sel) {
      case "1":
        $("#re").show();
        $("#reportmes").hide();
        $("#reportrango").hide();

        break;
      case "2":
        $("#re").show();
        $("#reportmes").show();
        $("#reportrango").hide();
        break;
      case "3":
        $("#re").hide();
        $("#reportmes").hide();
        $("#reportrango").show();
        break;
      default:
        alert("ERROR AL ELEGIR");
        break;
    }
  });

  $(".div-check").click(function () {
    $("#check").prop("checked", true);
  });
});
/*=============================   FUNCIONES  ================================= */

function validaNumericos(event) {
  if (event.charCode >= 48 && event.charCode <= 57) {
    return true;
  }
  return false;
}
function MostrarAlerta(mensaje, descripcion, tipoalerta) {
  Swal.fire(mensaje, descripcion, tipoalerta);
}
function limpiarcampos() {
  document.getElementById("formnew").reset();
  $("#error2").text("");
  $("#Aviso").text("");
  $("#AvisoE").text("");
  $("#error1").text("");
}

function limpiarcamposarea() {
  document.getElementById("formarea").reset();
}
function salir() {
  window.location = "/Sistema_MesaPartes/controller/salir.php"; //pagina donde tienes tus consultas para borrar
}

function limpiarderivacion() {
  document.getElementById("formderivacion").reset();
}

function limpiaraceptacion() {
  document.getElementById("Formaceptacion").reset();
}

function ResetForm(id) {
  document.getElementById(id).reset();
}

function RegistroDocumento() {
  var isChecked = document.getElementById("check").checked;
  if (isChecked) {
    if (ValidarPDF()) {
      Swal.fire({
        title: "¿Estás seguro?",
        text: "Se registrará su trámite",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Enviar",
      }).then((result) => {
        if (result.isConfirmed) {
          var parametros = new FormData($("#formulario-tramite")[0]);

          $.ajax({
            data: parametros,
            url: "../../controller/savetramite.php",
            type: "POST",
            contentType: false,
            processData: false,
            beforesend: function () {},
            success: function (response) {
              Swal.fire({
                icon: "success",
                title: "TRÁMITE REGISTRADO",
                html: '<div style="text-align:left">' + response + "</div>",
              });
              Limpiar();
              $("#Avisoa").hide();
            },
          });
        }
      });
      return false;
    } else {
      Swal.fire({
        icon: "error",
        title: "Solo se permite archivos tipo PDF",
        html: "El archivo no es de tipo pdf",
      });
      return false;
    }
  } else {
    alert("Por favor complete todos los campos requeridos");
  }
}

function ValidarPDF() {
  var archivo = document.getElementById("idfile").value;
  var extensiones = archivo.substring(archivo.lastIndexOf("."));
  if (extensiones != ".pdf") {
    return false;
  } else {
    return true;
  }
}

function Limpiar() {
  document.getElementById("formulario-tramite").reset();
  document.querySelector("#alias").innerText = "";
  document.getElementById("idtipo").selectedIndex = 0;
}

function convertirfecha(fecha) {
  if (typeof fecha != "string") {
    return false;
  } else {
    if (fecha == "") {
      return "";
    } else {
      let partes = fecha.split("/");
      return partes[2] + "-" + partes[1] + "-" + partes[0];
    }
  }
}

const input = document.getElementById("icupo");

const check = () => {
  if (!input.validity.valid) input.value = 1;
  if (+input.value < 0) input.value = 1;
};

let archivo = document.querySelector("#idfile");
archivo.addEventListener("change", () => {
  document.querySelector("#alias").innerText = archivo.files[0].name;
});
