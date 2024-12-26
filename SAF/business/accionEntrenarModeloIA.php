<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

function saveJson() {
    $result;
    $data = scandir('../images/productos');
    $dataf = array_slice($data, 2);
    $jsonRes = json_encode($dataf);
    // Ruta
    $filePath = '../modelo de python/keys.json';
    // Guardar el JSON en el archivo
    file_put_contents($filePath, $jsonRes);

    //mensajes de depuracion eliminar despues
    // Verificar si el archivo se creó correctamente
    if (file_exists($filePath)) {
        $result = "Archivo JSON creado exitosamente en $filePath";
        return count($dataf);
    } else {
        $result = "Hubo un error al crear el archivo JSON.";
        return $result;
    }
}

function reTrainin() {
    //vuelvo a entrenar
    $script_path = '"/opt/lampp/htdocs/SAF/modelo de python/.venv/bin/python" "/opt/lampp/htdocs/SAF/modelo de python/train_model.py"';
    exec("$script_path 2>&1", $output, $return_var);
    //mensajes de depuracion eliminar despues
    if ($return_var !== 0) {
        return "Hubo un error al ejecutar el Entrenamiento de Inteligencia Artificial.";
    } else {
        return "Entrenamiento de Inteligencia Artificial ejecutado exitosamente.";
    }
}

try {
    $cantidad = saveJson();
    $res = reTrainin();
    echo json_encode(["code" => 200, "cantidad" => $cantidad, "status" => $res]);
    exit();
} catch (Exception $exc) {
    json_encode(["code" => 400, "cantidad" => 0, "status" => $res]);
}



