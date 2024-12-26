<?php
require_once './validacionRutas.php';

include_once "../business/ControladoraTipoProveedor.php";
include_once "../business/ControladoraProveedor.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$proveedorContoller = new ControladoraProveedor();
// Obtener los proveedores para la tabla
$proveedores = $proveedorContoller->getAllSuppliers();

$supplierTypesController = new ControladoraTipoProveedor();
$supplierTypes = $supplierTypesController->getAllTypeSupplier();
?>
<style>
    form#proveedorForm {
        display: flex;
        flex-direction: row;
        align-items: center;
    }
    form#proveedorForm span {
        display: grid;
        align-content: center;
        justify-content: center;
        align-items: center;
        justify-items: center;
        margin: 2ch;
    }
    table#datatable {
        width: -webkit-fill-available;
    }
    span.seach-filter {
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        align-items: center;
        justify-content: flex-end;
    }
    span.seach-filter span {
        display: grid;
        margin: 2ch;
    }
</style>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Proveedores</title>
        <link rel="stylesheet" href="footer.css"/>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Función para obtener los datos desde el servidor
                function fetchData() {
                    fetch('../business/accionPaisLocalizacion.php')
                            .then(response => response.json())
                            .then(data => {
                                getCountry(data.countries);
                            })
                            .catch(error => console.error('Error fetching data:', error));
                }

                // Event listener para el cambio de pais
                document.querySelector('select[name="country"]').addEventListener('change', function () {
                    const CountryIdentifier = this.options[this.selectedIndex].value;
                    fetch(`../business/accionCanton.php?countryIdent=${CountryIdentifier}`)

                            .then(response => response.json())
                            .then(data => {

                                if (data.success) {
                                    getProvince(data.provinces);
                                } else {
                                    console.error('Error:', data.message);
                                }
                            })
                            .catch(error => console.error('Error fetching cantons:', error));
                });
                // Event listener para el cambio de provincia
                document.querySelector('select[name="province"]').addEventListener('change', function () {
                    const provinceIdentifier = this.options[this.selectedIndex].value;
                    getpostalCode('');
                    fetch(`../business/accionCanton.php?provinceIdent=${provinceIdentifier}`)
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    getCanton(data.cantons);
                                    getDistrict(null);
                                } else {
                                    console.error('Error:', data.message);
                                }
                            })
                            .catch(error => console.error('Error fetching cantons:', error));
                });
                document.querySelector('select[name="canton"]').addEventListener('change', function () {
                    const cantonIdentifier = this.options[this.selectedIndex].value;
                    getpostalCode('');
                    console.log(cantonIdentifier);
                    fetch(`../business/accionDistrito.php?cantonIdent=${cantonIdentifier}`)
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    getDistrict(data.district);
                                } else {
                                    console.error('Error:', data.message);
                                }
                            })
                            .catch(error => console.error('Error fetching cantons:', error));
                });
                document.querySelector('select[name="district"]').addEventListener('change', function () {
                    const districtIdentifier = this.options[this.selectedIndex].value;
                    console.log(districtIdentifier);
                    fetch(`../business/accionDistrito.php?districtIdent=${districtIdentifier}`)
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    getpostalCode(data.postalData);
                                } else {
                                    console.error('Error:', data.message);
                                }
                            })
                            .catch(error => console.error('Error fetching cantons:', error));
                });
                // Llama a la función para obtener los datos
                fetchData();
            });

            function getCountry(countryList) {
                const select = document.querySelector('select[name="country"]');
                select.innerHTML = '<option disabled selected>País</option>';
                countryList.forEach(country => {
                    const option = document.createElement('option');
                    option.value = country.identifier;
                    option.textContent = country.name;
                    select.appendChild(option);
                });
            }

            function getProvince(provincesList) {
                const select = document.querySelector('select[name="province"]');
                select.innerHTML = '<option disabled selected>Provincia</option>';
                provincesList.forEach(province => {
                    const option = document.createElement('option');
                    option.value = province.identifier;
                    option.textContent = province.name;
                    select.appendChild(option);
                });
            }

            function getCanton(cantonList) {
                const select = document.querySelector('select[name="canton"]');
                select.innerHTML = '<option disabled selected>Cantones</option>';
                cantonList.forEach(canton => {
                    const option = document.createElement('option');
                    option.value = canton.identifier;
                    option.textContent = canton.name;
                    select.appendChild(option);
                });
            }

            function getDistrict(districtList) {
                const select = document.querySelector('select[name="district"]');
                select.innerHTML = '<option disabled selected>Distrito</option>';
                if (districtList != null) {
                    districtList.forEach(distrito => {
                        const option = document.createElement('option');
                        option.value = distrito.identifier;
                        option.textContent = distrito.name;
                        select.appendChild(option);
                    });
                }
            }

            function getpostalCode(postalCode) {
                const select = document.querySelector('input[name="postalCode"]');
                select.value = postalCode;
            }
        </script>
    </head>
    <?php include_once './header.php'; ?>

    <body>

        <h1>CRUD Proveedores</h1>
        <span class="seach-filter">
            <span>
                <label for="btnSearch" title="Busqueda">Busqueda por nombre</label>
                <input type="search" id="searchSupplier" style="margin-bottom: 5vh; width: min-content;" name="searchSupplier" />
            </span>
            <button style="cursor: pointer" id="btnSearch" onclick="searchByName()">Buscar</button>

        </span>
        <hr style="width: 100%">


        <div id="formContainer">
            <form id="proveedorForm">
                <input type="hidden" name="supplierId" id="supplierId">
                <span>
                    <label for="name">Nombre</label>
                    <input type="text" name="name" placeholder="Nombre" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+"
                           title="Solo se permiten letras y espacios" id="newName" required />
                </span>
                <span>
                    <label for="phone">Teléfono</label>
                    <input type="text" name="phone" placeholder="Teléfono" maxlength="8" pattern="\d{8}"
                           title="Debe ingresar exactamente 8 números" id="newPhone" required />
                </span>
                <span>
                    <label for="email">Correo</label>
                    <input type="email" name="email" placeholder="Correo" id="newEmail" required />
                </span>
                <span>
                    <label for="supplierType">Tipo proveedor</label>
                    <select name="supplierType" id="" required>
                        <option disabled selected>Tipo de proveedor</option>
                        <?php foreach ($supplierTypes as $supplierType): ?>
                            <option value="<?php echo htmlspecialchars($supplierType->getIdentifier()); ?>">
                                <?php echo htmlspecialchars($supplierType->getNameType()); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </span>
                <span>
                    <label for="country">País</label>
                    <select name="country">
                        <option disabled selected>País</option>
                    </select>
                </span>
                <span>
                    <label for="province">Provincia</label>
                    <select name="province">
                        <option disabled selected>Provincia</option>
                    </select>
                </span>
                <span>
                    <label for="canton">Cantón</label>
                    <select name="canton">
                        <option disabled selected>Cantón</option>
                    </select>
                </span>
                <span>
                    <label for="district">Distrito</label>
                    <select name="district">
                        <option disabled selected>Distrito</option>
                    </select>
                </span>
                <span>
                    <label for="postalCode">Código postal</label>
                    <input type="text" name="postalCode" placeholder="Código postal" required>
                </span>
                <span>
                    <label for="direction">Dirección</label>
                    <input type="text" name="direction" id="" placeholder="Dirección por señas" required>
                </span>
                <span>
                    <input style="cursor: pointer" type="submit" value="Agregar" id="save" />
                </span>
            </form>
            <button style="cursor: pointer; visibility: hidden;" id="btn-cancel" onclick="cancelModiSupplier()">Cancelar</button>
            <spam id="messageError" style="display: flex;"></spam>
        </div>
        <span id="mensajes-usuario-nombre" style="color: red;"></span>
        <span id="mensajes-usuario-telefono" style="color: red;"></span>
        <span id="mensajes-usuario-correo" style="color: red;"></span>
        <hr style="width: 100%;">
        <button id="btn-viewDisable" type="button" onclick="mostrarProveedores()">Ver proveedores deshabilitados</button>
        <table border="1" cellpadding="1" id="datatable">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Correo</th>
                    <th>Tipo</th>
                    <th>Código postal</th>
                    <th>Dirección por señas</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="tbody-table">
                <?php foreach ($proveedores as $proveedor): ?>
                    <tr>
                        <td> <?php echo ($proveedor->getName()); ?> </td>
                        <td> <?php echo ($proveedor->getPhone()->getPhone()); ?> </td>
                        <td> <?php echo ($proveedor->getEmail()->getEmail()); ?> </td>
                        <td> <?php echo ($proveedor->getSupplierType()->getNameType()); ?> </td>
                        <td>
                            <?php echo ($proveedor->getSupplierDirection()->getDistrict()->getpostalCode()); ?>
                        </td>
                        <td>
                            <?php echo ($proveedor->getSupplierDirection()->getSignalDirection()); ?>
                        </td>
                        <td style="width: 150px;">
                            <div style="justify-content: space-between; display: flex;">
                                <button style="cursor: pointer; flex: 0 0 49%;" type="button" onclick="ModifySupplier('<?php echo ($proveedor->getIdentifier()); ?>')" id="btn-editar">Editar</button>
                                <button style="cursor: pointer; flex: 0 0 49%;" type="button"
                                        onclick="deleteSupplier('<?php echo ($proveedor->getIdentifier()); ?>')">Eliminar</button>
                            </div>
                        </td>
                    </tr>

                <?php endforeach; ?>
            </tbody>
        </table>
        <script src="proveedorPrincipal.js"></script>
        <?php include_once './footer.php'; ?>
    </body>
</html>
<script>
function showModal() {
    try {
        document.getElementById("modal-login").showModal();
    } catch (e) {
        window.alert("Ya has iniciado session.");
    }
}
</script>