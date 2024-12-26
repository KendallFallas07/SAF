<?php

require_once "./ControladoraUsuarios.php";

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

if (filter_input(INPUT_POST, "code") === "1") {
    $nombreUsuario = filter_input(INPUT_POST, "nombreusuario");
    $identificador = filter_input(INPUT_POST, "identificador");
    if ($nombreUsuario == false && $identificador == false) {
        response("400", "el nombre de usuario no puede estar vacio");
    } else {
        //verificacion de existencia en la base de datos
        $controller = new ControladoraUsuarios();
        $dataDB = $controller->searchByNameUser($nombreUsuario);
        if (empty($dataDB)) {
            response("200", "Nombre valido");
        } else {
            $contr = new ControladoraUsuarios();
            //es nuevo
            if (empty($identificador)) {
                response("400", "nombre de usuario invalido, ya existe una cuenta con ese nombre de usuario");
            } else {
                $user = $contr->getUserByIdentifier($identificador);
                if ($user[0]["tbusuarionombreusuario"] == $nombreUsuario) {
                    response("200", "Nombre valido");
                } else {
                    response("400", "nombre de usuario invalido, ya existe una cuenta con ese nombre de usuario");
                }
            }
        }
    }
}


if (filter_input(INPUT_POST, "code") === "2") {
    $email = filter_input(INPUT_POST, "email");
    $identificador = filter_input(INPUT_POST, "identificador");
    if ($email == false && $identificador == false) {
        response("400", "el correo no puede estar vacio");
    } else {
        if (!str_contains($email, "@")) {
            response("400", "email de usuario invalido");
        }
        //verificacion de existencia en la base de datos
        $controller = new ControladoraUsuarios();
        $dataDB = $controller->searchByEmail($email);
        if (empty($dataDB)) {
            response("200", "Email valido");
        } else {
            //ver si es nuevo
            if ($identificador == false) {
                response("400", "Email invalido, ya esta asociado a una cuenta");
            } else {
                //si esta editando verificar que sea el de el
                $cont = new ControladoraUsuarios();
                $user = $cont->getUserByIdentifier($identificador);
                if ($user[0]["tbusuarioemail"] == $email) {
                    response("200", "Email valido");
                } else {
                    response("400", "Email invalido, ya esta asociado a una cuenta");
                }
            }
        }
    }
}
