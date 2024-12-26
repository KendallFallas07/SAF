<form action="../business/accionPresentacionNuevo.php" method="POST" id="guardar">
    <span>
        <label for="name">Nombre</label>
        <input type="text" id="name" name="name" title="Solo se permiten letras" pattern="[a-zA-Z\s]+" placeholder="Ingrese un nombre" required autocomplete="off">
    </span>
    <span>
        <label for="description">Descripcion</label>
        <input type="text" id="description" name="description" placeholder="(Opcional)">
    </span>
    <span>
        <button type="button" id="boton-cargar">Agregar presentación</button>
    </span>
    <span>
        <button type="button" id="boton-cancelar">Cancelar edición</button>
    </span>
    <span>
        <input type="hidden" id="idAModificar" name="idAModificar" value="">
    </span>
</form>