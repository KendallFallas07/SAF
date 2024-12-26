
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


<form action="../business/accionMargenGananciaCrear.php" method="POST" id='createMg'>
<div class="form-father">
    <input type="hidden" id="identifier" name="identifier"  readonly>

    <div class="form-group">
    <label for="loteSelect">Seleccionar Lote:</label>
    <select name="loteSelect" id="loteSelect" required>
<option label="Seleccione el lote" selected="true" disabled="true" value="ss"></option>
            <?php
        
           include_once '../business/ControladoraMargenGanancia.php';
           $controller = new ControladoraMargenGanancia();
           $loteList=$controller->getAllLotes();
           foreach ($loteList as $lote ) {
               $ident = (string) $lote-> getIdentificador();
               $name = htmlspecialchars($lote->getTbProductoName());
               echo "<option value=\"$ident\">$name</option>";
           }
            ?>
</select>
</div>

    <div class="form-group">
    <label for="porcentaje">Porcentaje</label>
    <input type="number" step="0.01" min="0" id="porcentaje" name="porcentaje" placeholder="agregar porcentaje, minimo 0,01">
    </div>

</div>
<input type="submit" value="Guardar"style="visibility: visible;" id="btn-save" onclick='saveMargen(event, "createMg")'>
    <button style="cursor: pointer; visibility: hidden;" id="btn-finish" onclick='editData(event, "createMg")'>Aceptar edicion </button>
    <button style="cursor: pointer; visibility: hidden;" id="btn-cancel" onclick='cancel(event)'>Cancelar</button>
</form>
