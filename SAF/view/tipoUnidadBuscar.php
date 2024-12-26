
<style>
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
<label for="searchUnit">Buscar</label>
<input type="text" name="search" id="search" placeholder="Buscar Tipo Unidad" list="autocomplete">
<button type="button" id="btn-search" onclick="buscarPalabra()">Buscar</button>

</form>

