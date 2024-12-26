<?php
require_once "../business/ControladoraRol.php";
$data;
try {
    $controller = new ControladoraRol();
    $interableEdit = 1;
    $interableDel = 2;
    if (isset($_GET["data"]) && !empty($_GET["data"])) {
        $data = $controller->search($_GET["data"]);
    } else {
        $data = $controller->getAll();
    }
} catch (Exception $exc) {
    $data = array();
}
?>
<style>
    div#table table {
        width: -webkit-fill-available;
        width: -moz-available;
    }
    div#table tbody td input {
        width: -webkit-fill-available;
        width: -moz-available;
    }
</style>
<hr>
<div id="table" >
    <table border="1">
        <thead
            <tr>
                <th hidden='true'>ID</th>
                <th hidden='true'>Identificador</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Fecha de creacion</th>
                <th>Fecha de modificacion</th>
                <th hidden='true' >Estado</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (empty($data)) {
                echo 'No se encontraron registros';
            } else {
                foreach ($data as $key => $value) {
                    echo "<tr>";
                    $identificador;
                    foreach ($value as $keyf => $valuef) {
                        if ($keyf == "tbrolidentificador") {
                            $identificador = $valuef;
                        } elseif ($keyf == "tbrolid" || $keyf == "tbrolestado") {
                            
                        } else {
                            echo "<td>$valuef</td>";
                        }
                    }
                    echo "<td><input type=\"button\" value=\"Editar Rol\" onclick=\"loadData('$identificador')\" ></td>";
                    echo "<td><input type=\"button\" value=\"Eliminar Rol\" onclick=\"delRol('$identificador')\"></td>";
                    echo "</tr>";
                }
            }
            ?>
        </tbody>
    </table>
</div>
<hr>