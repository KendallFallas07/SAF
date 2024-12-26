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
<form action="../business/accionCategoriaCrear.php" method="POST" id='createCat'>
<div class="form-father">
    <input type="hidden" id="identifier" name="identifier"  readonly>

    <div class="form-group">
    <label for="nameCat">Nombre</label>
    <input type="text" id="nameCat" autocomplete="off" name="nameCat" placeholder="Nombre" required>
    <span style="visibility: hidden;" id="message"></span>
    </div>

    <div class="form-group">
    <label for="descriptionCat">Descripcion</label>
    <input type="text" id="descriptionCat" name="descriptionCat" placeholder="Descripcion">
    </div>

</div>
<input type="submit" value="Guardar"style="visibility: visible;" id="btn-save" onclick='saveCategory(event, "createCat")'>
    <button style="cursor: pointer; visibility: hidden;" id="btn-finish" onclick='editData(event, "createCat")'>Aceptar edicion </button>
    <button style="cursor: pointer; visibility: hidden;" id="btn-cancel" onclick='cancel(event)'>Cancelar</button>
</form>

<button id="btn-viewDisable"  type="button">Ver Categorias eliminadas</button>