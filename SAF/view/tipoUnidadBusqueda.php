<style>
    .div-search{
        text-align: right;
        display: flex;
        flex-direction: row-reverse;
        flex-wrap: nowrap;
        align-items: center;
    }
    .div-search label {
        display: grid;
        justify-content: start;
    }
</style>
<div class="div-search">
    <form>
        <datalist id="autocomplete">
        </datalist>
        <label for="search">Buscar</label>
        <input type="text" name="search" id="search" placeholder="Buscar Tipo Unidad" list="autocomplete">
        <button type="button" id="btn-search" onclick="buscarPalabra()">Buscar</button>
    </form>
</div>


