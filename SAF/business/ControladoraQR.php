
<?php
require_once "qr/phpqrcode/qrlib.php";

/**
 * Clase encargada de administrar códigos de QR
 * 
 * @author Daniel Briones
 * @since 26/08/24
 * 
 */
class ControladoraQR
{
    /**
     * Función encargada de generar una imagen en formato PNG y guardar en un directorio
     * 
     * @param String $dir Ruta al directorio donde se va a guardar el QR
     * @param String $imageName Nombre con el cual se guardará el QR
     * @param String $contenido Contenido que se va a registrar en el QR
     * 
     * @return bool TRUE en caso de poder registrar la imagen, FALSE en caso que algo falle
     */
    public function generateImgQRPNG($dir, $imageName, $contenido)
    {
        //Si no existe la carpeta se crea
        if (!file_exists($dir))
            mkdir($dir);

        //Generar ruta a la imagen QR
        $filename = $dir . $imageName;

        //Eliminar caracteres especiales
        $filename = str_replace([' ', ':'], '_', $filename);

        //Parametros de Condiguración

        $tamaño = 10; //Tamaño de Pixel
        $level = 'H'; //Precisión Alta
        $framSize = 3; //Tamaño en blanco

        //Enviar los parametros a la Función para generar código QR 
        QRcode::png($contenido, $filename, $level, $tamaño, $framSize);

        //Mostrar la imagen generada
        //echo '<img src="' . $dir . basename($filename) . '" /><hr/>';

        return file_exists($filename);
    }
}
