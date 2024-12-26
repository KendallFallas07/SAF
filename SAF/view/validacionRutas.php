<?php

//si las sesiones están habilitadas, pero no existe ninguna.
if (session_status() == PHP_SESSION_NONE) {
    //hacer un leggeo
    session_start();
    if ($_SESSION["id"] != $_COOKIE["PHPSESSID"] || !isset($_SESSION)) {
        session_destroy();
        header("Location: /SAF/index.php");
    }
}
?>

