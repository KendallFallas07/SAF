<!DOCTYPE html>
<hr>
<form method="POST" action="../business/accionImpuestoNuevo.php" autocomplete="off" id="save">
    <span>
        <label for="name">Nombre</label>
        <input type="text" id="name" name="name" title="Solo se permiten letras" pattern="[a-zA-Z\s]+" placeholder="Ingrese un nombre" required autocomplete="off">
    </span>
    <span>
        <label for="description">Descripcion</label>
        <input type="text" id="description" name="description" placeholder="(Opcional)">
    </span>
    <span >
        <label for="value">Valor</label>
        <input type="number" id="value" name="value" placeholder="0 y 100" min="0" max="100" step="0.01" />
    </span>
    <span>
        <label for="date">Vigencia</label>
        <input type="date" id="date" name="date" placeholder="Vigencia" />
    </span>
    <span>
        <button type="button" id="boton-cargar">Agregar impuesto</button>
    </span>
    <span>
        <button type="button" id="boton-cancelar">Cancelar edición</button>
    </span>
    <span>
        <input type="hidden" id="idAModificar" name="idAModificar" value="">
    </span>

</form>