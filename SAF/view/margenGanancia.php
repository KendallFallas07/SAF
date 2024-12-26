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
        <title>Gestion de Ganancias</title>
        <link rel="stylesheet" href="footer.css"/>
        <script defer src="MargenGanancia.js"></script>
    </head>
    <?php include_once './header.php'; ?>  
    <body>
        <h1>CRUD Margen Ganancia</h1>

        <hr>
        <?php include_once './margenGananciaFormulario.php'; ?>  
        <hr>

        <?php include_once './margenGananciaTabla.php'; ?>  
        <hr>
        
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