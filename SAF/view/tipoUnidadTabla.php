<style>


.father {
    display: flex;
    justify-content: space-between; /* Space between the two child elements */
    padding: 20px; /* Optional: Add some padding around the container */
}

/* Style for the left div */
#disable-table {
    flex: 1; /* Adjusts the width of the left div */
    margin-right: 10px; /* Optional: Space between the two divs */
}

/* Style for the right div */
#list-similar {
    flex: 1; /* Adjusts the width of the right div */
    margin-left: 10px; /* Optional: Space between the two divs */
}

</style>

<div class="father">
<div>
<h4 id="title-table">Tipo de unidades Activos</h4>
<table border="1" cellpadding="1" id="datatable">
        <thead>
            <tr>
                <th>Nombre </th>
                <th>Descripcion</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($UnitList as $unit): ?>
                <tr>
                    <td> <?php echo ($unit->getNameUnit()); ?> </td>
                    <td> <?php echo ($unit->getDescriptionUnit()); ?> </td>
                    <td style="width: 150px;">
                        <div style="justify-content: space-between; display: flex;">
                            <button style="cursor: pointer; flex: 0 0 49%;" type="button" onclick="selectUnitType('<?php echo ($unit->getIdentifierTU()); ?>')">Editar</button>
                            <button style="cursor: pointer; flex: 0 0 49%;" type="button"
                                onclick="deleteUnitType('<?php echo ($unit->getIdentifierTU()); ?>')">Eliminar</button>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>


<div id="list-similar" style="visibility: hidden;">
<h4>Medidas asociadas a este tipo de unidad</h4>
<div id="listaSimilarfather">
     <ul id="listaSimilar"></ul>
</div>

</div>

</div>







   