<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once "../domain/UnidadMedida.php";
include_once "../business/ControladoraUnidadMedida.php";
//traer los datos
$controller = new ControladoraUnidadMedida();
if (isset($_GET["search"])) {
    $data = $controller->searchData($_GET["search"]);
} else {
    $data = $controller->getAllData();
}
$interableDel = 0;
$interableEdit = 1;
?>

<style>
    table{
        width: -webkit-fill-available ;
        width: -moz-available;
        text-align: center;
    }
    table input {
        width: -webkit-fill-available;
        width: -moz-available;
    }
</style>

<hr>
<table border=1>
    <thead >
        <tr>
            <th hidden="true">ID</th>
            <th hidden="true">IDENTIFICADOR</th>
            <th>Nombre</th>
            <th>Abreviatura</th>
            <th>Sistema de Medida</th>
            <th>Tipo de Unidad</th>
            <th>Fecha de Creacion</th>
            <th>Fecha de Modificacion</th>
            <th hidden="true">ESTADO</th>
            <th>Editar</th>
            <th>Eliminar</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($data as $key => $value) {
            echo '<tr>';
            $cont = 1;
            $ident;
            foreach ($value as $keyf => $valuef) {
                if ($cont >= 3 && $cont <= 8) {
                    if ($cont == 6) {
                        $valuef = $controller->getUnitTypeByIdentifier($valuef);
                        echo "<td>{$valuef[0]}</td>";
                    } else {
                        echo "<td>{$valuef}</td>";
                    }
                } else {
                    echo "<td hidden>{$valuef}</td>";
                }
                if($cont == 2){
                    $ident = $valuef;
                }
                $cont++;
            }
            echo "<td><input type='button' value='Editar' name='Editar' onclick='loadData(event,\"{$ident}\")' /></td>";
            echo "<td><input type='button' value='Eliminar' name='Eliminar' onclick='delData(event,\"{$ident}\")' /></td>";
            echo '</tr>';
        }
        ?>
    </tbody>
</table>