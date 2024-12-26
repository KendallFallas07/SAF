<!--Brayan Rosales Perez fecha de modificaciones 31/07/24-->
<?php ?>
<style>
    div#container-auth {
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        justify-content: center;
        margin: 2ch;
    }

    header{
        border-style: solid;
        border-radius: 1ch;
        display: flex;
        flex-wrap: nowrap;
        justify-content: space-between;
        align-content: center;
        align-items: center;
    }

    header nav{
        margin: 2ch;
    }
</style>
<header>
    <nav>
        <a href="/SAF/index.php">Inicio</a>
        <h1>Sistema Autonomo de Facturacion</h1>
    </nav>
    <div id="container-auth">
        <div>
            <input type="button" value="Iniciar Session" onclick="showModal()">
        </div>
        <form action="/SAF/business/accionCerrarSession.php" method="post">
            <input type="submit" value="Cerrar sesion">
        </form>
    </div>
</header>
