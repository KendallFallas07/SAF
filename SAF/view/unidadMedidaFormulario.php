<?php
include_once "../business/ControladoraUnidadMedida.php";
$typeUnit = new ControladoraUnidadMedida();
?>
<style>
    .input-for{
        display: flex;
        flex-direction: column;
        flex-wrap: wrap;
        align-content: flex-start;
        align-items: flex-start;
        justify-content: center;
        margin: 10px;
    }
    #data{
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        justify-content: flex-start;
        align-items: stretch;
    }
</style>
<hr>
<form action="../business/accionUnidadMedidaNuevo.php" method="post" id="data">
    <div class="input-for">
        <label for="nameUnit">Nombre Unidad:</label>
        <label hidden="true">Ingrese el nombre de la unidad</label>
        <input type="text" name="nameUnit" placeholder="Nombre" id="nameUnit">
        <label hidden="true">error</label>
    </div>
    <div class="input-for">
        <label for="abbreviation">Abreviatura:</label>
        <label hidden="true">Ingrese la abreviatura</label>
        <input type="text" id="abbreviation" name="abbreviation" placeholder="Abreviatura">
        <label hidden="true">error</label>
    </div>
    <div class="input-for">
        <label for="systemMeasurement">Sistema de medida:</label>
        <label hidden="true">Ingrese el sistema de medida</label>
        <input type="text" id="systemMeasurement" name="systemMeasurement" placeholder="Sistema de medida">
        <label hidden="true">error</label>
    </div>
    <div class="input-for">
        <label for="typeUnit">Tipo de unidad:</label>
        <label hidden="true">Ingrese el Tipo de unidad</label>
        <select id="typeUnit" name="typeUnit" >
            <option label="Selecione El Tipo" selected="true" disabled="true"></option>
            <?php
            foreach ($typeUnit->getAllUnitTypes() as $key => $value) {
                $ident;
                $name;
                foreach ($value as $keyf => $valuef) {
                    if ($keyf == "tbtipounidadidentificador") {
                        $ident = $valuef;
                    } elseif ($keyf == "tbtipounidadnombre") {
                        $name = $valuef;
                    }
                }
                echo "<option value=$ident label=$name ></option>";
            }
            ?>
        </select>
        <label hidden="true">error</label>
    </div>
    <div class="input-for">
        <label for="btn-s">Guardar:</label>
        <input type="submit" id="btn-s" value="Guardar Tipo Unidad" onclick="saveData(event, 'data')">
        <input hidden="true" type="submit" id="btn-e" value="Editar Tipo Unidad">
        <label hidden="true">error</label>
    </div>
</form>
