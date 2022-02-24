<?php
include_once '../modelo/Usuario.php';
$usuario = new Usuario();
session_start();
$id_usuario = $_SESSION['usuario'];
if ($_POST['funcion'] == 'buscar_usuario') {
    $json = array();
    $fecha_actual = new DateTime();
    $usuario->obtener_datos($_POST['dato']);
    foreach ($usuario->objetos as $objeto) {
        $nascimento = new DateTime($objeto->edad);
        $edad = $nascimento->diff($fecha_actual);
        $edae_years = $edad->y;
        $json[] = array(
            'nombre' => $objeto->nombre_us,
            'apellidos' => $objeto->apellidos_us,
            'edad' => $edae_years,
            'dni' => $objeto->dni_us,
            'tipo' => $objeto->nombre_tipo,
            'telefono' => $objeto->telefono_us,
            'residencia' => $objeto->residencia_us,
            'correo' => $objeto->correo_us,
            'sexo' => $objeto->sexo_us,
            'adicional' => $objeto->adicional_us,
            'avatar' => '../img/' . $objeto->avatar

        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}
if ($_POST['funcion'] == 'capturar_datos') {
    $json = array();
    $id_usuario = $_POST['id_usuario'];
    $usuario->obtener_datos($id_usuario);
    foreach ($usuario->objetos as $objeto) {
        $json[] = array(
            'telefono' => $objeto->telefono_us,
            'residencia' => $objeto->residencia_us,
            'correo' => $objeto->correo_us,
            'sexo' => $objeto->sexo_us,
            'adicional' => $objeto->adicional_us

        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}
if ($_POST['funcion'] == 'editar_usuario') {
    $id_usuario = $_POST['id_usuario'];
    $telefono = $_POST['telefono'];
    $residencia = $_POST['residencia'];
    $correo = $_POST['correo'];
    $sexo = $_POST['sexo'];
    $adicional = $_POST['adicional'];
    $usuario->editar($id_usuario, $telefono, $residencia, $correo, $sexo, $adicional);
    echo 'editado';
}
if ($_POST['funcion'] == 'cambiar_contra') {
    $id_usuario = $_POST['id_usuario'];
    $oldpass = $_POST['oldpass'];
    $newpass = $_POST['newpass'];
    $usuario->cambiar_contra($id_usuario, $oldpass, $newpass);
}
if ($_POST['funcion'] == 'cambiar_foto') {
    if (($_FILES['photo']['type'] == 'image/jpeg') || ($_FILES['photo']['type'] == 'image/png') || ($_FILES['photo']['type'] == 'image/gif')) {
        $nombre = uniqid() . '-' . $_FILES['photo']['name'];
        $ruta = '../img/' . $nombre;
        move_uploaded_file($_FILES['photo']['tmp_name'], $ruta);
        $usuario->cambiar_photo($id_usuario, $nombre);
        foreach ($usuario->objetos as $objeto) {
            unlink('../img/' . $objeto->avatar);
        }
        $json = array();
        $json[] = array(
            'ruta' => $ruta,
            'alert' => 'edit'
        );
        $jsonstring = json_encode($json[0]);
        echo $jsonstring;
    } else {
        $json = array();
        $json[] = array(
            'alert' => 'noedit'
        );
        $jsonstring = json_encode($json[0]);
        echo $jsonstring;
    }
}
if ($_POST['funcion'] == 'buscar_usuarios_adm') {
    $json = array();
    $fecha_actual = new DateTime();
    $usuario->buscar();
    foreach ($usuario->objetos as $objeto) {
        $nascimento = new DateTime($objeto->edad);
        $edad = $nascimento->diff($fecha_actual);
        $edae_years = $edad->y;
        $json[] = array(
            'id' => $objeto->id_usuario,
            'nombre' => $objeto->nombre_us,
            'apellidos' => $objeto->apellidos_us,
            'edad' => $edae_years,
            'dni' => $objeto->dni_us,
            'tipo' => $objeto->nombre_tipo,
            'telefono' => $objeto->telefono_us,
            'residencia' => $objeto->residencia_us,
            'correo' => $objeto->correo_us,
            'sexo' => $objeto->sexo_us,
            'adicional' => $objeto->adicional_us,
            'avatar' => '../img/' . $objeto->avatar,
            'tipo_usuario' => $objeto->us_tipo

        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}
if ($_POST['funcion'] == 'crear_usuario') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $edad = $_POST['edad'];
    $dni = $_POST['dni'];
    $pass = $_POST['pass'];
    $tipo=2;
    $avatar='default_user.jpg';
    $usuario->crear($nombre,$apellido,$edad,$dni,$pass,$tipo,$avatar);
}
if ($_POST['funcion'] == 'subir') {
    $pass=$_POST['pass'];
    $id_aumentou=$_POST['id_usuario'];
    $usuario->subir($pass,$id_aumentou,$id_usuario);
}
if ($_POST['funcion'] == 'descer') {
    $pass=$_POST['pass'];
    $id_diminuiu=$_POST['id_usuario'];
    $usuario->descer($pass,$id_diminuiu,$id_usuario);
}
if ($_POST['funcion'] == 'excluir-usuario') {
    $pass=$_POST['pass'];
    $id_eliminado=$_POST['id_usuario'];
    $usuario->excluir($pass,$id_eliminado,$id_usuario);
}
?>