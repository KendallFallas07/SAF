<?php
require_once './validacionRutas.php';
?>

<!DOCTYPE html>

<html lang="en">
    <head>


        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Lote</title>
        <link rel="stylesheet" href="footer.css"/>
        <link rel="stylesheet" href="lote.css"/>
    </head>
    <body>

        <?php include_once './header.php'; ?>

        <h1>CRUD LOTE</h1>

        <!-- Modulo de busqueda -->
        <?php include_once './loteBuscador.php'; ?>
        <!-- Modulo de Formulario -->
        <?php include_once './loteFormulario.php'; ?>
        <!-- Modulo de Tabla -->
        <?php include_once './loteTabla.php'; ?>
        <hr>
        <?php include_once './footer.php'; ?>
        <script defer src="lote.js"></script>
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