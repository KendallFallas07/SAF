<?php 
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>
<form name="saveLote" action="../business/accionLoteNuevo.php" method="POST" id="FORM">
    <div class="DIV">
        <input type="hidden" id="Identifier"  name="identifier" >
        <label for="Producto">Producto:</label>
        <select id="Producto" name="producto">
            <?php
            require_once '../business/ControladoraLote.php';
            $Controller = new LoteController();
            $option = $Controller->getAllProducto();
            foreach ($option as $key => $value) {
                $contador = 0;
                $identificadorProd;
                $nombreProd;
                foreach ($value as $key => $valueF) {
                    if ($contador == 1)
                        $identificadorProd = $valueF;
                    if ($contador == 2)
                        $nombreProd = $valueF;
                    $contador++;
                }
                echo "<option value='$identificadorProd' label='$nombreProd'></option>";
            }
            ?>
        </select>
    </div>
    <div class="DIV"> 
        <label for="EscanearCodigoDeBarras">Codigo Barras:</label>
        <input id="EscanearCodigoDeBarras" type="submit" value="Escanear" disabled>
    </div >
    <div class="DIV"> 
        <label for="CantidadAdquirida">Cantidad Adquirida:</label>
        <input type="number" id="CantidadAdquirida" min="1" name="cantAdq">
    </div >
    <div class="DIV">
        <label for="PrecioCompra">Precio Compra:</label>
        <input type="number" id="PrecioCompra" min="0" name="precCom" step="0.01">
    </div>
    <div class="DIV">
        <label for="FechaAdquisicion">Fecha de Compra:</label>
        <input type="date" id="FechaAdquisicion" name="fechAdq" >
    </div>
    <div class="DIV">
        <label for="FechaExp">Fecha Expiración:</label>
        <input type="date" id="FechaExp"name="fechExp">
    </div>

    <input id="btn-save" type="submit" value="Enviar" onclick="saveData(event, 'FORM')">
    <button  form="FORM" type="submit" style="cursor: pointer; visibility: hidden;" onclick="editData(event, 'FORM')" id="btn-finish">Editar Lote</button>
    <button  type="button" style="cursor: pointer; visibility: hidden;" id="btn-cancel" onclick='cancel(event)'>Cancelar edición</button>
</form