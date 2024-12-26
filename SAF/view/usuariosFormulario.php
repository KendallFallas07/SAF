<?php
require_once "../business/ControladoraUsuarios.php";
?>

<hr>
<h5 id="info" hidden >prueba de manejo de errores</h5>
<form action="../business/accionUsuariosNuevo.php" method="post" id="save" enctype="multipart/form-data">
    <div>
        <input type="text" id="ident" name="identificador" hidden >
    </div>
    <div class="div-modal-data">
        <label for="nombreusuario">Nombre de Usuario:</label>
        <label hidden="true" for="nombreusuario">Ingrese un nombre de Usuario</label>
        <input type="text" id="nombreusuario" name="nombreusuario" placeholder="nombre de usuario" required="true" onchange="checkNombreUsuario()">
        <label hidden="true" for="nombreusuario">error</label>
    </div>
    <div class="div-modal-data">
        <label for="email">Email:</label>
        <label hidden="true" for="email">Ingrese un correo electronico valido</label>
        <input type="email" id="email" name="email" placeholder="correo electronico" autocomplete="true" required="true" onchange="checkEmail()">
        <label hidden="true" for="email">error</label>
    </div>
    <div class="div-modal-data">
        <label for="contrasena">Contraseña:</label>
        <label hidden="true" for="contrasena">Ingrese una Contraseña valida</label>
        <input type="password" id="contrasena" name="contrasena" placeholder="Contraseña" required="true">
        <label hidden="true" for="contrasena">error</label>
    </div>
    <div class="div-modal-data" id="checkempresa">
        <label for="esempresa">Es una empresa:</label>
        <label hidden="true" for="esempresa">Seleccione una opcion:</label>
        <input type="checkbox" id="esempresa" name="esempresa" onclick="isEmpresa()">
        <label hidden="true" for="esempresa">error</label>
    </div>
    <div class="div-modal-data" id="siempresanombre">
        <label for="empresa" hidden="true" >Ingrese el nombre de la empresa :</label>
        <label hidden="true" for="empresa">Seleccione una opcion:</label>
        <input hidden="true" type="text" id="empresa" name="empresa" placeholder="nombre de la empresa">
        <label hidden="true" for="empresa">error</label>
    </div>
    <div class="div-modal-data" id="noempresanombre">
        <label for="nombre">Ingrese el nombre :</label>
        <label hidden="true" for="nombre">Seleccione una opcion:</label>
        <input type="text" id="nombre" name="nombre" placeholder="nombre">
        <label hidden="true" for="nombre">error</label>
    </div>
    <div class="div-modal-data" id="noempresaapellidos" >
        <label for="apellidos">Ingrese los apellidos :</label>
        <label hidden="true" for="apellidos">Ingrese un valor valido:</label>
        <input type="text" id="apellidos" name="apellidos" placeholder="apellidos">
        <label hidden="true" for="apellidos">error</label>
    </div>
    <div class="div-modal-data">
        <label for="rol">Ingrese un rol :</label>
        <label hidden="true" for="rol">Seleccione un rol valido:</label>
        <select name="rol" id="rol">
            <option value="first" selected="true" disabled="true" label="selecione un rol"></option>
            <?php
            //llamada a la controller
            $controller = new ControladoraUsuarios();
            $data = $controller->getAllRol();
            //recorrido de datos
            foreach ($data as $key => $value) {
                $identificador;
                $nombre;
                foreach ($value as $keyf => $valuef) {
                    if ($keyf == "tbrolidentificador") {
                        $identificador = $valuef;
                    }
                    if ($keyf == "tbrolnombre") {
                        $nombre = $valuef;
                    }
                }
                echo "<option value='$identificador' label='$nombre' ></option>";
            }
            ?>
        </select>
        <label hidden="true" for="rol">error</label>
    </div >
    <div class="div-modal-data">
        <label for="foto">Ingrese una foto de perfil :</label>
        <label hidden="true" for="foto">Ingrese una imagen:</label>
        <input type="file" id="foto" name="foto" accept="image/png,image/jpeg,/image/webp">
        <img src="" width="0" height="0"/>
        <label hidden="true" for="foto">error</label>
    </div>
    <div class="div-modal-data">
        <label for="telefono">Ingrese un numero de telefono :</label>
        <label hidden="true" for="telefono">Ingrese un valor valido:</label>
        <input type="tel" id="telefono" name="telefono" placeholder="telefono">
        <label hidden="true" for="telefono">error</label>
    </div>
    <div class="div-modal-data">
        <label for="direccion" >Direccion:</label>
        <textarea id="direccion" name="direccion" rows="5" cols="50"></textarea>
    </div>
    <div class="div-modal-data">
        <input type="submit" value="Crear" id="btn-save" onclick="saveData(event, 'save')">
    </div>
    <div class="div-modal-data">
        <input type="button" value="Editar" id="btn-edit" onclick="editSave('save',)">
    </div>
</form>
<hr>

