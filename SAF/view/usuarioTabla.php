<?php
require_once "../business/ControladoraUsuarios.php";
$interableEdit = 1;
$data = array();
if (filter_input(INPUT_GET, "data") == false) {
    $controller = new ControladoraUsuarios();
    $data = $controller->getAll();
} else {
    $busqueda = filter_input(INPUT_GET, "data");
    $controller = new ControladoraUsuarios();
    $data = $controller->search($busqueda);
}
?>
<hr>
<?php if (!empty($data)) {
    ?>

    <table border="1">
        <thead>
            <tr>
                <th hidden>Id</th>
                <th hidden>Identificador</th>
                <th>Nombre Usuario</th>
                <th>Email</th>
                <th hidden>Contrasena</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Fecha De Creacion</th>
                <th>Fecha De Modificacion</th>
                <th>Ultimo Ingreso</th>
                <th hidden>Estado</th>
                <th>Rol</th>
                <th>Imagen De Perfil</th>
                <th>Numero De Telefono</th>
                <th>Direccion</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($data as $key => $value) {
                echo "<tr id='$interableEdit'>";
                $cont = 1;
                $ident;
                foreach ($value as $keyf => $valuef) {
                    if ($cont == 1 || $cont == 5 || $cont == 11) {
                        echo "<td hidden >$valuef</td>";
                    } elseif ($cont == 2) {
                        echo "<td hidden >$valuef</td>";
                        $ident = $valuef;
                    } elseif ($cont == 12) {
                        $name = new ControladoraUsuarios();
                        $rol = $name->getRolByIdentifier($valuef);
                        foreach ($rol[0] as $key => $valueR) {
                            echo "<td>$valueR</td>";
                        }
                    } else {
                        echo "<td>$valuef</td>";
                    }
                    $cont++;
                }
                echo "<td><input type='submit' value='Editar' onclick='editData(\"{$interableEdit}\")' ></td>";
                echo "<td><input type='submit' value='Eliminar' onclick='deleteData(\"{$ident}\")' ></td>";
                echo "</tr>";
                $interableEdit++;
            }
            ?>
        </tbody>
    </table>
    <?php
} else {
    echo "<h3>No se encontraron registros de busqueda</h3>";
}
?>
<hr>
