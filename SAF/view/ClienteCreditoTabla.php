<!DOCTYPE html>
<?php
include_once "../business/ControladoraCreditoCliente.php";

$controladora = new ClienteCreditoControladora();

$usuarios = $controladora->obtenerClientes();

$data = isset($_GET["data"]) ? $controladora->getSearch($_GET["data"]) : $controladora->getAll();

$usuariosMap = [];
foreach ($usuarios as $usuario) {
    $usuariosMap[$usuario['id']] = $usuario['nombre'] . " " . $usuario['apellidos'];
}
?>

<?php if (!empty($data)): ?>
    <table border="1" cellpadding="1" id="datatable">
        <thead>
            <tr>
                <th>Cliente</th>
                <th>Cantidad del crédito</th>
                <th>Porcentaje del crédito</th>
                <th>Plazo del crédito</th>
                <th>Inicio del crédito</th>
                <th>Vencimiento del crédito</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>

            <?php foreach ($data as $key): ?>

                <tr>
                    <td> 
                        <?php
                        $clienteId = $controladora->ObtenerIdClientePorIdentificador($key['tbclienteidentificador']);
                        echo htmlspecialchars($usuariosMap[$key['tbclienteidentificador']], ENT_QUOTES, 'UTF-8');
                        ?>
                    </td>
                    <td> <?php echo htmlspecialchars($key['tbclientecreditocantidad'], ENT_QUOTES, 'UTF-8'); ?> </td>
                    <td> <?php echo htmlspecialchars($key['tbclientecreditoporcentaje'], ENT_QUOTES, 'UTF-8'); ?> </td>
                    <td> <?php echo htmlspecialchars($key['tbclientecreditoplazo'], ENT_QUOTES, 'UTF-8'); ?> </td>
                    <td> <?php echo htmlspecialchars($key['tbclientecreditofechainicio'], ENT_QUOTES, 'UTF-8'); ?> </td>
                    <td> <?php echo htmlspecialchars($key['tbclientecreditofechavencimiento'], ENT_QUOTES, 'UTF-8'); ?> </td>

                    <td style="width: 150px;">
                        <div style="justify-content: space-between; display: flex;">
                            <button style="cursor: pointer; flex: 0 0 49%;" type="button" onclick="modificarClienteCredito('<?php echo htmlspecialchars($key['tbclientecreditoidentificador'], ENT_QUOTES, 'UTF-8'); ?>')">Editar</button>
                            <button style="cursor: pointer; flex: 0 0 49%;" type="button" onclick="eliminarClienteCredito('<?php echo htmlspecialchars($key['tbclientecreditoidentificador'], ENT_QUOTES, 'UTF-8'); ?>')">Eliminar</button>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No hay creditos registrados.</p>
<?php endif; ?>