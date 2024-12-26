<?php
include_once "../business/ControladoraProveedor.php";

$proveedorContoller = new ControladoraProveedor();
// Obtener los proveedores para las opciones
$proveedores = $proveedorContoller->getAllSuppliers();

?>

<!DOCTYPE html>
<form method="POST" action="../business/accionCompraNuevo.php" autocomplete="off" id="save">

        
    <label for="supplierId">Proveedor</label>
    <select name="supplierId" id="supplierId" required>
        <option value="" disabled selected>Proveedor</option>
        <?php foreach ($proveedores as $proveedor): ?>
            <option value="<?php echo htmlspecialchars($proveedor->getIdentifier()); ?>">
                <?php echo htmlspecialchars($proveedor->getName()); ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for="payMethod">Método de pago</label>
    <select name="payMethod" id="payMethod" required>
        <option value="" selected>Seleccione un método de pago</option>
        <option value="Tarjeta">Tarjeta</option>
        <option value="Efectivo">Efectivo</option>
        <option value="Transferencia">Transferencia</option>
        <option value="Sinpe">Sinpe</option>
        <option value="E-wallet">E-Wallets</option>
        <option value="Otro">Otro</option>
    </select>
    <input type="hidden" id="idToModify" name="idToModify" value="">
    <label for="notes">Notas adicionales</label>
    <input type="text" name="notes" id="notes" placeholder="(Opcional)">

    <label for="notes">Fecha de la compra</label>
    <input type="date" name="date" id="date" placeholder="Fecha de la compra" />
    <button type="button" id="submit-btn">Agregar compra</button>
    <button type="button" id="cancel-btn">Cancelar edición</button>
    
</form>
