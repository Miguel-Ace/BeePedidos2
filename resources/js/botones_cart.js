const buttons = document.querySelector('.button')
const counts = document.querySelectorAll('.detalle-carrito')
const products = document.querySelectorAll('.productos')

setTimeout(() => {
    saberCantidad()
}, 300);

buttons.addEventListener('click', () => {
    boton.disabled = true
    saberCantidad()
    setTimeout(() => {
        boton.disabled = false
    }, 300);
})

function saberCantidad() {
    counts.forEach(item => {
        const idcart = item.querySelector('.id')
        const cantidad = item.querySelector('.detalle-producto .count')
        // console.log(item);
        pasarDatos(idcart.textContent, cantidad.textContent)
    });
}

function pasarDatos(idCart, existencias) {
    products.forEach(item => {
        const id = item.querySelector('.id-producto').textContent
        const boton = item.querySelector('.button')
        const existencia = item.querySelector('.existencia span').textContent
        const nombre = item.querySelector('.descuento p')

        if (parseInt(idCart) == parseInt(id)) {
            if (parseInt(existencias) == parseInt(existencia)) {
                console.log(item);
                boton.disabled = true
                boton.style = 'opacity:.5'
            }
            // console.log(existencia);
            // console.log(existencias);
        }
        // boton.addEventListener('click', () => {
        // })
    });
}
