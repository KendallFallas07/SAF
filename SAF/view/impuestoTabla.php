<!DOCTYPE html>
<!--Brayan Rosales Perez fecha de modificaciones 31/07/24-->
<?php
require_once "../business/ControladoraImpuesto.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$controladora = new ImpuestosController();

//verifico que tipo de datos muestro
$data = isset($_GET["data"]) ? $controladora->getSearch($_GET["data"]) : $controladora->getAll();

?>

<?php if (!empty($data)): ?>
<table border="1">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Descripcion</th>
            <th>Valor</th>
            <th>Vigencia</th>
            <th>Acciones</th>
            
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $key) { ?>
            <tr>
                
                <td> <?php echo htmlspecialchars($key['tbimpuestonombre'], ENT_QUOTES, 'UTF-8'); ?> </td>
                <td> <?php echo htmlspecialchars($key['tbimpuestodescripcion'], ENT_QUOTES, 'UTF-8'); ?> </td>
                <td> <?php echo htmlspecialchars($key['tbimpuestovalor'], ENT_QUOTES, 'UTF-8'); ?> </td>
                <td> <?php echo htmlspecialchars($key['tbimpuestovigencia'], ENT_QUOTES, 'UTF-8'); ?> </td>

                <td style="width: 150px;">
                        <div style="justify-content: space-between; display: flex;">
                            <button style="cursor: pointer; flex: 0 0 49%;" type="button" onclick="modificarImpuesto('<?php echo htmlspecialchars($key['tbimpuestoidentificador'], ENT_QUOTES, 'UTF-8'); ?>')">Editar</button>
                            <button style="cursor: pointer; flex: 0 0 49%;" type="button" onclick="eliminarImpuesto('<?php echo htmlspecialchars($key['tbimpuestoidentificador'], ENT_QUOTES, 'UTF-8'); ?>')">Eliminar</button>
                        </div>
                    </td>
            </tr>
        <?php 
        
        }
        ?>
    </tbody>
</table>
<?php else: ?>
    <p>No hay impuestos registrados.</p>
<?php endif; ?>