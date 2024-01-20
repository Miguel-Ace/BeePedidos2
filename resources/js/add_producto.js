const productos = document.querySelectorAll('.productos')
const agregarProdut = document.querySelector('.cart-info')
const dropdownCarrito = document.querySelector('.dropdown-carrito .productos-agregados')
const textPrecio = document.querySelector('.text-precio')
const spanMostrarTotal = document.querySelector('.totalProductosAgregados')

let totalProductosAgregados = 0
let sumarCart = 0
let arr_products = []

// Si existen productos en el sessionStorage lo agrega al array y lo pone en el carrito
setTimeout(() => {
if (sessionStorage.getItem('productos')) {
        arr_products = JSON.parse(sessionStorage.getItem('productos'))
        agregarOrden()
        comparar()
    }
}, 500);

// Mejorar
function comparar() {
    arr_products.forEach(item => {
          identificarId(item.id,item.cantidad)

          function identificarId(id,cantidad) {
            productos.forEach(item => {
                const quantity = item.querySelector('.selectCantidades .quantity')
                if (parseInt(item.querySelector('.id-producto').textContent.trim()) == id) {
                    quantity.value = cantidad
                }
            });
          }
    })
}
// Mejorar

// Si no hay productos se ejecuta un mensaje
mensajeSinProducts()
function mensajeSinProducts() {
    if (dropdownCarrito.innerHTML == '') {
        dropdownCarrito.innerHTML = `<p class="desc-cart">Sin productos</p>`
    }
}

productos.forEach(item => {
    const id = item.querySelector('.id-producto');
    const imagen = item.querySelector('.content-img img').src;
    const nombre = item.querySelector('.descuento p');
    const descuento = item.querySelector('.span');
    const descripcion = item.querySelector('.descripcion');
    const precio = item.querySelector('.precio span:nth-child(2)');
    const moneda = item.querySelector('.precio .moneda');
    const existencia = item.querySelector('.existencia span');
    const categoria = item.querySelector('.categoria');
    const iva = item.querySelector('.iva');

    const menos = item.querySelector('.selectCantidades .menos');
    const mas = item.querySelector('.selectCantidades .mas');
    const quantity = item.querySelector('.selectCantidades .quantity')
    
    const btnCart = item.querySelector('.button')

    let cantidadInput

    btnCart.addEventListener('click', () => {
        // Extraer el indice del arreglo para encontrar el objeto
        const indice = arr_products.findIndex(product => product.id == id.textContent.trim());

        // Si el indice es -1 entonces el producto no ha sido agregado
        // De lo contrario se le suma 1 a cantidad
        if (indice == -1) {
            if (quantity.value > 0 && quantity.value <= parseInt(existencia.textContent.trim())) {
                cantidadInput = quantity.value
            }else{
                cantidadInput = 1
                quantity.value = cantidadInput
            }
            arr_products.push({
                id: parseInt(id.textContent.trim()),
                imagen: imagen,
                nombre: nombre.textContent.trim(),
                descuento: descuento,
                descripcion: descripcion.textContent.trim(),
                precio: parseFloat(precio.textContent.trim().replace(/,/g, '')),
                moneda: moneda.textContent.trim(),
                existencia: parseInt(existencia.textContent.trim()),
                categoria: categoria.textContent.trim(),
                iva: iva.textContent.trim(),
                quantity: parseInt(quantity.value),
                cantidad: parseInt(cantidadInput)
            })
            agregarOrden()
            conProducto()
            comprobarExis()
        }else{
            arr_products[indice].cantidad++;
            quantity.value = arr_products[indice].cantidad
            agregarOrden()
            comprobarExis()
        }
    })

    menos.addEventListener('click', () => {
        const indice = arr_products.findIndex(product => product.id == id.textContent.trim());
        // Si el indice es diferente -1 entonces el producto ha sido agregado y se actualiza existencias
        if (quantity.value > 0) {
            quantity.value--
        }
        if (indice != -1) {
            if (quantity.value > 0 && quantity.value <= parseInt(existencia.textContent.trim())) {
                arr_products[indice].quantity = quantity.value;
                arr_products[indice].cantidad = quantity.value;
                mas.disabled = false
            }else{
                // arr_products[indice].quantity = parseInt(existencia.textContent.trim());
                // arr_products[indice].cantidad = parseInt(existencia.textContent.trim());
                menos.disabled = true
            }
            agregarOrden()
            comprobarExis()
        }
    })

    mas.addEventListener('click', () => {
        const indice = arr_products.findIndex(product => product.id == id.textContent.trim());
        // Si el indice es diferente -1 entonces el producto ha sido agregado y se actualiza existencias
        if (quantity.value < parseInt(existencia.textContent.trim())) {
            quantity.value++
        }
        if (indice != -1) {
            if (quantity.value > 0 && quantity.value <= parseInt(existencia.textContent.trim())) {
                arr_products[indice].quantity = quantity.value;
                arr_products[indice].cantidad = quantity.value;
                menos.disabled = false
            }else{
                // arr_products[indice].quantity = parseInt(existencia.textContent.trim());
                // arr_products[indice].cantidad = parseInt(existencia.textContent.trim());
                mas.disabled = true
            }
            agregarOrden()
            comprobarExis()
        }
    })

    quantity.addEventListener('keyup', () => {
        const indice = arr_products.findIndex(product => product.id == id.textContent.trim());
        // Si el indice es diferente -1 entonces el producto ha sido agregado y se actualiza existencias
        if (indice != -1) {
            if (quantity.value > 0 && quantity.value <= parseInt(existencia.textContent.trim())) {
                arr_products[indice].quantity = quantity.value;
                arr_products[indice].cantidad = quantity.value;
            }else{
                arr_products[indice].quantity = 1;
                arr_products[indice].cantidad = 1;
            }
            agregarOrden()
            comprobarExis()
        }
    })

    setTimeout(() => {
        comprobarExis()
    }, 1000);
    function comprobarExis() {
        // const indice = arr_products.findIndex(product => product.id == id.textContent.trim());
        // if (indice != -1) {
        //     if (quantity.value < 0) {
        //         quantity.value = 1
        //     }
        //     arr_products[indice].quantity = quantity.value;
        //     arr_products[indice].cantidad = quantity.value;
        //     agregarOrden()
        // }

        if (quantity.value >= parseInt(existencia.textContent.trim()) || quantity.value < 0) {
            btnCart.style = "opacity:.5"
            btnCart.disabled = true
        }else{
            btnCart.style = ""
            btnCart.disabled = false
        }
    }
});

