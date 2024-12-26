<?php
require_once '../business/ControladoraPresentacion.php';

$controladora = new PresentacionController();

$data = isset($_GET["data"]) ? $controladora->getSearchEliminated($_GET["data"]) : $controladora->getAllEliminated();

?>

<?php if (!empty($data)): ?>
<table border="1">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Descripcion</th>
            <th>Accion</th>
            
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $key) { ?>
            <tr>
                
                <td> <?php echo htmlspecialchars($key['tbpresentacionombre'], ENT_QUOTES, 'UTF-8'); ?> </td>
                <td> <?php echo htmlspecialchars($key['tbpresentaciondescripcion'], ENT_QUOTES, 'UTF-8'); ?> </td>

                <td >
                        <div style="justify-content: space-between; display: flex;">
                            <button style="cursor: pointer; " type="button" onclick="recuperarPresentacion('<?php echo htmlspecialchars($key['tbpresentacionidentificador'], ENT_QUOTES, 'UTF-8'); ?>')">Recuperar</button>
                        </div>
                </td>
            </tr>
        <?php 
        
        }
        ?>
    </tbody>
</table>
<?php else: ?>
    <p>No hay presentaciones eliminadas.</p>
<?php endif; ?>