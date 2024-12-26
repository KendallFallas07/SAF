<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<form name="crearProveedorC" action="../business/accionProveedorCreditoNuevo.php" method="POST" id="FORM">
    <div class="DIV">
        <input type="hidden" id="Identifier"  name="identifier" readonly="true">
        <label for="Proveedor">Proveedor:</label>
        <select id="Proveedor" name="proveedor">
            <?php
            require_once '../business/ControladoraProveedorCredito.php';
            $Controller = new ProveedorCreditoController();
            $option = $Controller->obtenerTodosLosProveedores();
            foreach ($option as $key => $value) {
                $contador = 0;
                $identificadorProveedor;
                $nombreProveedor;
                foreach ($value as $key => $valueF) {
                    if ($contador == 2)
                       $identificadorProveedor = $valueF;
                    if ($contador == 3)
                        $nombreProveedor = $valueF;
                    $contador++;
                }
                echo "<option value='$identificadorProveedor' label='$nombreProveedor'></option>";
            }
            ?>
        </select>
    </div>
    <div class="DIV"> 
        <label for="CantidadCredito">Cantidad Credito:</label>
        <input type="number" id="CantidadCredito" min="0" name="cantCre" step="0.01">
    </div >
    <div class="DIV">
        <label for="Porcentaje">Porcentaje:</label>
        <input type="number" id="Porcentaje" min="0" name="porcentaje" step="0.01">
    </div>
    <div class="DIV">
        <label for="Plazo">Plazo:</label>
        <input type="number" id="Plazo" min="1" name="plazo" min="1">
    </div>
    <div class="DIV">
        <label for="FechaInicio">Fecha de Inicio:</label>
        <input type="date" id="FechaInicio" name="fechIni" >
    </div>
    <div class="DIV">
        <label for="FechaExp">Fecha Expiración:</label>
        <input type="date" id="FechaExp"name="fechExp">
    </div>

    <input id="btn-save" type="submit" value="Enviar" onclick="saveData(event, 'FORM')" >
    <button  form="FORM" type="submit" style="cursor: pointer; visibility: hidden;" onclick="editData(event, 'FORM')" id="btn-finish">Editar Proveedor Creditor</button>
    <button  type="button" style="cursor: pointer; visibility: hidden;" id="btn-cancel" onclick='cancel(event)'>Cancelar edicion</button>
</form>