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
        <?php require_once './VentaHistorialTabla.php'; ?>
        <?php require_once './footer.php'; ?>
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