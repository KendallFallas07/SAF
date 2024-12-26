
<?php
include_once "../domain/Lote.php";
include_once "../business/ControladoraLote.php";

$conn = new LoteController();

$loteListeGeneral = [];

if (isset($_GET["data"])&&!empty($_GET["data"])) {
    $data = $conn->getSearch($_GET["data"]);

    foreach ($data as $lote) {
        $objLote = new Lote(
                $lote['tbloteid'],
                $lote['tbloteidentificador'],
                $lote['tbproductoidentificador'],
                $lote['tblotecantidadadquirida'],
                $lote['tblotecantidadactual'],
                $lote['tblotepreciocompra'],
                $lote['tblotefechaadquisicion'],
                $lote['tblotefechaexpiracion'],
                $lote['tblotefechacreacion'],
                $lote['tblotefechamodificacion'],
                $lote['tbloteestado']
        );
  
        $nameProduct = $conn->prueba($objLote->getTbProductoId());
        $objLote->setTbProductoId($nameProduct);
       
        $loteListeGeneral[] = $objLote;
  //      $loteListeGeneral[] = $lote;
    }
    //var_dump($loteListeGeneral);
} else {
    $loteList = $conn->getAll();
    
    foreach ($loteList as $lote) {

        $objLote = new Lote(
                $lote['tbloteid'],
                $lote['tbloteidentificador'],
                $lote['tbproductoidentificador'],
                $lote['tblotecantidadadquirida'],
                $lote['tblotecantidadactual'],
                $lote['tblotepreciocompra'],
                $lote['tblotefechaadquisicion'],
                $lote['tblotefechaexpiracion'],
                $lote['tblotefechacreacion'],
                $lote['tblotefechamodificacion'],
                $lote['tbloteestado']
        );
  
        $nameProduct = $conn->prueba($objLote->getTbProductoId());
        $objLote->setTbProductoId($nameProduct);
       
        $loteListeGeneral[] = $objLote;
    }
}


/*
  $lotes = [];
  foreach ($loteList as $lote) {
  // Suponiendo que $lote es un array asociativo
  $id = $lote['tbloteid'];
  $lotes[$id] = $lote;
  } */
?>

<?php if (!empty($loteListeGeneral)): ?>
    <table border="1" cellpadding="1" id="datatable">
        <thead>
            <tr>
                <th hidden="true">Identificador</th>
                <th>Producto</th>
                <th>Cantidad Adquirida</th>
                <th>Cantidad Actual</th>
                <th>Fecha de la compra</th>
                <th>Fecha de expiración</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
    <?php foreach ($loteListeGeneral as $key): ?>

                <tr>
                    <td hidden="true"><?php echo htmlspecialchars($key->getIdentificador(), ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($key->getTbProductoId(), ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($key->getCantidadAdquirida(), ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($key->getCantidadActual(), ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($key->getFechaAdquisicion(), ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($key->getFechaExpiracion(), ENT_QUOTES, 'UTF-8'); ?></td>
                    <td style="width: 150px;">
                        <div style="justify-content: space-between; display: flex;">
                            <button style="cursor: pointer; flex: 0 0 49%;" type="button"
                                    onclick="selectLote('<?php echo htmlspecialchars($key->getIdentificador(), ENT_QUOTES, 'UTF-8'); ?>')"
                                    title="No disponible">Editar</button>
                            <button style="cursor: pointer; flex: 0 0 49%;" type="button"
                                    onclick="deleteLote('<?php echo $key->getIdentificador(); ?>')">Eliminar</button>
                        </div>
                    </td>
                </tr>
    <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No hay Lotes registrados.</p>
<?php endif; ?>

<script>


    function selectLote(identifierLote) {
    document.getElementById('btn-save').style.visibility = "hidden";
    document.getElementById('btn-finish').style.visibility = "visible";
    document.getElementById('btn-cancel').style.visibility = "visible";
    fetch(`../business/accionLoteEditar.php?identifierLote=${encodeURIComponent(identifierLote)}`, {
    method: 'GET'
    })


        .then(response => response.json())
        .then(data => {

  
           

            if (data.Lote && data.Lote.name) {
                document.querySelector('input[name="identifier"]').value = data.Lote.identifier;
   
                document.querySelector('select[name="producto"]').value = data.Lote.name;

                document.querySelector('input[name="cantAdq"]').value = data.Lote.cantidadAd;
 
                document.querySelector('input[name="precCom"]').value = data.Lote.precioCompra;

                document.querySelector('input[name="fechAdq"]').value= data.Lote.fechaAdquisicion;
                document.querySelector('input[name="fechExp"]').value= data.Lote.fechaExpiracion;
                manejarEdicion();
  
            } else {
                alert('No se encontraron datos del lote.');
            }
 
        })

    .catch(error => {
    console.error('Error:', error);
    });
  
    }


</script>
