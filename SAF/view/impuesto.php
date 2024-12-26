<?php
require_once './validacionRutas.php';
?>

<style>
    table{
        width: -webkit-fill-available;
    }
    form#save span {
        display: grid;
        align-content: center;
        align-items: center;
        justify-items: center;
        margin: 2ch;
    }

    form#save {
        display: flex;
        flex-direction: row;
    }
    form#formSearch {
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        align-content: center;
        justify-content: flex-end;
        align-items: center;
    }
    form#formSearch span {
        display: grid;
        align-content: center;
        justify-items: start;
        margin: 2ch;
    }
</style>
<!DOCTYPE html>
<!--Brayan Rosales Perez fecha de modificaciones 31/07/24-->
<html>

    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="footer.css" />
        <title>Impuestos</title>
    </head>

    <body>
        <?php require_once './header.php'; ?>
        <h1>CRUD IMPUESTOS</h1>
        <form action="impuesto.php" method="get" autocomplete="off" id="formSearch">
            <span>
                <label>Buscar:</label>
                <input type="search" name="data" id="data" placeholder="Ingrese un nombre" list="lista">
                <datalist id="lista">
                </datalist>
            </span>
            <input type="submit" value="Buscar">
        </form>
        <?php require_once './impuestoFormulario.php'; ?>
        <br>
        <button id="botonCambiar" onclick="alternarDiv()">Mostrar impuestos eliminados</button>
        <div id="divOculto" style="display: none;">
            <hr>
            <?php require_once './impuestoTablaOculta.php'; ?>
        </div>
        <hr>
        <!-- tabla dinamica -->
        <?php require_once './impuestoTabla.php'; ?>
        <?php require_once './footer.php'; ?>
        <script src="impuesto.js"></script>
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