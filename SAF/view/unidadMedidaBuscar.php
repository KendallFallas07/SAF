<?php ?>
<style>
    .div-search {
        display: flex;
        flex-direction: row-reverse;
    }
    .div-search label {
        display: grid;
        justify-content: start;
    }
</style>
<script defer="true">
    async function autocompleteSearch() {

        //soliciotar los datos segun lo que haya escrito
        valor = document.getElementById("search").value;
        //si esta vacio no muestro nada sino traigo los registros asociados
        if (valor === "") {
            document.getElementById("list").innerHTML = "";
        } else {
            data = new URLSearchParams();
            data.append("search", valor);
            headers = {'Content-Type': 'application/x-www-form-urlencoded'};
            options = {method: "POST", body: data, headers};
            response = await fetch("../business/accionUnidadMedidaBuscar.php", options).then(
                    function (response) {
                        return response.json(); // Convierte la respuesta a JSON
                    }).then(
                    function (data) {
                        dataFinal = "";
                        for (var i = 0; i < data.length; i++) {
                            value = data[i]["tbunidadmedidanombreunidad"];
                            dataFinal += `<option value='${value}'>${value}</option>`;
                        }
                        document.getElementById("list").innerHTML = dataFinal;
                    }).catch(
                    function (error) {
                        alert(error);
                    });
        }
    }
</script>
<hr>
<div class="div-search">
    <form action="unidadMedida.php" method="get">
        <datalist id="list"></datalist>
        <label>Busqueda:</label>
        <input type="search" id="search" name="search" list="list" onkeyup="autocompleteSearch()">
        <input type="submit" value="Buscar">
    </form>
</div>
