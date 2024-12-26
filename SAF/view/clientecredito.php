<?php
require_once './validacionRutas.php';
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cliente Credito</title>
        <link rel="stylesheet" href="footer.css" />

    </head>

    <body>
        <?php include_once './header.php'; ?>

        <h1>CRUD CREDITO CLIENTE</h1>
        <hr>
        <form action="clientecredito.php" method="get" autocomplete="off" id="formSearch">
            <label for="data">Buscar:</label>
            <input type="search" name="data" id="data" placeholder="Ingresa un cliente" list="lista">

            <datalist id="lista">

            </datalist>
            <input type="submit" value="Buscar">
        </form>

        <hr>

        <?php include_once './ClienteCreditoFormulario.php'; ?>

        <hr>

        <?php include_once './ClienteCreditoTabla.php'; ?>
        <?php require_once './footer.php'; ?>
        <script src="clientecredito.js"></script>
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