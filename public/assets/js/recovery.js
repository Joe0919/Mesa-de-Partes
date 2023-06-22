$(document).ready(function () {

    var opcion, dniC;
    $('#divmail').hide();
    $('#divdni').show();
    $('#verificarC').hide();
    $('#verificar').show();
    $('#j').hide();
    $('#h').hide();

    $("#verificar").click(function () {
    dniC = $('#ingdni').val();

    if(dniC.length < 8){
        alert('El DNI no es válido');
    }else{
        opcion = 1;
        $.ajax({
            url: "../controller/recuperacion.php",
            type: "POST",
            datatype: "json",
            data: { dniC: dniC, opcion: opcion },
            success: function (response) {
              data = $.parseJSON(response);
              if(data != 1){
                let email = ocultar(data[0]['em']);
                $("#corre").text("Email registrado: "+email).css("color","green");
                $('#h').show();
                $('#divmail').show();
                $('#divdni').hide();
                $('#verificarC').show();
                $('#verificar').hide();
                $('#j').show();
              }else{
                alert('EL DNI INGRESADO NO SE ENCUENTRA REGISTRADO');
                ResetForm('recov');
                $('#ingdni').focus();
              }
            },
          });
    }
    });

    $("#verificarC").click(function () {
        vercorreo = $('#vercorreo').val();
        dniC = $('#ingdni').val();
        if(vercorreo.length == 0){
            alert('Por favor ingrese el email');
        }else{
            if(ValidarCorreo(vercorreo) == false){
              alert('El Formato de Correo no es válido, ingrese uno adecuado');
              $('#vercorreo').select();
            }else{
                opcion = 2;
                $.ajax({
                    url: "../controller/recuperacion.php",
                    type: "POST",
                    datatype: "json",
                    data: { dniC:dniC, vercorreo: vercorreo, opcion: opcion },
                    success: function (response) {
                      data = $.parseJSON(response);
                      if(data != 1){
                        let idpersona = data[0]["idpersona"];
                        let idusuario = data[0]["idusuarios"];
                        let usuario = data[0]["datos"];
                        let newcontra = generateP();
                        opcion = 3;
                        Swal.fire({
                            title: "¿Estás seguro?",
                            html: "La contraseña del Usuario <b>"+usuario+"</b> será editada",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            cancelButtonText: "Cancelar",
                            confirmButtonText: "Si, Cambiar",
                          }).then((result) => {
                            if (result.isConfirmed) {
                              $.ajax({
                                url: "../controller/recuperacion.php",
                                type: "POST",
                                datatype: "json",
                                data: {idusuario:idusuario,newcontra:newcontra,vercorreo:vercorreo,usuario:usuario,opcion:opcion},
                                success: function (data) {
                                    Swal.fire(
                                        'Contraseña Cambiada', 
                                        'Se envio un email a: '+vercorreo+' con su nueva contraseña', 
                                        'success'
                                        );
                                        $('#divmail').hide();
                                        $('#divdni').show();
                                        $('#verificarC').hide();
                                        $('#verificar').show();
                                        $('#j').hide();
                                        $('#h').hide();
                                        ResetForm('recov')
                                },
                              });
                            }
                          });
                      }else{
                        alert('EL correo ingresado NO corresponde al registrado');
                        $('#vercorreo').select();
                      }
                    },
                  });
            }

        }
    });

    // VALIDACION DE FORMATO DE CORREO
  $('#vercorreo').keyup(function(){    
    correo=$('#vercorreo').val();
    if(ValidarCorreo(correo) == false){
      $("#Vcorreo1").text("Formato correo no válido").css("color", "red");
    }else{
      $("#Vcorreo1").text("Formato correo válido").css("color", "green");
    }
  });
});

function validaNumericos(event) {
if (event.charCode >= 48 && event.charCode <= 57) {
    return true;
}
return false;
}

function ocultar(email){
    if(typeof email != 'string'){
        return false;
    }else{
      let partes = email.split('@');  
      return partes[0].substring(0,2) + '****@' + partes[1];
    }
}

function ResetForm(id) {
    document.getElementById(id).reset();
  }

  function ValidarCorreo(correo){
    var expReg= /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
    var esValido = expReg.test(correo);
    if(esValido == true){
      return true;
    }else{
      return false;
    }
  }

  function generateP() {
    var pass = '';
    var str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ' + 
            'abcdefghijklmnopqrstuvwxyz0123456789@#$';
      
    for (i = 1; i <= 8; i++) {
        var char = Math.floor(Math.random()
                    * str.length + 1);
          
        pass += str.charAt(char)
    }
      
    return pass;
}