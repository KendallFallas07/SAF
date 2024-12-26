<?php

require_once "./ControladoraUsuarios.php";
require_once "./ControladoraImagenes.php";

function response(string $error, string $message) {
    $response = [
        'status' => $error,
        'message' => $message
    ];
    // Establecer el encabezado para JSON
    header('Content-Type: application/json');
    // Codificar el array a formato JSON
    echo json_encode($response);
    exit();
}

date_default_timezone_set("America/Costa_Rica");

$date = new DateTime();
////datos de prueba
$data = array();
$data["id"] = 1;
$data["identificador"] = "USUARIO-" . $date->getTimestamp();
//validacion del nomnre de usuario
if (isset($_POST["nombreusuario"]) && !empty($_POST["nombreusuario"])) {
    $data["nombreusuario"] = $_POST["nombreusuario"];
} else {
    response("404", "Lo sentimos debe ingresar un nombre de usuario valido.");
}
//validacion de el email
if (isset($_POST["email"]) && !empty($_POST["email"])) {
    $data["email"] = $_POST["email"];
} else {
    response("404", "Lo sentimos debe un correo valido de usuario valido.");
}
//validacion y encriptacion de la contrasena
if (isset($_POST["contrasena"]) && !empty($_POST["contrasena"])) {
    $data["contrasena"] = password_hash($_POST["contrasena"], PASSWORD_DEFAULT);
} else {
    response("404", "Debe proporcionar una contrasena valida!.");
}
//validacion de si es empresa o persona
if (isset($_POST["esempresa"]) && !empty($_POST["esempresa"])) {
    //validando el nombre de la empresa
    if (isset($_POST["empresa"]) && !empty($_POST["empresa"])) {
        $data["empresa"] = $_POST["empresa"];
        $data["apellidos"] = "";
    } else {
        response("404", "Lo sentimos debe colocar un nombre valido.");
    }
} else {
    //validando los datos de un usuario
    if (isset($_POST["nombre"]) && !empty($_POST["nombre"])) {
        $data["nombre"] = $_POST["nombre"];
    } else {
        response("404", "Lo sentimos debe colocar un nombre valido.");
    }
    //validando los apellidos
    if (isset($_POST["apellidos"]) && !empty($_POST["apellidos"])) {
        $data["apellidos"] = $_POST["apellidos"];
    } else {
        response("404", "Lo sentimos debe colocar unos apellidos validos");
    }
}
$data["fechacreacion"] = $date->format("Y-m-d H:i:s");
$data["fechamodificacion"] = $date->format("Y-m-d H:i:s");
$data["ultimoingreso"] = $date->format("Y-m-d H:i:s");
$data["estado"] = 1;
//validando el rol
if (isset($_POST["rol"]) && !empty($_POST["rol"])) {
    $data["rol"] = $_POST["rol"];
} else {
    response("404", "Lo sentimos intentelo de nuevo");
}

//validando la foto
if (isset($_FILES["foto"]) && !empty($_FILES["foto"])) {
    // $data["foto"] = $_FILES["foto"];
    $image = new ControladoraImagenes();

    if (!$image->saveImage($_FILES["foto"], '../images/user', $data["identificador"])) {
        response("400", "Error al subir la imagen, intentelo mas tarde");
    }
    $data["foto"] = $data["identificador"];
}

//validando el telefono
if (isset($_POST["telefono"]) && !empty($_POST["telefono"])) {
    $data["telefono"] = $_POST["telefono"];
} else {
    $data["telefono"] = "";
}

//validando el telefono
if (isset($_POST["direccion"]) && !empty($_POST["direccion"])) {
    $data["direccion"] = $_POST["direccion"];
} else {
    $data["direccion"] = "";
}
//
$conn = new ControladoraUsuarios();
if ($conn->save($data)) {
    response("200", "Usuario Guardado con EXITO");
} else {
    response("404", "Lo sentimos intentelo mas tarde.");
}


