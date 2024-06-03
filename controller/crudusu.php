<?php
include_once '../config/conexion1.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$dni = (isset($_POST["idni"])) ? $_POST["idni"] : '';
$nombre = (isset($_POST['inombre'])) ? strtoupper(trim($_POST['inombre'])) : '';
$appat = (isset($_POST['iappat'])) ? strtoupper(trim($_POST['iappat'])) : '';
$apmat = (isset($_POST['iapmat'])) ? strtoupper(trim($_POST['iapmat'])) : '';
$celular = (isset($_POST['icel'])) ? $_POST['icel'] : '';
$direccion = (isset($_POST['idir'])) ? strtoupper(trim($_POST['idir'])) : '';
$email = (isset($_POST['iemail'])) ? $_POST['iemail'] : '';

$usuario = (isset($_POST['inomusu'])) ? $_POST['inomusu'] : '';
$rol = (isset($_POST['tipo'])) ? $_POST['tipo'] : '';
$estado = (isset($_POST['estado'])) ? $_POST['estado'] : '';
$contraseña = (isset($_POST['ipassco'])) ? $_POST['ipassco'] : '';

$anterior = (isset($_POST['ipswa'])) ? $_POST['ipswa'] : '';
$nueva = (isset($_POST['ipswn'])) ? $_POST['ipswn'] : '';

