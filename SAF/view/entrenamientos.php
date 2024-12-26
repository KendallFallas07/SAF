<!DOCTYPE html>
<?php require_once './validacionRutas.php'; ?>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->

<style>
    main {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;
        align-items: center;
        align-content: center;
    }

    .objectData {
        text-align: center;
        margin: 2ch;
        padding: 2ch;
    }
    button#train {
        border-radius: 2ch;
        border-color: transparent;
        cursor: pointer;
    }
    dialog:-internal-dialog-in-top-layer::backdrop {
        background: rgba(0 0 0 / 56%);
    }
    dialog#modal {
        width: 42ch;
        text-align: center;
    }
    p.objectData {
        width: 50ch;
        text-align: justify;
    }
    button#train:hover {
        transform: scale(1.3);
    }
    p.objectData:hover {
        transform: scale(1.1);
    }

</style>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Gestion de Modelo de Inteligencia artificial</title>
        <link rel="stylesheet" href="footer.css"/>
    </head>
    <body>
        <!-- header -->
        <?php include_once './header.php'; ?>
        <!-- contenido -->
        <h1>Gestion de Modelo de Inteligencia artificial</h1>
        <main>
            <div id="container-data" class="objectData">
                <label for="cantidad">Cantidad de elementos entrenados</label>
                <p hidden="true" id="cantidad">0</p>
            </div>
            <button id="train" onclick="trainModel()" class="objectData">Re-Entrenar Modelo de IA</button>
            <p class="objectData">️&#9432 Información: El entrenaminento de un modelo de inteligencia artificial proporciona resultados precisos y personalizados. Este proceso puede tardar unos minutos. Agradecemos tu paciencia y te recomendamos no cerrar la página hasta que el entrenamiento finalice.</p>
        </main>
        <!-- footer -->
        <?php include_once './footer.php'; ?>
    </body>
</html>
<dialog id="modal">
    <p id="info">⚠️ Entrenamiento en Proceso

        El proceso de entrenamiento de inteligencia artificial está en curso y podría demorar unos minutos. Por favor, mantén la página abierta y evita realizar otras acciones hasta que el entrenamiento haya finalizado.

        Gracias por tu paciencia.</p>
</dialog>
<script defer="">
    async function trainModel() {
        const modal = document.getElementById("modal");
        modal.showModal();
        const response = await fetch('../business/accionEntrenarModeloIA.php');
        const data = await response.json();
        if (data.code === 200) {
            document.getElementById("info").textContent = data.status;
            document.getElementById("cantidad").textContent = data.cantidad;
            document.getElementById("cantidad").hidden = false;
        } else {
            document.getElementById("cantidad").hidden = false;
        }
        setTimeout(() => {
            modal.close();
        }, 5000);
    }
</script>