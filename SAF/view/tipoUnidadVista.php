<?php
require_once './validacionRutas.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tipo de unidad</title>
        <link rel="stylesheet" href="footer.css"/>
    </head>
    <body>

        <?php include_once './header.php'; ?>
        <h1>CRUD TIPO UNIDAD</h1>

        <hr>
        <?php include_once './tipoUnidadBuscar.php'; ?>
        <hr>

        <hr>
        <?php include_once './tipoUnidadFormulario.php'; ?>
        <hr>

        <hr>
        <?php include_once './tipoUnidadTabla.php'; ?>
        <hr>

        <?php include_once './footer.php'; ?>

        <script src="tipoUnidad.js"></script>
    </body>
</html>
<script>
    function showModal() {
        try {
            document.getElementById("modal-login").showModal();
        } catch (e) {
            window.alert("Ya has iniciado session.");
        }
    }
</script>