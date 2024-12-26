<?php


class ControladoraImagenes{
    function getTimestamp(DateTime $date): int {
        $date->setTimezone(new DateTimeZone("America/Costa_Rica"));
        return $date->getTimestamp();
    }
    
    function saveImage($file, $targetDirectory,$newName) {
        if ($file['error'] !== UPLOAD_ERR_OK) {
            return false;
        }
    
        $fileTmpPath = $file['tmp_name'];
        $fileName = $file['name'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    
        $allowedExtensions = ['jpg', 'jpeg', 'png'];
        if (!in_array($fileExtension, $allowedExtensions)) {
            return false;
        }
    
        // Generar la ruta completa del archivo destino
        $targetFilePath = $targetDirectory . '/' . $newName.'.'.$fileExtension;
    
        // Mover el archivo a la carpeta de destino
        if (move_uploaded_file($fileTmpPath, $targetFilePath)) {
            return true;
        } else {
            return false;
        }
    }

    function saveImageWithFolder($file, $targetDirectory, $newName) {
        if ($file['error'] !== UPLOAD_ERR_OK) {
            return false;
        }
    
        $fileTmpPath = $file['tmp_name'];
        $fileName = $file['name'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    
        $allowedExtensions = ['jpg', 'jpeg', 'png'];
        if (!in_array($fileExtension, $allowedExtensions)) {
            return false;
        }
    
        // Verificar si la carpeta de destino existe, si no, crearla
        if (!is_dir($targetDirectory)) {
            if (!mkdir($targetDirectory, 0777, true)) { // Crea la carpeta con permisos de escritura y lectura
                return false; // Si no se pudo crear la carpeta, retorna false
            }
        }
    
        // Generar la ruta completa del archivo destino
        $targetFilePath = $targetDirectory . '/' . $newName ;
    
        // Mover el archivo a la carpeta de destino
        if (move_uploaded_file($fileTmpPath, $targetFilePath)) {
            return true;
        } else {
            return false;
        }
    }

    function deleteImage($fileName, $targetDirectory) {
        if (substr($targetDirectory, -1) !== '/') {
            $targetDirectory .= '/';
        }
    
        $filePath = $targetDirectory . $fileName;
    
        if (file_exists($filePath)) {
            if (unlink($filePath)) {
                return 'Imagen eliminada exitosamente: ' . $fileName;
            } else {
                return 'Error al intentar eliminar la imagen: ' . $fileName;
            }
        } else {
            return 'La imagen no se encontró en la ruta especificada: ' . $fileName;
        }
    }


}

 









