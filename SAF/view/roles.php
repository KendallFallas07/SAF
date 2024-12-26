<?php
require_once './validacionRutas.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>CRUD de Roles</title>
        <link rel="stylesheet" href="footer.css"/>
        <script src="roles.js"></script>
    </head>
    <?php require_once './header.php'; ?>
    <body>
        <h1>CRUD DE ROLES</h1>
        <?php require_once './rolesBusqueda.php'; ?>
        <?php require_once './rolesFormulario.php'; ?>
        <?php require_once './rolesTabla.php'; ?>
    </body>
    <?php require './footer.php'; ?> 
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
