<?php
require_once './validacionRutas.php';
?>
<!DOCTYPE html>
<style>
    .div-search {
        display: flex;
        flex-direction: row;
        justify-content: flex-end;
        align-items: center;
    }
</style>
<html lang="en">
    <head>
        <!-- View categorias: Josue  -->
        <meta charset="UTF-8">
        <title>Gestion de Categorias</title>
        <link rel="stylesheet" href="footer.css"/>
    </head>
    <?php include_once './header.php'; ?>  
    <body>
        <h1>CRUD Categoria</h1>
        <hr>
        <?php include_once './categoriaBuscar.php'; ?>
        <hr>
        <hr>
        <?php include_once './categoriaFormulario.php'; ?>
        <hr>

        <hr>
        <?php include_once './categoriaTabla.php'; ?>
        <hr>
    </body>
    <?php include_once './footer.php'; ?>
    <script src="Categoria.js"></script>
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