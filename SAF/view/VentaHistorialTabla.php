<?php
include_once "../business/ControladoraVentaHistorial.php";
require_once './validacionRutas.php';
$conn = new ControladoraVentaHistorial();


// Obtener el identificador del usuario (puedes pasarlo por GET o como necesites)
$identificadorUsuario = $_SESSION["identificador"];

// Obtener los datos antes de intentar mostrarlos
$venHisListaGeneral = $conn->obtenerDatosUsuario($identificadorUsuario);

if (!empty($venHisListaGeneral)): ?>
    <table border="1" cellpadding="1" id="datatable">
        <thead>
            <tr>
                <th>Fecha de Venta</th>
                <th>Productos</th>
                <th>Cantidades</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($venHisListaGeneral as $venta): ?>
                <tr>
                    <td><?php echo htmlspecialchars($venta['fecha'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td>
                        <?php 
                        $nombresProductos = array_map(function($producto) {
                            return htmlspecialchars($producto['tbproductonombreproducto'], ENT_QUOTES, 'UTF-8');
                        }, $venta['productos']);
                        echo implode("<br>", $nombresProductos);
                        ?>
                    </td>
                    <td>
                        <?php 
                        $cantidades = array_map(function($producto) {
                            return htmlspecialchars($producto['tbventacantidadproducto'], ENT_QUOTES, 'UTF-8');
                        }, $venta['productos']);
                        echo implode("<br>", $cantidades);
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No hay ventas registradas para este usuario.</p>
<?php endif; ?>
  