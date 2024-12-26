<!DOCTYPE html>
<!--Brayan Rosales Perez fecha de modificaciones 31/07/24-->
<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../business/ControladoraImpuesto.php';

$controladora = new ImpuestosController();

$data = isset($_GET["data"]) ? $controladora->getSearchEliminated($_GET["data"]) : $controladora->getAllEliminated();

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

                <td>
                        <div style="justify-content: space-between; display: flex;">
                            <button style="cursor: pointer" type="button" onclick="recuperarImpuesto('<?php echo htmlspecialchars($key['tbimpuestoidentificador'], ENT_QUOTES, 'UTF-8'); ?>')">Recuperar</button>
                            
                        </div>
                    </td>
            </tr>
        <?php 
        
        }
        ?>
    </tbody>
</table>
<?php else: ?>
    <p>No hay impuestos eliminados.</p>
<?php endif; ?>