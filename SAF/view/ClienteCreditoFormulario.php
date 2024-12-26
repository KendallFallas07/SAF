<?php

include_once "../business/ControladoraClienteCredito.php";
$controladora = new ClienteCreditoControladora();
$usuarios = $controladora->obtenerClientes();

?>

<!DOCTYPE html>

<form method="POST" action="../business/accionClienteCreditoNuevo.php" autocomplete="on" id="guardar">


    <label for="clienteId">Cliente</label>
    <select name="clienteId" id="clienteId" required>
        <option value="" disabled selected>Seleccione un cliente</option>
        <?php foreach ($usuarios as $usuario): ?>
            <option value="<?php echo htmlspecialchars($usuario['id']); ?>">
                <?php echo htmlspecialchars($usuario['nombre'] . " " . $usuario['apellidos']); ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for="clienteCreditoCantidad">Cantidad del crédito</label>
    <input style="width: 85px" type="number" name="clienteCreditoCantidad" id="clienteCreditoCantidad" min="0.1" step="0.1">

    <label for="clienteCreditoPorcentaje">Porcentaje del crédito</label>
    <input style="width: 55px" type="number" name="clienteCreditoPorcentaje" id="clienteCreditoPorcentaje" min="0" max="100" step="0.1">
    <label for="clienteCreditoPlazo">Plazo del crédito</label>
    <input style="width: 80px" oninput="handlePlazoChange()" type="number" name="clienteCreditoPlazo" id="clienteCreditoPlazo" placeholder="En meses" min="1">
    <button type="button" id="boton-cargar">Agregar crédito</button>
    <button type="button" id="boton-cancelar">Cancelar edición</button>

    <br><br>


    <input type="hidden" id="idAModificar" name="idAModificar" value="">
    <label for="clienteCreditoFechaInicio">Fecha de inicio del crédito</label>
    <input type="date" name="clienteCreditoFechaInicio" id="clienteCreditoFechaInicio">
    <label for="clienteCreditoFechaVencimiento">Fecha de vencimiento del crédito</label>
    <input readonly type="date" name="clienteCreditoFechaVencimiento" id="clienteCreditoFechaVencimiento">


</form>