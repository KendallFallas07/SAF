<?php
require_once './validacionRutas.php';
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Unidades de Medicion Crud</title>
        <script src="unidadMedida.js"></script>
        <link rel="stylesheet" href="footer.css"/>
    </head>
    <?php include_once './header.php'; ?>
    <body>
        <h1>CRUD DE MEDIDAS</h1>
        <!-- Herraminetas de busqueda -->
        <?php include_once './unidadMedidaBuscar.php'; ?>
        <!-- recoleccion de datos nuevos -->
        <?php include_once './unidadMedidaFormulario.php'; ?>
        <!-- mostrando los datos  -->
        <?php include_once './unidadMedidaTabla.php'; ?>
    </body>
    <?php include_once './footer.php'; ?>
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