$idper = (isset($_POST['idper'])) ? $_POST['idper'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$user_id = (isset($_POST['user_id'])) ? $_POST['user_id'] : '';

$user_dni = (isset($_POST['iddni1'])) ? $_POST['iddni1'] : '';
$ur_id = (isset($_POST['idusua'])) ? $_POST['idusua'] : '';
$archivo = (isset($_FILES['idfile1'])) ? $_FILES['idfile1'] : '';

$user_dni1 = (isset($_POST['iddni2'])) ? $_POST['iddni2'] : '';
$ur_id1 = (isset($_POST['idusua2'])) ? $_POST['idusua2'] : '';
$foto = (isset($_FILES['idfilep'])) ? $_FILES['idfilep'] : '';

switch ($opcion) {
    case 1: //GUARDAR USUARIO
        $consulta = "INSERT into persona values (null,'$dni','$appat','$apmat','$nombre','$email','$celular','$direccion',null,null)";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "INSERT into usuarios values (null,'$usuario','$dni','$contraseña','$email',sysdate(),null,sysdate(),'DESACTIVADO','files/images/0/persona.png','$rol')";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT * FROM usuarios ORDER BY idusuarios DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //EDITAR USUARIO  
        $consulta = "select count(*) total from persona p, usuarios u, roles r
        where p.dni=u.dni and r.idroles=u.idroles and (p.dni='$dni' or nombre='$usuario' or u.email='$email') and idpersona != '$idper'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetch(PDO::FETCH_ASSOC);

        if ($data['total'] == 0) {

            $consulta = "UPDATE persona SET dni='$dni', ap_paterno='$appat', ap_materno='$apmat', nombres='$nombre', email='$email', telefono='$celular', direccion='$direccion'
                WHERE idpersona='$idper'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            $consulta = "UPDATE usuarios SET nombre='$usuario', dni='$dni', email='$email', fechaedicion=sysdate(), estado='$estado', idroles='$rol'
                WHERE idusuarios='$user_id'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $data = 1;
        }
        break;
    case 3: //Eliminacion en cascada de usuarios
        $consulta = "select count(*) total from empleado where idpersona=(select idpersona from persona where dni='$dni');";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetch(PDO::FETCH_ASSOC);

        if ($data['total'] == 0) {
            $consulta = "DELETE FROM usuarios WHERE dni='$dni' ";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            $consulta = "DELETE FROM persona WHERE dni='$dni'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
        } else {
            $data = 1;
        }
        break;
    case 4:
        $consulta = "SELECT idusuarios, nombre, dni, email, estado FROM usuarios";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 5: //Validacion de existencia de DNI
        $consulta = "select count(*) total from usuarios where dni='$dni'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetch(PDO::FETCH_ASSOC);

        if ($data['total'] == 0) {
            $data = 2;
        } else {
            $data = 1;
        }

        break;
    case 6: //CONSULTA PARA MOSTRAR DATOS A EDITAR
        $consulta = "select idusuarios ID1, idpersona ID2, p.dni dni, nombres ,ap_paterno ap, ap_materno am, telefono, direccion, u.email email, nombre,r.idroles IDR, estado,foto
        from persona p, usuarios u, roles r
        where p.dni=u.dni and r.idroles=u.idroles and idusuarios='$user_id' and p.dni='$dni'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);

        break;
    case 7: //Validacion de existencia de EMAIL
        $consulta = "select count(*) total from persona where email='$email'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetch(PDO::FETCH_ASSOC);

        if ($data['total'] == 0) {
            $data = 2;
        } else {
            $data = 1;
        }
        break;

    case 8: //Validacion de existencia de NOMBRE USUARIO
        $consulta = "select count(*) total from usuarios where nombre='$usuario'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetch(PDO::FETCH_ASSOC);

        if ($data['total'] == 0) {
            $data = 2;
        } else {
            $data = 1;
        }

        break;
    case 9: //CAMBIO DE CONTRASEÑA
        $consulta = "SELECT count(*) total FROM usuarios  where contraseña='$anterior' and idusuarios='$user_id';";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetch(PDO::FETCH_ASSOC);

        if ($data['total'] == 0) {
            $data = 1;
        } else {
            $consulta = "UPDATE usuarios SET contraseña='$nueva', fechaedicion=sysdate() where idusuarios='$user_id'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
        }
        break;
    case 10: //cambio de foto de perfil
        $a = "../";
        $ruta = "files/images/" . $ur_id . "/";
        $file_tmp_name = $archivo['tmp_name'];
        $file_tmp_type = $archivo['type'];
        $new_name_file = $a . $ruta . $ur_id . '_' . date('Y') . '_' . $user_dni . '.jpg';
        $nuevo = $ruta . $ur_id . '_' . date('Y') . '_' . $user_dni . '.jpg';

        if (!file_exists($a . $ruta)) {
            mkdir($a . $ruta, 0777, true);
        }

        if (copy($file_tmp_name, $new_name_file)) {
            $consulta = "UPDATE usuarios SET foto='$nuevo', fechaedicion=sysdate() where idusuarios='$ur_id'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data = 'Se guardo';
            $new_name_file = '';
            $nuevo = '';
        } else {
            $data = 'Error';
        }
        break;
    case 11:
        $consulta = "SELECT * FROM persona where dni='$dni'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 12:
        $consulta = "select count(*) total from persona p, usuarios u, roles r
        where p.dni=u.dni and r.idroles=u.idroles and (nombre='$usuario' or u.email='$email') and idpersona != '$idper'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetch(PDO::FETCH_ASSOC);

        if ($data['total'] == 0) {

            $consulta = "UPDATE persona SET  ap_paterno='$appat', ap_materno='$apmat', nombres='$nombre', email='$email', telefono='$celular', direccion='$direccion'
                WHERE idpersona='$idper'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            $consulta = "UPDATE usuarios SET nombre='$usuario', email='$email', fechaedicion=sysdate()
                WHERE idusuarios='$user_id'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $data = 1;
        }
        break;
    case 13:
        $a = "../";
        $ruta = "files/images/" . $ur_id1 . "/";
        $file_tmp_name = $foto['tmp_name'];
        $file_tmp_type = $foto['type'];
        $new_name_file = $a . $ruta . $ur_id1 . '_' . date('Y') . '_' . $user_dni1 . '.jpg';
        $nuevo = $ruta . $ur_id1 . '_' . date('Y') . '_' . $user_dni1 . '.jpg';

        if (!file_exists($a . $ruta)) {
            mkdir($a . $ruta, 0777, true);
        }

        if (move_uploaded_file($file_tmp_name, $new_name_file)) {
            $consulta = "UPDATE usuarios SET foto='$nuevo', fechaedicion=sysdate() where idusuarios='$ur_id1'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data = 'Se guardo' . $user_dni1;
            $new_name_file = '';
            $nuevo = '';
        } else {
            $data = 'Error';
        }
        break;
}
$opcion = '';
print json_encode($data, JSON_UNESCAPED_UNICODE); //envio el array final el formato json a AJAX
$conexion = null;
