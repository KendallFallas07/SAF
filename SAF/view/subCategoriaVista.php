<?php
require_once './validacionRutas.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Subcategorias</title>
        <link rel="stylesheet" href="footer.css"/>
    </head>
    <body>

        <?php include_once './header.php'; ?>
        <h1>CRUD Subcategorias</h1>

        <hr>
        <?php include_once './subCategoriaFormulario.php'; ?>
        <hr>

        <?php include_once './subcategoriaTabla.php'; ?>

        <?php include_once './footer.php'; ?>

        <script src="subCategoria.js"></script>
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