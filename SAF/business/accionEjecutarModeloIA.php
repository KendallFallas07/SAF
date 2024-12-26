<?php

function searchIA() {
    //vuelvo a entrenar
    $script_path = '"/opt/lampp/htdocs/SAF/modelo de python/.venv/bin/python" "/opt/lampp/htdocs/SAF/modelo de python/load_model.py"';
    exec("$script_path 2>&1", $output, $return_var);
    //mensajes de depuracion eliminar despues
    if ($return_var !== 0) {
        return "Hubo un error al reconocer la imagen intentelo de nuevo o utilice el metodo QR.";
    } else {
        return $output[count($output) - 1];
    }
}

function reloadPerm() {
    // Cambiar permisos de la subcarpeta SAF
    exec('sudo chmod -R 777 /opt/lampp/htdocs/SAF', $array_output, $result_code);
    // Cambiar propietario de la subcarpeta SAF
    exec('sudo chown -R Brayan:Brayan /opt/lampp/htdocs/SAF', $array_output2, $result_code2);
    return "Permisos cambiados en SAF exitosamente.";
}


$result = "";
$fileTmpPath = $_FILES['image']['tmp_name'];
$uploadPath = '../modelo de python/test.png';
if (move_uploaded_file($fileTmpPath, $uploadPath)) {
    $result . "Imagen subida correctamente a test.png\n";
    $response = searchIA();
    $result . reloadPerm();
    echo json_encode(["code" => 200, "identifier" => $response]);
    exit();
} else {
    $result . "No se pudo mover la imagen a la ubicación deseada\n";
    echo json_encode($result);
    exit();
}



