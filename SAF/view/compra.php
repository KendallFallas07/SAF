<?php
require_once './validacionRutas.php';
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Compra</title>
        <link rel="stylesheet" href="footer.css" />

    </head>

    <body>
        <?php include_once './header.php'; ?>

        <h1>CRUD COMPRAS</h1>
        <hr>
        <form action="compra.php" method="get" autocomplete="off" id="formSearch">
            <label>Buscar:</label>
            <input type="search" name="data" id="data" placeholder="Ingresa un proveedor" list="lista">

            <datalist id="lista">

            </datalist>
            <input type="submit" value="Buscar">

        </form>

        <hr>

        <?php include_once './compraFormulario.php'; ?>
        <hr>

        <?php require_once './compraTabla.php'; ?>
        <?php require_once './footer.php'; ?>
        <script src="compra.js"></script>
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