<?php
require_once '../business/ControladoraPresentacion.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$controladora = new PresentacionController();

$data = isset($_GET["data"]) ? $controladora->getSearch($_GET["data"]) : $controladora->getAll();


?>

<?php if (!empty($data)): ?>
<table border="1">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Descripcion</th>
            <th>Acciones</th>
            
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $key) { ?>
            <tr>
                
                <td> <?php echo htmlspecialchars($key['tbpresentacionombre'], ENT_QUOTES, 'UTF-8'); ?> </td>
                <td> <?php echo htmlspecialchars($key['tbpresentaciondescripcion'], ENT_QUOTES, 'UTF-8'); ?> </td>

                <td style="width: 150px;">
                        <div style="justify-content: space-between; display: flex;">
                            <button style="cursor: pointer; flex: 0 0 49%;" type="button" onclick="modificarPresentacion('<?php echo htmlspecialchars($key['tbpresentacionidentificador'], ENT_QUOTES, 'UTF-8'); ?>')">Editar</button>
                            <button style="cursor: pointer; flex: 0 0 49%;" type="button" onclick="eliminarPresentacion('<?php echo htmlspecialchars($key['tbpresentacionidentificador'], ENT_QUOTES, 'UTF-8'); ?>')">Eliminar</button>
                        </div>
                    </td>
            </tr>
        <?php 
        
        }
        ?>
    </tbody>
</table>
<?php else: ?>
    <p>No hay presentaciones registradas.</p>
<?php endif; ?>