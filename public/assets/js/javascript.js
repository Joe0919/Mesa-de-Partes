$(document).ready(function () {
  var opcion;
  var dni;
  $('#Avisoa').hide();
  $('#mostrar').hide();
  $('#divNoFound').hide();
  $('#dat').hide();
  $('#linea').hide();
  $('#contenido').hide();
  $('#divT').hide();
  $("#validar").prop("disabled", false);


  $("input[name='customRadio']").change(function () {
      if ($(this).val() == 'juridica') {
          $('#mostrar').show();
      }
      else {
          $('#mostrar').hide();
      }
  });

  $("#validar").click(function () {
    opcion = 11;
    var idni = $("#iddni").val();
    if(idni.length < 8){
      alert('El DNI debe tener 8 digitos');
      $("#iddni").focus();
    }else{
      $.ajax({
      url: "../controller/crudusu.php",
      type: "POST",
      datatype: "json",
      data: { idni: idni, opcion: opcion },
      success: function (response) {
        data = $.parseJSON(response);
        if(data.length < 1){
          $("#validar").prop("disabled", true); 
          Swal.fire({
            position: 'top-end',
            icon: 'warning',
            title: 'No se encuentra registrado. Complete correctamente los campos.',
            showConfirmButton: false,
            timer: 2800,
            width: '850px'
          })
        }else{
          $("#idnombre").prop('readonly', true);
          $("#idap").prop('readonly', true);
          $("#idam").prop('readonly', true);
          $("#idpersona").val(data[0]["idpersona"]);
          $("#idnombre").val(data[0]["nombres"]);
          $("#idap").val(data[0]["ap_materno"]);
          $("#idam").val(data[0]["ap_paterno"]);
          $("#idcel").val(data[0]["telefono"]);
          $("#iddirec").val(data[0]["direccion"]);
          $("#idcorre").val(data[0]["email"]);

          $("#idruc").val(data[0]["ruc_institu"]);
          $("#identi").val(data[0]["institucion"]);
          $("#validar").prop("disabled", true);
          ruc = data[0]["ruc_institu"];
          if (ruc == null || ruc == '' || ruc == ' ' || ruc == '  ') {
            $("#customRadio1").prop("checked", true);
            $('#mostrar').hide();
          } else {
            $("#customRadio2").prop("checked", true);
            $('#mostrar').show();
            $("#idruc").prop('readonly', true);
            $("#identi").prop('readonly', true);
          }
          $('#Avisoa').show();
        }
      },
    });
  }
  });

  $('#idcorre').keyup(function(){
    correo=$('#idcorre').val();
    if(ValidarCorreo(correo) == false){
      $("#Vcorreo").text("Formato no válido").css("color", "red");
    }else{
      $("#Vcorreo").text("Formato válido").css("color", "green");
    }
  });

  $("#btnLimpiar").click(function () {
    Limpiar();
    $('#Avisoa').hide();
    ResetForm('FormBuscar');
    $("#validar").prop("disabled", false);
  });

  $("#btnSeguir").click(function () {
    $('#contenido').show();
    $('#mesa').hide();
    $('#divT').show();
    $('#divS').hide();
    Limpiar();
    $('#Avisoa').hide();
  });
  
  $("#btnNuevoT").click(function () {
    $('#contenido').hide();
    $('#mesa').show();
    $('#divT').hide();
    $('#divS').show();
    ResetForm('FormBuscar');
    $("#celdaexpe").text('');
    $("#celdanro").text('');
    $("#celdatipo").text('');
    $("#celdasunto").text('');

    $("#celdadni").text('');
    $("#celdadatos").text('');
    $("#celdaruc").text('');
    $("#celdaenti").text('');
    $('#divNoFound').hide();
    $("#linea").hide();
    $('#dat').hide();
    $('#insert').show();
    $('#histo').remove();
    $("#idexpb").focus();
    $('#divL').show();
  });

  $("#btnBusca").click(function () {
    opcion = 7;
    id = $.trim($("#idexpb").val());
    dni = $("#iddnii").val();
    año = $("#idtipob").val();
    if (id.length < 6 || dni.length < 8) {
      alert("Por favor, complete correctamente todos los campos necesarios para la búsqueda");
    } else {
      $.ajax({
        url: "../controller/cruddocumento.php",
        type: "POST",
        datatype: "json",
        data: { opcion: opcion, id: id, año: año, dni: dni },
        success: function (response) {
          data = $.parseJSON(response);
          if (data != 0) {
            $("#celdaexpe").text(data[0]["nro_expediente"]);
            $("#celdanro").text(data[0]["nro_doc"]);
            $("#celdatipo").text(data[0]["tipodoc"]);
            $("#celdasunto").text(data[0]["asunto"]);

            $("#celdadni").text(data[0]["dni"]);
            $("#celdadatos").text(data[0]["Datos"]);
            $("#celdaruc").text(data[0]["ruc_institu"]);
            $("#celdaenti").text(data[0]["institucion"]);
            $('#divNoFound').hide();
            $('#insert').hide();
            $('#dat').show();
            $("#btnhistorial").prop("disabled", false);
            $('#divL').hide();
          }else{
            $('#divNoFound').show();
            ResetForm('FormBuscar');
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
      url: "../controller/historial.php",
      type: "POST",
      datatype: "json",
      data: { expediente: expediente, año: año, dni: dni },
      success: function (response) {
        $("#linea").append(response);
        $("#linea").show();
        $("#btnhistorial").prop("disabled", true);
        window.location = '#linea';
      },
    });
  });

  $("#btnNew").click(function () {
    $("#celdaexpe").text('');
    $("#celdanro").text('');
    $("#celdatipo").text('');
    $("#celdasunto").text('');

    $("#celdadni").text('');
    $("#celdadatos").text('');
    $("#celdaruc").text('');
    $("#celdaenti").text('');
    $('#divNoFound').hide();
    ResetForm('FormBuscar');
    $("#linea").hide();
    $('#dat').hide();
    $('#insert').show();
    $('#histo').remove();
    $("#idexpb").focus();
    $('#divL').show();
  });
});



function validaNumericos(event) {
  if (event.charCode >= 48 && event.charCode <= 57) {
      return true;
  }
  return false;
}

document.getElementById('idtipo').selectedIndex = -1;

let archivo = document.querySelector('#idfile');
        archivo.addEventListener('change',() => {
            document.querySelector('#alias').innerText=archivo.files[0].name;
        });

function RegistroDocumento(){
  var isChecked = document.getElementById('check').checked;
  if(isChecked){
      if(ValidarPDF()){
        Swal.fire({
          title: '¿Estás seguro?',
          text: "Se registrará su trámite",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          cancelButtonText: 'Cancelar',
          confirmButtonText: 'Enviar'
        }).then((result) => {
          if (result.isConfirmed) {
            
            var parametros = new FormData($('#formulario-tramite')[0]);

              $.ajax ({
                data: parametros,
                url: '../controller/savetramite.php',
                type:'POST',
                contentType: false,
                processData: false,
                beforesend: function(){

                },
                success:  function(response){
                  Swal.fire({ 
                    icon: 'success',
                    title: 'TRÁMITE REGISTRADO',
                    html: '<div style="text-align:left">'+response+'</div>'
                  })
                  Limpiar();
                  $('#Avisoa').hide();
                }

              })		        
               
          }
       }) 
        return false;
      }else{
        Swal.fire({ 
          icon: 'error',
          title: 'Solo se permite archivos tipo PDF',
          html: 'El archivo no es de tipo pdf',
        })
        return false;
      }
    }else{
      alert('Marque la casillas de condiciones');
    } 
}

function ValidarPDF(){
  var archivo = document.getElementById("idfile").value;
  var extensiones = archivo.substring(archivo.lastIndexOf("."));
  if(extensiones != ".pdf"){
    return false;
  }else{
    return true;
  }
}


function Limpiar(){
  document.getElementById("formulario-tramite").reset();
  document.querySelector('#alias').innerText="";
  document.getElementById('idtipo').selectedIndex = 0;
  
}

function ValidarCorreo(correo){
  var expReg= /^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/;
  var esValido = expReg.test(correo);
  if(esValido == true){
    return true;
  }else{
    return false;
  }
}

function ResetForm(id) {
  document.getElementById(id).reset();
}


function generarPas() {
  var pass = '';
  var str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ' + 
          'abcdefghijklmnopqrstuvwxyz0123456789.#$';
    
  for (i = 1; i <= 8; i++) {
      var char = Math.floor(Math.random()
                  * str.length + 1);
        
      pass += str.charAt(char)
  }
    
  return pass;
}
