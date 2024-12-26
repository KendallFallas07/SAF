<?php ?>
<style>
    .container-form form {
        display: flex;
        align-content: center;
    }
    .container-form form div {
        display: grid;
        margin: 2ch;
        justify-items: center;
    }
</style>
<div class="container-form">
    <form id="container" action="../business/accionRolNuevo.php" method="post">
        <div>
            <label for="name">Nombre de Rol:</label>
            <input type="text" id="name"  name="nombre" autocomplete="off">
            <label hidden="true" for="name" >error</label>
        </div>
        <div >
            <label for="description">Descripcion:</label>
            <input type="text" name="descripcion" id="description" autocomplete="off">
            <label hidden="true" for="description">error</label>
        </div>
        <div id="id-save">
            <label for="save">Guardar:</label>
            <input type="submit" id="save" value="Guardar Rol" onclick="saveData(event, 'container')"  >
            <label hidden="true" for="save">error</label>
        </div>
        <div id="id-edit" style="visibility: hidden">
            <label for="save">Guardar:</label>
            <input type="button" id="btn-edit" value="Modificar Rol"  >
            <label hidden="true" for="save">error</label>
        </div>
    </form>
</div>

<!-- -->