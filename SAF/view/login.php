<!-- inicio de session -->
<dialog onkeydown="handleKeyDown(event)" id="modal-login">
    <form action="../business/actionUsuariosValidador.php" method="post" id="login">
        <div>
            <label for="user" >Nombre de usuario  /  Email</label>
            <input type="text" id="user" name="user">
            <label for="user" hidden="true">error</label>
        </div>
        <div>
            <label for="pass" >Contrasena</label>
            <input type="password" id="pass" name="pass">
            <label for="pass" hidden="true" id="error-login" >error</label>
        </div>
        <span class="class">
            <input type="button" value="Iniciar Sesion" onclick="validateLogin()">
        </span>
        <span class="class">
            <a href="" >olvide mi contrasena</a>
            <a href="" >crear nuevo usuario</a>
        </span>
    </form>
</dialog>