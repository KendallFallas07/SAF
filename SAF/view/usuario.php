<?php
require_once './validacionRutas.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Usuarios CRUD</title>
        <script defer="" src="usuario.js"></script>
        <link  rel="stylesheet" href="usuario.css"/>
        <link rel="stylesheet" href="footer.css"/>
    </head>
    <body>
        <!-- header -->
        <?php include_once './header.php'; ?>
        <h1>CRUD DE USUARIOS</h1>
        <!-- busqueda -->
        <?php include_once './usuarioBusqueda.php'; ?>
        <!-- formulario -->
        <?php include_once './usuariosFormulario.php'; ?>
        <!-- tabla de datos -->
        <?php include_once './usuarioTabla.php'; ?>
        <!-- footer -->
        <?php include_once './footer.php'; ?>
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
