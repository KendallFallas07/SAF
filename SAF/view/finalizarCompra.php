<?php
require_once './validacionRutas.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finalizar-Compra</title>
    <link rel="stylesheet" href="footer.css" />
    <script defer="" src="finalizarCompra.js"></script>
    <link rel="stylesheet" href="finalizarCompra.css">
</head>

<body>

    <?php include_once './header.php'; ?>
    <h1>Articulos seleccionados</h1>
    <div class="container">

        <div id="container-list">
        </div>

        <h2>Métodos de Pago:</h2>
        <div class="form-group">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="metodo_pago" value="tarjeta" id="tarjeta" required>
                <label class="form-check-label" for="tarjeta">Tarjeta</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="metodo_pago" value="efectivo" id="efectivo" required>
                <label class="form-check-label" for="transferencia">Efectivo</label>
            </div>
        </div>
        <div class="info-producto total">
            <span class="etiqueta">Total:</span>
            <span class="precio-total">&cent;</span>
        </div>

        <button type="button" class="btn btn-custom mt-3" onclick="confirmarLista('<?php echo $_SESSION['identificador'] ?>')">Confirmar Compra</button>
        <button type="button" class="btn btn-custom-cancel mt-3" onclick="clearListProduct()">Cancelar y volver</button>
    </div>


    <div id="myModal" class="modal">
        <div class="modal-content">
            <span id="closeModalBtn" class="close">&times;</span>
            <h2>Pasa este QR por el cajero para procesar tu compra</h2>
            <div class="qr-container" id="qr-container">
            </div>
            <p>Escanea el código QR para continuar con el pago en el cajero. Si tienes problemas, contacta con soporte.</p>
            <button id="closeModalBtnAction" class="btn">Cerrar</button>
        </div>
    </div>


    <?php include_once './footer.php'; ?>

</body>

</html>