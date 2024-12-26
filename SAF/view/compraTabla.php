<!DOCTYPE html>
<?php

include_once "../business/ControladoraCompra.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$conn = new CompraController();

$supplierList = $conn->getAllSuppliers();
$data = isset($_GET["data"]) ? $conn->getSearch($_GET["data"]) : $conn->getAll();

$suppliers = [];
foreach ($supplierList as $supplier) {
    $id = $supplier->getId();
    $suppliers[$id] = $supplier;
}

?>

<?php if (!empty($data)): ?>
    <table border="1" cellpadding="1" id="datatable">
        <thead>
            <tr>
                <th>Proveedor</th>
                <th>Método de pago</th>
                <th>Notas</th>
                <th>Fecha de la compra</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $key): ?>
                <tr>
                    <td> 
                        <?php 
                            $proveedorController = new ControladoraProveedor();
                            $proveedor = $proveedorController->findByIdentifier($key['tbcompraidentificadorproveedor']);
                        
                            if($proveedor) {
                                echo htmlspecialchars($proveedor->getName(), ENT_QUOTES, 'UTF-8');
                            } else {
                                echo htmlspecialchars("N/A", ENT_QUOTES, 'UTF-8');
                            }
                            
                        ?> 
                    </td>
                    <td> <?php echo htmlspecialchars($key['tbcomprametodopago'], ENT_QUOTES, 'UTF-8'); ?> </td>
                    <td> <?php echo htmlspecialchars($key['tbcompranotas'], ENT_QUOTES, 'UTF-8'); ?> </td>
                    <td> <?php echo htmlspecialchars($key['tbcomprafecha'], ENT_QUOTES, 'UTF-8'); ?> </td>

                    <td style="width: 150px;">
                        <div style="justify-content: space-between; display: flex;">
                            <button style="cursor: pointer; flex: 0 0 49%;" type="button" onclick="ModifyBuy('<?php echo htmlspecialchars($key['tbcompraidentificador'], ENT_QUOTES, 'UTF-8'); ?>')">Editar</button>
                            <button style="cursor: pointer; flex: 0 0 49%;" type="button" onclick="deleteBuy('<?php echo htmlspecialchars($key['tbcompraidentificador'], ENT_QUOTES, 'UTF-8'); ?>')">Eliminar</button>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No hay compras registradas.</p>
<?php endif; ?>
