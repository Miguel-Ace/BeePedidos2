const productos = document.querySelectorAll('.productos')
const agregarProdut = document.querySelector('.cart-info')
const dropdownCarrito = document.querySelector('.dropdown-carrito .productos-agregados')
const textPrecio = document.querySelector('.text-precio')
let sumarCart = 0
let arr_products = []

// Si existen productos en el sessionStorage lo agrega al array y lo pone en el carrito
if (sessionStorage.getItem('productos')) {
    arr_products = JSON.parse(sessionStorage.getItem('productos'))
    agregarOrden()
}

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
    const cadProductoBeesy = item.querySelector('.cadProductoBeesy');
    
    const btnCart = item.querySelector('.button')

    btnCart.addEventListener('click', () => {

        // Extraer el indice del arreglo para encontrar el objeto
        const indice = arr_products.findIndex(product => product.id == id.textContent.trim());

        // Si el indice es -1 entonces el producto no ha sido agregado
        // De lo contrario se le suma 1 a cantidad
        if (indice == -1) {
            arr_products.push({
                id: id.textContent.trim(),
                imagen: imagen,
                nombre: nombre.textContent.trim(),
                descuento: descuento,
                descripcion: descripcion.textContent.trim(),
                precio: parseFloat(precio.textContent.trim().replace(/,/g, '')),
                moneda: moneda.textContent.trim(),
                existencia: existencia.textContent.trim(),
                categoria: categoria.textContent.trim(),
                cadProductoBeesy: cadProductoBeesy.textContent.trim(),
                cantidad: 1
            })
            agregarOrden()
            conProducto()
        }else{
            arr_products[indice].cantidad++;
            // arr_products[indice].precio = arr_products[indice].precio + parseFloat(precio.textContent.trim().replace(/,/g, ''));
            agregarOrden()
        }
    })
});

function agregarOrden() {
    dropdownCarrito.innerHTML = ''
    
    for (const producto of arr_products) {

        const precio_x_cantidad = producto.precio * producto.cantidad

        dropdownCarrito.innerHTML += `
        <div class="detalle-carrito">
            <span class="id d-none">${producto.id}</span>
            <div class="detalle-img">
                <img src="${producto.imagen}" width="100">
                <ion-icon name="trash-outline" class="vaciar"></ion-icon>
            </div>
            <div class="detalle-producto">
                <p>${producto.nombre}</p>
                <span class="price text-info">${producto.moneda} ${precio_x_cantidad.toFixed(2)} </span> Cantidad: <span class="count">${producto.cantidad}</span>
            </div>
        </div>
    `

    sumarCart += precio_x_cantidad
    textPrecio.textContent = sumarCart
    }

    // Crear un sessionStorage y pasarle todo el arreglo
    sessionStorage.setItem('productos', JSON.stringify(arr_products))

    // Ejecutar una función que permite saber cuantos productos hay agregado y de esa forma poder eliminarlos
    borrarProducto()
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
        }
    });

    conProducto()
}

function conProducto() {
    // Bloquear btn de confirmar pedido
    const verCarrito = document.querySelector('.ver-carrito')
    const a1 = verCarrito.querySelector('a:nth-child(1)')
    const a2 = verCarrito.querySelector('a:nth-child(2)')

    if (dropdownCarrito.innerHTML != '') {
        a2.classList.add('d-none')
        a1.classList.remove('d-none')
    }else{
        a1.classList.add('d-none')
        a2.classList.remove('d-none')
    }
}