
<!DOCTYPE html>
<!--Brayan Rosales Perez fecha de modificaciones 24/07/24-->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Autonomo De Facturacion</title>
    <link rel="stylesheet" href="view/index.css"/>
    <link rel="stylesheet" href="view/footer.css"/>
    <link rel="stylesheet" href="view/header.css"/>
    <script defer="on" src="view/index.js"></script>
</head>
<body>
    <!-- original header -->
    <?php include_once './view/header.php'; ?>
    <?php
    session_start(); //para reanudar o crear una variable de sesion
    if (!isset($_SESSION["id"])) {
        ?>
        <!-- validar el tipo de usuario y dependiendo del acceso dar permisos -->
        <dialog onkeydown="handleKeyDown(event)" id="modal-login">
            <form action="business/accionUsuariosValidador.php" method="post" id="login">
                <div>
                    <label for="user" >Nombre de usuario  /  Email</label>
                    <input type="text" id="user" name="user">
                    <label for="user" hidden="true">error</label>
                </div>
                <div>
                    <label for="pass" >Contraseña</label>
                    <input type="password" id="pass" name="pass">
                    <label for="pass" hidden="true" id="error-login" >error</label>
                </div>
                <span class="class">
                    <input type="button" value="Iniciar Sesion" onclick="validateLogin()">
                </span>
            </form>
        </dialog>
        <?php
    } else {
        ?>
        <div>
            <a href="view/impuesto.php">Impuestos</a>
            <a href="view/proveedorVista.php">Proveedores</a>
            <a href="view/presentacion.php">Presentaciones</a>
            <a href="view/categoriaVista.php">Categorias</a>
            <a href="view/subCategoriaVista.php">Sub-Categorias</a>
            <a href="view/compra.php">Compras</a>
            <a href="view/productoVista.php">Producto</a>
            <a href="view/unidadMedida.php">Unidades de Medicion</a>
            <a href="view/lote.php">Lote</a>
            <a href="view/tipoUnidadVista.php">Tipo Unidad</a>
            <a href="view/clientecredito.php">Cliente Credito</a>
            <a href="view/proveedorCredito.php">Proveedor Credito</a>
            <a href="view/roles.php">Roles</a>
            <a href="view/usuario.php">Usuarios</a>
            <a href="view/venta.php">Ventas</a>
            <a href="view/margenGanancia.php">Margen Ganancia</a>
            <a href="view/cajeroVista.php">Cajero</a>
            <a href="view/entrenamientos.php">Gestion de Modelo de Inteligencia artificial</a>
        </div>
    <?php } ?>
</body>
<?php include_once './view/footer.php'; ?>

