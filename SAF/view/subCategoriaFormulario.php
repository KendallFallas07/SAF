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

    .div-search{
        text-align: right;
        }

        #search{
            width: 175px;
        }

       

        #listaDiv{
            text-align: left;
            position: fixed; 
            right: 0; 
            margin-right: 70px;
            margin-top: -8px;
        }

        ul {
            
            list-style-type: none;
            width: 175px;
            height: 10px;
        }

        li {
            background-color: #EEEEEE;
            border-top: 1px solid #ffff;
            padding: 6px;
            cursor: pointer;
        }
</style>

<form class="div-search">
<datalist id="autocomplete">
</datalist>
        <label for="search">Buscar:</label>
        <input type="search" name="search" id="search" list="autocomplete">
        <button type="button" onclick="enviarBuscadorAuto()">Buscar</button>
</form>


<form action="../business/accionSubcategoriaCrear.php" method="POST" id='createsubCat'>
<div class="form-father">
    <input type="hidden" id="identifier" name="identifier"  readonly>
    <div class="form-group">
    <label for="categorySelect">Seleccionar Categoria:</label>
    <select name="categorySelect" id="categorySelect">
<option label="Seleccione la categoria" selected="true" disabled="true" value="N/A"></option>
            <?php
            include_once '../business/ControladoraCategoria.php';
            $controller = new ControladoraCategoria();
            $categoriesList=$controller->getAllCategories();
            foreach ($categoriesList as $category ) {
                $ident = (string) $category-> getIdentifierCat();
                $name = htmlspecialchars($category->getNameCategory());
                echo "<option value=\"$ident\">$name</option>";
            }
            ?>
</select>
</div>


    <div class="form-group">
    <label for="nameSubCat">Nombre</label>
    <input type="text" id="nameSubCat" autocomplete="off" name="nameSubCat" placeholder="Nombre" required>
    <span id="message" style="visibility: hidden;" ></span>
    </div>

    <div class="form-group">
    <label for="descriptionSubCat">Descripcion</label>
    <input type="text" id="descriptionSubCat" name="descriptionSubCat" placeholder="Descripcion">
    </div>
   
</div>
<input type="submit" value="Guardar"style="visibility: visible;" id="btn-save" onclick='saveSubcategory(event, "createsubCat")'>
    <button style="cursor: pointer; visibility: hidden;" id="btn-finish" onclick='editData(event, "createsubCat")'>Aceptar edicion</button>
    <button style="cursor: pointer; visibility: hidden;" id="btn-cancel" onclick='cancel(event)'>Cancelar</button>
</form>

<hr>
<button id="btn-viewDisableSub"  type="button">Ver subCategorias eliminadas</button>