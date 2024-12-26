<?php
require_once './validacionRutas.php';
?>
<!DOCTYPE html>
<style>
    form#formSearch {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        flex-wrap: nowrap;
        flex-direction: row;
    }
    form#formSearch span {
        display: grid;
        align-content: center;
        justify-items: start;
        align-items: center;
        justify-content: center;
        margin: 2ch;
    }
    form#guardar {
        display: flex;
        flex-direction: row;
        align-items: center;
        /* margin: 2ch; */
    }
    form#guardar span {
        display: grid;
        align-content: center;
        justify-content: center;
        justify-items: center;
        align-items: center;
        margin: 2ch;
    }
    table {
        width: -webkit-fill-available;
        text-align: center;
    }
</style>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Presentacion</title>
        <link rel="stylesheet" href="footer.css" />
    </head>
    <?php include_once './header.php'; ?>

    <body>
        <h1>CRUD PRESENTACION</h1>
        <hr>
        <form action="presentacion.php" method="get" autocomplete="off" id="formSearch">
            <span>
                <label>Buscar:</label>
                <input type="search" name="data" id="data" placeholder="Ingrese un nombre" list="lista">
                <datalist id="lista">
                </datalist>
            </span>
            <span>
                <input type="submit" value="Buscar">
            </span>
        </form>
        <hr>
        <?php require_once './presentacionFormulario.php'; ?>
        <br>

        <button id="botonCambiar" onclick="alternarDiv()">Mostrar presentaciones eliminadas</button>

        <div id="divOculto" style="display: none;">
            <hr>
            <?php require_once './presentacionTablaOculta.php'; ?>
        </div>

        <hr>

        <?php require_once './presentacionTabla.php'; ?>
        <script src="presentacion.js"></script>
    </body>
    <?php require_once './footer.php'; ?>

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