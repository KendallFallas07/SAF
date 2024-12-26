<?php
require_once './validacionRutas.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once "../business/ControladoraPresentacion.php";
require_once "../business/ControladoraUnidadMedida.php";
require_once "../business/ControladoraProducto.php";
require_once "../business/ControladoraProveedor.php";
require_once "../business/ControladoraCategoria.php";
$categoryController = new ControladoraCategoria();
$categories = $categoryController->getAllCategories();

$supplierController = new ControladoraProveedor();
$suppliers = $supplierController->getAllSuppliers();

$presentationController = new PresentacionController();
$presentations = $presentationController->getAll();

$productController = new ControladoraProducto();
$products = $productController->findAllProductos();
$UnitMController = new ControladoraUnidadMedida();
$unitMs = $UnitMController->getAllData();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Producto</title>
    <link rel="stylesheet" href="footer.css" />

    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
            margin-bottom: -20px;
        }

        .modal-content {
            background-color: #fff;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 30%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .button-container {
            margin-top: 25px;
            display: flex;
            /* Activa el uso de Flexbox */
            justify-content: center;
            /* Centra horizontalmente */
            align-items: center;
            /* Centra verticalmente */
            height: 100%;
            /* Ajusta según lo necesario */
        }
    </style>

</head>
<?php include_once './header.php'; ?>

<body>


    <div class="container">
        <h1>CRUD de Producto</h1>
        <label for="btnSearch" title="Busqueda">Busqueda por nombre</label>
        <span>
            <input type="search" id="search-product" style="margin-bottom: 5vh; width: min-content;" name="searchProduct" />
            <button style="cursor: pointer" id="btnSearch" onclick="searchProduct()">Buscar</button>
        </span>
        <div>
            <form id="product-form">
                <input type="hidden" name="identificador-producto" id="identificador-producto">
                <label for="nombre-producto">Nombre</label>
                <input type="text" id="nombre-producto" name="nombre-producto" placeholder="Nombre producto" required>
                <label type="text" or="descripcion-producto">Descripción</label>
                <input id="descripcion-producto" name="descripcion-producto" rows="4" placeholder="Descripción" required></input>
                <label for="categoria-producto">Categoria</label>
                <select id="categoria-producto" name="categoria-producto" required>
                    <option disabled selected>Categoria</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo htmlspecialchars($category->getIdentifierCat()); ?>">
                            <?php echo htmlspecialchars($category->getNameCategory()); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <label for="unidad-medida">Unidad de medida</label>
                <select id="unidad-medida" name="unidad-medida" required>
                    <option disabled selected>Unidad de medida</option>
                    <?php foreach ($unitMs as $unit): ?>
                        <option value="<?php echo htmlspecialchars($unit['tbunidadmedidaidentificador']); ?>">
                            <?php echo htmlspecialchars($unit["tbunidadmedidanombreunidad"]); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <label for="presentacion">Presentación</label>
                <select id="" name="presentacion" required>
                    <option disabled selected>Presentación</option>
                    <?php foreach ($presentations as $presentation): ?>
                        <option value="<?php echo htmlspecialchars($presentation["tbpresentacionidentificador"]); ?>">
                            <?php echo htmlspecialchars($presentation["tbpresentacionombre"]); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <label for="proveedor">Proveedor</label>
                <select id="proveedor" name="proveedor" required>
                    <option disabled selected>Proveedor</option>
                    <?php foreach ($suppliers as $supplier): ?>
                        <option value="<?php echo htmlspecialchars($supplier->getIdentifier()); ?>">
                            <?php echo htmlspecialchars($supplier->getName()); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <input type="submit" value="Registrar" id="save">

            </form>
            <button style="cursor: pointer; visibility: hidden;" id="btn-cancel" onclick="cancelModiSupplier()">Cancelar</button>
        </div>
        <span id="mensajes-usuario-nombre" style="color: red;"></span>
        <hr style="width: 100%">

        <button id="btn-item-disable" type="button" onclick="mostrarProductos()">Ver productos deshabilitados</button>
        <table border="1" cellpadding="1" id="datatable">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Categoria</th>
                    <th>Unidad de medida</th>
                    <th>Presentación</th>
                    <th>Proveedor</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="tbody-table">
                <?php if (isset($products) && is_array($products) && count($products) > 0): ?>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <!-- Mostrar el nombre del producto -->
                            <td><?php echo htmlspecialchars($product->getNombre()); ?></td>

                            <!-- Mostrar la descripción del producto -->
                            <td><?php echo htmlspecialchars($product->getDescription()); ?></td>

                            <!-- Mostrar la categoría del producto -->
                            <td><?php echo htmlspecialchars($product->getCategoria()->getNameCategory()); ?></td>

                            <!-- Mostrar la unidad de medida del producto -->
                            <td><?php echo htmlspecialchars($product->getUnidadMedida()->getNameUnit()); ?></td>

                            <!-- Mostrar la presentación del producto -->
                            <td><?php echo htmlspecialchars($product->getPresentacion()->getName()); ?></td>

                            <!-- Mostrar el proveedor (si está disponible, modificar según el modelo) -->
                            <td><?php echo htmlspecialchars($product->getProveedor()->getName() ?? 'N/A'); ?></td>

                            <!-- Botones de acción -->
                            <td style="width: 250px;">
                                <div style="justify-content: space-between; display: flex;">
                                    <button style="cursor: pointer; flex: 0 0 33%;" type="button" onclick="ModifyProduct('<?php echo htmlspecialchars($product->getIdentificador()); ?>')" id="btn-editar">Editar</button>
                                    <button style="cursor: pointer; flex: 0 0 33%;" type="button" onclick="deleteProduct('<?php echo htmlspecialchars($product->getIdentificador()); ?>')">Eliminar</button>
                                    <button style="cursor: pointer; flex: 0 0 33%;" type="button" onclick="addImage('<?php echo htmlspecialchars($product->getIdentificador()); ?>')">Agregar Imagen</button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">No se encontraron productos.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>


    <div id="modal-add-image" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Agregar Imagenes</h2>
            <form id="form-upload-images" enctype="multipart/form-data" method="POST">
                <label for="images">Seleccionar Imagen:</label>
                <input type="file" id="images" name="images" accept="image/*">
                <input type="hidden" id="identifierProduct" name="identifier">
                
                <!-- Botón para agregar la imagen seleccionada -->
                <div class="button-container">
                <button type="button" onclick="addImageToList()">Agregar Imagen</button>
                </div>
                

                <!-- Listado de imágenes seleccionadas -->
                <ul id="image-list"></ul>

                <br>
                <div class="button-container">
                    <button style="align-items: center;" type="submit">Finalizar</button>
                </div>
                
            </form>
        </div>
    </div>

    <?php include_once './footer.php'; ?>

    <script src="./productoPrincipal.js"></script>
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