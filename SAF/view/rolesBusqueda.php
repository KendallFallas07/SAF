<?php ?>
<style>
    .container-search {
        display: flex;
        flex-direction: row;
        justify-content: flex-end;
        align-items: center;
    }
    .container-search form {
        display: grid;
    }
</style>
<div class="container-search">
    <form id="searchForm" method="get" action="roles.php">
        <label for="search">Busqueda:</label>
        <span>
            <input type="search" id="search" name="data">
            <input type="submit" value="Buscar">
        </span>
    </form>
</div>

