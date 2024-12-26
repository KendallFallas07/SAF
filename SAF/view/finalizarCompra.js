let listaCompra=[];

function showModal() {
    try {
        document.getElementById("modal-login").showModal();
    } catch (e) {
        window.alert("Ya has iniciado session.");
    }
}

document.addEventListener("DOMContentLoaded", () => {
    const object = document.getElementById("container-list");
    let total = 0;

    for (let i = 0; i < sessionStorage.length; i++) {
        const productString = sessionStorage.getItem(sessionStorage.key(i));
        const product = JSON.parse(productString);

    
        if (product && product.margenVenta) {
            const cantidad = product.cantidad;
            const precioUnitario = product.margenVenta.precio;

            const margenPorcentaje = product.margenVenta.margen / 100;
            const margenValor = precioUnitario * margenPorcentaje;

            const precioTotalProducto = (precioUnitario + margenValor) * cantidad;
           
            if (cantidad > 0) {
                listaCompra.push(product);
                total += precioTotalProducto;

                object.innerHTML += `
                    <span>
                        <input type="image" src="${product.imagenes[3]["tbproductoimagenruta"]}" width="200px" height="100px">
                        <span class="info-product">
                            <label>Nombre artículo:</label>
                            <label>${product.nombre}</label>
                        </span>
                        <span class="info-product">
                            <label>Cantidad de producto:</label>
                            <label>${product.cantidad}</label>
                        </span>
                        <span class="info-product">
                            <label>Presentación del producto:</label>
                            <label>${product.presentacion.name}</label>
                        </span>
                        <span class="info-product">
                            <label>Precio Unitario:</label>
                            <label>&cent;${precioUnitario + margenValor}</label>
                        </span>
                        <span class="info-product">
                            <label>Precio Total:</label>
                            <label>&cent;${precioTotalProducto}</label>
                        </span>
                    </span>`;
            }
        } else {
            console.warn(`El producto con clave ${sessionStorage.key(i)} no es válido.`);
        }
    }

    if(listaCompra.length !== 0){
        sessionStorage.setItem("total", total);
        listaCompra.push(total);
    }
   
    document.querySelector(".precio-total").textContent = "¢" + total;
});

function clearListProduct(){
if( window.confirm("Esta seguro que desea cancelar?")){
sessionStorage.clear();
window.location.href='./venta.php';
}
}



async function confirmarLista(id) {
    if (listaCompra.length === 0) {
        alert("No hay productos en la lista.");
        return;
    }

    const totalVenta = sessionStorage.getItem("total");
    const usuario = id;

    if (!totalVenta) {
        alert("Total de venta no disponible.");
        return;
    }

    const formData = new FormData();


    listaCompra.forEach((producto, index) => {
        if (producto.nombre) {
            formData.append(`productos[${index}][nombre]`, producto.nombre);
            formData.append(`productos[${index}][identificador]`, producto.identificador);
            formData.append(`productos[${index}][cantidad]`, producto.cantidad);
            formData.append(`productos[${index}][presentacion]`, producto.presentacion.name);
            formData.append(`productos[${index}][precioUnitario]`, producto.margenVenta.precio);
            formData.append(`productos[${index}][total]`, 
                (producto.margenVenta.precio + (producto.margenVenta.precio * (producto.margenVenta.margen / 100))) * producto.cantidad
            );
            
        }
      
    });
    const metodoPago = document.querySelector('input[name="metodo_pago"]:checked');
    const metodoPagoValor = metodoPago ? metodoPago.value : '';
    
    console.log(metodoPagoValor);
    formData.append(`DATOSVENTAS[0][totalVenta]`, totalVenta);
    formData.append(`DATOSVENTAS[0][Usuario]`, usuario);
    formData.append(`DATOSVENTAS[0][metodoPago]`, metodoPagoValor);

    try {
        const response = await fetch('../business/accionFinalizarCompra.php', {
            method: 'POST',
            body: formData,
        });

        if (!response.ok) {
            throw new Error('Error en la respuesta de la red');
        }

        const data = await response.json();
        if(data.code === 1){
            alert( data.message );
            sessionStorage.clear();
           const div=document.getElementById("qr-container");
            div.innerHTML = `<img src="${data.ruta}" alt="QR de Venta" id="qrImg" class="qr-image">`;
            document.getElementById("myModal").style.display = "block";
            return;
        }else{
            alert( data.message );
        }
       
    } catch (error) {
        console.error('Error:', error);
    }
}

const closeModalBtn = document.getElementById("closeModalBtn");
const closeModalBtnAction = document.getElementById("closeModalBtnAction");

closeModalBtn.onclick = function() {
    document.getElementById("myModal").style.display = "none";
}

closeModalBtnAction.onclick = function() {
    document.getElementById("myModal").style.display = "none";
}


