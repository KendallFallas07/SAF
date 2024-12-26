<?php
include_once './header.php';
include_once '../business/ControladoraCajero.php';
require_once './validacionRutas.php';

$ventaIdentificador = isset($_GET['venta']) ? $_GET['venta'] : "";

try {
    $controller = new ControladoraCajero();
    $impuestos = $controller->obtenerImpuestos();
    $detallesVenta = $controller->obtenerDetallesVenta($ventaIdentificador);

    if (isset($detallesVenta['error'])) {
        echo "<div class='error'>" . htmlspecialchars($detallesVenta['error']) . "</div>";
    }
} catch (Exception $e) {
    echo "<div class='error'>Error: " . htmlspecialchars($e->getMessage()) . "</div>";
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ventas SAF</title>
        <link rel="stylesheet" href="footer.css" />
        <style>
            /* Estilos para el modal del código QR */
            dialog#modal-qr {
                border-style: dashed;
                border-radius: 2ch;
            }
            dialog#modal-qr div {
                display: grid;
                justify-items: center;
            }
            dialog#modal-qr button {
                margin: 1ch;
            }
            dialog:-internal-dialog-in-top-layer::backdrop {
                position: fixed;
                inset: 0px;
                background: rgba(0, 0, 0, 0.5);
            }
        </style>
    </head>
    <body>
        <main>
            <section>
                <h2>Detalles de la Venta</h2>
                <button type="button" onclick="showModalQR()">Escanear QR</button>
                <button type="button" onclick="cancelAction()">Cancelar compra</button>
            </section>

            <section>
                <h2>Datos del Usuario</h2>
                <p>Nombre de Usuario: <?php echo htmlspecialchars($detallesVenta['usuario']['nombreUsuario'] ?? 'No disponible'); ?></p>
                <p>Nombre: <?php echo htmlspecialchars($detallesVenta['usuario']['nombre'] ?? 'No disponible'); ?></p>
                <p>Apellidos: <?php echo htmlspecialchars($detallesVenta['usuario']['apellidos'] ?? 'No disponible'); ?></p>
                <p>Dirección: <?php echo htmlspecialchars($detallesVenta['usuario']['direccion'] ?? 'No disponible'); ?></p>
            </section>

            <section>
                <h2>Productos en la factura actual</h2>
                <table border="1">
                    <thead>
                        <tr>
                            <th>Productos</th>
                            <th>Cantidad</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($detallesVenta['productos']) && is_array($detallesVenta['productos'])): ?>
                            <?php foreach ($detallesVenta['productos'] as $producto): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($producto['tbproductonombreproducto']); ?></td>
                                    <td><?php echo htmlspecialchars($producto['tbventacantidadproducto']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="2">No hay productos disponibles</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </section>

            <section>
                <h2>Resumen de la factura</h2>

                <form method="POST" action="">
                    <label for="impuesto">Selecciona un impuesto:</label>
                    <select name="impuesto" id="impuesto">
                        <option value="">No hay impuesto seleccionado</option>
                        <?php foreach ($impuestos as $impuesto): ?>
                            <option value="<?php echo htmlspecialchars($impuesto['tbimpuestoidentificador']); ?>"
                                    data-valor="<?php echo htmlspecialchars($impuesto['tbimpuestovalor']); ?>">
                                        <?php echo htmlspecialchars($impuesto['tbimpuestonombre']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </form>

                <table border="1">
                    <tr>
                        <td>Subtotal:</td>
                        <td id="subtotal">
                            $<?php
                            if (isset($detallesVenta['transaccion']['subtotal']) && is_numeric($detallesVenta['transaccion']['subtotal'])) {
                                echo htmlspecialchars(number_format($detallesVenta['transaccion']['subtotal'], 2));
                            } else {
                                echo '0.00';
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Impuesto Seleccionado:</td>
                        <td id="impuesto_valor">$0.00</td>
                    </tr>
                    <tr>
                        <td><strong>Total:</strong></td>
                        <td id="total">$0.00</td>
                    </tr>
                </table>

            </section>

            <section>
                <h2>Método de Pago</h2>
                <p>Tipo de Pago: <?php echo isset($detallesVenta['transaccion']['tipoPago']) ? ($detallesVenta['transaccion']['tipoPago'] == 0 ? 'Efectivo' : ($detallesVenta['transaccion']['tipoPago'] == 1 ? 'Tarjeta de Crédito' : 'No disponible')) : 'No disponible'; ?></p>
            </section>

            <section>
                <form method="POST" style="display: inline;">
                    <button type="button" onclick="cancelAction()">Cancelar Factura</button>
                    <button type="button" name="procesarFactura" onclick="crearFactura()">Procesar Factura</button>
                </form>
            </section>
        </main>
        <footer>
            <p>SAF</p>
        </footer>

        <!-- Modal de escaneo de QR -->
        <dialog id="modal-qr">
            <script src="../assets/plugins/qrCode.min.js"></script>
            <div>
                <div>
                    <h5>Escanear código QR</h5>
                    <div>
                        <a id="btn-scan-qr" href="#">
                            <img src="../assets/img/qr_icon.svg" width="75">
                        </a>
                        <canvas hidden="" id="qr-canvas"></canvas>
                    </div>
                    <div>
                        <button class="button" onclick="encenderCamara()">Encender cámara</button>
                        <button class="button" onclick="cerrarCamara()">Detener cámara</button>
                        <button class="button" onclick="closeModalQR()">Cerrar ventana</button>
                    </div>
                </div>
            </div>
            <audio id="audioScaner" src="../assets/sound/sonido.mp3"></audio>
            <script src="LectorQRCajero.js" defer="true"></script>
        </dialog>

        <script defer="true">
                            document.getElementById('impuesto').addEventListener('change', function () {
                                var selectedOption = this.options[this.selectedIndex];
                                var valorImpuesto = parseFloat(selectedOption.getAttribute('data-valor')) || 0;
                                var subtotal = parseFloat("<?php echo isset($detallesVenta['transaccion']['subtotal']) ? $detallesVenta['transaccion']['subtotal'] : '0.00'; ?>");

                                // Calcular el impuesto
                                var montoImpuesto = (subtotal * valorImpuesto) / 100;
                                var total = subtotal + montoImpuesto;

                                // Actualizar los valores en la tabla
                                document.getElementById('impuesto_valor').innerHTML = valorImpuesto + '%';
                                document.getElementById('total').innerHTML = '$' + total.toFixed(2);
                            });

                            function showModalQR() {
                                document.getElementById("modal-qr").showModal();
                            }

                            function closeModalQR() {
                                cerrarCamara();
                                document.getElementById("modal-qr").close();
                            }

                            function cancelAction() {
                                //redireccion para limpiar
                                window.location.href = "http://localhost/SAF/view/cajeroVista.php";
                            }
        </script>

        <script defer="true">

            //crea la factura y administra los demas metodos
            async function crearFactura() {
                const idUsuario = await verificaUsuario();
                verificacionVenta(idUsuario);
            }
            //metodo para traer el identificador deel usuario
            async function verificaUsuario() {

                const identificadorventa = "<?php echo $ventaIdentificador ?>";
                const data = new FormData();
                data.append("ventaIdentificador", identificadorventa);
                const options = {
                    'method': "POST",
                    'body': data
                };
                const response = await fetch("../business/accionCajeroUsuario.php", options);
                const responseJSON = await response.json();
                return responseJSON.message;
            }

            //realiza el pago,agrega la factura,cambialos datos ya sea en la tabla venta en la tabla transaccional
            async function verificacionVenta(idUsuario) {
                //verifica si existen mas de una venta por pagar
                const data = new FormData();
                data.append("idUsuario", idUsuario);
                const options = {
                    'method': "POST",
                    'body': data
                };
                const response = await fetch("../business/accionCajeroVerificar.php", options);
                const responseJSON = await response.json();
                //si es 402 es porque EL CLIENTE TIENE CUENTAS POR PAGAR lo cual lo llevara a la mas vieja 
                if (responseJSON.status === '402') {

                    if (sessionStorage.getItem("PAYOLD") === "True") {
                        const identificadorventa = "<?php echo $ventaIdentificador ?>";
                        const impuesto = document.getElementById("impuesto").value;
                        const data = new FormData();
                        data.append("ventaIdentificador", identificadorventa);

                        data.append("impuesto", impuesto);

                        const options2 = {
                            'method': "POST",
                            'body': data
                        };
                        const response = await fetch("../business/accionCajeroActualizar.php", options2);
                        const responseJSON = await response.json();
                        if (responseJSON.status !== "200") {
                            alert(responseJSON.message);
                            window.location.href = "http://localhost/SAF/view/cajeroVista.php";
                        } else {
                            //reiniciar la ss
                            sessionStorage.clear();
                            //vista de la factura
                            console.log(responseJSON.data);
                            const total = document.getElementById("total").textContent;
                            responseJSON.data.total = total;
                            document.getElementById('modal-factura').showModal();
                            cargarDatosEnModal(responseJSON.data);
                        }
                    } else {
                        alert(responseJSON.message);
                        if (confirm("DESEA PAGAR LA FACTURA ANTERIOR")) {
                            mostrarIdentificadorVenta(responseJSON.data.tbventaidentificador);
                            sessionStorage.setItem("PAYOLD", "True");
                        } else {
                            window.location.href = "http://localhost/SAF/view/cajeroVista.php";
                        }
                    }
                    //Por si no tiene cuentas pendientes procede a pagar
                } else {
                    const identificadorventa = "<?php echo $ventaIdentificador ?>";
                    const impuesto = document.getElementById("impuesto").value;
                    const data = new FormData();
                    data.append("ventaIdentificador", identificadorventa);

                    data.append("impuesto", impuesto);

                    const options3 = {
                        'method': "POST",
                        'body': data
                    };
                    const response = await fetch("../business/accionCajeroActualizar.php", options3);
                    const responseJSON = await response.json();
                    if (responseJSON.status !== "200") {
                        alert(responseJSON.message);
                        window.location.href = "http://localhost/SAF/view/cajeroVista.php";
                    } else {
                        //vista de la factura
                        console.log(responseJSON.data);
                        const total = document.getElementById("total").textContent;
                        responseJSON.data.total = total;
                        document.getElementById('modal-factura').showModal();
                        cargarDatosEnModal(responseJSON.data);
                    }
                }
            }
        </script>
    </body>
</html>
<!-- Modal -->
<dialog id="modal-factura">
    <div class="modal-header">
        <h2>Factura</h2>
    </div>
    <div class="modal-content" id="modal-content">
        <!-- Aquí se llenarán dinámicamente los datos -->
    </div>
    <button class="close-button" id="close-modal">Cerrar</button>
</dialog>


<script defer="true">
    // Variables para los botones y el modal
    const closeModalBtn = document.getElementById('close-modal');

    // Cerrar modal al hacer clic en el botón de cerrar
    closeModalBtn.addEventListener('click', () => {
        document.getElementById('modal-factura').close();
    });

    // Función para cargar los datos en el modal
    function cargarDatosEnModal(data) {

        // Llenando el modal con los datos de la factura
        const modalContent = document.getElementById('modal-content');
        modalContent.innerHTML = `
            <table>
                <tr>
                    <th>Identificador de Factura</th>
                    <td>${data.factura.identificador}</td>
                </tr>
                <tr>
                    <th>Fecha de Creación</th>
                    <td>${data.factura.fechaCreacion}</td>
                </tr>
                <tr>
                    <th>Identificador de Venta</th>
                    <td>${data.venta.identificador}</td>
                </tr>
                <tr>
                    <th>Cliente</th>
                    <td>${data.usuario.nombre} ${data.usuario.apellidos}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>${data.usuario.email}</td>
                </tr>
                <tr>
                    <th>Dirección</th>
                    <td>${data.usuario.direccion}</td>
                </tr>
            </table>
        `;

        // Si hay productos, los listamos
        if (data.productos && data.productos.length > 0) {
            let productosHTML = `
                <h3>Productos</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario</th>
                        </tr>
                    </thead>
                    <tbody>
            `;

            // Generar la lista de productos
            data.productos.forEach(producto => {
                productosHTML += `
                    <tr>
                        <td>${producto.nombre}</td>
                        <td>${producto.cantidad}</td>
                        <td>${producto.precio}</td>
                    </tr>
                `;
            });

            productosHTML += `</tbody></table>`;

            // Añadir los productos al contenido del modal
            modalContent.innerHTML += productosHTML;
        }

        // Mostrar el total al final
        modalContent.innerHTML += `
            <div class="total">
                Total: $${data.total}
            </div>
        `;
    }
</script>