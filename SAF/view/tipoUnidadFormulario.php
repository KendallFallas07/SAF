<style>
    .form-group {
        display: flex;
        flex-direction: column; 
        margin-right: 10px; 
    }

    .form-father {
        display: flex;
        flex-wrap: wrap;
    }

    
</style>
<form action="../business/accionTipoUnidadCrear.php" method="POST" id='createUnit'>
<div class="form-father">
    <input type="hidden" id="identifier" name="identifier"  readonly>

    <div class="form-group">
    <label for="nameUnit">Nombre</label>
    <input type="text" autocomplete="off" id="nameUnit" name="nameUnit" placeholder="Digite el nombre" required>
    <span id="message" style="visibility: hidden;" ></span>
    </div>

    <div class="form-group">
    <label for="descriptionUnit">Descripcion</label>
    <input type="text" id="descriptionUnit" name="descriptionUnit" placeholder="Digite la descripcion">
    </div>

</div>
<input type="submit" value="Guardar"style="visibility: visible;" id="btn-save" onclick='saveUnitType(event,"createUnit")'>
    <button style="cursor: pointer; visibility: hidden;" id="btn-finish" onclick='editData(event, "createUnit")'>Aceptar edicion</button>
    <button style="cursor: pointer; visibility: hidden;" id="btn-cancel" onclick='cancel(event)'>Cancelar</button>
</form>
<hr>
<button id="btn-viewDisableUnit"  type="button">Ver Unidades eliminadas</button>
