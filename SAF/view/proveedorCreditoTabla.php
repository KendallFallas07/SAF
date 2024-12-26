
<?php
include_once "../domain/ProveedorCredito.php";
include_once "../business/ControladoraProveedorCredito.php";

$conn = new ProveedorCreditoController();

$proCreListaGeneral = [];

if (isset($_GET["data"])&&!empty($_GET["data"])) {
    $data = $conn->getSearch($_GET["data"]);
    foreach ($data as $proveedorCredito) {
        $objproCre= new ProveedorCredito(
                $proveedorCredito['tbproveedorcreditoid'],
                $proveedorCredito['tbproveedorid'],
                $proveedorCredito['tbproveedorcreditoidentificador'],
                $proveedorCredito['tbproveedorcreditocantidadcredito'],
                $proveedorCredito['tbproveedorcreditoporcentaje'],
                $proveedorCredito['tbproveedorcreditoplazo'],
                $proveedorCredito['tbproveedorcreditofechainicio'],
                $proveedorCredito['tbproveedorcreditofechavencimiento'],
                $proveedorCredito['tbproveedorcreditofechacreacion'],
                $proveedorCredito['tbproveedorcreditofechamodificacion'],
                $proveedorCredito['tbproveedorcreditoestado']
        );
        $nameProveedor = $conn->buscarNombreProveedorPorIdentificador($objproCre->getTbproveedorid());
        $objproCre->setTbproveedorid($nameProveedor);
        $proCreListaGeneral[] = $objproCre;
        //$proCreListaGeneral[] = $proveedorCredito;
    }
} else {
    $proCreList = $conn->obtenerTodosLosProveedoresCredito();
    foreach ($proCreList as $proveedorCredito) {

        $objproCre= new ProveedorCredito(
                $proveedorCredito['tbproveedorcreditoid'],
                $proveedorCredito['tbproveedorid'],
                $proveedorCredito['tbproveedorcreditoidentificador'],
                $proveedorCredito['tbproveedorcreditocantidadcredito'],
                $proveedorCredito['tbproveedorcreditoporcentaje'],
                $proveedorCredito['tbproveedorcreditoplazo'],
                $proveedorCredito['tbproveedorcreditofechainicio'],
                $proveedorCredito['tbproveedorcreditofechavencimiento'],
                $proveedorCredito['tbproveedorcreditofechacreacion'],
                $proveedorCredito['tbproveedorcreditofechamodificacion'],
                $proveedorCredito['tbproveedorcreditoestado']
        );
        $nameProveedor = $conn->buscarNombreProveedorPorIdentificador($objproCre->getTbproveedorid());
        $objproCre->setTbproveedorid($nameProveedor);
        $proCreListaGeneral[] = $objproCre;
    }
}

?>

<?php if (!empty($proCreListaGeneral)): ?>
    <table border="1" cellpadding="1" id="datatable">
        <thead>
            <tr>
                <th hidden="true">Identificador</th>
                <th>Proveedor</th>
                <th>Cantidad De Credito</th>
                <th>Porcentaje</th>
                <th>Plazo</th>
                <th>Fecha Inicio</th>
                <th>Fecha de expiración</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
    <?php foreach ($proCreListaGeneral as $key): ?>

                <tr>
                    <td hidden="true"><?php echo htmlspecialchars($key->getProveedorCId(), ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($key->getTbproveedorid(), ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($key->getProveedorCCantidadCredito(), ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($key->getProveedorCPorcentaje(), ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($key->getProveedorCPlazo(), ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($key->getProveedorCFechaInicio(), ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($key->getProveedorCFechaVencimiento(), ENT_QUOTES, 'UTF-8'); ?></td>
                    <td style="width: 150px;">
                        <div style="justify-content: space-between; display: flex;">
                            <button style="cursor: pointer; flex: 0 0 49%;" type="button"
                                    onclick="select('<?php echo htmlspecialchars($key->getProveedorCIdentificador(), ENT_QUOTES, 'UTF-8'); ?>')"
                                    title="No disponible">Editar</button>
                            <button style="cursor: pointer; flex: 0 0 49%;" type="button"
                                    onclick="deleteP('<?php echo $key->getProveedorCIdentificador(); ?>')">Eliminar</button>
                        </div>
                    </td>
                </tr>
    <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No hay Creditos registrados.</p>
<?php endif; ?>

    <script>


    function select(identificador) {
    document.getElementById('btn-save').style.visibility = "hidden";
    document.getElementById('btn-finish').style.visibility = "visible";
    document.getElementById('btn-cancel').style.visibility = "visible";
    fetch(`../business/accionProveedorCreditoEditar.php?identificadorProCre=${encodeURIComponent(identificador)}`, {
    method: 'GET'
    })


        .then(response => response.json())
        .then(data => {

  
           

            if (data.ProveedorCredito) {
                document.querySelector('input[name="identifier"]').value = data.ProveedorCredito.identificador;
   
                document.querySelector('select[name="proveedor"]').value = data.ProveedorCredito.tbproveedorid;

                document.querySelector('input[name="cantCre"]').value = data.ProveedorCredito.cantidadCredito;
 
                document.querySelector('input[name="porcentaje"]').value = data.ProveedorCredito.porcentaje;

                document.querySelector('input[name="plazo"]').value = data.ProveedorCredito.plazo;
                document.querySelector('input[name="fechIni"]').value= data.ProveedorCredito.fechaInicio;
                document.querySelector('input[name="fechExp"]').value= data.ProveedorCredito.fechaVencimiento;
                manejarEdicion();
  
            } else {
                alert('No se encontraron datos del Credito.');
            }
 
        })

    .catch(error => {
    console.error('Error:', error);
    });
    }


</script>