function agregarOrden() {
    dropdownCarrito.innerHTML = ''
    totalProductosAgregados = 0
    
    for (const producto of arr_products) {

        totalProductosAgregados++
        mostrarCantidadproducts()
        const precio_x_cantidad = producto.precio * producto.cantidad

        dropdownCarrito.innerHTML += `
        <div class="detalle-carrito">
            <span class="id d-none">${producto.id}</span>
            <span class="cantidad-input d-none">${producto.quantity}</span>
            <span class="existencia-input d-none">${producto.existencia}</span>
            <div class="detalle-img">
                <img src="${producto.imagen}" width="100">
                <ion-icon name="trash-outline" class="vaciar"></ion-icon>
            </div>
            <div class="detalle-producto">
                <p>${producto.nombre}</p>
                <span class="price text-info">${producto.moneda} ${precio_x_cantidad.toLocaleString()} </span> Cantidad: <span class="count">${producto.cantidad}</span>
            </div>
        </div>
    `

    // sumarCart += precio_x_cantidad
    mostrarPrecioTotal()
    }

    // Crear un sessionStorage y pasarle todo el arreglo
    sessionStorage.setItem('productos', JSON.stringify(arr_products))

    // Ejecutar una función que permite saber cuantos productos hay agregado y de esa forma poder eliminarlos
    borrarProducto()
}

function mostrarPrecioTotal() {
    sumarCart = 0
    for (const producto of arr_products) {
        const precio_x_cantidad = producto.precio * producto.cantidad
        sumarCart += precio_x_cantidad
    }
    textPrecio.textContent = sumarCart.toLocaleString()

}

function borrarProducto() {
    const ProdutsCart = document.querySelectorAll('.detalle-carrito')

    ProdutsCart.forEach(item => {
        const idProdutCart = item.querySelector('.id').textContent
        const btnBorrar = item.querySelector('.detalle-img .vaciar')
        
        btnBorrar.onclick = () =>{
            const indiceProductCart = arr_products.findIndex(product => product.id == idProdutCart);
            arr_products.splice(indiceProductCart, 1)
            agregarOrden()
            mensajeSinProducts()
            mostrarPrecioTotal()
            location.reload()
        }
    });

    conProducto()
}

conProducto()
function conProducto() {
    // Bloquear btn de confirmar pedido
    const verCarrito = document.querySelector('.ver-carrito')
    const a1 = verCarrito.querySelector('a:nth-child(1)')

    if (arr_products.length == 0) {
        a1.style = "opacity:.5;cursor: no-drop"
        a1.disabled = true
    }else{
        a1.style = ""
        a1.disabled = false
    }
}

function mostrarCantidadproducts() {
    spanMostrarTotal.textContent = totalProductosAgregados
}