<?php

require_once "./ControladoraUsuarios.php";

date_default_timezone_set("America/Costa_Rica");

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

//
$identificador = filter_input(INPUT_POST, "identificador");
if ($identificador == false) {
    response("404", "lo sentimos intentelo mas tarde");
}

//traemos el original
$controller = new ControladoraUsuarios();
$user = $controller->getUserByIdentifier($identificador);
$id = $user[0]["tbusuarioid"] + 1;
//

$nombreUsuario = filter_input(INPUT_POST, "nombreusuario");
if ($nombreUsuario == false) {
    response("404", "Debe de ingresar una Nombre de usuario valido");
}

$email = filter_input(INPUT_POST, "email");
if ($email == false) {
    response("404", "Debe de ingresar una email valido");
}

$contrasena = filter_input(INPUT_POST, "contrasena");
if ($contrasena == false) {
    $contrasena = $user[0]["tbusuariocontrasena"];
} else {
    $contrasena = password_hash(filter_input(INPUT_POST, "contrasena"), PASSWORD_DEFAULT);
}


$esempresa = filter_input(INPUT_POST, "esempresa");
if ($esempresa == null) {
    $nombre = filter_input(INPUT_POST, "nombre");
    if ($nombre == false) {
        response("404", "Debe de ingresar un nombre valido");
    }
    $apellidos = filter_input(INPUT_POST, "apellidos");
    if ($apellidos == false) {
        response("404", "Debe de ingresar unos apellidos validos");
    }
} else {
    $empresa = filter_input(INPUT_POST, "empresa");
    if ($empresa == false) {
        response("404", "Debe de ingresar un nombre de empresa valido");
    }
    $apellidos = "";
}

$rol = filter_input(INPUT_POST, "rol");
if ($rol == false) {
    response("404", "lo sentimos intentelo mas tarde");
}

/*TODO*/
$imagen = "por implementar la ruta";

$date = new DateTime();

$telefono = filter_input(INPUT_POST, "telefono");

$direccion = filter_input(INPUT_POST, "direccion");

$data = [
    "id" => $id,
    "identificador" => $identificador,
    "nombreUsuario" => $nombreUsuario,
    "email" => $email,
    "contrasena" => $contrasena,
    "nombre" => $nombre,
    "apellidos" => $apellidos,
    "fechaCreaion" => $user[0]["tbusuariofechacreacion"],
    "fechaModif" => $date->format("Y-m-d H:i:s"),
    "ultimoIngreso" => $date->format("Y-m-d H:i:s"),
    "estado" => $user[0]["tbusuarioestado"],
    "rol" => $rol,
    "foto" => $imagen,
    "telefono" => $telefono,
    "direccion" => $direccion
];

$controllerf = new ControladoraUsuarios();
if($controllerf->update($identificador, $data)){
    response("200", "Usuario Actualizado con exito");
}
else{
    response("200", "lo sentimos intentelo mas tarde");
}


