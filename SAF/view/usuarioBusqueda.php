<?php ?>
<div id="container-form">
    <form action="usuario.php" id="searchForm" method="get">
        <datalist id="autocomplete">
        </datalist>
        <label for="search" >Busqueda:</label>
        <span>
            <input type="search" id="search" name="data" onkeyup="autocompleteSearch()" list="autocomplete">
            <input type="submit" value="Buscar">
        </span>

    </form>
</div>